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
	<div class='col-md-7 text-center  slidbar_bg'>
		<h2>管理的班级</h2>
		<table class="table table-striped">
<thead>
<tr>
<th>学生班级</th>
<th>学生人数</th>
</tr>
</thead>
<tbody>
@foreach ($class_tongjis as $class_tongji)
<tr>
<td>{{ $class_tongji->classname }}</td>
<td>{{ $class_tongji->student_count }}</td>
</tr>
@endforeach
</tbody>
</table>
		<h2>管理的学生</h2>
	<table class="table table-striped">
<thead>
<tr>
<th>学生姓名</th>
<th>学生班级</th>
<th>学生学号</th>
<th>邮箱地址</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($students as $student)
<tr>
<td>{{ $student->stuname }}</td>
<td>{{ $student->classname }}</td>
<td>{{ $student->stuno }}</td>
</tr>
@endforeach
</tbody>
</table>
	</div>
@stop
@section('bootor')
@stop