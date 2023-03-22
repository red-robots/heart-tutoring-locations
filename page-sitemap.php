<?php 
/**
* Template Name: Sitemap Page
*/
 get_header(); ?>

<div id="body-line"></div>

<div id="main-wrapper">

<div id="main">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<div class="page-content">
     <h1><?php the_title(); ?></h1>
     <?php the_content(); ?>
     
<div id="sitemap">
	<?php /* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assigned to the primary location is the one used. If one isn't assigned, the menu with the lowest ID is used. */ ?>
				<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
</div>
     
 </div><!-- / page content -->


<?php endwhile; endif; ?>

<?php //get_sidebar(); ?>
<?php get_footer(); ?>