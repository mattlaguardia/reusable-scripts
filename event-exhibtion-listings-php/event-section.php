<?php
if (count($events)) {
  ?>
  <section class="<?php echo $class; ?>">
    <header>
      <h1><?php echo (function_exists('pll__') ? pll__($title) : __($title)) ?></h1>
    </header>

    <div class="row child_page_list">
      <?php
      global $post;
      for ($i = 0; $i < count($events); $i++) {
        $post = $events[$i];
        ?>
        <!-- Event  -->
        <article id="post-<?php the_ID() ?>" class="large-6 block-grid-large column btrigger">
          <?php tribe_get_template_part('list/single', 'event') ?>
        </article><!-- .hentry .vevent -->
        <?php
      }
      ?>
    </div>
    <div class="row ">
      <div class="action_row">
        <a href="javascript:;" class="button secondary_button see_all_btn"><?php echo (function_exists('pll__') ? pll__('See All') : __('See All')) ?></a>
      </div>
    </div>
  </section>
  <?php
}
?>		