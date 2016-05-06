jQuery(document).ready(function($) {

    // $('#site-slogan').click(function() {
    //     $( "#site-slogan" ).animate({
    //         opacity: 0.25,
    //         left: "+=50",
    //         height: "toggle"
    //     }, 5000, function() {
    //     // Animation complete.
    //     });
    // });




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
