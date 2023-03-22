<?php
/**
* A Simple Category Template
*/

get_header(); ?> 

	<div id="main">

<div class="page-content">


<!-- -->
<!-- h1 will print the Category's name you're searching -->			
<h1><?php printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

<!-- news box -->
<div id="news-box">

 <h2>Categories</h2>
<ul><?php wp_list_cats('sort_column=name&optioncount=1') ?>
<li><a href="<?php bloginfo('url'); ?>/latest-news/">All</a></li>
</ul>

 <?php wp_reset_postdata(); ?>
 
 <h2>Recent Posts</h2>
 <?php $the_query = new WP_Query( 'showposts=7' ); ?>
<ul>
<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

 <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>

 <?php endwhile;?>
</ul>

<!-- <p><a href="<?php bloginfo('url'); ?>/blog">see all ></a></p> -->

 <?php wp_reset_postdata(); ?>
 
</div>
<!-- / news box -->

<?php
	/* Start the Loop 
	
		Number of posts on a category page, 
		before it paginates, will be determined 
		by the WordPress Admin in Settings > Reading
	
	*/
	
	while ( have_posts() ) : the_post(); ?>
    
    <div class="post">
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



?></div>    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<?php the_date('m.d.Y', '', ''); ?>
        <?php the_advanced_excerpt('length=85&add_link=1&use_words=1&no_custom=1&ellipsis=%26hellip;&exclude_tags=div,img,blockquote');?>
    </div><!-- post -->
    

<?php endwhile;?>

    <div class="clear"></div>
    <?php pagi_posts_nav(); ?>
    




<!-- -->

<h2>Monthly Archives</h2>
<ul class="archives"><?php wp_get_archives('type=monthly&show_post_count=1') ?></ul>
<!-- -->




	</div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>