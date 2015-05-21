@extends('master')
@section('hdsrc')
<link href={{ URL::asset('images/css/sb-admin-2.css') }} rel="stylesheet">
<link href={{ URL::asset('images/css/timeline.css') }} rel="stylesheet">
<script type="text/javascript" src={{ URL::asset('images/metisMenu/dist/metisMenu.js') }}></script>
<script type="text/javascript" src={{ URL::asset('images/js/sb-admin-2.js') }}></script>

@stop
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
<div class='col-md-2 text-center  slidbar_bg'>
		<div class="sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
        <li><a href="{{URL::to('users')}}" class="btn btn-default btn1" type="button">我的测评</a></li>
        <li><a href="{{URL::to('users/specialties')}}" class="btn btn-default btn1" type="button">专业列表</a></li>
        <li><a href="{{URL::to('users/matches')}}" class="btn btn-default btn1" type="button">院校列表</a></li>
	       <li>
                <a href="{{URL::to('users/collects')}}" class="btn btn-default btn1" type="button">我的收藏</a>
               <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{URL::to('users/collects/colleges')}}" >院校收藏</a>
                                </li>
                                <li>
                                    <a href="{{URL::to('users/collects/specialites')}}">专业收藏</a>
                                </li>
                                <li>
                                   <a>课程收藏</a>
                                </li>
                                <li>
                                   <a href="{{URL::to('users/collects/others')}}" >其他收藏</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
      </ul>
	</div>
	</div>
</div>
	<div class='col-md-7'>
	<div class="row">
    <div class="col-md-12">
        {{-- success message --}}
        <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{{$message}}</div>
        @endif
        @if( $errors->has('model') )
        <div class="alert alert-danger">{{$errors->first('model')}}</div>
        @endif
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> User profile</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
           
                            @include('laravel-authentication-acl::admin.user.partials.avatar_upload')

                                    <h4><i class="fa fa-cubes"></i> User data</h4>
                        {{Form::model($user_profile,['route'=>'users.profile.edit', 'method' => 'post'])}}
                        <!-- code text field -->
                        <div class="form-group">
                            {{Form::label('code','User code:')}}
                            {{Form::text('code', null, ['class' => 'form-control', 'placeholder' => ''])}}
                        </div>
                        <span class="text-danger">{{$errors->first('code')}}</span>
                        <!-- first_name text field -->
                        <div class="form-group">
                            {{Form::label('first_name','First name:')}}
                            {{Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => ''])}}
                        </div>
                        <span class="text-danger">{{$errors->first('first_name')}}</span>
                        <!-- last_name text field -->
                        <div class="form-group">
                            {{Form::label('last_name','Last name: ')}}
                            {{Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => ''])}}
                        </div>
                        <span class="text-danger">{{$errors->first('last_name')}}</span>
                        <!-- phone text field -->
                        <div class="form-group">
                            {{Form::label('phone','Phone: ')}}
                            {{Form::text('phone', null, ['class' => 'form-control', 'placeholder' => ''])}}
                        </div>
                        <span class="text-danger">{{$errors->first('phone')}}</span>
                        <!-- state text field -->
                        <div class="form-group">
                            {{Form::label('state','State: ')}}
                            {{Form::text('state', null, ['class' => 'form-control', 'placeholder' => ''])}}
                        </div>
                        <span class="text-danger">{{$errors->first('state')}}</span>
                        <!-- var text field -->
                        <div class="form-group">
                            {{Form::label('var','Vat: ')}}
                            {{Form::text('var', null, ['class' => 'form-control', 'placeholder' => ''])}}
                        </div>
                        <span class="text-danger">{{$errors->first('vat')}}</span>
                        <!-- city text field -->
                        <div class="form-group">
                            {{Form::label('city','City: ')}}
                            {{Form::text('city', null, ['class' => 'form-control', 'placeholder' => ''])}}
                        </div>
                        <span class="text-danger">{{$errors->first('city')}}</span>
                        <!-- country text field -->
                        <div class="form-group">
                            {{Form::label('country','Country: ')}}
                            {{Form::text('country', null, ['class' => 'form-control', 'placeholder' => ''])}}
                        </div>
                        <span class="text-danger">{{$errors->first('country')}}</span>
                        <!-- zip text field -->
                        <div class="form-group">
                            {{Form::label('zip','Zip: ')}}
                            {{Form::text('zip', null, ['class' => 'form-control', 'placeholder' => ''])}}
                        </div>
                        <span class="text-danger">{{$errors->first('zip')}}</span>
                        <!-- address text field -->
                        <div class="form-group">
                            {{Form::label('address','Address: ')}}
                            {{Form::text('address', null, ['class' => 'form-control', 'placeholder' => ''])}}
                        </div>
                        <span class="text-danger">{{$errors->first('address')}}</span>
                        {{Form::hidden('user_id', $user_profile->user_id)}}
                        {{Form::hidden('id', $user_profile->id)}}
                        {{Form::submit('保存',['class' =>'btn btn-info pull-right margin-bottom-30'])}}
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
@stop
@section('bootor')
@stop