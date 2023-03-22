<?php 

/**

* Template Name: Become Volunteer Test

*/

 get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="body-line"></div>

<?php 
$image = get_field('page_top_photo');
//if( !empty($image) ): ?>
<!-- <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /> -->
<?php //endif; ?>
  <div id="top-content" style="background-image:url(<?php echo $image['url']; ?>);">

  <!-- tabs -->
    <div id="top-content-links-wrapper">
      <div id="top-content-content">
        <div id="top-content-text">
          <?php the_field("top_photo_text"); ?>
        </div><!-- top content text -->
        <div id="top-content-header">
          <h1><?php the_title(); ?></h1>
        </div><!-- top content header -->
        <div id="top-content-links">

          <div class="top-content-linkbox">
            <a href="<?php bloginfo('url'); ?>/volunteers/become-a-volunteer/#volunteer">
              <h2>I’m ready!</h2>Sign up now to be<br>
              a tutor!
            </a>
          </div><!-- top content linkbox -->

          <div class="top-content-linkbox">
            <a href="<?php bloginfo('url'); ?>/volunteers/become-a-volunteer/#locations">
              <h2>I’m almost ready!</h2>View tutoring times<br>
              & locations.
            </a>
          </div><!-- top content linkbox -->

          <div class="top-content-linkbox">
            <a href="<?php bloginfo('url'); ?>/volunteers/become-a-volunteer/#faqs">
              <h2>I’d like to know more.</h2>Read our FAQs. 
            </a>
          </div><!-- top content linkbox -->

        </div><!-- top content links -->
      </div><!-- top content content -->

    </div><!-- top content links wrapper -->

  <!-- tabs -->
  </div><!-- top content -->



<div id="main-wrapper">
  <div id="main">
    <div class="page-content">
      <div id="featured-image" class="volunteer-video">
        <?php the_post_thumbnail( 'post-thumbnails' ); ?>
        <div id="featured-text">
          <h3><?php the_field("quote_text"); ?></h3>
          <?php the_field("quote_attribute"); ?>
        </div><!-- featured text -->
        <div id="sidebar-video">
          <?php the_field("video"); ?>
        </div><!-- sidebar video -->
      </div> <!-- featured image --> 

    <?php the_content(); ?>

      <a name="faqs"></a>
      <!-- -->
      <p>&nbsp;</p>
      <h2><?php the_field("accordion_header"); ?></h2>

      <div id="accordion">
      <?php if(get_field('accordion')): while(has_sub_field('accordion')): ?>
        <h2><a href="#"><?php the_sub_field("accordion_header"); ?></a></h2>
      <div><!-- accordion -->

      <?php the_sub_field("accordion_panel"); ?>
    </div><!-- page content -->
  <?php endwhile; endif; ?>
  </div><!--  main -->

    <div style="float: left; margin-top: -80px;" id="volunteer-school-list">  
      <a name="locations"></a>
      <p>&nbsp;</p> 
      <?php the_field("bottom_content"); ?>
    </div> 

  <?php endwhile; endif; ?> 
  <!-- -->
  <?php

  	$wp_query = new WP_Query();
    $wp_query->query(array(
      'post_type'=>'schools',
      'posts_per_page' => -1,
    ));
    if ($wp_query->have_posts()) : ?>
      <div class="acf-map">
        <?php while ($wp_query->have_posts()) : $wp_query->the_post(); 
          $location = get_field('google_map')
        ?>
          <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
            <h4><?php the_title(); ?></h4>
            <p class="address"><?php echo $location['address']; ?></p>
            <p>Tutoring Times: <?php the_field('tutoring_times'); ?></p>
            <?php if (strlen(get_post_meta($post->ID, "volunteers_needed", true)) > 0) : ?>
              <p>Number of Volunteers Needed: <?php the_field('volunteers_needed'); ?></p>
            <?php endif; ?>
          </div><!-- marker -->
        <?php endwhile; ?>
      </div><!-- map -->
    <?php endif; ?>
  <!-- -->  
  <?php 
  $recent = new WP_Query("page_id=70"); 
  while($recent->have_posts()) : $recent->the_post();?>
    <div style="float: left; margin-top: -80px; width: 100%;">
      <a name="volunteer"></a>
      <p>&nbsp;<p>&nbsp;<p>&nbsp;
      <?php the_field("content_area"); ?>
      <?php //get_template_part('inc/form-volunteer-new'); ?>
      <?php get_template_part('inc/salesforce'); ?>
      <?php the_field('after_form'); ?>
    </div>    
  <?php endwhile; wp_reset_postdata(); // end of the loop. ?>
</div><!-- / main wrapper -->


<script>
  // $(function() {
  //   $( "#accordion" ).accordion({
  //     collapsible: true,
  //     active:false,
  //     heightStyle: "content"
  //   });
  //   $('#accordion h2').bind('click',function(){
  //   var self = this;
  //   setTimeout(function() {
  //   theOffset = $(self).offset();
  //   $('body,html').animate({ scrollTop: theOffset.top - 100 });
  //   }, 310); // ensure the collapse animation is done
  //   });
  // });
</script>
<?php get_footer(); ?>