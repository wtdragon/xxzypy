<?php

namespace App\Controllers\College;
 
use Article;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\ArticleValidator;

class ArticlesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /college/articles
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return \View::make('colleges.articles.index')->with('articles', Article::all());
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
		return \View::make('colleges.articles.create');
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
		$validation = new ArticleValidator;
            if ($validation->passes())
            {
              $article = new Article;
              $article->title = Input::get('title');
              $article->body = Input::get('body');
              $article->user_id = Sentry::getUser()->id;
              $article->save();
              Notification::success('新增页面成功！');
              return Redirect::route('colleges.articles.edit', $article->id);
	}
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