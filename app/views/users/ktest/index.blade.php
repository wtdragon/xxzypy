@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		
       @include('users.slidbar')
        

	</div>
	<div class='col-md-10 lbk'>
		<p>
		<img  src="../images/img/w1.png">
		</p>
		<p>昵称：{{$user->stuno}}</p> 
		 
<iframe id="iFrame1" name="iFrame1" style="width: 800px; height: 600px;background-color=transparent" allowTransparency="true"  
            src="<?php echo $fullLoginUrl ?>"
            frameBorder="0">
              <p>Your browser does not support iframes.</p>
          </iframe>
            </div>

@stop
@section('bootor')
@stop