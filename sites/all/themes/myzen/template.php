<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function myzen_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  myzen_preprocess_html($variables, $hook);
  myzen_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function myzen_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function myzen_preprocess_page(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function myzen_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // myzen_preprocess_node_page() or myzen_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function myzen_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function myzen_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function myzen_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */
// adds a random custom slogan 
function myzen_preprocess_page(&$variables){

    $slogans = array(
    t("Life is Chocolate"),
    t("Life is Sweet"),
    t("Life is Taffy"),
    t("Life is a Candy Cane"),
    t("Life is Lucky Charms"),
    t("Life is Sprinkles"),
    t("Life is Coffee Cake!"),
    );
    $variables['site_slogan'] = $slogans[array_rand($slogans)];   
       
    //Add new variables to page.tpl
    if($variables['logged_in']){
    $variables['footer_message'] = t('Cookies are your friend, @username', array('@username' => $variables['user']->name)) . '!';
    }else{
        $variables['footer_message'] = t('Cookies are your friend');
    }
    if($variables['is_front'] == TRUE){
        drupal_add_css(path_to_theme().'/css/styles.css', array('group' => CSS_THEME, 'weight' => -10));
    }

    //kpr($variables); 
}
//adds a custom message to a page when the day matched the name of the tpl file
function myzen_preprocess_node(&$variables){
    //kpr($variables);
    if($variables['type'] == 'article'){
        $node = $variables['node'];
        //kpr($node);
        $variables['submitted_day'] = format_date($node->created, 'custom', 'j');
        $variables['submitted_month'] = format_date($node->created, 'custom', 'M');
        $variables['submitted_year'] = format_date($node->created, 'custom', 'Y');
        
    }
    if ($variables['type'] == 'page'){
        $today = strtolower(date('l'));
        $variables['theme_hook_suggestions'][] = 'node__'.$today;
        $variables['day_of_the_week'] = $today;
        //kpr($variables);
    }
}
// adds the path to the current page to the breadcrumb link
function myzen_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';
    $title = drupal_get_title();
    $output .= '<div class="breadcrumb">' . implode(' » ', $breadcrumb) . ' » ' . $title .'</div>';
    return $output;
  }
}
//theme_username()
function myzen_preprocess_username(&$variables){
    //kpr($variables);
    $account = user_load($variables['account']->uid);
    if(isset($account->field_real_name[LANGUAGE_NONE][0]['safe_value'])){
        $variables['name'] = $account->field_real_name[LANGUAGE_NONE][0]['safe_value'];
    }    
}
// changes output of taxonomy terms to be inline instead of vertically stacked
function myzen_field__field_tags($variables) {
  $output = '';  
  //kpr($variables);  
  $links = array();
  foreach($variables['items'] as $delta => $item){
      //kpr($item);
      $item['#options']['attributes'] += $variables['item_attributes_array'][$delta];
      //kpr($item);
      $links[] = drupal_render($item);
  }  
  $output .=implode(' | ', $links);
  return $output;
}
// example of removing a css file from the page source
function myzen_css_alter(&$css){
    //kpr($css);
    //unset($css['modules/system/system.menus.css']);
}

function myzen_page_alter(&$page){
    kpr($page);
}

