(function($) {
	
	// $ Works! You can test it with next line if you like
	console.log($);
    var $scrollingDiv = $("#review-left-sidebar");

        $(window).scroll(function(){            
            $scrollingDiv
                .stop()
                .animate({"marginTop": ($(window).scrollTop() )}, "slow" );         
        });
	
})( jQuery );