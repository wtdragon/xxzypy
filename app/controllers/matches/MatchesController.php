<?php

namespace App\Controllers\Matches;
 
use Area,City,College,School,Province;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;

class MatchesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /college/articles
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		$authentication = \App::make('authenticator');
		if($loggeduser)
		   {
		return \View::make('matches.index');
		  
		   }
		else {
		 	$logged='not login';
		   	return \View::make('users.login');
		}
		
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /college/articles/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		return \View::make('specialties.articles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /college/articles
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}
    public function specialtysearch()
	{
		//
		//
		$inputData = Input::get('specialty'); 
		$specialty = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$schools = School::search($specialty)->paginate(20);
		$provinces=Province::All();
		return \View::make('specialties.search.index')->with('schoolss',$schools)
                                                   ->with('provinces',$provinces);
	}
	/**
	 * Display the specified resource.
	 * GET /college/articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$authentication = \App::make('authenticator');
		return \View::make('colleges.articles.show')->with('article', Article::find($id))->withAuthor($authentication->getUserById(Article::find($id)->user_id)->name);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /college/articles/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		return \View::make('colleges.articles.edit')->with('article', article::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /college/articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /college/articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$article = article::find($id);
$article->delete();
Notification::success('删除成功！');
return Redirect::route('colleges.articles.index');
	}

}