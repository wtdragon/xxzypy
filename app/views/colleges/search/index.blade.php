@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<h3 class="acolor">
			院校搜索
		</h3>
		<p class='t1'>九子高考志愿匹配网为您提供权威的、全面的职业院校新闻资讯和招生信息。为您对于院校及专业的情况了解进行科学系统的导向。
</p>
			
	</div>
	<div class='col-md-7 bottom top'>
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
<div class="row top bottom marginlr">
        @foreach($provinces as $province)
        <div class="col-md-3">
          
               <a href="{{ URL::route('colleges.search.show',$province->provinceID) }}">{{ $province->pname }}</a>
         
        </div><!--/col-md-3-->
        @endforeach

</div>
 <div class="row top bottom bottom-border marginlr">
	 <a href="{{ URL::route('Cofilter','jyb') }}">教育部直属</a>
	  <a href="{{ URL::route('Cofilter','211') }}">211院校</a>
      <a href="{{ URL::route('Cofilter','985') }}">985院校</a>
      <a href="{{ URL::route('Cofilter','all') }}">全部</a>
 
</div>
<table class="table table-striped">
<thead>
<tr>
<th>院校名称</th>
<th>科类</th>
<th>批次</th>
<th>隶属</th>
<th><i class="icon-cog"></i></th>
</tr>
</thead>
<tbody>
@foreach ($colleges as $college)
<tr>
<td>{{ $college->name }}</td>
<td>{{ $college->kelei }}</td>
<td>{{ $college->pici }}</td>
<td>{{ $college->lishu }}</td>
</tr>
@endforeach
</tbody>
</table>
{{ $colleges->links() }}  
</div>
<div class='col-md-3'>
	<div class='row top bottom'>
		@include('ads')
	</div>
	</div>
@stop
@section('bootor')
@stop