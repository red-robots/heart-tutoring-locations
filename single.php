<?php
/**
 * Displays a Single Post
 */

get_header(); ?>

	
<div id="body-line"></div>
<div id="main-wrapper">
<div id="main">

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="single-post-container">

	<h1><?php the_title(); ?></h1>
	<h2><?php the_date(); ?></h2>

	  
    
    <div class="blog-featured-image">
	<?php 
		$image = get_field('featured_home_image');
		$image = get_field('featured_home_image'); 
		$url = $image['url'];
		$title = $image['title'];
		$alt = $image['alt'];
		$caption = $image['caption'];
	 
		// thumbnail or custom size that will go
		// into the "thumb" variable.
		$size = 'postimage';
		$thumb = $image['sizes'][ $size ];
		$width = $image['sizes'][ $size . '-width' ];
		$height = $image['sizes'][ $size . '-height' ];
		if( !empty($image) ): ?>
		    <img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" /> 
		<?php endif; ?>
    </div><!-- blog featured image  -->
        
        
 		<?php the_content(); ?>
        

        
	<div class="post-boxes"><?php previous_post(); ?></div>
	<div class="post-boxes-cat">This post is in:<br>
		<?php the_category( ', ' ); ?>
	</div>
	<div class="post-boxes"><?php next_post(); ?></div>


	<div id="news-box-mobile">

		<h2>Categories</h2>
		<ul><?php wp_list_cats('sort_column=name&optioncount=1') ?></ul>
	 	<?php wp_reset_postdata(); ?>
	 
		<h2>Recent Posts</h2>
		<?php $the_query = new WP_Query( 'showposts=10' ); ?>
		<ul>
			<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				<li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>

	 		<?php endwhile;?>
		</ul>

	 	<?php wp_reset_postdata(); ?>
	 
		  <!-- --> 
			 <form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
			<div><input type="text" size="18" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
			<input type="submit" id="searchsubmit" value="Search" class="btn" />
			</div>
			</form>
		  <!-- -->
	 
	</div>
        
</div><!-- single post container -->



<div id="news-box">
	<h2>Categories</h2>
	<ul><?php wp_list_cats('sort_column=name&optioncount=1') ?></ul>
 	<?php wp_reset_postdata(); ?>
 
 	<h2>Recent Posts</h2>
 	<?php $the_query = new WP_Query( 'showposts=10' ); ?>
	<ul>
		<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

 			<li>
 				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
 			</li>

		<?php endwhile;?>
	</ul>
	<?php wp_reset_postdata(); ?>
 
  <!-- --> 
	<form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
		<div>
		<input type="text" size="18" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
		<input type="submit" id="searchsubmit" value="Search" class="btn" />
		</div>
	</form>
  <!-- -->
 
</div>


<?php endwhile; endif; ?>

<?php get_footer(); ?>