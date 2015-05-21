<?php
namespace App\Controllers\Backend;
 
use Area,City,College,School,Province,UserProfile,ProfileField,Ktest,Kresult,Teacher,Student;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class CollegesController extends \BaseController {

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
		$ccounts=College::All()->count();
		$mcounts=School::All()->count();
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
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		 $userinfo=\App::make('authenticator')->getUserById($loggeduser->id);
		     $userprofile=UserProfile::find($loggeduser->id);
			 
		return \View::make('backend.edit')->with('user',$userprofile)
		                                  ->with('specialty', null)
										  ->with('carticle', null)
										  ->with('mschool', null)
		                                  ->with('college', College::find($id));
 
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
		var_dump('test');
		$college =College::find($id);
$college->name = Input::get('name');
$college->paiming = Input::get('paiming');
$college->is985 = Input::get('is985');
$college->is211 = Input::get('is211');
$college->lishu = Input::get('lishu');
$college->juban = Input::get('juban');
$college->leixing = Input::get('leixing');
$college->kelei = Input::get('kelei');
 

$college->save();

Notification::success('更新成功！');
return Redirect::route('backend.colleges.index');	 
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
			$college =College::find($id);
$college->delete();
Notification::success('删除成功！');
return Redirect::route('backend.colleges.index');
	}

}