<?php
/**
 * Displays a Single Post
 */

get_header(); ?>

	
<div id="body-line"></div>

<div id="main-wrapper">

<div id="main">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
	$image = get_field('photo');
	$size = 'large'; 
	$name = get_the_title();
	$title = get_field('title');
	$bio = get_field('bio');
	$email = get_field('email');
	$antispam = antispambot($email);
?>


<div class="page-content">
	<section class="single-team">
		
		<div class="bio">
			<h1><?php the_title(); ?></h1>
			<h2><?php echo $title; ?></h2>
			<div class="email">
				<a href="mailto:<?php echo $antispam; ?>"><?php echo $antispam; ?></a>
			</div>
			<?php echo $bio; ?>
		</div>
		<div class="single-photo"><?php echo wp_get_attachment_image( $image, $size ); ?></div>

		<div class="clear"></div>

		<div class="team-button">
			<a href="<?php bloginfo('url'); ?>/team">Other Team Members</a>
		</div>

	</section>
</div>




<?php endwhile; endif; ?>

<?php get_footer(); ?>