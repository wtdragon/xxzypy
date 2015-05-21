@extends('master')
<head>
  <meta charset="utf-8">
  <title>九子高考志愿匹配网</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="为您提供全面，专业的数据库搜索功能，根据搜索结果查询专业信息">
  <meta name="_token" content="{{ csrf_token() }}"/>
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
	 {{ Form::open(array('route' => array('Gradestore','method' => 'post'),'class'=>'form-horizontal')) }}
    <fieldset>
      <div id="legend" class="">
        <legend class="">教师端管理中心</legend>
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

		<h3>学生列表</h3>
	<table class="table table-striped border">
<thead>
<tr>
<th>学生姓名</th>
<th>学号</th>
<th>邮箱地址</th>
<th>联系方式</th>
<th>管理</th>
</tr>
</thead>
<tbody>
@foreach ($students as $student)
<tr>
<td><a href="#" data-toggle="modal" class="open-popup-link" data-target="#modal1">{{ $student->stuname }}</a></td>
<td>{{ $student->stuno }}</td>
<td>{{ $student->emailaddress }}</td>
<td>{{ $student->phone }}</td>
 <td>
<a href="{{ URL::route('tcadmin.students.edit', $student->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('tcadmin.students.destroy', $student->id  ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('tcadmin.students.destroy', $student->id ) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $students->links() }}  
<h3>新增学生</h3>
@if ($errors->any())
<div class="alert alert-error">
{{ implode('<br>', $errors->all()) }}
</div>
@endif
 {{ Form::open(array('route' => 'tcadmin.students.store','class'=>'border')) }}
<div class="form-group">
{{ Form::label('classname','班级名称', array('class' => 'col-sm-2 control-label')) }}
<div class="col-md-4"> 
{{ Form::text('classname') }}
</div>
{{ Form::label('stuname', '学生姓名', array('class' => 'col-sm-2 control-label')) }}
<div class="col-md-4"> 
{{ Form::text('stuname') }}
</div>
{{ Form::label('stuno', '学生学号', array('class' => 'col-sm-2 control-label')) }}
<div class="col-md-4"> 
{{ Form::text('stuno') }}
</div>
{{ Form::label('emailaddress', '邮箱地址', array('class' => 'col-sm-2 control-label')) }}
<div class="col-md-4"> 
{{ Form::text('emailaddress') }}
</div>
</div>

<div class="form-actions">
{{ Form::submit('新增', array('class' => 'btn btn-success bottom btn-save btn-large')) }}
<a href="{{ URL::route('tcadmin.students.index') }}" class="btn bottom btn-large">取消</a>
</div>

{{ Form::close() }}
{{ Form::open(array('action' => 'Filestore','files'=>true)) }}
<h3>批量上传学生数据</h3>
<div class="form-actions dropzone">
{{ Form::file('file') }}
{{ Form::submit('新增', array('class' => 'btn btn-success btn-save bottom btn-large')) }}
<a href="{{ URL::route('tcadmin.students.index') }}" class="btn bottom btn-large">取消</a>
</div>
{{ Form::close() }}
</div>
</div>
@stop
@section('bootor')
<div class="modal fade" id="modal1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title text-primary"></h4>
      </div>
      <div class="modal-body">
         
      </div>
      <div class="modal-footer">
        <button type="button" id="modal-button1" class="btn btn-default" data-dismiss="modal">返回</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript">
$(document).ready(function() { 
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});  
$('.open-popup-link').click(function(){
	 
	var stuname=$(this).html();
	var postStr   = "stuname="+ stuname;
	 $.ajax({
	 	type: 'post',
		url: "{{ URL::to('tcadmin/ajaxktest') }}",
		data: postStr,
		dataType:  'html',
		tryCount:0,//current retry count
		retryLimit:3,//number of retries on fail
		timeout: 2000,//time before retry on fail
		success: function(data) {
			 $(".modal-body").html(data);// 设置文本内容
			 
		},
		error: function(xhr, textStatus, errorThrown) {
			 if (textStatus == 'timeout') {//if error is 'timeout'
				this.tryCount++;
				if (this.tryCount < this.retryLimit) {
					$.ajax(this);//try again
					return;
				}
			}//try 3 times to get a response from server
		}
	});
}); 
} );    
</script>
@stop