/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.my_custom_behavior = {
  attach: function(context, settings) {

      jQuery(document).ready(function($){

          // $('.comment').hover(function(){
          //     var color = $(this).css('background-color');
          //     console.log(color);
          //     if(color !== 'rgb(255, 249, 231)'){
          //         $(this).css( 'background-color', '#FFF9E7' );
          //     }else{
          //         $(this).css( 'background-color', 'rgb(255, 253, 249)' );
          //     }
          // });
          $('.comment').mouseover(function(){
            // $(this).css( 'background-color', '#FFF9E7' );
            $(this).removeClass('not-hovering');
            $(this).addClass('hovering');
          }).mouseout(function(){
            // $(this).css( 'background-color', 'rgb(255, 253, 249)' );
            $(this).removeClass('hovering');
            $(this).addClass('not-hovering');
          });
      });
  }
};


})(jQuery, Drupal, this, this.document);
