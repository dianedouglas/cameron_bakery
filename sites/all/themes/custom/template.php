<?php
/**
 * @file template.php
 */

// Ensure that __DIR__ constant is defined:
if (!defined('__DIR__')) {
    define('__DIR__', dirname(__FILE__));
}

drupal_static_reset('element_info');

global $theme_name;
global $regions;

$theme_name = 'custom2';
$regions = array('header_brown',
  'content_light_orange',
  'footer_social',
  'footer_menu',
);

/**
 * Implements hook_preprocess_page().
 */
function custom2_preprocess_page(&$variables) {
  global $theme_name;
  global $regions;
  // Implement smart region rendering for all applicable blocks.
  if (!empty($regions)) {
    _mbase_smart_region($variables, $regions, $theme_name);
  }
  
  $variables['display_content_regions'] = _mbase_setting('toggle_frontpage_content', $theme_name, '');
  
}
