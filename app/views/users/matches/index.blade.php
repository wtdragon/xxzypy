@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		
       @include('users.slidbar')
        

	</div>
	<div class='col-md-8'>
		<div class="row top bottom marginlr">
		<h2>
			会员中心
		</h2>
		<p>
			用户名：{{$user->stuname}}
		</p>
		<p>会员信息：学号{{$user->stuno}}</p> 
		 
        <h4>根据您的测评结果，我们为您推荐以下院校：</h4>
        	<div class="row top bottom  marginlr">
        <a>本科院校</a>   <a>专科院校</a>  <a>全部</a> 
        </div>
        <div class='row top bottom bottom-border marginlr'>
      @foreach ($ktests as $ktest)
       <div class="col-md-4">
        <a href="{{ URL::route('Specfilter',$ktest->co_id) }}">
         {{ $ktest->colleges->name }}
         </a>
        </div>
         @endforeach
        </div>
          </div>
         <div class='row top bottom bottom-border marginlr'>
        <h4>
		  {{ $ktest1st->colleges->name }}
		  <div class='row top bottom  marginlr'>
		  	<div class='col-md-4'>
		  	<h5>所属地区:{{ $ktest1st->colleges->province->pname }}</h5>
		  	</div>
		  	<div class='col-md-4'>
		  	<h5>所属科类:{{ $ktest1st->colleges->kelei}}</h5>
		  	</div>
		  	<div class='col-md-4'>
		  	<h5><a>添加收藏</a></h5>
		  	</div>
		  </div>
		</h4> 
		</div>
<table class="table table-striped">
<thead>
<tr>
<th>专业名称</th>
<th>科类</th>
<th>招生批次</th>
<th>学制</th>
</tr>
</thead>
<tbody>
@foreach ($zylbs as $zylb)
<tr>
<td>{{ $zylb->zymingcheng }}</td>
<td>{{ $zylb->kelei }}</td>
<td>{{ $zylb->pici }}</td>
<td>{{ $zylb->xuezhi }}</td>
</tr>
@endforeach
</tbody>
</table>
{{ $zylbs->links() }}  
            </div>
<div class='col-md-3'>
		@include('ads')
	</div>
@stop
@section('bootor')
	@include('users.script')
@stop