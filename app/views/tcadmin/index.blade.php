@extends('master')
<head>
  <meta charset="utf-8">
  <title>九子高考志愿匹配网</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="为您提供全面，专业的数据库搜索功能，根据搜索结果查询专业信息">
  <meta name="author" content="">

	<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
	<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
	<!--script src="images/js/less-1.3.3.min.js"></script-->
	<!--append ‘#!watch’ to the browser URL, then refresh the page. -->
	
	<link href={{ URL::asset('images/css/bootstrap.min.css') }} rel="stylesheet">
	<link href={{ URL::asset('images/css/style.css') }} rel="stylesheet">

  <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
  <!--[if lt IE 9]>
    <script src="images/js/html5shiv.js"></script>
  <![endif]-->

  <!-- Fav and touch icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/img/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/img/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/img/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="images/img/apple-touch-icon-57-precomposed.png">
  <link rel="shortcut icon" href="images/img/favicon.png">
  
	<script type="text/javascript" src={{ URL::asset('images/js/jquery.min.js') }}></script>
	<script type="text/javascript" src={{ URL::asset('images/js/bootstrap.min.js') }}></script>
	<script type="text/javascript" src={{ URL::asset('images/js/scripts.js') }}></script>
 

</head>
		
			@section('header.nav')	 
		@include('tcadmin.headnav')
		@overwrite
	</div>
@section('content')
{{ Notification::showAll() }}
<div class='col-md-2 text-center  slidbar_bg'>
 	@include('tcadmin.slidbar')
</div>
<div class='col-md-7 text-center'>
<h3>班级列表</h3>
<table class="table table-striped">
<thead>
<tr>
<th>学生班级</th>
<th>学生人数</th>
<th>管理</th>
</tr>
</thead>
<tbody>
@foreach ($class_tongjis as $class_tongji)
<tr>
<td>{{ $class_tongji->classname }}</td>
<td>{{ $class_tongji->stucount }}</td>
<td>查看</td>
</tr>
@endforeach
</tbody>
</table>
		<h3>管理的学生</h3>
	<table class="table table-striped">
<thead>
<tr>
<th>学生姓名</th>
<th>学号</th>
<th>邮箱地址</th>
<th>联系方式</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($students as $student)
<tr>
<td>{{ $student->stuname }}</td>
<td>{{ $student->stuno }}</td>
<td>{{ $student->emailaddress }}</td>
<td>{{ $student->phone }}</td>
</tr>
@endforeach
</tbody>
</table>
{{ $students->links() }}  
	</div>
@stop
@section('bootor')
@stop