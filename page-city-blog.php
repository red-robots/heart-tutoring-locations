<?php 
/*
* Template Name: City Blog
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
					<div class="locpage-left"><?php //echo $city->slug; ?>
						<?php
						$args = array(
							'post_type'=>'post',
							'posts_per_page' => 3,
							'tax_query' => array(
								array(
									'taxonomy' => 'location',
									'field'    => 'slug',
									'terms'    => $cityTerm,
								),
							),
						);
							$wp_query = new WP_Query($args);
							
							if ($wp_query->have_posts()) : ?>
							<section class="city-locations-blog">
								<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
									<div class="blogentry">
										<div class="blogentry-thumb">
											<?php if ( get_the_post_thumbnail($post_id) != '' ) {
													echo '<a href="'; the_permalink(); echo '" class="thumbnail-wrapper">';
														the_post_thumbnail();
													echo '</a>';
												} else {
													echo '<a href="'; the_permalink(); echo '" class="thumbnail-wrapper">';
													echo '<img src="';
													echo catch_that_image();
													echo '" alt="" />';
													echo '</a>';
												} ?>
										</div>
										<h2>
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h2>
										<?php the_date('m.d.Y', '', ''); ?>
										<p><?php  echo get_excerpt(200); ?></p>
									</div><!-- blogentry -->
								<?php endwhile; ?>
								<?php pagi_posts_nav(); ?>
							</section>
						<?php endif ?>
					</div>
					<?php include(locate_template('inc/locations-box.php')); ?>
				</section>
				<div class="clear"></div>
				

			</div><!-- / page content -->

<!--
		
		Other 2 closing Divs are in the footer because of a bad dev.

 -->

<?php get_footer(); ?>