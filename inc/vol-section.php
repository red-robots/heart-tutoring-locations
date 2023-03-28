<?php 

/*
New Volunteers Section

*/
$how_it_works_title = get_field('how_it_works_title');
$content = get_field('content');
$video = get_field('video');
$cta_button = get_field('cta_button');
$steps_title = get_field( 'steps_title' );
// echo '<pre>';
// print_r($cta_button);
// echo '</pre>';

?>
<section class="vols">
	<div class="title"><h2><?php echo $how_it_works_title ?></h2></div>
	<div class="inner">
		
		<div class="video">
			<div class="inside">	
		   		<?php echo $video; ?>
		   	</div>
		</div>
		 <div class="content">
		   <?php echo $content ?>
		   <?php if( $cta_button ) { ?>
		    <div class="btn-drop">
		    	<span><?php echo $cta_button['title'] ?>&nbsp;&nbsp;&nbsp;<i class="fa-sharp fa-solid fa-chevron-down"></i></span>
		      <div class="btn-dropbox">
		        <?php while( have_rows('dropdown_links') ): the_row(); 
		            $link = get_sub_field('link');
		          ?>
		          
		            <div class="link">
		              <a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a>
		            </div>
		          
		        <?php endwhile; ?>
		        </div>
		    </div>
		   <?php } ?>
		</div>
	</div>
</section>
<?php $i=0; if( have_rows('steps') ) : ?>
 <section class="steps">
 	<?php  if($steps_title) { echo '<h2 class="steps-title">'.$steps_title.'</h2>';} ?>
 	<div class="inner">
   
   <?php while( have_rows('steps') ): the_row(); $i++; 
      $title = get_sub_field('title');
      $description = get_sub_field('description');
    ?>
    <div class="step">
      <div class="num"><?php echo $i; ?></div>
      <?php if($title) { echo '<h3>'.$title.'</h3>';}?>
      <?php if($description) { echo '<div class="step-desc">'.$description.'</div>';}?>
    </div>
    <?php endwhile; ?>
    </div>
 </section>
<?php endif; ?>