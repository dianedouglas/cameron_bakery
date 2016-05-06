jQuery(document).ready(function() {
  jQuery('a').hover(
    function() {
      jQuery(this).addClass('animated flash');
      console.log("Yo");
    },
    function() {
      jQuery('#header').removeClass('animated flash');
      console.log("Yo out");
    }
  );
});
