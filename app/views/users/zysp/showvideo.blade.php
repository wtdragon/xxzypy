@extends('master')
@section('header')
@include('users.vscript')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		
       @include('users.slidbar')
        

	</div>

		<div class='col-md-10 lbk'>
	<div class="row top bottom marginlr">
	   <div class="player">
<video id="video-playlist" class="video-js vjs-default-skin" controls preload="auto" width="600" height="400" poster="" data-setup="{}">
     <source src="http://115.29.45.209:81/{{$video->k_sppath }}" type='video/mp4' />
 </video>
 
 <p>   {{$video->kcontent }}	</p>
         </div>
</div>


@stop
@section('bootor')
@stop