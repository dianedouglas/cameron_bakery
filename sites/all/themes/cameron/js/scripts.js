jQuery(document).ready(function($) {
    $('.content').css('display', 'none');
    $('.content').fadeIn(1000);

    $('.link').click(function() {
        event.preventDefault();
        newLocation = this.href;
    });

    function newpage() {
        window.location = newLocation;
    }

});
