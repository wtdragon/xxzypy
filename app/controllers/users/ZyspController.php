<?php

namespace App\Controllers\Users;
 
use Area,City,College,Specialty,Province,Kcms_video,Kcms_list,UserProfile,ProfileField,Zylb,Ktest,Kresult,Flzhuanye,Student;
use Input, Notification, Redirect, Sentry, Str;

use App\Services\Validators\PageValidator;
use App\Services\Ktest\Cryptographer;
use App\Services\Ktest\HesClient;
use App\Services\Ktest\Kclasses;
use App\Services\Sclass\JsonArrayHandle;
use SoapBox\Formatter\Formatter;

class ZyspController extends \BaseController {
		
	
 

	public function index()
{
	    
		$klists=Kcms_list::where('listid1','=',5)->orderBy('listimg')->get();  
		return \View::make('users.zysp.index')
		                   ->with('klists',$klists);
						                

}
 
	/**
	 * Store a newly created resource in storage.
	 * POST /college/articles
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}
    public function collects()
	{
		//
		//
		$inputData = Input::get('specialty'); 
		$specialty = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$schools = Specialty::search($specialty)->paginate(20);
		$provinces=Province::All();
		return \View::make('users.collects.index');
	}
	 public function colleges()
	{
		//
		//
		$inputData = Input::get('specialty'); 
		$specialty = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$schools = Specialty::search($specialty)->paginate(20);
		$provinces=Province::All();
		return \View::make('users.collects.colleges');
	}
		 public function splist($id)
	{
		//
		//

 
		$klist = Kcms_list::where('listid1','=',$id)->lists('listid');
		//var_dump($klist);
		$kvideolists=Kcms_video::whereIn('listid',$klist)->get();
  //var_dump($kvideolists);
		return \View::make('users.zysp.videolist')
		                    ->with('kvideolists',$kvideolists);
	}
	 public function showvideo($id)
	{
		 
		$video=Kcms_video::where('listid','=',$id)->first();
		//var_dump($video);
  //var_dump($kvideolists);
		return \View::make('users.zysp.showvideo')
		                    ->with('video',$video);
	}
	 public function others()
	{
		//
		//
		$inputData = Input::get('specialty'); 
		$specialty = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$schools = Specialty::search($specialty)->paginate(20);
		$provinces=Province::All();
		return \View::make('users.collects.others');
	}
	 public function specialites()
	{
		$inputData = Input::get('specialty'); 
		$specialty = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$schools = Specialty::search($specialty)->paginate(20);
		$provinces=Province::All();
		return \View::make('users.collects.specialites');
		
	}
	 public function training()
	{
		//
		//
		$inputData = Input::get('specialty'); 
		$specialty = $inputData;
		$provinces=Province::All();
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $pre_page = 20;//每页显示页数
		$schools = Specialty::search($specialty)->paginate(20);
		$provinces=Province::All();
		return \View::make('users.collects.training');
	}
    // for colleges use ktest
	  public function matches()
	{
		//
		//
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
   		$student=Student::whereraw("user_id = $loggeduser->id")->first();  
         
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $ktests=Ktest::distinct()->select('co_id','id')->where('user_id','=',$loggeduser->id)->groupBy('co_id')->get();
	     $student=Student::whereraw("user_id = $loggeduser->id")->first();  
		$ktest1st=Ktest::where('user_id','=',$loggeduser->id)->first();
	    $kclass=new Kclasses("singapore");
          $kuserId=$student->kuser_id;
          //$kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		 $kurl=$kclass->getkLsiUrl($kuserId);
			if(!$ktest1st)
		{
			$kresult="你还没做过测试";
				return \View::make('users.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
						                 ->with('kresult',$kresult);
						                 } 
else{
		
		
		
		$collegename=Zylb::where('coid','=',$ktest1st->coid)->distinct()->first();
        $zylbs =Zylb::search($ktest1st->co_id)->distinct()->paginate(10);
        
		return \View::make('users.matches.index')->with('ktests',$ktests)
		->with('user',$student)
		                                             ->with('ktest1st',$ktest1st)
		                                             ->with('zylbs',$zylbs);
	}
	}

   // college search use spec name for filter
      public function specfilter($filter)
	{
		//
		//
			 
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
			$collegename=$filter;
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
   		$student=Student::whereraw("user_id = $loggeduser->id")->first();  
         
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
       $ktests=Ktest::distinct()->select('co_id','id')->where('user_id','=',$loggeduser->id)->groupBy('co_id')->get();
	    $configId = 104;  //lsi
        $accountId = 1000001;
        $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
        $bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
        $kuserId=$student->kuser_id;
		  $ktest1st=Ktest::where('co_id','=',$collegename)->first();
		  	$zyjs=Flzhuanye::where('zymc','=',$ktest1st->zymc)->first();
			$mzyjs= preg_replace("/(。)/", "/(。)/</p><p>", $zyjs->zyjs);
		$ktest1st->zyjs=$mzyjs;
	 
        $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
	
			if(!$ktest1st)
		{
			$kresult="你还没做过测试";
				return \View::make('users.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
						                 ->with('kresult',$kresult);
						                 } 
else{
		
		
		
	
	  
        $zylbs =Zylb::where('coid','=',$collegename)->distinct()->paginate(10);
        
		return \View::make('users.matches.index')->with('ktests',$ktests)
		->with('user',$student)
		                                             ->with('ktest1st',$ktest1st)
		                                             ->with('zylbs',$zylbs);
	}
	}
   // get spec use ktest
	  public function colfilter($filter)
	{
		//
		//
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		 $student=Student::whereraw("user_id = $loggeduser->id")->first();  
         
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $ktests=Ktest::where('user_id','=',$loggeduser->id)->get();
		$ktest1st=Ktest::where('zymc','=',$filter)->first();
			$zyjs=Flzhuanye::where('zymc','=',$filter)->first();
		$ktest1st->zyjs=$zyjs->zyjs;
	     $configId = 104;  //lsi
         $accountId = 1000001;
         $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
         $bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
         $kuserId=$student->kuser_id;
         $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		
		if(!$ktest1st)
		{
			$kresult="你还没做过测试";
				return \View::make('users.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
						                 ->with('kresult',$kresult);
						                 } 
else{
	    $ktest1st->zymc=$filter;  
        $colleges =Zylb::search($ktest1st->zymc)->distinct()->paginate(10);
        
		return \View::make('users.specialties.index')->with('ktests',$ktests)
		->with('user',$student)
		                                               ->with('ktest1st',$ktest1st)
                                            ->with('colleges',$colleges);
	} 
	}
// use filter to get the colleges
    public function specialties()
	{
		//
		//
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		 $student=Student::whereraw("user_id = $loggeduser->id")->first();  
         
		//return \View::make('colleges.search.index')->with('colleges',$colleges)
         //                                        ->with('provinces',$provinces);
        $ktests=Ktest::where('user_id','=',$loggeduser->id)->get();
		$ktest1st=Ktest::where('user_id','=',$loggeduser->id)->first();
		 $configId = 104;  //lsi
         $accountId = 1000001;
         $yourDomain = "http://localhost:8000/users/ktest"; //change this to your server domain
         $bounceUrl = "https://api.keystosucceed.cn/setCookieAndBounce.php?returnUrl=$yourDomain";
         $kuserId=$student->kuser_id;
         $kurl = $bounceUrl . urlencode('?accountId='.$accountId.'&userId='.$kuserId.'&configId='.$configId);
		
		if(!$ktest1st)
		{
			$kresult="你还没做过测试";
				return \View::make('users.index')->with('user',$student)
		                                 ->with('kurl',$kurl)
						                 ->with('kresult',$kresult);
						                 } 
else{   $zyjs=Flzhuanye::where('zymc','=',$ktest1st->zymc)->first();
			$mzyjs= preg_replace("/(。)/", "。</p><p>", $zyjs->zyjs);
		$ktest1st->zyjs=$mzyjs;
	   
        $colleges =Zylb::search($ktest1st->zymc)->distinct()->paginate(10);
        
		return \View::make('users.specialties.index')->with('ktests',$ktests)
		->with('user',$student)
		                                               ->with('ktest1st',$ktest1st)
                                            ->with('colleges',$colleges);
	} 
	}
	/**
	 * Display the specified resource.
	 * GET /college/articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
		$authentication = \App::make('authenticator');
		return \View::make('colleges.articles.show')->with('article', Article::find($id))->withAuthor($authentication->getUserById(Article::find($id)->user_id)->name);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET  userid to do profileedit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editprofile()
	{
		//
		$size=1000;
		 $loggeduser=\App::make('authenticator')->getLoggedUser();
		 $user_profile=$loggeduser->user_profile()->first();
		 $use_gravatar=$loggeduser->user_profile()->first()->presenter()->avatar($size);
		 return \View::make('users.editprofile')->with('user_profile',$user_profile)
		                                       ->with('use_gravatar','$use_gravatar');
	}
     	/**
	 * Show the form for editing the specified resource.
	 * GET /college/articles/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		return \View::make('colleges.articles.edit')->with('article', article::find($id));
	}
  
	/**
	 * Update the specified resource in storage.
	 * PUT /college/articles/{id}
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
	 * DELETE /college/articles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		$article = article::find($id);
$article->delete();
Notification::success('删除成功！');
return Redirect::route('colleges.articles.index');
	}

}