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
		<p>会员信息： 学号：{{$user->stuno}}</p> 
		<p>根据您的测评结果，我们为您推荐以下专业：</p>
		<div class="row top bottom marginlr">
		@foreach ($ktests as $ktest)
		 <div class="col-md-3">
         <a href="{{ URL::route('Colfilter',$ktest->zymc) }}">
         {{ $ktest->zymc }}
         </a>
        </div>
         @endforeach
        </div>
           </div>
         <div class='row top bottom bottom-border marginlr'>
        <h4>
		  {{ $ktest1st->zymc }}
		  		</h4>
		    <div class='row top bottom  marginlr'>
		     {{ $ktest1st->zyjs }}
		    </div>
  
		</div>
<table class="table table-striped">
<thead>
<tr>
<th>开设院校</th>
<th>科类</th>
<th>招生批次</th>
<th>所在地区</th>
</tr>
</thead>
<tbody>
@foreach ($colleges as $college)
<tr>
<td>{{ $college->yxmc }}</td>
<td>{{ $college->kelei }}</td>
<td>{{ $college->pici }}</td>
<td>{{ $college->province->pname }}</td>
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
@include('users.script')
@stop