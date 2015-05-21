<div  class='list notshow' id="zy4">
		 <?php $i=0;
	  ?>
@foreach ($zkfl as $zkfl)
<section>
 <?php $i+=1;
 $sub_bkzjfl=Zjfl::whereRaw("parent_id = $zkfl->fldm and $zkfl->parent_id=0")->get();
	  ?>
<p id="ab{{ $i }}"></p>	
@if ($zkfl->parent_id === 0)
<div class="cf">
    <h3>{{ $zkfl->flmc }}</h3>
    <small>{{ $zkfl->erjicount }}个学科门类，{{ $zkfl->sanjicount }}个专科专业</small>
</div>
@endif
@foreach($sub_bkzjfl as $sub_bkzjfl)
  <section>
    <h4>{{ $sub_bkzjfl->flmc }}</h4>
    <?php  
 $thrd_bkzjfl=Zjfl::whereRaw("parent_id = $sub_bkzjfl->fldm")->get();
	  ?>
	    <ul class="list-inline">
	  @foreach($thrd_bkzjfl as $thrd_bkzjfl)
        <li><a href="{{ URL::route('Showsspec', $thrd_bkzjfl->flmc) }}">{{ $thrd_bkzjfl->flmc }}</a></li>
     
    @endforeach
       </ul>
  </section>
</section>
@endforeach

@endforeach
</div>