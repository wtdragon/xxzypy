<div class='col-md-10 lbk'>
		<p>
		<img  src="images/img/w1.png">
		</p>
		<p>昵称：{{$user->stuno}}</p> 
		  <div class="panel-body">
		  	
@if ($kresult === "你还没做过测试" )
</div>
    <p>  请点击多元智能或学习风格测试进行测试</p>
 <div class='col-md-10 lbk'>
 	<p>
 		 <a href="{{ $kMiurl }}" class="btn btn-default btn1 center" type="button">多元智能评估测试</a> 
	 </p>
	 <p>
	 	 <a href="{{ $kLsiurl }}" class="btn btn-default btn1 center" type="button">学习风格评估测试</a> 
	 </p>
	 </div>
	   
 		
@else
   <p>根据您做的测试，以下为您的测试结果：</p>
  <iframe id="iFrame1" name="iFrame1" style="width: 800px;" allowTransparency="true"  style="background-color=transparent" onload="this.height=iFrame1.document.body.scrollHeight"
            src="<?php echo $kresult ?>"  allowTransparency="true"
            frameBorder="0">
        </iframe>
@endif
       </div>
</div>