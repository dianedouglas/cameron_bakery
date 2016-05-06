jQuery(document).ready(function($) {
    $('#main-menu a').addClass('animated');

    $('#main-menu a').click(function() {
        $(this).addClass('fadeIn');
    })

});
