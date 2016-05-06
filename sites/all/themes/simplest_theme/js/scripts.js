jQuery(document).ready(function($){
    $('a').hover(function(){
        $(this).fadeOut( 50 );
        $(this).fadeIn(50);
    });
});
