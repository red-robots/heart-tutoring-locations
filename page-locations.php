<?php 
/**
* Template Name: Locations
*/
 get_header(); ?>



<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<div id="body-line"></div>

<?php 
$image = get_field('page_top_photo'); 
$tC = get_field('beginning_content'); 
$sciptt = get_field('form_script'); 
$bC = get_field('bottom_content'); 
?>

<div id="top-content" style="background-image:url(<?php echo $image['url']; ?>);">
	<div id="top-content-links-wrapper">
		<div id="top-content-content">
			<div id="top-content-text">
				<?php the_field("top_photo_text"); ?>
			</div>
			<div id="top-content-header">
				<h1><?php the_title(); ?></h1>
			</div>
			<?php if(have_rows('box_links')): ?>
				<div id="top-content-links">
					<?php while(have_rows('box_links')): the_row(); 
						$tTitle = get_sub_field('title');
						$tLink = get_sub_field('link');
						$subText = get_sub_field('sub_text');
						?>
						<div class="top-content-linkbox2">
							<a href="<?php echo $tLink;; ?>">
								<h2><?php echo $tTitle;; ?></h2>
								<?php echo $subText; ?>
							</a>
						</div>
				<?php endwhile; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<div id="main-wrapper">
<div id="main">
	<div class="page-content need">
		<div id="featured-image">
			<?php the_post_thumbnail( 'post-thumbnails' ); ?>
			<div id="featured-text">
				<h3><?php the_field("quote_text"); ?></h3>
				<?php the_field("quote_attribute"); ?>
			</div>
		</div>
	     <h1><?php the_title(); ?></h1>

	     <?php 
	     the_content(); 
	     echo $tC;
	     echo '<br><!-- form script -->';
	     echo '<div id="formz-wrap">'.$sciptt.'</div>';
	     echo '<br><!-- Bottom Content -->';
	     echo $bC;
	     ?>
	</div><!-- / page content -->
<?php endwhile; endif; ?>
<?php get_footer(); ?>