<?php
namespace App\Controllers\Gxadmin;
 
use Area,City,College,School,Province,User,UserProfile,ProfileField,Teacher,Student,Sclass,Ktest;
use Input, Notification, Redirect, Sentry, Str,DB;

use App\Services\Validators\TeacherValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;

class TeachersController extends \BaseController {

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
		if (array_key_exists('_teacher',$loggeduser->permissions)){
		$teacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();
		$teachers=Teacher::where('mschoolid','=',$teacher->mschoolid)->get();
		return \View::make('gxadmin.teachers.index')->with('teachers',$teachers);
	}
		else {
			{
				return "not a teacher";
			}
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
			$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
		$mteacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();
$validation = new TeacherValidator;
if ($validation->passes())
{
$teacher =new Teacher;
$teacher->teachername = Input::get('teachername');
$teacher->phone = Input::get('phone');
$teacher->emailaddress = Input::get('emailaddress');
$teacher->mschoolid = $mteacher->mschoolid;

$data = array(
                "email"     => $teacher->emailaddress,
                "password"  => 123456,
                "activated" => 1,
                "banned"    =>  0,
                'permissions' => array("_teacher" => 1 )
        );
//use sentry create a user		
$user=\Sentry::createUser($data);	
$teacher->user_id=$user->id;
$teacher->save();
Notification::success('新增教师成功！');
return Redirect::route('gxadmin.teachers.index');
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
		return \View::make('gxadmin.teachers.edit')->with('teachers', Teacher::find($id));
 
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
$validation = new TeacherValidator;
if ($validation->passes())
{
	$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
        $authentication = \App::make('authenticator');
$teacher =Teacher::find($id);
$teacher->teachername = Input::get('teachername');
$teacher->classname = Input::get('classname');
$teacher->phone = Input::get('phone');
$teacher->emailaddress = Input::get('emailaddress');
$teacher->save();
  $user = Sentry::findUserById($teacher->user_id);

    // Update the user details
    $user->email = Input::get('emailaddress');
 

    // Update the user
 $user->save();
//var_dump(Input::get('classname'));
Notification::success('更新教师成功！');
return Redirect::route('gxadmin.teachers.edit', $teacher->id);
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
		
		$teacher =Teacher::find($id);
$teacher->delete();
Notification::success('删除成功！');
return Redirect::route('gxadmin.teachers.index');
	}

}