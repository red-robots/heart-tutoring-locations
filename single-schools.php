<?php



/**



 * Displays a Single Post



 */







get_header(); ?>







	



<div id="body-line"></div>







<div id="main-wrapper">







<div id="main">



<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>







<div class="page-content">







<h1><?php the_title(); ?></h1>















        



<div id="school-photo"><?php 



$image = get_field('school_photo');



if( !empty($image) ): ?>



    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /> 



<?php endif; ?></div>



<p><strong>Principal:</strong> <?php the_field("principal"); ?>



<br><strong>Assistant Principal:</strong> <?php the_field("assistant_principal"); ?>



<br><strong>Math Facilitator:</strong> <?php the_field("math_facilitator"); ?>
<br><strong>Program Coordinator:</strong> <?php the_field("program_coordinator"); ?>
<br><strong>Email:</strong>
<?php $email = get_field("email"); 
if($email):?>
    <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
<?php endif;?>






<p><strong>Grades:</strong> <?php the_field("grades"); ?>



<br><strong>Enrollment:</strong> <?php the_field("enrollment"); ?>



<br><strong>Math Proficiency Rate:</strong> <?php the_field("math_proficiency_rate"); ?>



<br><strong>Economically Disadvantaged Students (EDS):</strong> <?php the_field("eds"); ?>







<p><strong>Tutoring Times:</strong> <?php the_field("tutoring_times"); ?>



<br><strong>Beginning of Heart Partnership:</strong> <?php the_field("date_beginning_with_heart"); ?>







<br><strong><a href="<?php the_field("website"); ?>" target="_blank">Website</a></strong>





<p><strong><a href="<?php bloginfo('url'); ?>/become-a-volunteer/#volunteer">Volunteer to tutor at <?php the_title(); ?></a></strong>













<!-- --> 



<p><?php 







$location = get_field('google_map');
// $location = get_field('google_map_new');
if( !empty($location) ):
?>
<div class="acf-map">
<?php //echo $location; ?>
	<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
	<h4><?php the_title(); ?></h4>
	<p class="address"><?php echo $location['address']; ?></p>
	<p>Tutoring Hours: <?php the_field('tutoring_times'); ?>

<?php if (strlen(get_post_meta($post->ID, "volunteers_needed", true)) > 0) : ?>
<p>Number of Volunteers Needed: <?php the_field('volunteers_needed'); ?></p>
<?php endif; ?>

    



    </div>



</div>



<?php endif; ?>



<!-- --> 











































        



<div style="float: left;"><?php previous_post_link('%link', 'previous school', false); ?>: <?php previous_post_link('<strong>%link</strong>'); ?></div>



<div style="float: right;"><?php next_post_link('%link', 'next school', false); ?>: <?php next_post_link('<strong>%link</strong>'); ?></div>



        



</div><!-- single post container -->



























<?php endwhile; endif; ?>







<?php get_footer(); ?>