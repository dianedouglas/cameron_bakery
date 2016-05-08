jQuery(document).ready(function($) {
  $('#site-name').mouseenter(function(){
    console.log('Welcome!');
  });
  $('#content > div > div.region.region-content').mouseleave(function(){
    console.log('Hope you enjoy your stay on the site!');
  });
  $('#edit-submit').click(function(){
    alert('Thanks for searching!');
  });
});
