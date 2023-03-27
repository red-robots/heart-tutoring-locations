<?php 
/*
	*
	* Template Name: Team Page
	*
	*
*/
get_header(); 
?>
<div id="body-line"></div><!-- body-line -->

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 

	$pageContent = get_the_content();
	$board_of_directors = get_field('board_of_directors');
	$location = get_field('staff_location');
	$loc = $location->slug;
	
?>
	<?php endwhile; endif; ?> 


<div id="main-wrapper">
	<div id="main">
		<div class="page-content">
			

			<h1><?php the_title(); ?></h1>
			<?php 
			echo $pageContent; 
			// echo '<pre>';
			// print_r($location);
			// echo '</pre>';
			// echo $loc;
			?>

			<?php
			$i=0;
				$wp_query = new WP_Query();
				$wp_query->query(array(
				'post_type'=>'team',
				'posts_per_page' => -1,
				'orderby'   => 'menu_order',
              	'order'     => 'ASC',
    	        'tax_query' => array(
					array(
						'taxonomy' => 'team-type',
						'field'    => 'slug',
						'terms'    => 'staff',
					),
				),

				// 'paged' => $paged,
			));
				if ($wp_query->have_posts()) :  ?>

				<section class="team">
					<div class="inner">
					<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $i++;

					$image = get_field('photo');
					$size = 'large'; 
					$name = get_the_title();
					$title = get_field('title');
					// $image = get_field('image');
					// $image = get_field('image');

					if( $i == 4 ) {
						$class = 'last';
						$i = 0;
					} else {
						$class = 'first';
					}
					?>	

						<div class="team-member <?php echo $class; ?> ">
							<?php if( $image ) { ?>
								<div class="photo js-blocks">
									<?php echo wp_get_attachment_image( $image, $size ); ?>
									<div class="overlay">
										<div class="plus">+</div>
									</div>
								</div><!-- photo -->
							<?php } ?>
							<div class="info js-titles" style="width: 100%;">
								<h2><?php echo $name; ?></h2>
								<h3><?php echo $title; ?></h3>
							</div><!-- info -->
							<div class="link">
								<a href="<?php the_permalink(); ?>"></a>
							</div><!-- link -->
						</div><!-- team member -->

					<?php 
					endwhile; 
					// pagi_posts_nav(); ?>
					</div>
				</section>
			<?php endif; ?>






			<?php
			//        Board of Directors
			$i=0;
				$wp_query = new WP_Query();
				$wp_query->query(array(
				'post_type'=>'team',
				'posts_per_page' => -1,
				'orderby'   => 'menu_order',
              	'order'     => 'ASC',
              	'tax_query' => array(
					array(
						'taxonomy' => 'team-type',
						'field'    => 'slug',
						'terms'    => 'board-of-directors',
					),
				),

				// 'paged' => $paged,
			));
				if ($wp_query->have_posts()) :  ?>
					<div class="board-of-dir">
						<h2>Board of Directors</h2>
					</div>
				<section class="team">
					<div class="inner">
					<?php while ($wp_query->have_posts()) : $wp_query->the_post(); $i++;

					$image = get_field('photo');
					$size = 'large'; 
					$name = get_the_title();
					$title = get_field('title');
					// $image = get_field('image');
					// $image = get_field('image');

					if( $i == 4 ) {
						$class = 'last';
						$i = 0;
					} else {
						$class = 'first';
					}
					?>	

						<div class="team-member <?php echo $class; ?> ">
							<?php if( $image ) { ?>
								<div class="photo js-blocks">
									<?php echo wp_get_attachment_image( $image, $size ); ?>
									<div class="overlay">
										<div class="plus">+</div>
									</div>
								</div><!-- photo -->
							<?php } ?>
							<div class="info js-titles" style="width: 100%;">
								<h2><?php echo $name; ?></h2>
								<h3><?php echo $title; ?></h3>
							</div><!-- info -->
							<!-- <div class="link"> -->
							<!--	<a href="<?php the_permalink(); ?>"></a>
							</div> link -->
						</div><!-- team member -->

					<?php 
					endwhile; 
					// pagi_posts_nav(); ?>
					</div>
				</section>
			<?php endif; ?>

			<section class="board-of-dir">
				<?php echo $board_of_directors; ?>
			</section>
		   
		    
		</div><!-- / page content -->
<?php get_footer(); ?>