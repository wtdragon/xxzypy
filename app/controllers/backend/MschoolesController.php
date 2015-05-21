<?php
namespace App\Controllers\Backend;
 
use Area,City,College,Mschool,Province,UserProfile,ProfileField,Ktest,Kresult,Teacher,Student;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Validators\TeacherValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class MschoolesController extends \BaseController {

	
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
		     $mschools = Mschool::paginate($pre_page);
			 
		     return \View::make('backend.mschools')->with('user',$userprofile)
			                                       ->with('mschools',$mschools);
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
				
$validation = new TeacherValidator;
if ($validation->passes())
{
	 
$mschool =new Mschool;
$mschool->schoolname = Input::get('schoolname');
$teachername= Input::get('teachername');
$teacher_email = Input::get('emailaddress');
$teacher_phone = Input::get('phone');
$newteacher =new Teacher;
$newteacher->teachername=$teachername;
$newteacher->emailaddress=$teacher_email;
$data = array(
                "email"     => $teacher_email,
                "password"  => 123456,
                "activated" => 1,
                "banned"    =>  0,
                'permissions' => array("_teacher" => 1,"_mschool" => 1 )
        );
//use sentry create a user		
$user=\Sentry::createUser($data);	
$newteacher->user_id=$user->id;
$newteacher->phone=$teacher_phone;
$newteacher->save();
$mschool->tcid=$newteacher->id;
$mschool->save();

$mteacher = Teacher::find($newteacher->id);

$mteacher->mschoolid = $mschool->id ;

$mteacher->save();
//var_dump(Input::get('classname'));
Notification::success('新增受管学校成功！');
return Redirect::route('backend.mschools.index');
}
return Redirect::back()->withInput()->withErrors($validation->errors);
		
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
		                                  ->with('college',null)
		                                  ->with('specialty', null)
										  ->with('carticle', null)
										  ->with('mschool', Mschool::find($id));
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
		$mschool =Mschool::find($id);
$mschool->schoolname = Input::get('schoolname');
$mschool->save();
$teachername= Input::get('teachername');
$teacher=Teacher::find($mschool->tcid);
 
$teacher->teachername=$teachername;
$teacher->save();
//var_dump(Input::get('classname'));
Notification::success('更新成功！');
return Redirect::route('backend.mschools.index');	}

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
		$mschool =Mschool::find($id);
$mschool->delete();
Notification::success('删除成功！');
return Redirect::route('backend.mschools.index');
	}

}