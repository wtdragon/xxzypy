<?php
namespace App\Controllers\Gxadmin;
 
use Area,City,College,School,Province,UserProfile,ProfileField,Teacher,Student,Sclass;
use Input, Notification, Redirect, Sentry, Str,DB;

use App\Services\Validators\AdminValidator;

class ClassesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /gxadmin/gxadmin
	 *
	 * @return Response
	 */
 

	/**
	 * Show the form for creating a new resource.
	 * GET /gxadmin/gxadmin/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
			
	}
    /**
	 * Show the form for creating a new resource.
	 * GET /gxadmin/gxadmin/create
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
        $authentication = \App::make('authenticator');
		if (array_key_exists('_mschool',$loggeduser->permissions))
		{
		$teacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();
		$sclasses=Sclass::where('mschoolid','=',$teacher->mschoolid)->get();
		$banji=Sclass::distinct()->lists('classname');
		 return \View::make('gxadmin.classes.index')->with('classes', $sclasses)
		                                            ->with('banji', $banji);
	}
		else {
			return "not a teacher";
		}
	}
	/**
	 * Show the form for creating a new resource.
	 * GET /gxadmin/gxadmin/create
	 *
	 * @return Response
	 */
	public function students()
	{
		//
		return "students";
			
	}
	/**
	 * Store a newly created resource in storage.
	 * POST /gxadmin/gxadmin
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		
$validation = new AdminValidator;
if ($validation->passes())
{
	$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
        $authentication = \App::make('authenticator');
		$inputtname=Input::get('teachername');
		$mteacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();
		$teacher=Teacher::where('teachername','=',$inputtname)->first();
		if($teacher){$sclass = new Sclass;
$sclass->classname = Input::get('classname');
$sclass->stucount = Input::get('stucount');
$sclass->other = Input::get('other');
	var_dump($teacher);
$sclass->tid = $teacher->id;
$sclass->mschoolid = $mteacher->mschoolid;
$sclass->save();
Notification::success('新增班级成功！');
return Redirect::route('gxadmin.classes.index');
		}
		else{
			Notification::success('教师不存在，请先添加教师！');
return Redirect::route('gxadmin.classes.index');
		}
}
return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Display the specified resource.
	 * GET /gxadmin/gxadmin/{id}
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
	 * GET /gxadmin/gxadmin/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		return \View::make('gxadmin.classes.edit')->with('classes', Sclass::find($id));
 
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /gxadmin/gxadmin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
public function update($id)
{
		//
$validation = new AdminValidator;
if ($validation->passes())
{
	$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
        $authentication = \App::make('authenticator');
		$teacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();
$sclass =Sclass::find($id);
$sclass->classname = Input::get('classname');
$sclass->save();
//var_dump(Input::get('classname'));
Notification::success('更新班级成功！');
return Redirect::route('gxadmin.classes.edit', $sclass->id);
}
return Redirect::back()->withInput()->withErrors($validation->errors);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /gxadmin/gxadmin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
public function destroy($id)
	{
		//
		
		$sclass =Sclass::find($id);
$sclass->delete();
Notification::success('删除成功！');
return Redirect::route('gxadmin.classes.index');
	}

}