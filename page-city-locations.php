<?php 
/*
* Template Name: City Locations
*
*
*
*/
get_header(); 

$ID = get_the_ID();
$image = get_the_post_thumbnail_url($ID);
$city = get_field('location');
$map_pre_text = get_field('map_pre_text');
$form_pre_text = get_field('form_pre_text');
$form_script = get_field('form_script');
$location = get_field('google_map');
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
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
					<?php include(locate_template('inc/locations-box-city.php')); ?>
				</section>
				<div class="clear"></div>
				<?php
				$args = array(
					'post_type'=>'schools',
					'posts_per_page' => -1,
					'tax_query' => array(
						array(
							'taxonomy' => 'location',
							'field'    => 'slug',
							'terms'    => $city->slug,
						),
					),
				);
					$wp_query = new WP_Query($args);
					
					if ($wp_query->have_posts()) : ?>
					<section class="city-locations-map">
						<div class="wrap">
							<?php echo $map_pre_text; ?>
						</div>
							<?php include(locate_template('inc/acf-map.php')); ?>
					</section>
				<?php endif;
				wp_reset_query();
				?>

				<section class="form">
					<div class="wrap">
						<?php echo $form_pre_text; ?>
						<br>
						<?php 
						if( is_page('14907') ) {
							get_template_part('inc/salesforce'); 
						} elseif( is_page('14967') ) {
							get_template_part('inc/salesforce-winston'); 
						} elseif( is_page('14956') ) {
							get_template_part('inc/salesforce-charleston'); 
						}

						?>
						<?php echo $form_script; ?>
					</div>
				</section>





			</div><!-- / page content -->

<!--
		
		Other 2 closing Divs are in the footer because of a bad dev.

 -->

<?php get_footer(); ?>