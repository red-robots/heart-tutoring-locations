<?php 
/**
* Template Name: Schools
*/
 get_header(); ?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="body-line"></div>
<div id="main-wrapper">
<div id="main">

<div class="page-content">
<div id="featured-image2"><?php the_post_thumbnail( 'post-thumbnails' ); ?></div>       <h1><?php the_title(); ?></h1>
     <?php the_content(); ?>
   
   <?php endwhile; endif; ?>  
<!-- -->
<div id="schools-feed">
 <?php /* Second Custom Query pulling the post type, "Schools" */  
           $args = array( 
            'post_type' => array('schools'), // In an array so You can list multiple Custom Post Types if you want ('blog', 'another_post_type')
            'posts_per_page' => '-1', // # of posts to show use -1 for all posts.    
            );
            $query = new WP_Query( $args );  // Query all of your arguments from above
           ?>
           <?php if (have_posts()) : while( $query->have_posts() ) : $query->the_post(); // the loop ?>
           

<div class="schools-item">
<a href="<?php the_permalink() ?>">
<h2><?php the_title(); ?></h2>

<p>Principal: <?php the_field("principal"); ?>

<p>Beginning of Heart Partnership: <?php the_field("date_beginning_with_heart"); ?>

<p>Address:
<br>
<?php 
$add = get_field('address');
$map = get_field('google_map'); 
if( $map ) {
  echo $map['address'];
} elseif( $add ) {
  echo $add;
}


?>
 
</a>

</div>
        <?php  endwhile; endif; wp_reset_postdata();  // close loop and reset the query ?>	

<div class="schools-item"><h2><a href="<?php bloginfo('url'); ?>/become-a-school-partner/">Click here to learn more about bringing Heart Math Tutoring to your school.</a></h2></div>        
        
        
 </div>
<!-- --> 
   
     
 </div><!-- / page content -->



<?php get_footer(); ?>