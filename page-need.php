<?php 
/**
* Template Name: Need
*/
 get_header(); ?>



<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<div id="body-line"></div>
<div id="main-wrapper">
<div id="main">



<div class="page-content need">
<div id="featured-image"><?php the_post_thumbnail( 'post-thumbnails' ); ?><div id="featured-text"><h3><?php the_field("quote_text"); ?></h3><?php the_field("quote_attribute"); ?></div></div>

     <h1><?php the_title(); ?></h1>

     <?php the_content(); ?>
     


</div><!-- / page content -->



<?php endwhile; endif; ?>



<?php //get_sidebar(); ?>

<?php get_footer(); ?>