(function ($, Drupal, window, document) {

  'use strict';

  // To understand behaviors, see https://drupal.org/node/756722#behaviors
  Drupal.behaviors.my_custom_behavior = {
    attach: function (context, settings) {

        $("#page-wrapper").hide(); 
        $("#page-wrapper").slideDown(60000);

    }
  };

})(jQuery, Drupal, this, this.document);
