@extends('backend.layouts.master')

@section('title')
@parent
:: Home
@stop
@section('headtitle')
K测试管理
@stop
@section('content')
{{ Notification::showAll() }}
                <div class="row">
                	<table class="table table-bordered">
<thead>
<tr>
<th>学生姓名</th>
<th>院校名称</th>
<th>专业名称</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($ktests as $ktest)
<tr>
	
<td>{{ $ktest->student->stuname}}</td>
<td>{{ $ktest->colleges->name }}</td>
<td>{{ $ktest->zymc }}</td>

<td>
<a href="{{ URL::route('backend.ktests.edit', $ktest->id ) }}" class="btn btn-success btn-mini pull-left">编辑</a>
{{ Form::open(array('route' => array('backend.ktests.destroy', $ktest->id ), 'method' => 'delete', 'data-confirm' => '确定删除？')) }}
<button type="submit" href="{{ URL::route('backend.ktests.destroy', $ktest->id) }}" class="btn btn-danger btn-mini">删除</button>
{{ Form::close() }}
</td>
</tr>
@endforeach
</tbody>
</table>
{{ $ktests->links() }} 
       	   
  	  {{ Form::open(array('route' => array('Syncktest','method' => 'post'))) }}
      	     <div class="col-xs-2">
      	     	 <label for="exampleInputEmail2">同步用户测试数据</label>
        <button type="submit" class="btn btn-default" type="button">同步</button>
        </div>
           {{ Form::close() }}
           {{ Form::open(array('route' => array('SyncCoinfo','method' => 'post'))) }}
      	     <div class="col-xs-2">
      	     	 <label for="exampleInputEmail2">同步专业数据</label>
        <button type="submit" class="btn btn-default" type="button">同步</button>
        </div>
           {{ Form::close() }}
                   
                </div>
                <!-- /.row -->

@stop