<?php
/**
* Search Page
*/

get_header(); ?> 

	<div id="main">

<div class="page-content">


<!-- -->
	
<h1>Search Results</h1>

<!-- news box -->
<div id="news-box">

 <h2>Categories</h2>
<ul><?php wp_list_cats('sort_column=name&optioncount=1') ?></ul>
 </ul>
 <?php wp_reset_postdata(); ?>
 
 <h2>Recent Posts</h2>
 <?php $the_query = new WP_Query( 'showposts=7' ); ?>
<ul>
<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

 <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></li>

 <?php endwhile;?>
</ul>

<!-- <p><a href="<?php bloginfo('url'); ?>/blog">see all ></a></p> -->

 <?php wp_reset_postdata(); ?>
 
</div>
<!-- / news box -->

<?php
	/* Start the Loop 
	
		Number of posts on a category page, 
		before it paginates, will be determined 
		by the WordPress Admin in Settings > Reading
	
	*/
	
	while ( have_posts() ) : the_post(); ?>
    
    <div class="post">
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <?php the_excerpt(); ?>
    </div><!-- post -->
    

<?php endwhile;?>

    <div class="clear"></div>
    <?php pagi_posts_nav(); ?>
    




<!-- -->

<h2>Monthly Archives</h2>
<ul class="archives"><?php wp_get_archives('type=monthly&show_post_count=1') ?></ul>
<!-- -->




	</div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>