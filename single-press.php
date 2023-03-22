<?php
/**
 * Displays a Single Post
 */

get_header(); ?>

	
<div id="body-line"></div>

<div id="main-wrapper">

<div id="main">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="single-post-container-full">

<h1><?php the_title(); ?></h1>
<h2><?php the_date(); ?></h2>

  
  
 		<?php the_content(); ?>
        
<div class="press-release"><a href="<?php the_field("press_article"); ?>" target="_blank">Read Full Press Release Here</a></div>
        
<div style="width: 100%; float: left;"><div class="post-boxes"><?php previous_post(); ?></div>

<div class="post-boxes"><?php next_post(); ?></div>
</div>


        
</div><!-- single post container -->






<?php endwhile; endif; ?>

<?php get_footer(); ?>