(function($) {

    $('article h4').each(function(index, element) {
        $(element).attr('id', 'toc'+index);
    });

    $('#review-left-sidebar h6 a').each( function(index, element) {
        $(element).attr('href', '#toc'+index);
    });

    function scrollToAnchor(aid){
        var aTag = $('#'+aid);
        $('html,body').animate({scrollTop: aTag.offset().top-100},'slow');
    }

    $('#review-left-sidebar h6 a').click( function( event ) {
        var href = $(event.target).attr('href').replace('#', '');
        scrollToAnchor(href)
    })

	
})( jQuery );