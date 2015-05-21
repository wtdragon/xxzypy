@extends('master')
@section('header')

@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		<h3 class="acolor">
			专业搜索
		</h3>
		<p class='t1'>九子高考志愿匹配网为您提供全面的专业数据库搜索功能，以便于您可以根据搜索结果，查询所需要的专业信息。</p>
			
	</div>
	<div class='col-md-7 bottom top'>
     <div class="input-group">
       <span class="input-group-btn">
{{ Form::open(array('route' => array('PostSpecialtiysearch','method' => 'post'))) }}
      	     <div class="col-xs-2">
        <button type="submit" class="btn btn-default" type="button">专业搜索</button>
        </div>
      </span>
       <div class="col-xs-9">
      {{Form::text('specialty', null, array('class'=>'fc_search form-control','placeholder'=>'专业搜索'))}}
      </div>
    </div><!-- /input-group -->
{{ Form::close() }}
<div class='row top bottom marginlr'>
<p>
	<div class="btn-group">
  <button class="btn btn-large btn-primary" type="button">本科专业列表</button>
  <button class="btn btn-large" type="button">专科专业列表</button>
 </div>
</p>
<div class="scrollingBox">
<ul class="list-inline button" id="zy1">
    <li><a href="#a1" class="button">哲学</a></li>
    <li><a href="#a2" class="button">经济学</a></li>
    <li><a href="#a3" class="button">法学</a></li>
    <li><a href="#a4" class="button">教育学</a></li>
    <li><a href="#a5" class="button">文学</a></li>
    <li><a href="#a6" class="button">历史学</a></li>
    <li><a href="#a7" class="button" >理学</a></li>
    <li><a href="#a8" class="button">工学</a></li>
    <li><a href="#a9" class="button">农学</a></li>
    <li><a href="#a10" class="button">医学</a></li>
    <li><a href="#a11" class="button">管理学</a></li>
    <li class="last"><a href="#a12" class="button">艺术学</a></li>
  </ul>
  <ul class="list-inline notshow anchors" id="zy2">
    <li><a href="#ab6" class="button" >土建</a></li>
    <li><a href="#ab7" class="button" >水利</a></li>
    <li><a href="#ab8" class="button">制造</a></li>
    <li><a href="#ab12" class="button">财经</a></li>
    <li><a href="#ab14" class="button">旅游</a></li>
    <li><a href="#ab18" class="button">公安</a></li>
    <li><a href="#ab19" class="button">法律</a></li>
    <li><a href="#ab1" class="button">农林牧渔</a></li>
    <li><a href="#ab2" class="button">交通运输</a></li>
    <li><a href="#ab9" class="button">电子信息</a></li>
    <li> <a href="#ab11" class="button">轻纺食品</a></li>
    <li><a href="#ab13" class="button">医药卫生</a></li>
    <li><a href="#ab15" class="button">公共事业</a></li>
    <li><a href="#ab16" class="button">文化教育</a></li>
    <li><a href="#ab3" class="button">生化与药品</a></li>
    <li><a href="#ab5" class="button">材料与能源</a></li>
    <li><a href="#ab4" class="button">资源开发与测绘</a></li>
    <li><a href="#ab10" class="button">环保、气象与安全</a></li>
    <li><a href="#ab17" class="button">艺术设计传媒</a></li>
  </ul> 
</div>
</div>

@include('specialties.search.bklist')
@include('specialties.search.zklist')



</div>
<div class='col-md-3'>
	<div class='row top bottom'>
		@include('ads')
	</div>
	</div>
@stop


@section('bootor')
	@include('script')
@stop