@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		
       @include('users.slidbar')
        

	</div>

		<div class='col-md-10 lbk'>
	<div class="row top bottom marginlr">
	    @foreach ($kvideolists as $kvideolist)
       <div class="col-md-6">
         <a href="{{ URL::route('showvideo',$kvideolist->listid) }}">
  
         {{$kvideolist->ktitle }}
     
         </a>
        </div>
         @endforeach
         </div>
</div>


@stop
@section('bootor')
@stop