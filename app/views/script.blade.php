<script type="text/javascript">
$(".btn-group > .btn").click(function(){
    $(".btn-group > .btn").removeClass("btn-primary");
    $(this).addClass("btn-primary");
     $("#zy1").toggleClass("notshow");
     $("#zy2").toggleClass("notshow");
       $("#zy3").toggleClass("notshow");
         $("#zy4").toggleClass("notshow");
});
$(document).ready(function(){
 
    function smk_jump_to_it( _selector, _speed ){
        
        _speed = parseInt(_speed, 10) === _speed ? _speed : 300;
 
        $( _selector ).on('click', function(event){
            event.preventDefault();
            var url = $(this).attr('href'); //cache the url.
 
            // Animate the jump
            $("html, body").animate({ 
                scrollTop: parseInt( $(url).offset().top )
            }, _speed);
 
        });
    }
     // Function call
     smk_jump_to_it( '.link_classname', 500);
 
});

 $(function() {
		var offsetPixels = 250; // change with your sidebar height

		$(window).scroll(function() {
			if ($(window).scrollTop() > offsetPixels) {
				$(".scrollingBox").css({
					"position": "fixed",
					"top": "0px",
					"width": "47.5%"
				});
			} else {
				$(".scrollingBox").css({
					"position": "relative",
					"top": "0",
					"width": "100%"
				});
			}
		});
	});


</script>
