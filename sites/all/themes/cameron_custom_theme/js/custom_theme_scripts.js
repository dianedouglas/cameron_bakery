jQuery(document).ready(function($) {
  $('#clickhere').click(function() {
    $('#main-content').removeClass('hidden');
    $('#welcome-message').addClass('hidden');
  })
})
