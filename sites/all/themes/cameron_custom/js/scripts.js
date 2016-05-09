jQuery(document).ready(function($) {

    $('#site-slogan').click(function() {
        $( "#site-slogan" ).animate({
            height: "toggle"
        }, 5000, function() {
        });
    });


    $('#site-slogan').click(function() {
        alert("Cookies for all!");
    });


    $('#site-name').hover(function(){
        $(this).addClass("site-name-hover");
    },
        function() {
            $(this).removeClass("site-name-hover");
        }
    );
});
