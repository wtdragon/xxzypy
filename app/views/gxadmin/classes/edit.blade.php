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
          <li>
            <a href="{{URL::to('users/collects')}}" class="btn btn-default btn1" type="button">学生班级管理</a>
            <ul class="nav nav-second-level">
              <li> <a href="{{URL::to('gxadmin/classes')}}" >班级管理</a>
                </li>
                <li>
                 <a href="{{URL::to('gxadmin/students')}}">学生管理</a>
                  </li>
              </ul>
               </li>
      </ul>
	</div>
	</div>
	</div>
	<div class='col-md-7 text-center'>
 <h3>修改班级</h3>
@if ($errors->any())
<div class="alert alert-error">
{{ implode('<br>', $errors->all()) }}
</div>
@endif
 {{ Form::model($classes, array('method' => 'put', 'route' => array('gxadmin.classes.update', $classes->id))) }}
<div class="control-group">
{{ Form::label('classname', '修改班级名称') }}
{{ Form::text('classname') }}
</div>
<div class="form-actions">
{{ Form::submit('更新', array('class' => 'btn btn-success btn-save btn-large')) }}
<a href="{{ URL::route('gxadmin.classes.index') }}" class="btn btn-large">取消</a>
</div>
{{ Form::close() }}
	</div>
@stop
@section('bootor')
@stop