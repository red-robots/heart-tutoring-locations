<?php 
/* 
 * Template Name: HMT Volunteer Portal
 */
get_header(); 
global $post; 
$protected=false;
?>

<div id="primary" class="new-content-area noPadBottom">
	<main class="new-site-main contentWrap" role="main" style="min-height:20em"> 
    <?php if ( post_password_required($post) ) {  ?>

      <?php //Display default password protect text... ?>
      <?php while ( have_posts() ) : the_post();  ?>

        <div class="main-info-text">
          <h1><?php the_title(); ?></h1>
          <?php if( get_the_content() ) { ?>  
          <div class="entry-content"><?php the_content(); ?></div>
          <?php } ?>
        </div>
      
      <?php endwhile; ?>

    <?php } else { ?>

      <?php while ( have_posts() ) : the_post();  ?>

        <div class="main-info-text">
          <h1><?php the_title(); ?></h1>
          <?php if( get_the_content() ) { ?>  
          <div class="entry-content"><?php the_content(); ?></div>
          <?php } ?>
        </div>
      
      <?php endwhile; ?>


      <?php 
      $bottom_title = get_field("section_title");
      $bottom_contents = get_field("bottom_contents");
      $placeholder = THEMEURI . 'images/rectangle-lg.png';
      if($bottom_contents) { ?>
      <section class="resources-section">
        <?php if ($bottom_title) { ?>
        <div class="section-title"><h2><?php echo $bottom_title ?></h2></div>
        <?php } ?>
        
        <div class="flexwrap">
          <?php foreach ($bottom_contents as $c) { 
            $img = $c['image'];
            $title = $c['title'];
            $description = $c['description'];
            $button_name = $c['button_name'];
            $type = $c['button_link'];
            $button_type = ($type=='file') ? $type : 'url';
            $buttonLink = $c[$button_type];
            $buttonTarget = '_self';
            if($button_type=='file') {
              $buttonTarget = "_blank";
            } else {
              if($buttonLink) {
                $bLink = parse_external_url($buttonLink);
                $buttonTarget = $bLink['target'];
              }
            }
            $link_open = '';
            $link_close = '';
            if ($button_name && $buttonLink) {
              $link_open = '<a href="'.$buttonLink.'" target="'.$buttonTarget.'">';
              $link_close = '</a>';
            }
          ?>
          <div class="rscol">
            <div class="wrap">
              <div class="image <?php echo ($img) ? 'hasImage':'noImage' ?>">
                <?php echo $link_open; ?>
                <img src="<?php echo $placeholder ?>" alt="" aria-hidden="true">
                <?php if ($img) { ?>
                <span class="thumb" style="background-image:url('<?php echo $img['url'] ?>')"></span> 
                <?php } ?>
                <?php echo $link_close; ?>
              </div>
              <div class="details">
                <?php if ($title) { ?>
                <h3 class="title"><?php echo $title ?></h3> 
                <?php } ?>
                <?php if ($description) { ?>
                <div class="text"><?php echo $description ?></div>  
                <?php } ?>
                <?php if ($button_name && $buttonLink) { ?>
                <div class="button">
                  <a href="<?php echo $buttonLink ?>" target="<?php echo $buttonTarget ?>" class="theme-btn2"><?php echo $button_name ?></a>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>  
          <?php } ?>
        </div>
      </section>
      <?php } ?>

    <?php } ?>
    
	</main>

</div>

<?php get_footer(); ?>