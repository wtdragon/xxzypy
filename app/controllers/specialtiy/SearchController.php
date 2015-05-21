<?php

namespace App\Controllers\Specialtiy;
 
use Area,City,College,Specialty,Province,Zylb,Tzy,Flzhuanye,Yierjifl,Zjfl;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;

class SearchController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /college/articles
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$pre_page = 20;//每页显示页数
		$schools = Zylb::paginate($pre_page);
		$ptzys=Yierjifl::distinct()->select('yijimc','id')->groupBy('yijimc')->get();
		$tszys=Yierjifl::distinct()->select('erjimc','id')->groupBy('erjimc')->get();
		$flzhuanye=Flzhuanye::All();
		$bkfl=Zjfl::where('cengci','=',2)->get();
		$zkfl=Zjfl::where('cengci','=',1)->get();
		$provinces=Province::All();
		return \View::make('specialties.search.index')->with('schools',$schools)
                                                      ->with('provinces',$provinces)
												      ->with('bkfl',$bkfl)
												      ->with('zkfl',$zkfl);
		
	}
    
	
	//search  specialty by zhuanyemingcheng
	
	public function showsspec($specname)
	{
		//
		 //return $coid;
		  $pre_page = 20;//每页显示页数
		  $schools = Zylb::search($specname)->paginate(20);
		  $zy=Flzhuanye::where('zymc','=',$specname)->first();
		  $ptzys= Tzy::distinct()->select('mkml','id')->where('tszy', '=', 0)->groupBy('mkml')->get();
		  $tszys= Tzy::distinct()->select('mkml','id')->where('tszy', '=', 1)->groupBy('mkml')->get();
		
		  $provinces= Province::All();
		  return \View::make('specialties.search.show')->with('schools',$schools)
                                                        ->with('provinces',$provinces)
												        ->with('zy',$zy)
												        ->with('tszys',$tszys);
			 
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
	//specialies use name to search
	
    public function specsearch()
	{
		//
		//
		$inputData = Input::All(); 
		var_dump($inputData);
		$specialty = $inputData['title'];
		$zy=Flzhuanye::where('zymc','=',$specialty)->first();
		 $schools = Zylb::search($specialty)->paginate(20);
		  $ptzys= Tzy::distinct()->select('mkml','id')->where('tszy', '=', 0)->groupBy('mkml')->get();
		  $tszys= Tzy::distinct()->select('mkml','id')->where('tszy', '=', 1)->groupBy('mkml')->get();
	
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
          $provinces= Province::All();
   return \View::make('specialties.search.show')->with('schools',$schools)
                                                        ->with('provinces',$provinces)
												        ->with('zy',$specialty)
												        ->with('tszys',$tszys);
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
		return \View::make('specialties.search.show')->with('article', Article::find($id))->withAuthor($authentication->getUserById(Article::find($id)->user_id)->name);
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