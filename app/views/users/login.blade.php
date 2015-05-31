@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
		<div class='col-md-2 text-center  slidbar_bg'>
		
       @include('users.slidbar')
        

	</div>
	<div class='col-md-10 lbk'>
		
		  <div class="panel-body pd50">
		  			 <p>
		  			 	<img  src="images/img/d2.png">
		  			 </p>
                {{Form::open(array('url' => URL::action("Jacopo\Authentication\Controllers\AuthController@postClientLogin"), 'method' => 'post') )}}
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <span>用户名：</span>
                                {{Form::email('email', '', ['id' => 'email', 'class' => 'form-control', 'placeholder' => '邮件地址', 'required', 'autocomplete' => 'off'])}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-8">
                        <div class="form-group">
                            <div class="input-group input-group-sm">
                                <span>密码：</span>
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
        {{link_to_action('Jacopo\Authentication\Controllers\AuthController@getReminder','忘记密码')}}
        or <a href="{{URL::action('Jacopo\Authentication\Controllers\UserController@signup')}}" class="btn  disabled" role="button"><i class="fa fa-sign-in"></i> 注册</a>
            </div>
        </div>
            </div>
    </div>
@stop
@section('bootor')
@stop