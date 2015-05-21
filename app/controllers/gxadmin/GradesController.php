<?php
namespace App\Controllers\Gxadmin;
 
use Area,City,College,School,Province,Grade,User,UserProfile,ProfileField,Teacher,Student,Sclass,Ktest;
use Input, Notification, Redirect, Sentry, Str,DB;

use App\Services\Validators\GradeValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;

class GradesController extends \BaseController {

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
		$authentication = \App::make('authenticator');
		  if($loggeduser)
      {
      	  
		if (array_key_exists('_mschool',$loggeduser->permissions)){
			
		$teacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();
		$grades=Grade::where('tid', '=',$teacher->id)->get();
		$niandu=Grade::distinct()->lists('niandu');
		$banji=Sclass::distinct()->lists('classname');
		$teachers=Teacher::where('mschoolid','=',$teacher->mschoolid)->get();
		return \View::make('gxadmin.grades.index')->with('grades',$grades)
		                                          ->with('niandu',$niandu);
			
		}
		else {
			return "您没有权限，请询问管理员";
		}
		}
		  else {
		  		$logged='not login';
		   	return \View::make('users.login');
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
/**
	 * Store a newly created resource in storage.
	 * POST /gxadmin/gxadmin
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		
$validation = new GradeValidator;
if ($validation->passes())
{
$loggeduser=\App::make('authenticator')->getLoggedUser();
$teacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();
$grade =new Grade;
$grade->gradename = Input::get('gradename');
$grade->tid=$teacher->id;
$grade->stucount = Input::get('stucount');
$grade->niandu = Input::get('niandu');
$grade->save();
	
//var_dump(Input::get('classname'));
Notification::success('新增年级成功！');
return Redirect::route('gxadmin.grades.index');
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
		return \View::make('gxadmin.grades.edit')->with('grades', Grade::find($id));
 
	}
	
    /**
	 * 处理excel 数据 the form for editing the specified resource.
	 *    
	 *
	 * @param  int  $id
	 * @return Response
	 */
		public function excel()
	{
		//
		$file = Input::file('file'); // your file upload input field in the form should be named 'file'

$destinationPath = 'uploads/';
$filename = $file->getClientOriginalName();
//$extension =$file->getClientOriginalExtension(); //if you need extension of the file
$uploadSuccess = Input::file('file')->move($destinationPath, $filename);
$file=$destinationPath . $filename;
if( $uploadSuccess ) {
    \Excel::load($file, function($reader) {

    // Getting all results
    $results = $reader->get();

    // ->all() is a wrapper for ->get() and will work the same
    $results = $reader->all();
	$uploadstudents=$reader->select(array('stuno', 'stuname','classname','emailaddress'))->get();
	   foreach($uploadstudents as $row)
        { 
            $student =new Student;
$student->stuname = $row->stuname;
$student->stuno = $row->stuno;
$student->classname = $row->classname;
$student->emailaddress = $row->emailaddress;
$student->save();   } 
});
Notification::success('批量新增学生成功！');
return Redirect::route('gxadmin.students.index');
} else {
   return Response::json('error', 400);
}
 
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
$validation = new GradeValidator;
if ($validation->passes())
{
	$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
        $authentication = \App::make('authenticator');
$grade =Grade::find($id);
$grade->niandu = Input::get('niandu');
$grade->gradename = Input::get('gradename');
$grade->stucount = Input::get('stucount');
$grade->save();
//var_dump(Input::get('classname'));
Notification::success('更新年级成功！');
return Redirect::route('gxadmin.grades.edit', $grade->id);
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
		
		$grade =Grade::find($id);
$grade->delete();
Notification::success('删除成功！');
return Redirect::route('gxadmin.grades.index');
	}

}