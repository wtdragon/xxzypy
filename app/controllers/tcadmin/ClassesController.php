<?php
namespace App\Controllers\Tcadmin;
 
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
		if (array_key_exists('_teacher',$loggeduser->permissions))
		{
			//var_dump($loggeduser->id);
		$teacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();
			//var_dump($teacher->teachername);
		$sclasses=Sclass::where('tid', '=',$teacher->id)->get();
	   // var_dump($sclasses->classname);
	   //$classes=$sclasses->toArray();
		 return \View::make('tcadmin.classes.index')->with('classes', $sclasses);
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
		$teacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();
$sclass = new Sclass;
$sclass->classname = Input::get('classname');
$sclass->tid = $teacher->id;
$sclass->save();
var_dump(Input::get('classname'));
Notification::success('新增班级成功！');
return Redirect::route('gxadmin.classes.edit', $sclass->id);
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