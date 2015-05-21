<?php
namespace App\Controllers\Gxadmin;
 
use Area,City,College,School,Province,User,UserProfile,ProfileField,Teacher,Student,Sclass,Ktest,Grade;
use Input, Notification, Redirect, Sentry, Str,DB;

use App\Services\Validators\HistoryValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;

class HistoryController extends \BaseController {

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
		$niandu=Grade::distinct()->lists('niandu');
		$banji=Sclass::distinct()->lists('classname');
		$sclasses=Sclass::where('tid', '=',$teacher->id)->get();
	    $classid=$sclasses->toArray();
		$students=Student::wherein('sclassid',array_fetch($classid, 'id'))->get();
		return \View::make('gxadmin.history.index')->with('students',$students)
		                                           ->with('banji',$banji)
		                                           ->with('niandu',$niandu);
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
		return \View::make('gxadmin.students.edit')->with('students', Student::find($id));
 
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
$validation = new AdminValidator;
if ($validation->passes())
{
	$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
        $authentication = \App::make('authenticator');
$student =Student::find($id);
$student->stuname = Input::get('stuname');
$student->stuno = Input::get('stuno');
$student->classname = Input::get('classname');
$student->emailaddress = Input::get('emailaddress');
$student->save();
//var_dump(Input::get('classname'));
Notification::success('更新学生成功！');
return Redirect::route('gxadmin.students.edit', $student->id);
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
		
		$student =Student::find($id);
$student->delete();
Notification::success('删除成功！');
return Redirect::route('gxadmin.students.index');
	}

}