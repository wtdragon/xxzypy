@extends('master')
@section('header')
@stop
@section('content')
{{ Notification::showAll() }}
	<div class='col-md-2 text-center  slidbar_bg'>
		
       @include('users.slidbar')
        

	</div>
	<div class='col-md-8'>
		<h2>
			测试中心
		</h2>
    </div>
    <div class='col-md-7'>
		<h3>
			职业测试：
		</h3>
		<p>会员信息：</p>
		
		 

          <iframe style="width: 800px; height: 600px;"
            src="<?php echo $fullLoginUrl ?>"
            frameBorder="0">
              <p>Your browser does not support iframes.</p>
          </iframe>
            </div>

@stop
@section('bootor')
@stop