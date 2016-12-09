jQuery(document).ready(function($) {
  $('.field-name-body').hover(function(){
    $(this).css("color", "red");
    }, function(){
    $(this).css("color", "black");
  });
});

jQuery(document).ready(function($){
  $('#logo img').click(function(){
    alert("don't touch my bread");
  });
});
