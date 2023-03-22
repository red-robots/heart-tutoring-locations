<?php

/**

 * Template Name: Latest News

 */



get_header(); ?>

<div id="body-line"></div>

<div id="main-wrapper">

<div id="main">




<div class="page-content">



<h1><?php the_title()?></h1>





<div id="news-box">



 <h2>Categories</h2>

<ul><?php wp_list_cats('sort_column=name&optioncount=1') ?></ul>

 </ul>

 <?php wp_reset_postdata(); ?>

 



</div>





<!-- featured post -->
<?php
$post_object = get_field('featured_post');
if( $post_object ): 
	// override $post
	$post = $post_object;
	setup_postdata( $post ); 
	?>
    <div class="featured-blog">

    	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_date('m.d.Y', '', ''); ?>

    	<div id="featured-blog-image"><?php // check if the post has a Post Thumbnail assigned to it.
if ( has_post_thumbnail() ) {
	the_post_thumbnail();
} 
?></div><?php the_advanced_excerpt('length=85&add_link=1&use_words=1&no_custom=1&ellipsis=%26hellip;&exclude_tags=div,img');?>

    </div>

    <?php 
	$postid = get_the_ID();
	
	wp_reset_postdata(); 
	
	?>

<?php endif; ?>

<!-- / featured post -->




<?php
//echo $postid;

	$wp_query = new WP_Query();

	$wp_query->query(array(

	'post_type'=>'post',

	'posts_per_page' => 5,

	'paged' => $paged,
	'post__not_in' => array($postid)

));

	if ($wp_query->have_posts()) : ?>

    <?php while ($wp_query->have_posts()) : ?>

        

    <?php $wp_query->the_post(); ?>

<div class="blogentry">



<div class="blogentry-thumb"><?php 

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

 

  <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

<?php the_date('m.d.Y', '', ''); ?>

 <p><?php  echo get_excerpt(200); ?> 



</div><!-- blogentry -->

<?php endwhile; endif; ?>



<?php pagi_posts_nav(); ?>



<!-- <a href="<?php bloginfo('url'); ?>/blog-archive">Blog Archive ></a> -->

 



<?php get_footer(); ?>