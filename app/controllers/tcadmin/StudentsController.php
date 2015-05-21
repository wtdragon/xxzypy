<?php
namespace App\Controllers\Tcadmin;
 
use Area,City,College,School,Province,User,UserProfile,ProfileField,Teacher,Student,Sclass,Grade,Ktest,Kresult;
use Input, Notification, Redirect, Sentry, Str,DB;

use App\Services\Validators\AdminValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Ktest\Kclasses;
class StudentsController extends \BaseController {

	/**
	 * Show the form for creating a new resource.
	 * GET /tcadmin/tcadmin/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
			
	}
    /**
	 * Show the form for creating a new resource.
	 * GET /tcadmin/tcadmin/create
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
		$sclasses=Sclass::where('tid', '=',$teacher->id)->get();
			$niandu=Grade::distinct()->lists('niandu');
		$banji=Sclass::distinct()->lists('classname');
	
	    $classid=$sclasses->toArray();
		$students=Student::whereIn('sclassid',array_fetch($classid, 'id'))->paginate(10);
		return \View::make('tcadmin.students.index')->with('niandu',$niandu)
		                                            ->with('banji',$banji)
													->with('students',$students);
	}
		else {
			{
				return "not a teacher";
			}
		}
	}
	/**
	 * Show the form for creating a new resource.
	 * GET /tcadmin/tcadmin/create
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
	 * POST /tcadmin/tcadmin
	 *
	 * @return Response
	 */
/**
	 * Store a newly created resource in storage.
	 * POST /tcadmin/tcadmin
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
$asclass=Sclass::where('classname','=',$classname)->first();
if($asclass)
{
//var_dump($classid);
//$student->classname = $classname;
$student->sclassid=$asclass->id;
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
return Redirect::route('tcadmin.students.edit', $student->id);
}
else {
	Notification::success('班级不存在，请先添加班级！');
return Redirect::route('tcadmin.students.index');
}
}
return Redirect::back()->withInput()->withErrors($validation->errors);
}
	/**
	 * Display the specified resource.
	 * GET /tcadmin/tcadmin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}
    /**
	 *  ajax ktest data.
	 * GET /tcadmin/tcadmin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function ajaxktest()
	{
		$stuname= Input::get('stuname');
		$student=Student::whereraw("stuname = '$stuname'")->first();  
		$ktest=Kresult::where('kuser_id','=',$student->kuser_id); 
		   $kclass=new Kclasses("singapore");
          $kuserId=$student->kuser_id;
		   $kurl=$kclass->getkLsiUrl($kuserId);
         if ($ktest->count())
	       {
	       	 
			 return \Response::view('ajaxview', array('kurl' => $kurl));
			 }
else {
	 return '此同学未进行职业测试';
}
	}
	/**
	 * Show the form for editing the specified resource.
	 * GET /tcadmin/tcadmin/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
		public function edit($id)
	{
		//
		return \View::make('tcadmin.students.edit')->with('students', Student::find($id));
 
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
        	$loggeduser=\App::make('authenticator')->getLoggedUser();
		$loginteacher = array_search('teacher', $loggeduser->permissions);
        $authentication = \App::make('authenticator');
		$teacher=Teacher::whereRaw("user_id = '$loggeduser->id'")->first();	 
            $student =new Student;
$classname=$row->classname;			
$asclass=Sclass::where('classname','=',$classname)->first();
//var_dump($classid);
//$student->classname = $classname;
$student->sclassid=$asclass->id;
$student->mschoolid=$teacher->mschoolid;
$student->stuname = $row->stuname;
$student->stuno = $row->stuno;
$student->emailaddress = $row->emailaddress;
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
$student->save();   } 
});
Notification::success('批量新增学生成功！');
return Redirect::route('tcadmin.students.index');
} else {
   return Response::json('error', 400);
}
 
	}
	/**
	 * Update the specified resource in storage.
	 * PUT /tcadmin/tcadmin/{id}
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
$classid=Sclass::where('classname','=',Input::get('classname'))->first();
if($classid){
$student->sclassid=$classid->id;
$student->emailaddress = Input::get('emailaddress');
$student->save();

//var_dump(Input::get('classname'));
Notification::success('更新学生成功！');
return Redirect::route('tcadmin.students.edit', $students->id);
}
else 
	{
		Notification::success('班级不存在，请先添加班级！');
return Redirect::route('tcadmin.students.index');
	}
}
return Redirect::back()->withInput()->withErrors($validation->errors);
	}


	/**
	 * Remove the specified resource from storage.
	 * DELETE /tcadmin/tcadmin/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		
		$student =Student::find($id);
$student->delete();
Notification::success('删除成功！');
return Redirect::route('tcadmin.students.index');
	}

}