<div id="body-line"></div>

<div class="city-header" style="background-image:url(<?php echo $image; ?>);">
	<div class="wrap plain-header">
		<h1>
			<?php 
				$cT = get_field('custom_page_title');
				if( $cT ) {
					echo $cT;
				} else {
					the_title(); 
				}
			?>
		</h1>
	</div>
	<div class="overlay"></div>
</div><!-- top content -->