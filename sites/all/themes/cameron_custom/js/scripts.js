jQuery(document).ready(function($) {

    // $('#main-menu').slidedown('slow', function() {
    //
    // });
    $('#site-name').hover(function(){
        $(this).addClass("site-name-hover");
    },
        function() {
            $(this).removeClass("site-name-hover");
        }
    );
});
