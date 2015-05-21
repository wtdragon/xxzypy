<div class='col-md-8'>
<h2>
会员中心
</h2>
		<p>
		用户名：{{$user->stuname}}
		</p>
		<p>学生信息:学号：{{$user->stuno}}</p> 
		  <div class="panel-body">
		  	
@if ($kresult === "你还没做过测试" )
</div>
    <p> {{ $kresult }}   请点击职业测试进行职业测试</p>
    <div class='col-md-8'>
	 <a href="{{ $kurl }}" class="btn btn-default btn1 center" type="button">职业测试</a> 
	 </div>
@else
   <p>根据您做的测试，以下为您的测试结果：</p>
  <iframe style="width: 800px; height: 600px;"
            src="<?php echo $kresult ?>"
            frameBorder="0">
          </iframe>
@endif
       </div>
</div>