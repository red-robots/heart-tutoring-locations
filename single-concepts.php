<?php
/**
 * Displays a Single Post
 */

get_header(); ?>

<div id="primary" class="new-content-area single-content concepts">
	<main class="new-site-main contentWrap" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

		<h1><?php the_title(); ?></h1>

		<?php if( get_the_content() ) { ?>	
		<div class="main-info-text"><?php the_content(); ?></div>
		<?php } ?>

		<?php endwhile; ?>

		<?php 
		$vid_section_title = get_field("vid_section_title");
		$video_galleries = get_field("video_galleries");
		$placeholder = THEMEURI . 'images/rectangle.png';
		?>
		
		<?php if ($video_galleries) { ?>
		<section class="concept-section-videos">
			<?php if ($vid_section_title) { ?>
				<h2 class="section-title-2"><?php echo $vid_section_title ?></h2>
			<?php } ?>
			<div class="flexwrap">
				<?php foreach ($video_galleries as $v) { 
					$customThumb = $v['custom_video_thumb'];
					$video_title = $v['video_title'];
					$video_description = $v['video_description'];
					$video_url = $v['video_url'];
					$button_name = $v['button_name'];
					$type = $v['button_link'];
					$button_type = ($type=='file') ? $type : 'url';
					$buttonLink = $v[$button_type];
					$buttonTarget = '';
					if($button_type=='file') {
						$buttonTarget = "_blank";
					} else {
						if($buttonLink) {
							$bLink = parse_external_url($buttonLink);
							$buttonTarget = $bLink['target'];
						}
					}
					$youtubeId = '';
					if($video_url) {
						$parts = parse_url($video_url);
						parse_str($parts['query'], $query);
						$youtubeId = (isset($query['v']) && $query['v']) ? $query['v']:'';
					}
					if($video_url && $youtubeId) { 
					$thumbURL = 'https://i.ytimg.com/vi/'.$youtubeId.'/hqdefault.jpg';  
					$embedURL = 'https://www.youtube.com/embed/' . $youtubeId;
					if($customThumb) {
						$thumbURL = $customThumb['url'];
					}
					?>
					<div class="vidcol">
						<div class="wrap">
							<div class="image <?php echo ($customThumb) ? 'hasCustomImage':'noCustomImage' ?>">
								<img src="<?php echo $placeholder ?>" alt="" aria-hidden="true">
								<iframe src="<?php echo $embedURL ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
							</div>
							<div class="details">
							<?php if ($video_title) { ?>
							<h3 class="title"><?php echo $video_title ?></h3>	
							<?php } ?>
							<?php if ($video_description) { ?>
							<div class="text"><?php echo $video_description ?></div>	
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
				<?php } ?>
			</div>
		</section>
		<?php } ?>


		<?php  
		$other_sections = get_field("other_sections");
		$placeholder2 = THEMEURI . 'images/rectangle.png';
		if($other_sections) { ?>
		<section class="concept-section-other">
			<?php foreach ($other_sections as $c) { 
			$section_title = $c['other_title'];
			$contents = $c['other_content'];
			?>
			<article class="row-other">
				<?php if ($section_title) { ?>
				<h2 class="section-title-2"><?php echo $section_title ?></h2>
				<?php } ?>
				<div class="flexwrap">
				<?php foreach ($contents as $c) { 
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
								<img src="<?php echo $placeholder2 ?>" alt="" aria-hidden="true">
								<?php if ($img) { ?>
								<div class="thumb" style="background-image:url('<?php echo $img['url'] ?>')"></div>	
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
			</article>
			<?php } ?>
		</section>
		<?php } ?>
	</main>

	<?php get_template_part("inc/bottom-concept"); ?>

</div>

<?php get_footer(); ?>