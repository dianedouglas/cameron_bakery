<?php
/**
 * @file
 * Theme settings file.
 */

if (!defined('__DIR__')) {
  define('__DIR__', dirname(__FILE__));
}

require_once __DIR__ . '/includes/helper.inc';

/**
 * Implements hook_form_system_theme_settings_alter().
 */
function mbase_form_system_theme_settings_alter(&$form, $form_state) {
  // Get the theme name.
  $theme = !empty($form_state['build_info']['args'][0]) ? $form_state['build_info']['args'][0] : FALSE;
  $jquery_message = t('jQuery Update is not enabled, Bootstrap requires a minimum jQuery version of 1.9 or higher. Please enable the <a href="!jquery_update_project_url">jQuery Update</a> module @jquery_update_version or higher. If you are seeing this, then you must <a href="!jquery_update_configure">manually configuration</a> this setting or optionally <a href="!bootstrap_suppress_jquery_error">suppress this message</a> instead.', array(
      '@jquery_update_version' => '7.x-2.5',
      '!jquery_update_project_url' => 'https://www.drupal.org/project/jquery_update',
      '!jquery_update_configure' => url('admin/config/development/jquery_update'),
      '!bootstrap_suppress_jquery_error' => url('admin/appearance/settings/' . $theme, array(
        'fragment' => 'edit-bootstrap-toggle-jquery-error',
      )),
    ));
  // Display a warning if jquery_update isn't enabled.
  if ((!module_exists('jquery_update') || !version_compare(variable_get('jquery_update_jquery_version', '1.10'), '1.9', '>=')) && !_mbase_setting('toggle_jquery_error', $theme)) {
    drupal_set_message(filter_xss($jquery_message), 'error', FALSE);
  }

  // Create vertical tabs for all Bootstrap related settings.
  $form['bootstrap'] = array(
    '#type' => 'vertical_tabs',
    '#attached' => array(
      'js'  => array(drupal_get_path('theme', 'mbase') . '/js/bootstrap.admin.js'),
    ),
    '#prefix' => '<h2><small>' . t('Bootstrap Settings') . '</small></h2>',
    '#weight' => -10,
  );

  // General.
  $form['general'] = array(
    '#type' => 'fieldset',
    '#title' => t('General'),
    '#group' => 'bootstrap',
  );

  // Container.
  $form['general']['container'] = array(
    '#type' => 'fieldset',
    '#title' => t('Container'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['container']['mbase_fluid_container'] = array(
    '#type' => 'checkbox',
    '#title' => t('Fluid container'),
    '#default_value' => _mbase_setting('fluid_container', $theme),
    '#description' => t('Use <code>.container-fluid</code> class. See <a href="http://getbootstrap.com/css/#grid-example-fluid">Fluid container</a>'),
  );

  // Buttons.
  $form['general']['buttons'] = array(
    '#type' => 'fieldset',
    '#title' => t('Buttons'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['buttons']['mbase_button_size'] = array(
    '#type' => 'select',
    '#title' => t('Default button size'),
    '#default_value' => _mbase_setting('button_size', $theme),
    '#empty_option' => t('Normal'),
    '#options' => array(
      'btn-xs' => t('Extra Small'),
      'btn-sm' => t('Small'),
      'btn-lg' => t('Large'),
    ),
  );
  $form['general']['buttons']['mbase_button_colorize'] = array(
    '#type' => 'checkbox',
    '#title' => t('Colorize Buttons'),
    '#default_value' => _mbase_setting('button_colorize', $theme),
    '#description' => t('Adds classes to buttons based on their text value. See: <a href="!bootstrap_url" target="_blank">Buttons</a> and <a href="!api_url" target="_blank">hook_bootstrap_colorize_text_alter()</a>', array(
      '!bootstrap_url' => 'http://getbootstrap.com/css/#buttons',
      '!api_url' => 'http://drupalcode.org/project/bootstrap.git/blob/refs/heads/7.x-3.x:/bootstrap.api.php#l13',
    )),
  );
  $form['general']['buttons']['mbase_button_iconize'] = array(
    '#type' => 'checkbox',
    '#title' => t('Iconize Buttons'),
    '#default_value' => _mbase_setting('button_iconize', $theme),
    '#description' => t('Adds icons to buttons based on the text value. See: <a href="!api_url" target="_blank">hook_bootstrap_iconize_text_alter()</a>', array(
      '!api_url' => 'http://drupalcode.org/project/bootstrap.git/blob/refs/heads/7.x-3.x:/bootstrap.api.php#l37',
    )),
  );

  // Forms.
  $form['general']['forms'] = array(
    '#type' => 'fieldset',
    '#title' => t('Forms'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['forms']['mbase_forms_required_has_error'] = array(
    '#type' => 'checkbox',
    '#title' => t('Make required elements display as an error'),
    '#default_value' => _mbase_setting('forms_required_has_error', $theme),
    '#description' => t('If an element in a form is required, enabling this will always display the element with a <code>.has-error</code> class. This turns the element red and helps in usability for determining which form elements are required to submit the form.  This feature compliments the "JavaScript > Forms > Automatically remove error classes when values have been entered" feature.'),
  );
  $form['general']['forms']['mbase_forms_smart_descriptions'] = array(
    '#type' => 'checkbox',
    '#title' => t('Smart form descriptions (via Tooltips)'),
    '#description' => t('Convert descriptions into tooltips (must be enabled) automatically based on certain criteria. This helps reduce the, sometimes unnecessary, amount of noise on a page full of form elements.'),
    '#default_value' => _mbase_setting('forms_smart_descriptions', $theme),
  );
  $form['general']['forms']['mbase_forms_smart_descriptions_limit'] = array(
    '#type' => 'textfield',
    '#title' => t('"Smart form descriptions" maximum character limit'),
    '#description' => t('Prevents descriptions from becoming tooltips by checking the character length of the description (HTML is not counted towards this limit). To disable this filtering criteria, leave an empty value.'),
    '#default_value' => _mbase_setting('forms_smart_descriptions_limit', $theme),
    '#states' => array(
      'visible' => array(
        ':input[name="bootstrap_forms_smart_descriptions"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['general']['forms']['mbase_forms_smart_descriptions_allowed_tags'] = array(
    '#type' => 'textfield',
    '#title' => t('"Smart form descriptions" allowed (HTML) tags'),
    '#description' => t('Prevents descriptions from becoming tooltips by checking for HTML not in the list above (i.e. links). Separate by commas. To disable this filtering criteria, leave an empty value.'),
    '#default_value' => _mbase_setting('forms_smart_descriptions_allowed_tags', $theme),
    '#states' => array(
      'visible' => array(
        ':input[name="bootstrap_forms_smart_descriptions"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Images.
  $form['general']['images'] = array(
    '#type' => 'fieldset',
    '#title' => t('Images'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['images']['mbase_image_shape'] = array(
    '#type' => 'select',
    '#title' => t('Default image shape'),
    '#description' => t('Add classes to an <code>&lt;img&gt;</code> element to easily style images in any project. Note: Internet Explorer 8 lacks support for rounded corners. See: <a href="!bootstrap_url" target="_blank">Image Shapes</a>', array(
      '!bootstrap_url' => 'http://getbootstrap.com/css/#images-shapes',
    )),
    '#default_value' => _mbase_setting('image_shape', $theme),
    '#empty_option' => t('None'),
    '#options' => array(
      'img-rounded' => t('Rounded'),
      'img-circle' => t('Circle'),
      'img-thumbnail' => t('Thumbnail'),
    ),
  );
  $form['general']['images']['mbase_image_responsive'] = array(
    '#type' => 'checkbox',
    '#title' => t('Responsive Images'),
    '#default_value' => _mbase_setting('image_responsive', $theme),
    '#description' => t('Images in Bootstrap 3 can be made responsive-friendly via the addition of the <code>.img-responsive</code> class. This applies <code>max-width: 100%;</code> and <code>height: auto;</code> to the image so that it scales nicely to the parent element.'),
  );

  // Tables.
  $form['general']['tables'] = array(
    '#type' => 'fieldset',
    '#title' => t('Tables'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['tables']['mbase_table_bordered'] = array(
    '#type' => 'checkbox',
    '#title' => t('Bordered table'),
    '#default_value' => _mbase_setting('table_bordered', $theme),
    '#description' => t('Add borders on all sides of the table and cells.'),
  );
  $form['general']['tables']['mbase_table_condensed'] = array(
    '#type' => 'checkbox',
    '#title' => t('Condensed table'),
    '#default_value' => _mbase_setting('table_condensed', $theme),
    '#description' => t('Make tables more compact by cutting cell padding in half.'),
  );
  $form['general']['tables']['mbase_table_hover'] = array(
    '#type' => 'checkbox',
    '#title' => t('Hover rows'),
    '#default_value' => _mbase_setting('table_hover', $theme),
    '#description' => t('Enable a hover state on table rows.'),
  );
  $form['general']['tables']['mbase_table_striped'] = array(
    '#type' => 'checkbox',
    '#title' => t('Striped rows'),
    '#default_value' => _mbase_setting('table_striped', $theme),
    '#description' => t('Add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>. <strong>Note:</strong> Striped tables are styled via the <code>:nth-child</code> CSS selector, which is not available in Internet Explorer 8.'),
  );
  $form['general']['tables']['mbase_table_responsive'] = array(
    '#type' => 'checkbox',
    '#title' => t('Responsive tables'),
    '#default_value' => _mbase_setting('table_responsive', $theme),
    '#description' => t('Makes tables responsive by wrapping them in <code>.table-responsive</code> to make them scroll horizontally up to small devices (under 768px). When viewing on anything larger than 768px wide, you will not see any difference in these tables.'),
  );

  // Components.
  $form['components'] = array(
    '#type' => 'fieldset',
    '#title' => t('Components'),
    '#group' => 'bootstrap',
  );

  // Breadcrumbs.
  $form['components']['breadcrumbs'] = array(
    '#type' => 'fieldset',
    '#title' => t('Breadcrumbs'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['components']['breadcrumbs']['mbase_breadcrumb'] = array(
    '#type' => 'select',
    '#title' => t('Breadcrumb visibility'),
    '#default_value' => _mbase_setting('breadcrumb', $theme),
    '#options' => array(
      0 => t('Hidden'),
      1 => t('Visible'),
      2 => t('Only in admin areas'),
    ),
  );
  $form['components']['breadcrumbs']['mbase_breadcrumb_prefix'] = array(
    '#type' => 'textfield',
    '#title' => t('Breadcrumb Prefix'),
    '#default_value' => _mbase_setting('breadcrumb_prefix', $theme),
    '#description' => t('Show the prefix header to the breadcrumb.'),
  );
  $form['components']['breadcrumbs']['mbase_breadcrumb_home'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show "Home" breadcrumb link'),
    '#default_value' => _mbase_setting('breadcrumb_home', $theme),
    '#description' => t('If your site has a module dedicated to handling breadcrumbs already, ensure this setting is enabled.'),
    '#states' => array(
      'invisible' => array(
        ':input[name="bootstrap_breadcrumb"]' => array('value' => 0),
      ),
    ),
  );
  $form['components']['breadcrumbs']['mbase_breadcrumb_title'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show current page title at end'),
    '#default_value' => _mbase_setting('breadcrumb_title', $theme),
    '#description' => t('If your site has a module dedicated to handling breadcrumbs already, ensure this setting is disabled.'),
    '#states' => array(
      'invisible' => array(
        ':input[name="bootstrap_breadcrumb"]' => array('value' => 0),
      ),
    ),
  );

  // Navbar.
  $form['components']['navbar'] = array(
    '#type' => 'fieldset',
    '#title' => t('Navbar'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['components']['navbar']['mbase_navbar_position'] = array(
    '#type' => 'select',
    '#title' => t('Navbar Position'),
    '#description' => t('Select your Navbar position.'),
    '#default_value' => _mbase_setting('navbar_position', $theme),
    '#options' => array(
      'static-top' => t('Static Top'),
      'fixed-top' => t('Fixed Top'),
      'fixed-bottom' => t('Fixed Bottom'),
    ),
    '#empty_option' => t('Normal'),
  );
  $form['components']['navbar']['mbase_navbar_inverse'] = array(
    '#type' => 'checkbox',
    '#title' => t('Inverse navbar style'),
    '#description' => t('Select if you want the inverse navbar style.'),
    '#default_value' => _mbase_setting('navbar_inverse', $theme),
  );

  // Region wells.
  $wells = array(
    '' => t('None'),
    'well' => t('.well (normal)'),
    'well well-sm' => t('.well-sm (small)'),
    'well well-lg' => t('.well-lg (large)'),
  );
  $form['components']['region_wells'] = array(
    '#type' => 'fieldset',
    '#title' => t('Region wells'),
    '#description' => t('Enable the <code>.well</code>, <code>.well-sm</code> or <code>.well-lg</code> classes for specified regions. See: documentation on !wells.', array(
      '!wells' => l(t('Bootstrap Wells'), 'http://getbootstrap.com/components/#wells'),
    )),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  // Get defined regions.
  $regions = system_region_list($theme);
  foreach ($regions as $name => $title) {
    $form['components']['region_wells']['mbase_region_well-' . $name] = array(
      '#title' => $title,
      '#type' => 'select',
      '#attributes' => array(
        'class' => array('input-sm'),
      ),
      '#options' => $wells,
      '#default_value' => _mbase_setting('region_well-' . $name, $theme),
    );
  }
  // Region visibility.
  $breakpoints = array(
    'xs' => t('Extra small devices (Phones)'),
    'sm' => t('Small devices (Tablets)'),
    'md' => t('Medium devices (Desktops)'),
    'lg' => t('Large devices (Desktops)'),
  );
  $form['components']['region_visibility'] = array(
    '#type' => 'fieldset',
    '#title' => t('Region Visibility'),
    '#description' => t('Choose the visibility per breakpoints per region. See: documentation on !responsive.', array(
      '!responsive' => l(t('Bootstrap Responsive utilities'), 'http://getbootstrap.com/css/#responsive-utilities'),
    )),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  foreach ($regions as $name => $title) {
    $form['components']['region_visibility'][$name] = array(
      '#type' => 'fieldset',
      '#title' => $name,
      '#collapsible' => FALSE,
    );
    foreach ($breakpoints as $devicekey => $devicename) {
      $visibility_options = array(
        'visible-' . $devicekey . '-block' => t('Display as block'),
        'visible-' . $devicekey . '-inline' => t('Display as inline'),
        'visible-' . $devicekey . '-inline-block' => t('Display as inline block'),
        'hidden-' . $devicekey => t('Hide from display'),
      );
      $form['components']['region_visibility'][$name]['mbase_region_visibility-' . $name . '-' . $devicekey] = array(
        '#title' => $devicename,
        '#type' => 'select',
        '#attributes' => array(
          'class' => array('input-sm'),
        ),
        '#options' => $visibility_options,
        '#default_value' => _mbase_setting('region_visibility-' . $name . '-' . $devicekey, $theme),
      );
    }
  }
  // Other Bootstrap settings.
  $form['components']['other'] = array(
    '#type' => 'fieldset',
    '#title' => t('Other settings'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['components']['other']['mbase_alert_dismissible'] = array(
    '#type' => 'checkbox',
    '#title' => t('Dismissible Alert'),
    '#description' => t("Makes the alert messages dismissable."),
    '#default_value' => _mbase_setting('alert_dismissible', $theme),
  );
  // JavaScript settings.
  $form['javascript'] = array(
    '#type' => 'fieldset',
    '#title' => t('JavaScript'),
    '#group' => 'bootstrap',
  );

  // Anchors.
  $form['javascript']['anchors'] = array(
    '#type' => 'fieldset',
    '#title' => t('Anchors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascript']['anchors']['mbase_anchors_fix'] = array(
    '#type' => 'checkbox',
    '#title' => t('Fix anchor positions'),
    '#default_value' => _mbase_setting('anchors_fix', $theme),
    '#description' => t('Ensures anchors are correctly positioned only when there is margin or padding detected on the BODY element. This is useful when fixed navbar or administration menus are used.'),
  );
  $form['javascript']['anchors']['mbase_anchors_smooth_scrolling'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable smooth scrolling'),
    '#default_value' => _mbase_setting('anchors_smooth_scrolling', $theme),
    '#description' => t('Animates page by scrolling to an anchor link target smoothly when clicked.'),
    '#states' => array(
      'invisible' => array(
        ':input[name="bootstrap_anchors_fix"]' => array('checked' => FALSE),
      ),
    ),
  );

  // Forms.
  $form['javascript']['forms'] = array(
    '#type' => 'fieldset',
    '#title' => t('Forms'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascript']['forms']['mbase_forms_has_error_value_toggle'] = array(
    '#type' => 'checkbox',
    '#title' => t('Automatically remove error classes when values have been entered'),
    '#default_value' => _mbase_setting('forms_has_error_value_toggle', $theme),
    '#description' => t('If an element has a <code>.has-error</code> class attached to it, enabling this will automatically remove that class when a value is entered. This feature compliments the "General > Forms > Make required elements display as an error" feature.'),
  );

  // Popovers.
  $form['javascript']['popovers'] = array(
    '#type' => 'fieldset',
    '#title' => t('Popovers'),
    '#description' => t('Add small overlays of content, like those on the iPad, to any element for housing secondary information.'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascript']['popovers']['mbase_popover_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable popovers.'),
    '#description' => t('Elements that have the !code attribute set will automatically initialize the popover upon page load. !warning', array(
      '!code' => '<code>data-toggle="popover"</code>',
      '!warning' => '<strong class="error text-error">WARNING: This feature can sometimes impact performance. Disable if pages appear to "hang" after initial load.</strong>',
    )),
    '#default_value' => _mbase_setting('popover_enabled', $theme),
  );
  $form['javascript']['popovers']['options'] = array(
    '#type' => 'fieldset',
    '#title' => t('Options'),
    '#description' => t('These are global options. Each popover can independently override desired settings by appending the option name to !data. Example: !data-animation.', array(
      '!data' => '<code>data-</code>',
      '!data-animation' => '<code>data-animation="false"</code>',
    )),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#states' => array(
      'visible' => array(
        ':input[name="bootstrap_popover_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['javascript']['popovers']['options']['mbase_popover_animation'] = array(
    '#type' => 'checkbox',
    '#title' => t('animate'),
    '#description' => t('Apply a CSS fade transition to the popover.'),
    '#default_value' => _mbase_setting('popover_animation', $theme),
  );
  $form['javascript']['popovers']['options']['mbase_popover_html'] = array(
    '#type' => 'checkbox',
    '#title' => t('HTML'),
    '#description' => t("Insert HTML into the popover. If false, jQuery's text method will be used to insert content into the DOM. Use text if you're worried about XSS attacks."),
    '#default_value' => _mbase_setting('popover_html', $theme),
  );
  $form['javascript']['popovers']['options']['mbase_popover_placement'] = array(
    '#type' => 'select',
    '#title' => t('placement'),
    '#description' => t('Where to position the popover. When "auto" is specified, it will dynamically reorient the popover. For example, if placement is "auto left", the popover will display to the left when possible, otherwise it will display right.'),
    '#default_value' => _mbase_setting('popover_placement', $theme),
    '#options' => drupal_map_assoc(array(
      'top',
      'bottom',
      'left',
      'right',
      'auto',
      'auto top',
      'auto bottom',
      'auto left',
      'auto right',
    )),
  );
  $form['javascript']['popovers']['options']['mbase_popover_selector'] = array(
    '#type' => 'textfield',
    '#title' => t('selector'),
    '#description' => t('If a selector is provided, tooltip objects will be delegated to the specified targets. In practice, this is used to enable dynamic HTML content to have popovers added. See !this and !example.', array(
      '!this' => l(t('this'), 'https://github.com/twbs/bootstrap/issues/4215'),
      '!example' => l(t('an informative example'), 'http://jsfiddle.net/fScua/'),
    )),
    '#default_value' => _mbase_setting('popover_selector', $theme),
  );
  $form['javascript']['popovers']['options']['mbase_popover_trigger'] = array(
    '#type' => 'checkboxes',
    '#title' => t('trigger'),
    '#description' => t('How a popover is triggered.'),
    '#default_value' => _mbase_setting('popover_trigger', $theme),
    '#options' => drupal_map_assoc(array(
      'click',
      'hover',
      'focus',
      'manual',
    )),
  );
  $form['javascript']['popovers']['options']['mbase_popover_trigger_autoclose'] = array(
    '#type' => 'checkbox',
    '#title' => t('Auto-close on document click'),
    '#description' => t('Will automatically close the current popover if a click occurs anywhere else other than the popover element.'),
    '#default_value' => _mbase_setting('popover_trigger_autoclose', $theme),
  );
  $form['javascript']['popovers']['options']['mbase_popover_title'] = array(
    '#type' => 'textfield',
    '#title' => t('title'),
    '#description' => t("Default title value if \"title\" attribute isn't present."),
    '#default_value' => _mbase_setting('popover_title', $theme),
  );
  $form['javascript']['popovers']['options']['mbase_popover_content'] = array(
    '#type' => 'textfield',
    '#title' => t('content'),
    '#description' => t('Default content value if "data-content" or "data-target" attributes are not present.'),
    '#default_value' => _mbase_setting('popover_content', $theme),
  );
  $form['javascript']['popovers']['options']['mbase_popover_delay'] = array(
    '#type' => 'textfield',
    '#title' => t('delay'),
    '#description' => t('The amount of time to delay showing and hiding the popover (in milliseconds). Does not apply to manual trigger type.'),
    '#default_value' => _mbase_setting('popover_delay', $theme),
  );
  $form['javascript']['popovers']['options']['mbase_popover_container'] = array(
    '#type' => 'textfield',
    '#title' => t('container'),
    '#description' => t('Appends the popover to a specific element. Example: "body". This option is particularly useful in that it allows you to position the popover in the flow of the document near the triggering element - which will prevent the popover from floating away from the triggering element during a window resize.'),
    '#default_value' => _mbase_setting('popover_container', $theme),
  );

  // Tooltips.
  $form['javascript']['tooltips'] = array(
    '#type' => 'fieldset',
    '#title' => t('Tooltips'),
    '#description' => t("Inspired by the excellent jQuery.tipsy plugin written by Jason Frame; Tooltips are an updated version, which don't rely on images, use CSS3 for animations, and data-attributes for local title storage. See !link for more documentation.", array(
      '!link' => l(t('Bootstrap tooltips'), 'http://getbootstrap.com/javascript/#tooltips'),
    )),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascript']['tooltips']['mbase_tooltip_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable tooltips'),
    '#description' => t('Elements that have the !code attribute set will automatically initialize the tooltip upon page load. !warning', array(
      '!code' => '<code>data-toggle="tooltip"</code>',
      '!warning' => '<strong class="error text-error">WARNING: This feature can sometimes impact performance. Disable if pages appear to "hang" after initial load.</strong>',
    )),
    '#default_value' => _mbase_setting('tooltip_enabled', $theme),
  );
  $form['javascript']['tooltips']['options'] = array(
    '#type' => 'fieldset',
    '#title' => t('Options'),
    '#description' => t('These are global options. Each tooltip can independently override desired settings by appending the option name to !data. Example: !data-animation.', array(
      '!data' => '<code>data-</code>',
      '!data-animation' => '<code>data-animation="false"</code>',
    )),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
    '#states' => array(
      'visible' => array(
        ':input[name="bootstrap_tooltip_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['javascript']['tooltips']['options']['mbase_tooltip_animation'] = array(
    '#type' => 'checkbox',
    '#title' => t('animate'),
    '#description' => t('Apply a CSS fade transition to the tooltip.'),
    '#default_value' => _mbase_setting('tooltip_animation', $theme),
  );
  $form['javascript']['tooltips']['options']['mbase_tooltip_html'] = array(
    '#type' => 'checkbox',
    '#title' => t('HTML'),
    '#description' => t("Insert HTML into the tooltip. If false, jQuery's text method will be used to insert content into the DOM. Use text if you're worried about XSS attacks."),
    '#default_value' => _mbase_setting('tooltip_html', $theme),
  );
  $form['javascript']['tooltips']['options']['mbase_tooltip_placement'] = array(
    '#type' => 'select',
    '#title' => t('placement'),
    '#description' => t('Where to position the tooltip. When "auto" is specified, it will dynamically reorient the tooltip. For example, if placement is "auto left", the tooltip will display to the left when possible, otherwise it will display right.'),
    '#default_value' => _mbase_setting('tooltip_placement', $theme),
    '#options' => drupal_map_assoc(array(
      'top',
      'bottom',
      'left',
      'right',
      'auto',
      'auto top',
      'auto bottom',
      'auto left',
      'auto right',
    )),
  );
  $form['javascript']['tooltips']['options']['mbase_tooltip_selector'] = array(
    '#type' => 'textfield',
    '#title' => t('selector'),
    '#description' => t('If a selector is provided, tooltip objects will be delegated to the specified targets.'),
    '#default_value' => _mbase_setting('tooltip_selector', $theme),
  );
  $form['javascript']['tooltips']['options']['mbase_tooltip_trigger'] = array(
    '#type' => 'checkboxes',
    '#title' => t('trigger'),
    '#description' => t('How a tooltip is triggered.'),
    '#default_value' => _mbase_setting('tooltip_trigger', $theme),
    '#options' => drupal_map_assoc(array(
      'click',
      'hover',
      'focus',
      'manual',
    )),
  );
  $form['javascript']['tooltips']['options']['mbase_tooltip_delay'] = array(
    '#type' => 'textfield',
    '#title' => t('delay'),
    '#description' => t('The amount of time to delay showing and hiding the tooltip (in milliseconds). Does not apply to manual trigger type.'),
    '#default_value' => _mbase_setting('tooltip_delay', $theme),
  );
  $form['javascript']['tooltips']['options']['mbase_tooltip_container'] = array(
    '#type' => 'textfield',
    '#title' => t('container'),
    '#description' => t('Appends the tooltip to a specific element. Example: "body"'),
    '#default_value' => _mbase_setting('tooltip_container', $theme),
  );

  // Fonts settings.
  $form['cdn'] = array(
    '#type' => 'fieldset',
    '#title' => t('CDNs'),
    '#group' => 'bootstrap',
  );
  if ($theme == 'mbase') {
    // Bootstrap CSS CDN URL.
    $form['cdn']['mbase_bscdn_css'] = array(
      '#type' => 'textfield',
      '#title' => t('Bootstrap CSS URL'),
      '#description' => t('It is best to use protocol relative URLs (i.e. without http: or https:) here as it will allow more flexibility if the need ever arises. You can use either minified or normal version. Leave blank if you want add bootstrap library by other means.'),
      '#default_value' => _mbase_setting('bscdn_css', $theme),
    );
    // Bootstrap JS CDN URL.
    $form['cdn']['mbase_bscdn_js'] = array(
      '#type' => 'textfield',
      '#title' => t('Bootstrap JS URL'),
      '#description' => t('Additionally, you can provide the minimized version of the file. It will be used instead if site aggregation is enabled. You can use either minified or normal version. Leave blank if you want add bootstrap library by other means.'),
      '#default_value' => _mbase_setting('bscdn_js', $theme),
    );
    // Font awesome link.
    $form['cdn']['mbase_fontawesome'] = array(
      '#type' => 'textfield',
      '#title' => t('Font Awesome link'),
      '#description' => t('Enter the CDN link for fontawesome, Leave it blank if dont want or load via other modules like iconapi.'),
      '#default_value' => _mbase_setting('fontawesome', $theme),
    );
    // Google Fonts link.
    $form['cdn']['mbase_googlefont'] = array(
      '#type' => 'textfield',
      '#title' => t('Google Font link'),
      '#description' => t('Enter the google font link. Leave it blank if you dont want, or if you like to load via fontyourface module.'),
      '#default_value' => _mbase_setting('googlefont', $theme),
    );
  }
  // External CSS link.
  $form['cdn']['mbase_external_css'] = array(
    '#type' => 'textarea',
    '#title' => t('Include External CSS files.'),
    '#description' => t('Enter the External CSS file Links. Enter one link per line'),
    '#default_value' => _mbase_setting('external_css', $theme),
  );
  // External CSS link.
  $form['cdn']['mbase_external_js'] = array(
    '#type' => 'textarea',
    '#title' => t('Include External JS files.'),
    '#description' => t('Enter the External JS file Links. Enter one link per line'),
    '#default_value' => _mbase_setting('external_js', $theme),
  );
  // Advanced settings.
  $form['advanced'] = array(
    '#type' => 'fieldset',
    '#title' => t('Advanced'),
    '#group' => 'bootstrap',
  );
  // Option to hide and show the home page content region for child theme.
  if ($theme != 'mbase') {
    $form['advanced']['mbase_toggle_frontpage_content'] = array(
      '#type' => 'checkbox',
      '#title' => t('Show content region in front page'),
      '#default_value' => _mbase_setting('toggle_frontpage_content', $theme),
      '#description' => t('Toggle the content region in front page. Especally useful if the sub-theme generated using cmsbots.com'),
    );
  }
  // jQuery Update error suppression.
  $form['advanced']['mbase_toggle_jquery_error'] = array(
    '#type' => 'checkbox',
    '#title' => t('Suppress jQuery version error message'),
    '#default_value' => _mbase_setting('toggle_jquery_error', $theme),
    '#description' => t('Enable this if the version of jQuery has been upgraded to 1.9+ using a method other than the <a href="!jquery_update" target="_blank">jQuery Update</a> module.', array(
      '!jquery_update' => 'https://drupal.org/project/jquery_update',
    )),
  );
  $form['advanced']['mbase_search_box'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Searchbox'),
    '#default_value' => _mbase_setting('search_box', $theme),
    '#description' => t('Show search box in navigation.'),
  );
  $form['advanced']['mbase_flatit'] = array(
    '#type' => 'checkbox',
    '#title' => t('Flat it'),
    '#default_value' => _mbase_setting('flatit', $theme),
    '#description' => t('Overrides all the border radius to zero.'),
  );
  $form['advanced']['mbase_animatecss'] = array(
    '#type' => 'checkbox',
    '#title' => t('Add animate.css'),
    '#default_value' => _mbase_setting('animatecss', $theme),
    '#description' => t('Select to add CSS3 animations to site. Using <a href="@animation" target = "_blank">Animate.css</a> CSS.', array('@animation' => 'https://github.com/daneden/animate.css')),
  );
  $form['advanced']['mbase_credits'] = array(
    '#type' => 'checkbox',
    '#title' => t('Display credits'),
    '#default_value' => _mbase_setting('credits', $theme),
    '#description' => t('Display the theme credits to cmsbots.com at bottom of footer.'),
  );
}
