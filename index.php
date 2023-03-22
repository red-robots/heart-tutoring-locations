<?php 

get_header(); 

?>
<div id="home-wrapper">
  <div id="home-row1">
    <div id="home-row1-content">
      <div id="home-row1-box">
        <div id="home-slider">
        <?php 
          // Query the Post type Slides
          $querySlides = array(
            'post_type' => 'slides',
            'posts_per_page' => '-1'
          );
          // The Query
          $the_query = new WP_Query( $querySlides );

          // The Loop
          if ( $the_query->have_posts()) : ?>
            <div class="flexslider">
              <ul class="slides">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                  <li> 
                    <?php
                      // check if the post has a Post Thumbnail assigned to it.
                      if ( has_post_thumbnail() ) {
                        the_post_thumbnail();
                      } 
                      the_content(); 
                      ?>
                  </li>
                <?php endwhile; ?>
              </ul><!-- slides -->
            </div><!-- .flexslider -->
          <?php 
            endif; // end loop 
            wp_reset_postdata(); 
          ?>
        </div><!-- home slider -->
      </div>
    <!-- tabs -->
      <div id="home-row1-links">
        <div class="linkbox">
          <a href="<?php bloginfo('url'); ?>/volunteers/become-a-volunteer/">
            sign up to <span class="linkboxlgfont">volunteer</span>
          </a>
        </div>
        <div class="linkbox">
          <a href="<?php bloginfo('url'); ?>/donate">
            make a <span class="linkboxlgfont">donation</span>
          </a>
        </div>
        <div class="linkbox">
          <a href="<?php bloginfo('url'); ?>/become-a-school-partner/">
            info for <span class="linkboxlgfont">schools</span>
          </a>
        </div>
      </div>
    <!-- tabs -->
    </div>
  </div><!-- home row1 -->

  <div id="home-row2">
    <div id="home-row2-content">
      <div id="latest-news">
        <a href="<?php bloginfo('url'); ?>/#latest-news">Latest News</a>
      </div>
      <?php 
      $recent = new WP_Query("page_id=2239"); 
      while($recent->have_posts()) : $recent->the_post();
      ?>
        <div id="tagline">
          <?php the_field("tagline"); ?>
        </div>
        <div id="callout-content">
          <?php the_field("callout_content"); ?>
        </div>
        <?php the_content(); ?>
      <?php 
        endwhile; 
        wp_reset_postdata(); // end of the loop. 
      ?>
    </div>
  </div><!-- home row2 -->

  <div id="home-row3">
    <div id="home-row3-content">
      <div id="instagram-wrapper">
        <div id="instagram-feed">
          <?php echo do_shortcode("[instagram-feed]"); ?>
        </div>
        <a href="https://instagram.com/heartmathtutoring/" target="_blank">HEART ON INSTAGRAM</a>
      </div>
      <div id="latest-news-feed">
        <h2>Latest News</h2>
        <?php
          query_posts('posts_per_page=3');
          if ( have_posts() ) : while ( have_posts() ) : the_post();
        ?>
        <?php the_date(); ?>
        <h3>
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <?php 
          endwhile; 
          endif; 
        ?>
      <a name="latest-news"></a>
      </div>
    </div>
  </div><!-- home row3 -->

  <div id="home-row4">
    <div id="home-row4-content">
      <div class="inner">
        <?php 
          $recent = new WP_Query("page_id=2239"); 
          while($recent->have_posts()) : $recent->the_post();
        ?>
        <div class="video">
          <?php the_field("video_one"); ?>
        </div>
        <div class="video">
          <?php the_field("video_two"); ?>
        </div>
        <div class="video">
          <?php the_field("video_three"); ?>
        </div>
        <div class="video">
          <?php the_field("video_four"); ?>
        </div>
        <?php 
          endwhile; 
          wp_reset_postdata(); // end of the loop. 
        ?>
      </div>
    </div>
  </div>
  <!-- home row4 -->
  
</div>
<a href="https://plus.google.com/104177206931999535082" rel="publisher"></a>
<?php 

get_footer(); 
