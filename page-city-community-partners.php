<?php 
/*
* Template Name: City Community Partners
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
<?php include(locate_template('inc/city-headers.php')); ?>

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