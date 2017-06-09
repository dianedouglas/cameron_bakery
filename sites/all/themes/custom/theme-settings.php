<?php
/**
 * @file
 * - Theme settings file.
 */

if (!defined('__DIR__')) {
  define('__DIR__', dirname(__FILE__));
}

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function custom2_form_system_theme_settings_alter(&$form, $form_state) {
  $path_to_theme = drupal_get_path('theme', 'custom2');

  // Get the theme name.
  $theme = !empty($form_state['build_info']['args'][0]) ? $form_state['build_info']['args'][0] : FALSE;

  $homepage_regions['header_brown']['regionname']  = 'Header brown';
  $homepage_regions['header_brown']['designid']  = '59';
  $homepage_regions['content_light_orange']['regionname']  = 'Content light orange';
  $homepage_regions['content_light_orange']['designid']  = '110';
  $homepage_settings = _mbase_subtheme_themesettings($homepage_regions, $theme, 'frontpage', 'Front Page');
  $form = array_merge($form,$homepage_settings);

  $footer_regions['footer_social']['regionname']  = 'Footer Social';
  $footer_regions['footer_social']['designid']  = '72';
  $footer_regions['footer_menu']['regionname']  = 'Footer Menu';
  $footer_regions['footer_menu']['designid']  = '72';
  $footer_settings = _mbase_subtheme_themesettings($footer_regions, $theme, 'footer', 'Site wide Footer');
  $form = array_merge($form,$footer_settings);


}
