
</div> <!-- main -->
</div> <!-- main -->

<?php if(get_field("testimonial")) { ?>

<div id="bottom-content">
<?php 
wp_reset_postdata();
wp_reset_query();
if ( have_posts() ) : while ( have_posts() ) : the_post(); 
$image = get_field('page_bottom_photo');
$bcStyle = ($image) ? ' style="background-image:url('.$image['url'].')"' : '';
?>
<div class="bottom-inner-img"<?php echo $bcStyle ?>>
	<?php if( !empty($image) ) { ?>
		<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /> 
	<?php } ?>
	<div id="bottom-content-testimonial-wrapper">
		<div id="bottom-content-testimonial"><?php the_field("testimonial"); ?></div>
	</div>
</div>
</div>
<?php endwhile; endif; ?>

<?php } ?>


<div id="footer">



<div id="footer2-wrapper">

<div id="footer2-column1">Heart Math Tutoring | <a href='ma&#105;&#108;&#116;o&#58;volunt&#101;e%72%40h%6&#53;ar&#37;&#55;4tu&#116;o&#114;in&#103;%2E&#111;%7&#50;g'>&#118;olunt&#101;e&#114;&#64;&#104;&#101;a&#114;t&#116;&#117;t&#111;ring&#46;org</a>

<div class="clear"></div>

<div class="sociallinks">
<?php if( $social = get_social_media() ) { ?>
	<?php foreach ($social as $type=>$data) { ?>
	<a href="<?php echo $data[0] ?>" target="_blank" class="social <?php echo $type ?>"><i class="<?php echo $data[1] ?>"></i><span style="position:absolute;z-index:-999"><?php echo ucwords($type) ?></span></a>	
	<?php } ?>
<?php } ?>
</div>

<br>
<a href="<?php bloginfo('url'); ?>/contact-us">CONTACT US</a> &nbsp; | &nbsp;
<a href="<?php bloginfo('url'); ?>/sitemap">sitemap</a> &nbsp; | &nbsp; site by <a href="https://www.bellaworksweb.com" target="_blank">Bellaworks</a>

</div>


	

<div id="footer2-right">
	<div id="newsletter-signup-footer">




		<!-- Begin Mailchimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/classic-071822.css" rel="stylesheet" type="text/css">
<style type="text/css">
              #mc_embed_signup{
              	/*background:#fff; */
              	border: 0;
              	clear:left; 
              	font:14px Helvetica,Arial,sans-serif;  
              	width:90%;
              	padding-top: 10px;
              	padding-bottom: 30px;
              	color: #fff;
                background: #ccc;
              }
              #mc_embed_signup input.email {
              	background: #fff;
              }
              #mc_embed_signup input.button {
              	background: #fff;
              	color: #00A5D1;
              }
              #mc_embed_signup_scroll h2 {
              	color: #fff;
              }
              #mc_embed_signup .helper_text {
              	padding: 0;
              }
              .bw-btn {
                width: 100%;
                float: left;
                position: relative;
              }
              @media screen and (min-width: 600px) {
                #mc_embed_signup{
                  width:600px;
                }
              }
              @media screen and (max-width: 820px) {
                #mc_embed_signup .button {
                  right: 8px ;
                  width: auto  !important;
                }
              }
              /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
                 We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
    <form action=https://hearttutoring.us10.list-manage.com/subscribe/post?u=0880b3c4481ad69db0317e28d&amp;id=c189b5056a&amp;f_id=00f6c2e1f0 method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll">
        <h2>Subscribe</h2>
        <div class="indicates-required"><span class="asterisk">*</span> indicates required</div>
<div class="mc-field-group">
              <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
</label>
              <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" required>
              <span id="mce-EMAIL-HELPERTEXT" class="helper_text"></span>
</div>
              <div id="mce-responses" class="clear">
                             <div class="response" id="mce-error-response" style="display:none"></div>
                             <div class="response" id="mce-success-response" style="display:none"></div>
              </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_0880b3c4481ad69db0317e28d_c189b5056a" tabindex="-1" value=""></div>
    <div class="clear"></div>
    <div class="bw-btn"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
    
    </div>
</form>
</div>
<script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->




		
		<?php //echo do_shortcode("[pdb_signup]"); ?>
	</div>
	<div class="clear"></div>
	


</div>


</div>
</div>
	

<?php wp_footer(); ?>

</body>
</html>
