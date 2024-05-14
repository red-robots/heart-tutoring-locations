<?php 
/**
* Template Name: Donate
*/
 get_header(); ?>





<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="body-line"></div>
<?php 
$image = get_field('page_top_photo');
//if( !empty($image) ): ?>
   <!-- <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /> -->
<?php //endif; ?>
<div id="top-content" style="background-image:url(<?php echo $image['url']; ?>);">




<!-- tabs -->
<div id="top-content-links-wrapper"><div id="top-content-content">
<div id="top-content-text"><?php the_field("top_photo_text"); ?></div>
<div id="top-content-header"><h1><?php the_title(); ?></h1></div>
<div id="top-content-links">
<div class="top-content-linkbox2"><a href="<?php bloginfo('url'); ?>/donate/#donate"><h2>Make an online
donation!</h2>Secure, tax-deductible donations.</a></div>
<div class="top-content-linkbox2"><a href="<?php bloginfo('url'); ?>/donate/#check"><h2>Donate by<br>
check!</h2>Mail your contribution<br>
to Heart.</a></div>
<div class="top-content-linkbox2"><a href="ma&#105;lto&#58;%&#54;7%&#54;C&#37;&#54;5nda&#46;m&#97;&#117;c&#107;&#37;40&#104;%6&#53;&#37;61rtm&#97;t&#104;tu&#116;%6Fring%&#50;Eo%72g"><h2>Become a community partner!</h2></a></div>
</div>


</div>
</div>
<!-- tabs -->


</div>

<div id="main-wrapper">
<div id="main">

<div class="page-content">
<div id="featured-image"><?php the_post_thumbnail( 'post-thumbnails' ); ?><div id="featured-text"><h3><?php the_field("quote_text"); ?></h3><?php the_field("quote_attribute"); ?></div><div id="sidebar-video"><?php the_field("video"); ?></div></div>     
     <?php the_content(); ?>
     
<?php //the_field("donate_form"); ?> 
<!--<script src="https://s3-us-west-2.amazonaws.com/bloomerang-public-cdn/hearttutoring/.widget-js/205824.js" type="text/javascript"></script>-->
<?php //get_template_part('inc/donate'); ?>

<?php the_field("donate_bottom_content"); ?>     

<?php endwhile; endif; ?> 

   <style type="text/css">
				.btn-group .btn-submit-donation {
					background: #00A5D1;
					color: #fff;
				}
		</style>
     
 </div><!-- / page content -->



<?php get_footer(); ?>
