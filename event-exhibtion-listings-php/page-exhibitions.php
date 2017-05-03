<?php
/**
 * Template Name: Exhibitions Template
 * Description: A Page Template to events page
 *
 * @package  WordPress
 * @file     page-events.php
 * @author   Cainkade
 * @link 	 http://www.cainkade.com
 */
if (!defined('ABSPATH')) {
  die('-1');
}
?>

<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
?>

<?php get_header(); ?>

<?php if (have_posts()) : ?>

  <?php while (have_posts()) : the_post(); ?>

    <div class="hero">
      <?php
      if (has_post_thumbnail()) {
        $primary_header = get_post_meta($post->ID, 'primary_header', true);
        if (!empty($primary_header) || has_excerpt()) {
          ?>

          <header>
            <?php
            if (!empty($primary_header)) {
              ?>
              <h2><?php echo $primary_header; ?></h2>
              <?php
            }
            ?>
            <div class="overview">
              <!-- am i here?
              <?php var_dump($post); ?>
              -->
              <?php
              echo the_excerpt_max_charlength($post->post_excerpt, 125); //get excerpt
              ?>
            </div>
          </header>
          <?php
        }

        the_post_thumbnail('hero');
      }
      ?>
  <?php the_breadcrumb(); ?>
    </div>
    <div class="page_title">
      <div class="row">
        <h1 class="thin large-7 column"><?php the_title(); ?></h1>
        <?php if (is_plugin_active('share-this/sharethis.php')) { ?>
          <div class="large-3 column end">
            <a href="javascript:;" class="button secondary_button share_button icon_before">Share This</a>
            <span st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>' class='st_sharethis_large'></span>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<div class="page-content events-list">

  <?php
  $events= tribe_get_events(
         array(
             'eventDisplay'=>'upcoming',
             'tax_query'=> array(
                 array(
                     'taxonomy' => 'tribe_events_cat',
                     'field' => 'slug',
                     'terms' => 'exhibits'
                 )
             )
     ));
   if (count($events)) {
     $title = 'Upcoming Exhibitions';
     $class = 'upcoming_events';
     include('inc/event-section.php');
   }
   /*---- getting pas events and including them in event-section ----*/
  //$events = tribe_get_past_events();
   $events = tribe_get_events(
         array(
             'eventDisplay'=>'past',
             'tax_query'=> array(
                 array(
                     'taxonomy' => 'tribe_events_cat',
                     'field' => 'slug',
                     'terms' => 'exhibits'
                 )
             )
     ));
   if (count($events)) {
     $title = 'Past Exhibitions';
     $class = 'past_events';
     include('inc/event-section.php');
   }
   ?>
</div>

<?php
get_footer();
