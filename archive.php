<?php
/*
Template Name: Archives
*/
get_header(); ?>
	<div id="main">

<div class="page-content">


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


<h1><?php the_date('F Y'); ?></h1>

<?php while(have_posts()) : the_post(); ?>

<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

    
<?php endwhile; ?>
<div class="clear"></div>
 <?php pagi_posts_nav(); ?>

<!-- -->

<h2>Monthly Archives</h2>
<ul class="archives"><?php wp_get_archives('type=monthly&show_post_count=1') ?></ul>
<!-- -->




	</div><!-- #content -->
</div><!-- #container -->

<?php get_footer(); ?>