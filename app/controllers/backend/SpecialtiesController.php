<?php
namespace App\Controllers\Backend;
 
use Area,City,College,Specialty,Province,UserProfile,ProfileField,Ktest,Kresult,Teacher,Student,Zylb;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class SpecialtiesController extends \BaseController {


	
		/**
	 * Display a listing of the resource.
	 * GET /backend/backend
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		
		//var_dump($userinfo);
		//var_dump($userprofile->first_name);
		    if($loggeduser)
			{
		     $userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		     $userprofile=UserProfile::find($loggeduser->id);
			 $pre_page = 20;//每页显示页数
		     $specialties = Zylb::paginate($pre_page);
			 
		     return \View::make('backend.specialties')->with('user',$userprofile)
			                                       ->with('specialties',$specialties);
			}
			else{
		 	$logged='not login';
		   	return \View::make('users.login');
		}
	}
			/**
	 * Display a listing of the resource.
	 * GET /backend/backend
	 *
	 * @return Response
	 */
	public function carticles()
	{
		//
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		
		//var_dump($userinfo);
		//var_dump($userprofile->first_name);
		    if($loggeduser)
			{
				$userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		$userprofile=UserProfile::find($loggeduser->id);
		return \View::make('backend.carticles')->with('user',$userprofile);
			}
			else{
		 	$logged='not login';
		   	return \View::make('users.login');
		}
	}
			/**
	 * Display a listing of the resource.
	 * GET /backend/backend
	 *
	 * @return Response
	 */
	public function specialties()
	{
		//
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		
		//var_dump($userinfo);
		//var_dump($userprofile->first_name);
		    if($loggeduser)
			{
				$userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		$userprofile=UserProfile::find($loggeduser->id);
		return \View::make('backend.specialties')->with('user',$userprofile);
			}
			else{
		 	$logged='not login';
		   	return \View::make('users.login');
		}
	}
	/**
	 * Show the form for creating a new resource.
	 * GET /backend/backend/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /backend/backend
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /backend/backend/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /backend/backend/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		$userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		$userprofile=UserProfile::find($loggeduser->id);
		$college=null;	 
		return \View::make('backend.edit')->with('user',$userprofile)
										  ->with('carticle', null)
										  ->with('mschool', null)
		                                  ->with('college', null)
		                                  ->with('specialty',Zylb::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /backend/backend/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
$zylb =Zylb::find($id);
$zylb->yxmc = Input::get('yxmc');
$zylb->cengci = Input::get('cengci');
$zylb->zymingcheng = Input::get('zymingcheng');
$zylb->kelei = Input::get('kelei');
$zylb->pici = Input::get('pici');
$zylb->jihuaxingzhi = Input::get('jihuaxingzhi');
 
 

$zylb->save();


Notification::success('更新成功！');
return Redirect::route('backend.specialties.index');	
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /backend/backend/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$zylb=Zylb::find($id);
		$zylb->delete();
Notification::success('删除成功！');
return Redirect::route('backend.specialties.index');
	}

}