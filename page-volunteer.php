<?php 

/**

* Template Name: Become a Volunteer

*/

get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="body-line"></div>

<?php 
  $image = get_field('page_top_photo'); 
  $page_title = get_field('page_title'); 
  $dropdown_label = get_field('dropdown_label'); 
?>
<div class="vol-header" style="background-image:url(<?php echo $image['url']; ?>);">

  <?php //include(locate_template('inc/old-vol-header.php')); ?>
  <div class="wrap">
    <h1><?php echo 'Volunteers'; ?></h1>
    <?php if( have_rows('dropdown_links') ): ?>
      <div class="vol-drop">
        <span><?php echo $dropdown_label; ?>&nbsp;&nbsp;&nbsp;<i class="fa-sharp fa-solid fa-chevron-down"></i></span>
        <div class="dropbox">
        <?php while( have_rows('dropdown_links') ): the_row(); 
            $link = get_sub_field('link');
          ?>
          
            <div class="link">
              <a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
            </div>
          
        <?php endwhile; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
<div class="overlay"></div>
</div><!-- top content -->



<?php include(locate_template('inc/vol-section.php')); ?>
  



<div id="main-wrapper">
  <div id="main">
    <div class="page-content">




      <div id="featured-image" class="volunteer-video">
        <?php the_post_thumbnail( 'post-thumbnails' ); ?>
        <div id="featured-text">
          <h3><?php the_field("quote_text"); ?></h3>
          <?php the_field("quote_attribute"); ?>
        </div><!-- featured text -->
       <!-- <div id="sidebar-video">
          <?php the_field("video"); ?>
        </div> sidebar video -->
      </div> <!-- featured image --> 

    <?php the_content(); ?>

      <a name="faqs"></a>
      <!-- -->
      <p>&nbsp;</p>
      <h2 class="faqTitle"><?php the_field("accordion_header"); ?></h2>

      <div id="custom-accordion">
      <?php if(get_field('accordion')): while(has_sub_field('accordion')): ?>
       <div class="faqrow">
          <div class="question">
            <h2><?php the_sub_field("accordion_header"); ?></h2>
            <span class="view"><span class="icon"></span></span>
          </div>
          <div class="answer">
            <?php the_sub_field("accordion_panel"); ?>
          </div>
        </div>
      <div><!-- accordion -->

      
    </div><!-- page content -->
  <?php endwhile; endif; ?>
  </div><!--  main -->

    <div style="float: left;" id="volunteer-school-list">  
      <a name="locations"></a>
      <p>&nbsp;</p> 
      <?php the_field("bottom_content"); ?>
    </div> 

  <?php endwhile; endif; ?> 
  <!-- -->
  <?php //include( locate_template('inc/vol-map.php') ); ?>
  <!-- -->  
  <?php 
  $recent = new WP_Query("page_id=70"); 
  while($recent->have_posts()) : $recent->the_post();?>
    <div style="float: left; margin-top: -80px; width: 100%;">
      <a name="volunteer"></a>
      <p>&nbsp;<p>&nbsp;<p>&nbsp;
      <?php the_field("content_area"); ?>
      <?php //get_template_part('inc/form-volunteer-new'); ?>
      <!-- using salesforce -->
      <?php //get_template_part('inc/salesforce'); ?>
      <a name="recruit"></a>
      <br><br><br><br><br>
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