<?php 
/*
* Template Name: Theory of Change
*
*
*/
get_header(); 
?>
<div id="body-line"></div>
<div id="main-wrapper">
<div id="main">
	<div class="page-content">
		<div class="left-cont">
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>

			<div id="theory-graphic">
				<div id="theory-graphic-left">
					<?php the_field("theory_graphic_left"); ?>
				</div>
				<div id="theory-graphic-right">
					<?php the_field("theory_graphic_right"); ?>
				</div>
			</div> 

			<?php the_field("content_area"); ?>  

		</div>

		
		<div class="right-cont">
			<div id="featured-image">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php the_post_thumbnail( 'post-thumbnails' ); ?>
				<div id="featured-text">
					<h3><?php the_field("quote_text"); ?></h3>
					<?php the_field("quote_attribute"); ?>
				</div>
				<div id="sidebar-video">
					<?php the_field("video"); ?>
				</div>
			</div>
		</div>
		

		

		<?php 
		endwhile; 
		endif; 
		?>     
	</div><!-- / page content -->
<?php get_footer(); ?>