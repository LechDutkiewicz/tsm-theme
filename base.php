<?php

use Roots\Sage\Setup;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part('templates/head'); ?>
<body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
    do_action('get_header');
      // get_template_part('templates/header');
    ?>
    <div class="off-canvas-wrapper">

      <div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
        <?= get_template_part("templates/off-canvas", "left"); ?>
      </div>
      <div class="off-canvas-content" data-off-canvas-content>
        <?= get_template_part("templates/navigation", "bar"); ?>
        <main class="grid-container menu__mobile--container">
          <?= get_template_part("templates/navigation", "mobile"); ?>
          <?php include Wrapper\template_path(); ?>
        </main>
        <?php 
        do_action('get_footer');
        if (!is_front_page() &&
          !is_page_template( "template-services.php" ) &&
          !is_page_template( "template-contact.php" )
        ) {
          get_template_part('templates/footer');
      }
      ?>
    </div><!-- /.content -->
  </div><!-- /.wrap -->
  <?php
  do_action('get_footer');
  get_template_part('templates/footer');
  wp_footer();
  ?>
</body>
</html>
