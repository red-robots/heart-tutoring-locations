<div class="acf-map">
	<?php  while ($wp_query->have_posts()) : $wp_query->the_post();

		$location = get_field('google_map');
		$format = get_field('format');
		if( $format == 'inperson' ) {
			$format = 'In-Person';
		}
		?>
		<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
			<h4><?php the_title(); ?></h4>
			<p class="address"><?php echo $location['address']; ?></p>
			<p>Tutoring Hours: <?php the_field('tutoring_times'); ?></p>
			<?php if( $format ){ echo '<p style="text-transform: capitalize;">Format: '.$format.'</p>';} ?>
			<?php if (strlen(get_post_meta($post->ID, "volunteers_needed", true)) > 0) : ?>
				<p>Number of Volunteers Needed: <?php the_field('volunteers_needed'); ?></p>
			<?php endif; ?>
		</div>
	<?php endwhile ?>
</div>