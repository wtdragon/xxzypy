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

		<h4>班级列表</h4>
	<table class="table table-striped">
<thead>
<tr>
<th>班级</th>
<th>人数</th>
<th>负责老师</th>
<th>备注</th>
<th>管理</th>
</tr>
</thead>
<tbody>
@foreach ($classes as $class)
<tr>
<td>{{ $class->classname }}</td>
<td>{{ $class->stucount }}</td>
<td>{{ $class->teacher->teachername }}</td>
<td>{{ $class->other }}</td>
<td>
<a href="{{ URL::route('gxadmin.classes.edit', $class->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('gxadmin.classes.destroy', $class->id ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('gxadmin.classes.destroy', $class->id) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
 <h3>新增班级</h3>
@if ($errors->any())
<div class="alert alert-error">
{{ implode('<br>', $errors->all()) }}
</div>
@endif
 {{ Form::open(array('route' => array('Classestore','method' => 'post'))) }}
<div class="form-group">
{{ Form::label('classname', '班级名称', array('class' => 'col-sm-2 control-label')) }}
<div class="col-md-4"> 
{{ Form::text('classname') }}
</div>
{{ Form::label('stucount', '班级人数', array('class' => 'col-sm-2 control-label')) }}
<div class="col-md-4"> 
{{ Form::text('stucount') }}
</div>
{{ Form::label('teachername', '负责老师', array('class' => 'col-sm-2 control-label')) }}
<div class="col-md-4"> 
{{ Form::text('teachername') }}
</div>
{{ Form::label('other', '班级备注', array('class' => 'col-sm-2 control-label')) }}
<div class="col-md-4"> 
{{ Form::text('other') }}
</div>
</div>
<div class="control-group bottom">
<div class="form-actions">
{{ Form::submit('新增', array('class' => 'btn btn-success bottom btn-save btn-large')) }}
<a href="{{ URL::route('gxadmin.classes.index') }}" class="btn bottom btn-large">取消</a>
</div>
</div>
{{ Form::close() }}
	</div>
@stop
@section('bootor')
@stop