jQuery(document).ready(function($) {
  $('#name-and-slogan h1').click(function(){
    var whines = ["But the home button is just right below us...", "No really there is a home link. It says home.", "Why does this site have two home links?", "You know I wanted to be an image link!"];
    var random = whines[Math.floor(Math.random() * whines.length)];
    alert(random);
  });
});
