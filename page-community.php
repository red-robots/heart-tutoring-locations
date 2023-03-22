<?php 
/**
* Template Name: Community Partners
*/
 get_header(); ?>



<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>


<div id="body-line"></div>

<div id="main-wrapper">

<div id="main">



<div class="page-content">
<div id="featured-image"><?php the_post_thumbnail( 'post-thumbnails' ); ?><div id="featured-text"><h3><?php the_field("quote_text"); ?></h3><?php the_field("quote_attribute"); ?></div></div>

     <h1><?php the_title(); ?></h1>

     <?php the_content(); ?>
     
<!-- -->
<div class="partners">
<?php the_field("volunteer_partners_text"); ?>

<?php if(get_field('volunteer_partners_logos')): ?>          

<?php while(has_sub_field('volunteer_partners_logos')): ?>

<div class="logo-<?php the_sub_field("logo_size"); ?>">

<?php 
$image = get_sub_field('logo');
if( !empty($image) ): ?>



<?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

<a href="<?php the_sub_field("web_address"); ?>" target="_blank">
<?php } ?>


<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

<?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

</a>

<?php } ?>


<?php endif; ?>

<?php the_sub_field("alternate_text"); ?>
</div>

<?php endwhile; endif; ?>
</div>
<!-- -->



















<!-- -->
<div class="partners">


<div class="anchor-wrapper"><?php the_field("volunteer_partners_text_2"); ?>



</div>

<span class="anchor" id="financial-partners"><a name="financial-partners"></a></span>

<?php the_field("financial_partners_text"); ?>



<div class="financial-partner-category">


<h2><?php the_field("financial_partners_category_1"); ?></h2>

<?php if(get_field('financial_partners_logos_1')): ?>          
<div id="container">


<?php while(has_sub_field('financial_partners_logos_1')): ?>

<div class="logo-<?php the_sub_field("logo_size"); ?> item"><?php 
$image = get_sub_field('logo');
if( !empty($image) ): ?>
    <?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

<a href="<?php the_sub_field("web_address"); ?>" target="_blank">
<?php } ?>


<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

<?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

</a>

<?php } ?>
<?php endif; ?>
<?php the_sub_field("alternate_text"); ?>
</div>

<?php endwhile; ?>
</div><!-- container -->
<?php endif; ?>

</div>

<!-- -->
<div class="financial-partner-category">



<h2><?php the_field("financial_partners_category_2"); ?></h2>

<?php if(get_field('financial_partners_logos_2')): ?>          
<div id="container">
<?php while(has_sub_field('financial_partners_logos_2')): ?>

<div class="logo-<?php the_sub_field("logo_size"); ?> item"><?php 
$image = get_sub_field('logo');
if( !empty($image) ): ?>
    <?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

<a href="<?php the_sub_field("web_address"); ?>" target="_blank">
<?php } ?>


<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

<?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

</a>

<?php } ?>
<?php endif; ?>
<?php the_sub_field("alternate_text"); ?>
</div>

<?php endwhile; ?>
</div><!-- container -->
<?php endif; ?>
</div>


<!-- -->
<div class="financial-partner-category">

<h2><?php the_field("financial_partners_category_3"); ?></h2>

<?php if(get_field('financial_partners_logos_3')): ?>          
<div id="container">
<?php while(has_sub_field('financial_partners_logos_3')): ?>

<div class="logo-<?php the_sub_field("logo_size"); ?> item"><?php 
$image = get_sub_field('logo');
if( !empty($image) ): ?>
    <?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

<a href="<?php the_sub_field("web_address"); ?>" target="_blank">
<?php } ?>


<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

<?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

</a>

<?php } ?>
<?php endif; ?>
<?php the_sub_field("alternate_text"); ?>
</div>

<?php endwhile; ?>
</div><!-- container -->
<?php endif; ?>
</div>
<!-- -->

<div class="financial-partner-category">
<h2><?php the_field("financial_partners_category_4"); ?></h2>

<?php if(get_field('financial_partners_logos_4')): ?>          
<div id="container">
<?php while(has_sub_field('financial_partners_logos_4')): ?>

<div class="logo-<?php the_sub_field("logo_size"); ?> item"><?php 
$image = get_sub_field('logo');
if( !empty($image) ): ?>
    <?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

<a href="<?php the_sub_field("web_address"); ?>" target="_blank">
<?php } ?>


<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

<?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

</a>

<?php } ?>
<?php endif; ?>
<?php the_sub_field("alternate_text"); ?>
</div>

<?php endwhile; ?>
</div><!-- container -->
<?php endif; ?>
</div>



</div>
<!-- -->






















<!-- -->
<div class="partners">
<?php the_field("other_partners_text"); ?>

<?php if(get_field('other_partners_logos')): ?>          

<?php while(has_sub_field('other_partners_logos')): ?>

<div class="logo-<?php the_sub_field("logo_size"); ?> "><?php 
$image = get_sub_field('logo');
if( !empty($image) ): ?>
    <?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

<a href="<?php the_sub_field("web_address"); ?>" target="_blank">
<?php } ?>


<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

<?php 

$someField = get_sub_field('web_address');
if ( $someField != "" ) { ?>

</a>

<?php } ?>
<?php endif; ?>
<?php the_sub_field("alternate_text"); ?>
</div>

<?php endwhile; ?>

<?php endif; ?>
</div>
<!-- -->


</div><!-- / page content -->



<?php endwhile; endif; ?>



<?php //get_sidebar(); ?>

<?php get_footer(); ?>