@extends('master')
@section('header')
@stop
@section('content')
<div class="col-md-12">
						<img class='img1'  src="images/img/hd.png">
</div>
<div class="col-md-12">
	<div class="col-md-4"> 
	 <img src="images/img/t1.png" class='imgcenter'>
	 @if(App::make('authenticator')->getLoggedUser())
         <p><a href="{{URL::to('users')}}">我的空间</a></p>  
         <p><a href="{{URL::to('user/logout')}}">登出</a></p> 
@else
	 <p>
		 <img  src="images/img/d1.png">
	 </p>
     <div class="panel-body">
                {{Form::open(array('url' => URL::action("Jacopo\Authentication\Controllers\AuthController@postClientLogin"), 'method' => 'post') )}}
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                {{Form::email('email', '', ['id' => 'email', 'class' => 'form-control', 'placeholder' => '邮件地址', 'required', 'autocomplete' => 'off'])}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                {{Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => '密码', 'required', 'autocomplete' => 'off'])}}
                            </div>
                        </div>
                    </div>
                </div>
                {{Form::label('remember','记住我')}}
                {{Form::checkbox('remember')}}
                <input type="submit" value="登录" class="btn btn-info">
                {{Form::close()}}
        <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 margin-top-10">
            	<a href="{{URL::action('Jacopo\Authentication\Controllers\UserController@signup')}}" class="btn  disabled" role="button"><i class="fa fa-sign-in"></i> 注册</a>|
        {{link_to_action('Jacopo\Authentication\Controllers\AuthController@getReminder','忘记密码')}} </div>
        </div>
        </div>
            <p>
            	<strong>注册/登录</strong>之后，可进行我们   <p>为小朋友们准备的测评 </p>
            </p>
            @endif	
        </div>
		<div class="col-md-4"> 
				<img src="images/img/t2.png">
		    <p>
		    	<img  src="images/img/h1.png">
		    </p>
			<p>
				最好的教育，就是帮助每一个孩子，去找到自己的生命价值：从事着自己喜
欢的事情，过着自己想要的生活。每个孩子都有自己的与生俱来的某种东西，这部分是孩子的根基，才华和技能则是生长在其上的枝条。“知识和技能”只有长在“性格”之上的，这才能构成统一的“内在”，因此每个孩子都有属于自己的教育方式。
</p>
<p>
所以，<strong>请多做一点，多了解一点，因为你所改变的，是孩子的命运。</strong>
</p>
		</div>
		<div class="col-md-4 text-right"> 
				<img alt="150x150" src="images/img/t3.png">
			 <p>
		    	<img  src="images/img/l1.png">
		    </p>
		     <p>
		    	<img  src="images/img/l2.png">
		    </p>
		     <p>
		    	<img  src="images/img/l3.png">
		    </p>
		    
			
		</div>
 	</div>
@stop
@section('bootor')
@stop