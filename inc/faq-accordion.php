<?php
/**
 * FAQ accordion — ACF "accordion" repeater with an optional "accordion_header" title.
 */
if ( function_exists('have_rows') && have_rows('accordion') ) : ?>

  <a name="faqs"></a>
  <p>&nbsp;</p>
  <?php if ( get_field('accordion_header') ) : ?>
    <h2 class="faqTitle"><?php the_field("accordion_header"); ?></h2>
  <?php endif; ?>

  <div id="custom-accordion">
    <?php while ( have_rows('accordion') ) : the_row(); ?>
      <div class="faqrow">
        <div class="question">
          <h2><?php the_sub_field("accordion_header"); ?></h2>
          <span class="view"><span class="icon"></span></span>
        </div>
        <div class="answer">
          <?php the_sub_field("accordion_panel"); ?>
        </div>
      </div>
    <?php endwhile; ?>
  </div><!-- accordion -->

<?php endif; ?>
