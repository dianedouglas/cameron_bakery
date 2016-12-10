jQuery(document).ready(function($) {
    var aTag = $('#header').find('a');
    aTag.hover(function() {
        $(this).addClass('hovered');
    })
});
