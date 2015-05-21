<?php

namespace App\Controllers\Users;
 
use Area,City,College,School,Province,UserProfile,ProfileField,Ktest,Student;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;

class KtestController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /college/articles
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$accountId = 1000001;
		$accountId = $_GET['accountId'];
        $userId = $_GET['userId'];
        $configId = $_GET['configId'];

        $accountKey = "deI%2BKwrnkhenLX"; 
        $accountPassword = "d1SLnDVAbxKxOid5"; 

        $environment = "singapore";

        $hesClient = new HesClient($environment);
        $nonce = $hesClient->handshake($accountId, $accountPassword, $accountKey);
		if($userId){
        $userId = $hesClient->encryptMe($userId, $accountKey);
        $fullLoginUrl = $hesClient->getLoginUrl($accountId, $configId, $userId, $nonce);
		}
		else {
		$loggeduser=\App::make('authenticator')->getLoggedUser();
			
		}
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		$authentication = \App::make('authenticator');
		if($loggeduser)
		   {
             
		   	  $student=Student::whereraw("user_id = $loggeduser->id")->first();
			 
			  //$xuehao=ProfileField::whereRaw("profile_id = '$userprofile->id' and profile_field_type_id = 2")->pluck('value');
			// $arr1 = json_decode(json_encode($xuehao),TRUE);
			// $userprofile->xuehao=$arr1["value"];
			
		    // $xihao=ProfileField::whereRaw("profile_id = '$userprofile->id' and profile_field_type_id = 3")->pluck('value');
			 // $arr2 = json_decode(json_encode($xihao),TRUE);
			 // $userprofile->xihao=$arr2["value"];
			
			// $userprofile->xuehao=$xuehao;
			// $userprofile->xihao=$xihao;
		return \View::make('users.ktest.index')->with('user',$student)
		                                 ->with('fullLoginUrl',$fullLoginUrl)
		                            ;
		  
		   }
		else {
		 	$logged='not login';
		   	return \View::make('users.login');
		}
		
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
    public function collects()
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
		return \View::make('users.collects.index');
	}
	  public function matches()
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
		return \View::make('users.matches.index');
	}
	  public function specialties()
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
		return \View::make('users.specialties.index');
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