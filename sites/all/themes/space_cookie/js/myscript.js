jQuery(document).ready(function() {
  jQuery('a').hover(
    function() {
      jQuery(this).addClass('animated flash infinite');
      console.log("Yo");
    },
    function() {
      jQuery(this).removeClass('animated flash infinite');
      console.log("Yo out");
    }
  );
});
