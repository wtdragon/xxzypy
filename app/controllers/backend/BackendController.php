<?php
namespace App\Controllers\Backend;
 
use Area,City,College,Specialty,Province,UserProfile,ProfileField,Ktest,Kresult,Teacher,Student;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class BackendController extends \BaseController {

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
		$ccounts=College::All()->count();
		$mcounts=Specialty::All()->count();
		$kcounts=Ktest::All()->count();
		$stucounts=Student::All()->count();
		$teccounts=Teacher::All()->count();
		$tongji=new \stdClass; 
		$tongji->cct=$ccounts;
		$tongji->mct=$mcounts;
		$tongji->kct=$kcounts;
		$tongji->stuct=$stucounts;
		$tongji->tect=$teccounts;
		//var_dump($userinfo);
		//var_dump($userprofile->first_name);
		    if($loggeduser)
			{
				$userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		$userprofile=UserProfile::find($loggeduser->id);
		return \View::make('backend.dashboard')->with('user',$userprofile)
		                                       ->with('tongji',$tongji);
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
	public function charts()
	{
		//
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		
		//var_dump($userinfo);
		//var_dump($userprofile->first_name);
		    if($loggeduser)
			{
				$userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		$userprofile=UserProfile::find($loggeduser->id);
		return \View::make('backend.charts')->with('user',$userprofile);
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
	public function colleges()
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
		     $colleges = College::paginate($pre_page);
			 
		     return \View::make('backend.colleges')->with('user',$userprofile)
			                                       ->with('colleges',$colleges);
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
		//
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
	}

}