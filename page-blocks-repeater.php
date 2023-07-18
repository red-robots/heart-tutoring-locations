<?php
/*
	* Template Name: Repeater Blocks
*/
get_header();
?>

<div id="primary" class="new-content-area noPadBottom">
	<main class="new-site-main contentWrap" role="main" style="min-height:20em">
	<?php while ( have_posts() ) : the_post();  ?>

		<div class="main-info-text">
			
			<h1 style="display:none"><?php the_title(); ?></h1>

			<?php if( get_the_content() ) { ?>
			<div class="entry-content"><?php the_content(); ?></div>
			<?php } ?>

			<?php if( have_rows('multiple_sections') ) { ?>
			<div class="repeater-blocks">
				<?php while ( have_rows('multiple_sections') ) : the_row(); ?>
					<div class="rb-row">
						<?php if( $title = get_sub_field('section_title') ) { ?>
						<h2 class="rb-title"><?php echo $title; ?></h2>
						<?php } ?>

						<?php if( $columns = get_sub_field('columns') ) { ?>
						<div class="rb-columns flexwrap">
							<?php foreach($columns as $col) {
									$btn = $col['button'];
									$btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
									$btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
									$btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
									$openLink = '<span class="iconBox">';
									$closeLink = '</span>';
									if($btnTitle && $btnLink) {
										$openLink = '<a href="'.$btnLink.'" target="'.$btnTarget.'" class="iconBox">';
										$closeLink = '</a>';
									}

									$icon = $col['icon'];
									$boxTitle = $col['title'];
									$hasIcon = ($icon) ? ' hasImage':'';
 								?>
								<div class="rscol">
									<div class="wrap">
										<div class="image<?php echo $hasIcon; ?>">
										<?php echo $openLink; ?>

											<figure class="iconWrap">
												<div class="inner">
												<?php if($icon) { ?>
													<span class="icon" style="background-image:url('<?php echo $icon['url']?>')"></span>
												<?php } ?>
												<?php if($boxTitle) { ?>
													<div class="title"><?php echo $boxTitle?></div>
												<?php } ?>
												</div>
											</figure>

											<?php if($btnTitle && $btnLink) { ?>
												<div class="button"><?php echo $btnTitle?></div>
											<?php } ?>

										<?php echo $closeLink; ?>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
				<?php endwhile; ?>
			</div>
			<?php } ?>

		</div>

	<?php endwhile; ?>

	</main>
</div>
<?php get_footer(); ?>
