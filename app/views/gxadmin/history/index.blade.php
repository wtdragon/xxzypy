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

 {{ Form::open(array('route' => array('Gradestore','method' => 'post'),'class'=>'form-horizontal')) }}
    <fieldset>
      <div id="legend" class="">
        <legend class="">管理中心</legend>
      </div>
    <div class="control-group">

          <!-- Select Basic -->
          <label class="control-label">年度选择：</label>
	  {{ Form::select( 'niandu',$niandu,null, array('class' => 'input-xlarge')) }}

        </div>

    <div class="control-group">

          <!-- Select Basic -->
          <label class="control-label">班级选择:</label>
           {{ Form::select( 'banji',$banji,null, array('class' => 'input-xlarge')) }}

        </div>

    <div class="control-group">
          <label class="control-label"></label>

          <!-- Button -->
          <div  id="legend">
          {{ Form::submit('确认', array('class' => 'btn btn-success btn-save btn-large')) }}
          </div>
        </div>

    </fieldset>
{{ Form::close() }}

<div class="row">
<div class='col-md-4 text-left'>	
<h3>学生列表</h3>
</div>

<div class='input-append input-prepend'>	
<input type="text" class="span2 search-query">
        <button type="submit" class="btn">搜索</button>
</div>

</div>
<table class="table table-striped">
<thead>
<tr>
<th>学生姓名</th>
<th>学号</th>
<th>邮箱地址</th>
<th>联系方式</th>
</tr>
</thead>
<tbody>
@foreach ($students as $student)
<tr>
<td>{{ $student->stuname }}</td>
<td>{{ $student->stuno }}</td>
<td>{{ $student->emailaddress }}</td>
<td>{{ $student->phone }}</td>
<td></td>
</tr>
@endforeach
</tbody>
</table>


	</div>
@stop
@section('bootor')
@stop