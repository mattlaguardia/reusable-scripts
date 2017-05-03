<?php
/**
 * Template Name: Homepage
 * Description: A Page Template
 *
 * @package  WordPress
 * @file     home.php
 * @author   Cainkade
 * @link 	 http://www.cainkade.com
 */
?>
<?php get_header(); ?>

<?php
if ($paged < 2) {
  if (is_active_sidebar('homepage-carousel')) {
    dynamic_sidebar('homepage-carousel');
  }
  ?>

  <div class="office_bar row">
    <div class="large-6 column">
      <?php
      $txt = ck_get_settings('ck_homepage_title');
      echo (function_exists('pll__') ? pll__($txt) : $txt);
      ?>
    </div>
    <?php get_social_links(); ?>
  </div>

  <div class="main_content">
    <?php
    if (is_active_sidebar('homepage-content-1-left')) {
      ?>
      <div class="content row">
        <?php
        dynamic_sidebar('homepage-content-1-left');
        ?>
      </div>
      <?php
    }

    if (is_active_sidebar('homepage-content-2-left')) {
      ?>
      <div class="content alternate row">
        <?php
        dynamic_sidebar('homepage-content-2-left');
        ?>
      </div>
      <?php
    }

    if (is_active_sidebar('homepage-content-3-left')) {
      echo '<div class="content row">';
      dynamic_sidebar('homepage-content-3-left');
      echo '</div>';
    }
    ?>
  </div>
  <?php
}
?>


<?php get_footer(); ?>