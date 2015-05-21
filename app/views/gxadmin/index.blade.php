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
		@include('gxadmin.headnav')
		@overwrite
	</div>
@section('content')
{{ Notification::showAll() }}
 <div class='col-md-2 text-center  slidbar_bg'>
 	@include('gxadmin.slidbar')
</div>
<div class='col-md-7 text-center'>
 <h3>管理中心</h3>
		<h4>年级列表</h4>
		<table class="table table-striped">
<thead>
<tr>
	<th>年度</th>
<th>年级</th>
<th>年级人数</th>
<th>备注</th>
</tr>
</thead>
<tbody>
@foreach ($grades as $grade)
<tr>
	<td>{{ $grade->niandu }}</td>
<td>{{ $grade->gradename }}</td>
<td>{{ $grade->stucount }}</td>
<td></td>
</tr>
@endforeach
</tbody>
</table>

		<h4>班级列表</h4>
	<table class="table table-striped">
<thead>
<tr>
	
<th>班级名称</th>
<th>班级人数</th>
<th>备注</th>
</tr>
</thead>
<tbody>
@foreach ($sclasses as $sclass)
<tr>
<td>{{ $sclass->classname }}</td>
<td>{{ $sclass->stuno }}</td>
<td></td>
</tr>
@endforeach
</tbody>
</table>


<h4>教师列表</h4>
<table class="table table-striped">
<thead>
<tr>
<th>教师姓名</th>
<th>邮箱地址</th>
<th>联系方式</th>
</tr>
</thead>
<tbody>
@foreach ($teachers as $teacher)
<tr>
<td>{{ $teacher->teachername }}</td>
<td>{{ $teacher->emailaddress }}</td>
<td>{{ $teacher->phone }}</td>
</tr>
@endforeach
</tbody>
</table>
	</div>
@stop
@section('bootor')
@stop