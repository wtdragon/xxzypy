<?php
namespace App\Controllers\Gxadmin;
 
use Area,City,College,School,Province,User,UserProfile,ProfileField,Teacher,Student,Sclass,Ktest;
use Input, Notification, Redirect, Sentry, Str,DB;

use App\Services\Validators\AdminValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;

class StudentsController extends \BaseController {

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
			//var_dump($loggeduser->id);
		$teacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();
			//var_dump($teacher->teachername);
		//var_dump($teacher->id);	
		//$class_tongjis =  DB::table('students')
         //   ->select((DB::raw('count(*) as student_count, classname')))
          //  ->groupBy('classname')
          //  ->get();
		//var_dump($class_tongji);
		//var_dump($teacher->teachername);
		$sclasses=Sclass::where('tid', '=',$teacher->id)->get();
	   // var_dump($sclasses->classname);
	   $classid=$sclasses->toArray();
	   
	   //var_dump(array_fetch($classid, 'id'));
		$students=Student::wherein('classid',array_fetch($classid, 'id'))->get();
		return \View::make('gxadmin.students.index')->with('students',$students);
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
		
$validation = new AdminValidator;
if ($validation->passes())
{
	$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
        $authentication = \App::make('authenticator');
 
$student =new Student;
$student->stuname = Input::get('stuname');
$student->stuno = Input::get('stuno');
$classname = Input::get('classname');
$student->emailaddress = Input::get('emailaddress');

//var_dump($classname);
$asclass=Sclass::where('classname','=',$classname)->firstOrFail();
//var_dump($classid);
$student->classname = $classname;
$student->classid=$asclass->id;
$data = array(
                "email"     => $student->emailaddress,
                "password"  => 123456,
                "activated" => 1,
                "banned"    =>  0,
                'permissions' => array("_student" => 1 )
        );
//use sentry create a user		
$user=\Sentry::createUser($data);	
//var_dump($user);
//var_dump($student->classid);
 $environment = "singapore";
 $hesClient = new HesClient($environment);
 $accountId = 1000001;
 $accountKey = "deI%2BKwrnkhenLX"; 
 $accountPassword = "d1SLnDVAbxKxOid5"; 
 $arr = array("user_type_id"=> 1,
                 "first_name"=> "$student->stuname",
                 "last_name"=> "$student->stuname",
                 "email_address"=> "$student->emailaddress",
                 "username"=> "$student->emailaddress",
                 "gender"=> "F",
                 "under_13"=> 0);
//$arr=json_encode($arr);				 
$nonce=$hesClient->handshake($accountId,$accountPassword,$accountKey);
$kuser=$hesClient->createUser($accountId,$nonce,$arr);  
	 $de_json = json_decode($kuser,true);
	    $count_json = count($de_json);
           for ($i = 0; $i < $count_json; $i++)
             {      
	      $ktest_id = $de_json[$i]['id'];
	      }
	$student->user_id=$user->id;
$student->kuser_id=$ktest_id;
$student->save();
//var_dump(Input::get('classname'));
Notification::success('新增学生成功！');
return Redirect::route('gxadmin.students.edit', $student->id);
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