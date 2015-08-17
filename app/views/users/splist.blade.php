<div class='col-md-10 lbk'>
	<div class="row top bottom marginlr">
		<img  src="../images/img/spfl.png">
	</div>
	<div class="row top bottom marginlr">
	    @foreach ($klists as $klist)
       <div class="col-md-6">
        <a href="#">
  
          <img  src="{{ $klist->listimg   }}">
     
         </a>
        </div>
         @endforeach
         </div>
</div>