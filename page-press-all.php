<?php 
/**
* Template Name: Press Room Posts
*/
 get_header(); ?>




<div id="body-line"></div>

<div id="main-wrapper">

<div id="main">



<div class="page-content">


<!-- -->
<div id="press-right">

<div class="press-right-box">
<div class="press-room-heading">
<h2 class="press-room-heading-tag">In The Media</h2><div class="press-room-view-all"><a href="<?php bloginfo('url'); ?>/category/press/">View All</a></div>
</div>
<div class="press-right-box-content">
<!-- content -->
<?php
$wp_query = new WP_Query();
$wp_query->query(array(
'post_type'=>'post', // your custom post type
'posts_per_page' => 3,
'tax_query' => array(
array(
'taxonomy' => 'category', // your custom taxonomy
'field' => 'slug',
'terms' => 'press' // the terms (categories) you created
)
)
));
if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
<div class="press-news-post"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><br><?php the_date('m.d.Y'); ?></div>
<?php endwhile;   ?>
<?php endif;   ?>
<?php wp_reset_query(); ?>
<?php wp_reset_postdata(); ?> 

<!-- / content -->
</div>
</div>


<div id="press-blog"><a href="<?php bloginfo('url'); ?>/latest-news">Blog</a></div>


<div class="press-right-box">
<div class="press-room-heading">
<h2 class="press-room-heading-tag">Contact Us</h2></div>
<div class="press-right-box-content">
<?php $recent = new WP_Query("page_id=4790"); while($recent->have_posts()) : $recent->the_post();?>
<?php the_field("contact_us"); ?>
<?php endwhile; wp_reset_postdata(); // end of the loop. ?>

</div>
</div>


<div class="press-right-box">
<div class="press-room-heading">
<h2 class="press-room-heading-tag">Quick Facts</h2></div>
<div class="press-right-box-content quick-facts">
<?php $recent = new WP_Query("page_id=4790"); while($recent->have_posts()) : $recent->the_post();?>
<?php the_field("quick_facts"); ?>
<?php endwhile; wp_reset_postdata(); // end of the loop. ?>
</div>
</div>



</div>
<!-- -->



<div id="press-left">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="press-room-heading"><h1 class="press-room-heading-tag"><?php the_title(); ?></h1>
</div>

     <?php the_content(); ?>
<?php endwhile; endif; ?>        



<!-- custom post feed -->
<?php
//echo $postid;
	$wp_query = new WP_Query();
	$wp_query->query(array(
	'post_type'=>'press',
	'posts_per_page' => 10,
	'paged' => $paged,
	'post__not_in' => array($postid)
));

	if ($wp_query->have_posts()) : ?>

    <?php while ($wp_query->have_posts()) : ?>

        

    <?php $wp_query->the_post(); ?>
  
      	<div class="press-room-item">
        <h2><a href="<?php the_field("press_article"); ?>" target="_blank"><?php the_title(); ?></a></h2><?php the_date('m.d.Y'); ?>
        
       <?php the_advanced_excerpt('length=20&add_link=1&use_words=1&no_custom=1&ellipsis=%26hellip;&exclude_tags=div,img');?>
        
        </div>
       	
    	<?php  endwhile; endif; wp_reset_postdata();  // close loop and reset the query ?>


   <?php pagi_posts_nav(); ?>  
 <!-- / custom post feed -->    

 </div>    
  


</div><!-- / page content -->





<?php get_footer(); ?>