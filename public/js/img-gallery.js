$(document).ready(function(){
  $(".fancybox").fancybox({
        openEffect: "elastic",
        closeEffect: "none"
    });

    $(".zoom").hover(function(){

		$(this).addClass('transition');
	}, function(){

		$(this).removeClass('transition');
	});
});
