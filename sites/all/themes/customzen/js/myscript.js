jQuery(document).ready(function($) {
    $('#page header').hover(function(){
    $(this).css("background-color", "blue");
    }, function() {
    $(this).css("background-color", "red");
    });
});


//     $("a").hover(function(){
//         $(this).css("background-color", "yellow");
//         }, function(){
//         $(this).css("background-color", "pink");
//     });
// });
