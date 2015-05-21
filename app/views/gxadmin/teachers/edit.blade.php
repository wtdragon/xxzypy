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
 

<link href={{ URL::asset('images/css/sb-admin-2.css') }} rel="stylesheet">
<link href={{ URL::asset('images/css/timeline.css') }} rel="stylesheet">
<script type="text/javascript" src={{ URL::asset('images/metisMenu/dist/metisMenu.js') }}></script>
<script type="text/javascript" src={{ URL::asset('images/js/sb-admin-2.js') }}></script>
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
 <h3>修改教师</h3>
@if ($errors->any())
<div class="alert alert-error">
{{ implode('<br>', $errors->all()) }}
</div>
@endif
 {{ Form::model($teachers, array('method' => 'put', 'route' => array('gxadmin.teachers.update', $teachers->id),'class'=>'form-inline')) }}
<div class="form-group">
{{ Form::label('teachername', '教师姓名', array('class' => 'col-sm-2 control-label')) }}
<div class="col-md-4"> 
{{ Form::text('teachername') }}
</div>
{{ Form::label('emailaddress', '邮箱地址', array('class' => 'col-sm-2 control-label')) }}
<div class="col-md-4"> 
{{ Form::text('emailaddress') }}
</div>
{{ Form::label('phone', '联系方式', array('class' => 'col-sm-2 control-label')) }}
<div class="col-md-4"> 
{{ Form::text('phone') }}
</div>
</div>
<div class="control-group bottom">
<div class="form-actions">
{{ Form::submit('更新', array('class' => 'btn btn-success btn-save btn-large')) }}
<a href="{{ URL::route('gxadmin.teachers.index') }}" class="btn btn-large">取消</a>
</div>
</div>
{{ Form::close() }}
	</div>
@stop
@section('bootor')
@stop