<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
   
	public function showHome()
	{   
		//$userlogged=array(str_replace(':','=>',App::make('authenticator')->getLoggedUser()));	
		 $userLogedid = Cookie::get('userid');
		 $userLogged=App::make('authenticator')->getLoggedUser();
		 if($userLogged==null){
		 $userID=0;
		 }
		 elseif($userLogedid!=null)
		 {$userID=$userLogedid;
		 }
		 else {
		 	$userID=$userLogged->id;
		 }
		//$session=Session::put('userid',$userID);
		//Session::push('userid',$userID);
		$cookie = Cookie::make('userid',$userID);
		return Response::view('home')->withCookie($cookie);
        /*
		 | 使用acl组件得到用户信息
		 | 
         ×/
		 
       
		$userID=$userLogged->id;
		//$session=Session::put('userid',$userID);
		//Session::push('userid',$userID);
		$cookie = Cookie::make('userid',$userID);
		return Response::view('home')->withCookie($cookie);
         //return Response::view('home')->withSession($session);;
		// $arr=json_decode($userlogged);
		/*
		 * 

        foreach($userlogged as $key=>$val) {
            if (is_array($val)) {     //判断$val的值是否是一个数组，如果是，则进入下层遍历
                 foreach($val as $key=>$val) {
                      print("<li>".$key."=>".$val."</li>");
                                              }
                                   print("</ul>");
                                                }
                                               }
				 
		foreach($arr as $key=>$value){
$arr->$key=$value;
}
 print_r($arr);
				
 $array = json_decode(json_encode($userlogged),TRUE);
 echo $userid=$array["id"];
  echo $useremail=$array["email"];
		 *  
		 */
	}


}
