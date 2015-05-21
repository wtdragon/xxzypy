@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<h2>
			院校搜索
		</h2>
		<p class='p-wid'>九子高考志愿匹配网为您提供权威的、全面的职业院校新闻资讯和招生信息。为您对于院校及专业的情况了解进行科学系统的导向。
</p>
			
	</div>
	<div class='col-md-7'>
     <div class="input-group">
 
      <span class="input-group-btn">
      	    {{ Form::open(array('route' => array('Postcollegesearch','method' => 'post'))) }}
      	     <div class="col-xs-2">
        <button type="submit" class="btn btn-default" type="button">院校搜索</button>
        </div>
      </span>
       <div class="col-xs-9">
      {{Form::text('college', null, array('class'=>'fc_search form-control','placeholder'=>'院校搜索'))}}
      </div>
    </div><!-- /input-group -->
           {{ Form::close() }}
</div>
	<div class='col-md-7'>
@foreach ($provinces as $province)
<a>{{ $province->pname }}</a>
@endforeach
</div>
	<div class='col-md-7'>
<table class="table table-striped">
<thead>
<tr>
<th>院校名称</th>
<th>科类</th>
<th>批次</th>
<th>详情</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($colleges as $college)
<tr>
<td>{{ $college->name }}</td>
<td>{{ $college->kelei }}</td>
<td>{{ $college->pici }}</td>
<td><a href="{{ URL::route('colleges.search.show', $college->coid) }}">查看</td>
</tr>
@endforeach
</tbody>
</table>
{{ $colleges->links() }}  
</div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
@stop