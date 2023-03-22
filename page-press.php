<?php 
/**
* Template Name: Press Room
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
<?php the_field("contact_us"); ?>
</div>
</div>


<div class="press-right-box">
<div class="press-room-heading">
<h2 class="press-room-heading-tag">Quick Facts</h2></div>
<div class="press-right-box-content quick-facts">
<?php the_field("quick_facts"); ?>
</div>
</div>



</div>
<!-- -->



<div id="press-left">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<div class="press-room-heading"><h1 class="press-room-heading-tag"><?php the_title(); ?></h1>
<div class="press-room-view-all"><a href="<?php bloginfo('url'); ?>/press-room-all">View All</a></div>
</div>

     <?php the_content(); ?>
<?php endwhile; endif; ?>        



<!-- custom post feed -->
<?php /* Second Custom Query pulling the post type, "Press" */  
       	$args = array( 
        	'post_type' => array('press'), // In an array so You can list multiple Custom Post Types if you want ('blog', 'another_post_type')
        	'posts_per_page' => '4', // # of posts to show use -1 for all posts.	
        	);
        	$query = new WP_Query( $args );  // Query all of your arguments from above
       	?>
       	<?php if (have_posts()) : while( $query->have_posts() ) : $query->the_post(); // the loop ?>
  
      	<div class="press-room-item">
<!-- <h2><a href="<?php the_field("press_article"); ?>" target="_blank"><?php the_title(); ?></a></h2>-->
<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

<?php the_date('m.d.Y'); ?>
        
       <?php the_advanced_excerpt('length=20&add_link=1&use_words=1&no_custom=1&ellipsis=%26hellip;&exclude_tags=div,img');?>
        
        </div>
       	
    	<?php  endwhile; endif; wp_reset_postdata();  // close loop and reset the query ?>


 <div id="press-view-all-bottom"><a href="<?php bloginfo('url'); ?>/press-room-all">View All</a></div>    
 <!-- / custom post feed -->    

 </div>    
  


</div><!-- / page content -->





<?php get_footer(); ?>