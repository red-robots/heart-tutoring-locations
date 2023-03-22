<?php 
/*
* Template Name: City Schools
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
$map_pre_text = get_field('map_pre_text');
$the_content = get_the_content();
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
							'post_type'=>'schools',
							'posts_per_page' => -1,
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
							<section class="city-locations-map">
								<?php if( $the_content ){ ?>
									<div class="wrap">
										<?php echo $the_content; ?>
									</div>
								<?php } ?>
								<div class="wrap">
									<?php echo $map_pre_text; ?>
								</div>
									<?php include(locate_template('inc/acf-map.php')); ?>
							</section>
						<?php endif; ?>
					</div>
					<?php include(locate_template('inc/locations-box.php')); ?>
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
							'terms'    => $cityTerm,
						),
					),
				);
					$wp_query = new WP_Query($args);
					
					if ($wp_query->have_posts()) : ?>
						<div id="schools-feed">
							<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
								<div class="schools-item">
									<a href="<?php the_permalink() ?>">
										<h2><?php the_title(); ?></h2>
										<p>Principal: <?php the_field("principal"); ?></p>
										<p>Beginning of Heart Partnership: <?php the_field("date_beginning_with_heart"); ?></p>
										<p>Address:</p>
										<br>
										<?php 
										$add = get_field('address');
										$map = get_field('google_map'); 
										if( $map ) { echo $map['address']; } elseif( $add ) { echo $add; } ?>
									</a>
								</div>
							<?php endwhile; ?>
						</div>
					<?php endif; ?>
				

			</div><!-- / page content -->

<!--
		
		Other 2 closing Divs are in the footer because of a bad dev.

 -->

<?php get_footer(); ?>