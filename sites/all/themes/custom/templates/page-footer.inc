<footer id = "footer" class = "footer-section section footer-dark-orange">
  <?php if ($page['footer_menu'] || $page['footer_social']): ?>
  <div class = "container horizontal-menu ">
    <div class = "row">
      <?php if ($page['footer_menu']): ?>
      <div class = "footer-menu col-sm-8 xs-text-center text-left">
        <?php print render($page['footer_menu']); ?>
      </div>
      <?php endif; ?>
      <?php if ($page['footer_social']): ?>
      <div class = "col-sm-4 footer-social xs-text-center text-right">
        <?php print render($page['footer_social']); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if($theme_credits) : ?>
  <div class = "theme-credit text-center">
    <?php print $theme_credits; ?>
  </div>
  <?php endif; ?>

</footer>

