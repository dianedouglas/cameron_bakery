jQuery(document).ready(function($) {
  $('.field-name-field-photo').click(function(){
    $('.field-name-field-photo').slideToggle();
    $('.field-name-field-photo2').slideToggle();
  });
  $('.field-name-field-photo2').click(function(){
    $('.field-name-field-photo2').slideToggle();
    $('.field-name-field-photo').slideToggle();
  });
});
