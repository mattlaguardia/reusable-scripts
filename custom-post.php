<?php
// NOTE: Don't forget about meta tags
// NOTE: If statements that looks to see if there is content and posts content if there is
 ?>
 <?php get_header();
 $main_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );?>
 <div class="property-listing-container main-image" style="background:url(<?php echo $main_image[0];?>);">
     <div class="current-status"><?php the_field('current_status');?></div>
     <div class="property-listing-wrapper">
         <div class="property-listing-container">
             <div class="overlay-text">
                 <div class="agent-name"><?php the_field('agent_name_main_title');?></div>
                 <div class="property-name"><?php the_field('property_name');?></div>
                 <div class="summary"><?php the_field('summary_details');?></div>
             </div>
         </div>
     </div>
 </div>
 <?php $video_tour = get_field('include_video_tour');
 if($video_tour == 'enable'){?>
 <div class="property-listing-container video-tour">
     <div class="property-listing-wrapper">
         <div class="property-listing-container">
             <h2>Take a Tour</h2>
             <iframe id="video_tour_video" class="iframe_video" width="100%" height="581" frameborder="0" allowfullscreen="" mozallowfullscreen="" webkitallowfullscreen="" src="<?php the_field('video_tour');?>" wmode="Opaque"></iframe>
         </div>
     </div>
 </div>
 <?php } ?>
 <div class="property-listing-container features" style="background:url('<?php the_field('feature_background_image');?> ')no-repeat;background-size:cover;">
     <div class="property-listing-wrapper">
         <div class="property-listing-container">
             <div class="features">
                 <div class="body">
                     <div class="title">Features</div>
                     <div class="text"><?php the_field('features'); ?></div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <div class="property-listing-container gallery">
     <div class="property-listing-wrapper">
         <div class="property-listing-container">
             <div class="galleries">
                 <div class="gallery-title">See the Property</div>
                 <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
                     <div class="slides"></div>
                     <h3 class="title"></h3>
                     <a class="prev">‹</a> <a class="next">›</a> <a class="close">×</a> <a class="play-pause"></a>
                     <ol class="indicator">
                     </ol>
                 </div>
                 <?php if( have_rows('galleries') ): while( have_rows('galleries') ): the_row(); ?>
                     <div class="property-gallery">
                         <div class="blueimp-gallery-main-click">
                             <img src="<?php the_sub_field('gallery_cover_image');?>"/>
                             <h2><?php the_sub_field('gallery_name');?></h2>
                         </div>
                         <div class="blueimp-gallery-link">
                         <?php if( have_rows('gallery_images') ):
                         while( have_rows('gallery_images') ): the_row(); ?>
                             <a href="<?php the_sub_field('image');?>"></a>
                         <?php endwhile; endif;?>
                         </div>
                     </div>
                 <?php endwhile; endif;?>
             </div>
         </div>
     </div>
 </div>
 <div class="property-listing-container about-neighborhood">
     <div class="property-listing-wrapper">
         <div class="property-listing-container">
             <div class="title">About the Neighborhood</div>
             <div class="info">
                 <div class="description"><?php the_field('neighborhood_description');?></div>
             </div>
             <div class=""><iframe width="100%" height="500" frameborder="0" style="border:0" src="<?php the_field('map');?>"></iframe></div>
         </div>
     </div>
 </div>
 <div class="property-listing-container schedule">
     <div class="property-listing-wrapper">
         <div class="property-listing-container">
             <div class="title">Schedule</div>
             <div class="open-houses"><?php the_field('schedule_open_houses');?></div>
             <div class="appointment"><?php the_field('schedule');?></div>
         </div>
     </div>
 </div>
 <div class="property-listing-container sharing">
     <div class="property-listing-wrapper">
         <div class="property-listing-container">
         <?php $sharing = get_field('sharing_enable_disable');
 $sharing_title = get_field('sharing_title');
 if($sharing != 'enabled'){
     echo '<div class="share-listing">
     <div class="share-title">'.$sharing_title.'</div>
     <div class="share-icons">';
     echo do_shortcode('[feather_share show="facebook, twitter, google_plus" hide="reddit, pinterest, linkedin, tumblr, mail"]');
     echo '</div></div>';
 }?>
         </div>
     </div>
 </div>
 </div>

 <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/slider/css/blueimp-gallery.min.css" media="all"/>
 <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/slider/css/integrity-light8603.css"/>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 <script src='<?php bloginfo('template_directory'); ?>/slider/js/jquery4a80.js'></script>
 <script src="<?php bloginfo('template_directory'); ?>/slider/js/blueimp-gallery.min.js"></script>
 <script>
 $(".blueimp-gallery-link").click(function(event){
     event = event || window.event;
     var target = event.target || event.srcElement,
     link = target.src ? target.parentNode : target,
     options = {index: link, event: event,hidePageScrollbars:false},
     links = this.getElementsByTagName('a');
     gallery = blueimp.Gallery(links, options);
     //hardcoded auto play for this site
 });
 $(".blueimp-gallery-main-click").click(function(event){
     var parent = $(this).closest(".property-gallery");
     parent.find(".blueimp-gallery-link").trigger("click");
 });
 $(document).ready(function() {
     $(".interactive-floorplans .left .image img").click(function() {
        $(".floorplans-popup").show();
        $("header").css('z-index','100');
        $(".floorplans-popup iframe").attr( 'src', function ( i, val ) { return val; });
     });
     $(".floorplans-popup .close").click(function(){
         $(".floorplans-popup").hide();
         $("header").css('z-index','110');
     });
 });
 </script>

 <?php get_footer(); ?>
