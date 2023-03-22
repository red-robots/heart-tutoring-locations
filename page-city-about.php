<?php 
/*
* Template Name: City About
*
*
*
*/
get_header(); 

$ID = get_the_ID();
$pID = wp_get_post_parent_id($ID);
$parentTitle = get_the_title($pID);
$image = get_the_post_thumbnail_url($ID);
$city = get_field('location', $pID );
$cityTerm = $city->slug;

// echo '<pre>';
// print_r($location);
// echo '</pre>';
?>
<div id="body-line"></div>

<div class="vol-header" style="background-image:url(<?php echo $image; ?>);">
	<div class="wrap plain-header">
		<h1><?php the_title(); ?></h1>
	</div>
	<div class="overlay"></div>
</div><!-- top content -->

	<div id="main-wrapper">
		<div id="main">
			<div class="page-content">
				<section class="locpage">
					<div class="locpage-left">
						<?php while( have_posts() ): the_post(); 
							the_content();
						 endwhile; ?>
					</div>
					<?php include(locate_template('inc/locations-box.php')); ?>
				</section>
				<div class="clear"></div>
				

			</div><!-- / page content -->

<!--
		
		Other 2 closing Divs are in the footer because of a bad dev.

 -->

<?php get_footer(); ?>