<div  class='list' id="zy3">
		 <?php $i=0;
	  ?>
@foreach ($bkfl as $bkfl)
<section>
 <?php $i+=1;
 $sub_bkzjfl=Zjfl::whereRaw("parent_id = $bkfl->fldm and $bkfl->parent_id=0")->get();
	  ?>
<p id="a{{ $i }}"></p>	
@if ($bkfl->parent_id === 0)
<div class="cf">
    <h3>{{ $bkfl->flmc }}</h3>
    <small>{{ $bkfl->erjicount }}个学科门类，{{ $bkfl->sanjicount }}个本科专业</small>
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