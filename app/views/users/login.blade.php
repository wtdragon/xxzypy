@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<h3 class="acolor">
			志愿匹配
		</h3>
		<p class='t1'>注册登录之后，您可以进行我们给您提供的一套权威的职业测评，为您推荐职业匹配，以便于您进行职业筛选和专业比较，对合适的选择可以收藏并记录。</p>
			
	</div>
	<div class='col-md-7'>
		<h2>
			会员中心
		</h2>

		  <div class="panel-body pd50">
		  			<h2>
			您好，请登录
		</h2>
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
        {{link_to_action('Jacopo\Authentication\Controllers\AuthController@getReminder','忘记密码')}}
        or <a href="{{URL::action('Jacopo\Authentication\Controllers\UserController@signup')}}" class="btn  disabled" role="button"><i class="fa fa-sign-in"></i> 注册</a>
            </div>
        </div>
            </div>
    </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@stop