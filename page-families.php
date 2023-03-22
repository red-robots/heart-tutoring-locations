<?php 
/* 
 * Template Name: Families
 */
get_header(); ?>

<div id="primary" class="new-content-area noPadBottom">
	<main class="new-site-main contentWrap" role="main">
	
	<?php while ( have_posts() ) : the_post(); ?>

		<h1 style="visibility:hidden;position:absolute;z-index:-333"><?php the_title(); ?></h1>

		<?php if( get_the_content() ) { ?>	
		<div class="main-info-text"><?php the_content(); ?></div>
		<?php } ?>
	
	<?php endwhile; ?>

	<?php  
		$post_type = 'concepts';
		$args = array(
			'posts_per_page'=> -1,
			'post_type'		=> $post_type,
			'post_status'	=> 'publish',
		);
		$posts = new WP_Query($args);
		if ( $posts->have_posts() ) {  ?>
		<section class="concepts-posts">
			<div class="wrapper">
				<div class="flexwrap cf">
				<?php $i=1; while ( $posts->have_posts() ) : $posts->the_post();
				$img = get_field("feat_image");
				$title = get_the_title(); 
				$link = get_permalink();
				$text = ( get_the_content() ) ? shortenText( get_the_content(),125,' ','...' ):'';
				?>
				<div class="flexcol">
					<div class="wrap">
						<?php if ($img) { ?>
						<div class="thumb"><img src="<?php echo $img['url'] ?>" alt="<?php echo $img['title'] ?>"></div>	
						<?php } ?>
						<h2 class="title"><?php echo $title ?></h2>
						<?php if ($text) { ?>
						<div class="text"><?php echo $text ?></div>	
						<?php } ?>
						<div class="button">
							<a href="<?php echo $link ?>" class="theme-btn">Learn More</a>
						</div>
					</div>
				</div>
				<?php $i++; endwhile; wp_reset_postdata(); ?>
				</div>
			</div>
		</section>
		<?php } ?>


		<?php  
		$bottom_title = get_field("section_title");
		$bottom_contents = get_field("bottom_contents");
		$placeholder = THEMEURI . 'images/rectangle-lg.png';
		if($bottom_contents) { ?>
		<section class="resources-section">
			<?php if ($bottom_title) { ?>
			<div class="section-title"><h2><?php echo $bottom_title ?></h2></div>
			<?php } ?>
			
			<div class="flexwrap">
				<?php foreach ($bottom_contents as $c) { 
					$img = $c['image'];
					$title = $c['title'];
					$description = $c['description'];
					$button_name = $c['button_name'];
					$type = $c['button_link'];
					$button_type = ($type=='file') ? $type : 'url';
					$buttonLink = $c[$button_type];
					$buttonTarget = '_self';
					if($button_type=='file') {
						$buttonTarget = "_blank";
					} else {
						if($buttonLink) {
							$bLink = parse_external_url($buttonLink);
							$buttonTarget = $bLink['target'];
						}
					}
					$link_open = '';
					$link_close = '';
					if ($button_name && $buttonLink) {
						$link_open = '<a href="'.$buttonLink.'" target="'.$buttonTarget.'">';
						$link_close = '</a>';
					}
				?>
				<div class="rscol">
					<div class="wrap">
						<div class="image <?php echo ($img) ? 'hasImage':'noImage' ?>">
							<?php echo $link_open; ?>
							<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true">
							<?php if ($img) { ?>
							<span class="thumb" style="background-image:url('<?php echo $img['url'] ?>')"></span>	
							<?php } ?>
							<?php echo $link_close; ?>
						</div>
						<div class="details">
							<?php if ($title) { ?>
							<h3 class="title"><?php echo $title ?></h3>	
							<?php } ?>
							<?php if ($description) { ?>
							<div class="text"><?php echo $description ?></div>	
							<?php } ?>
							<?php if ($button_name && $buttonLink) { ?>
							<div class="button">
								<a href="<?php echo $buttonLink ?>" target="<?php echo $buttonTarget ?>" class="theme-btn2"><?php echo $button_name ?></a>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>	
				<?php } ?>
			</div>
		</section>
		<?php } ?>
	</main>

	<?php get_template_part("inc/bottom-concept"); ?>
</div>

<?php get_footer(); ?>