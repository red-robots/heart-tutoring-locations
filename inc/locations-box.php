<?php 
	
	$listArgs = array(
		'child_of' => $pID, // other file...
		'title_li' => '',
		'sort_column' => 'menu_order',
	);
 ?>
<div class="locpage-right">
	<div class="locations-box">
		<h2>HMT <?php echo $city->name; ?></h2>
		<div class="list">
			<?php wp_list_pages( $listArgs ); ?>
		</div>
		<?php if( have_rows('top_buttons', 'option') ): ?>
			<?php while( have_rows('top_buttons', 'option') ): the_row(); 
	            $btnLink = get_sub_field('button', 'option');
	        ?>
	            <div class="btnlink">
	                <a href="<?php echo $btnLink['url']; ?>"><?php echo $btnLink['title']; ?></a>
	            </div>
	        <?php endwhile; ?>
	    <?php endif; ?>
	</div>

	<?php 
	$sideGallery = get_field('sidebar_photos'); 
	
	if( $sideGallery ) {
	?>
		<div class="sidebar-gallery">
			<?php foreach( $sideGallery as $p ) { ?>
				<img src="<?php echo $p['url']; ?>">
			<?php } ?>
		</div>
	<?php } ?>

</div>