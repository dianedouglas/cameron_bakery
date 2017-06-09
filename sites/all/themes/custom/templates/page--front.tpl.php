<?php
/**
 * @file
 * @see modules/system/page--front.tpl.php
 */
?>

<header role="banner" class="header-wrap header-brown-menu <?php print $navbar_classes; ?>" id = "navbar" data-spy="affix"  data-offset-top="70">
  <div class="<?php print $container_class; ?>">
    <div class="navbar-header">
      <?php if ($logo): ?>
        <a class="logo navbar-btn pull-left" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>">
          <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
        </a>
      <?php endif; ?>

      <?php if (!empty($site_name) || !empty($site_slogan)): ?>
        <a class="name navbar-brand hidden-xs" href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><?php print $site_name; ?> <span class = "lead"> <?php print $site_slogan; ?></span></a>
      <?php endif; ?>

      <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation'])): ?>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only"><?php print t('Toggle navigation'); ?></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      <?php endif; ?>
    </div>

    <?php if (!empty($primary_nav) || !empty($secondary_nav) || !empty($page['navigation']) || !empty($search_box)): ?>
      <div class="navbar-collapse collapse pull-right">
        <nav role="navigation">
          <?php if (!empty($primary_nav)): ?>
            <?php print render($primary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($secondary_nav)): ?>
            <?php print render($secondary_nav); ?>
          <?php endif; ?>
          <?php if (!empty($page['navigation'])): ?>
            <?php print render($page['navigation']); ?>
          <?php endif; ?>
          <?php if (!empty($search_box)): ?>
            <?php print render($search_box); ?>
          <?php endif; ?>          
        </nav>
      </div>
    <?php endif; ?>
  </div>
</header>

<?php print render($page['header_brown']); ?>


<?php print render($page['content_light_orange']); ?>	


<?php if ($display_content_regions) : ?>
  <?php print render($page['content']); ?>
<?php endif; ?>
  
<?php require_once __DIR__ . '/page-footer.inc'; ?>

