
<?php

/**

 * Template Name: Current Volunteers

 */




get_header(); ?>




<div id="body-line"></div>

<div id="main-wrapper">

<div id="main">




<div class="page-content">

<div id="featured-image3">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<?php the_post_thumbnail( 'post-thumbnails' ); ?><div id="featured-text" style="text-align: center; padding-right: 20px;"><h3><?php the_field("quote_text"); ?></h3><?php the_field("quote_attribute"); ?></div>
<?php endwhile; endif; ?>	


<div style="width: 100%; float: left; text-align: center;">
<!-- -->


<?php 
// Query the Post type Slides
$querySlides = array(
	'post_type' => 'page',
	'page_id' => 15,
	'paged' => $paged,
);
// The Query
$the_query = new WP_Query( $querySlides );
?>
<?php 
// The Loop
 if ( $the_query->have_posts()) : ?>
 <?php while ( $the_query->have_posts() ) : ?>
            <?php $the_query->the_post(); ?>
 

        
            
            

<?php if( have_rows('volunteer_partners_logos') ): ?>
 <div class="flexslider2">
        <ul class="slides">
<?php while ( have_rows('volunteer_partners_logos') ) : ?>

<?php the_row(); ?>

<?php 
$image = get_sub_field('logo');
if( !empty($image) ): ?>
    <li> 
        <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /> 
    </li>
<?php endif; ?>


    <?php endwhile; ?>       
       
      	 </ul><!-- slides -->
</div><!-- .flexslider -->

<?php endif; ?>

         <?php endwhile; endif; // end loop ?>
        
    <?php wp_reset_postdata(); ?>


<!-- -->
</div>

<div style="width: 100%; float: left;">
<!-- CATEGORY FEED -->

<?php

	$wp_query = new WP_Query();

	$wp_query->query(array(


	'posts_per_page' => -1,

	'cat' => 6,

));

	if ($wp_query->have_posts()) : ?>

    <ul><h2>Volunteer Resources</h2>

    <?php while ($wp_query->have_posts()) : ?>

    <?php $wp_query->the_post(); ?>




  <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>

<?php endwhile; ?>

</ul>

<?php endif; wp_reset_postdata(); wp_reset_query(); ?>
<!-- / CATEGORY FEED -->
</div>


</div>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
     <h1><?php the_title(); ?></h1>

     <?php the_content(); ?>

<?php endwhile; endif; ?>    

<div id="volunteer-spotlight">

<h2>Volunteer Spotlight</h2>

<?php
	$wp_query = new WP_Query();
	$wp_query->query(array(
	'posts_per_page' => 5,
	'cat' => 62,
));
	if ($wp_query->have_posts()) : ?>



    <?php while ($wp_query->have_posts()) : ?>

    <?php $wp_query->the_post(); ?>
<div class="volunteer-spotlight-box">


<div class="blogentry-thumb-volunteer"><?php 

if ( get_the_post_thumbnail($post_id) != '' ) {
  echo '<a href="'; the_permalink(); echo '" class="thumbnail-wrapper">';
   the_post_thumbnail();
  echo '</a>';
} else {
 echo '<a href="'; the_permalink(); echo '" class="thumbnail-wrapper">';
 echo '<img src="';
 echo catch_that_image();
 echo '" alt="" />';
 echo '</a>';
}
?></div>

<div class="blogentry-thumb-volunteer-date"><?php the_date(); ?></div>

<div class="blogentry-thumb-volunteer-text-header"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
<div class="blogentry-thumb-volunteer-text"> 
 
 <?php  echo get_excerpt(95); ?> 
 </div>

</div>
<?php endwhile; ?>


</div>

<?php endif; wp_reset_postdata(); wp_reset_query(); ?>
<!-- / CATEGORY FEED -->


</div><!-- / volunteer spotlight -->


</div><!-- / page content -->







<?php get_footer(); ?>