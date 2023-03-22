<!DOCTYPE html>

<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<script src="https://kit.fontawesome.com/aa807ceeb7.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/colorbox.css" />
<link href='https://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/fonts/MyFontsWebfontsKit.css">
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBOA-RHy6JvtZYx7etKtQL0-DU7tnrK36Y"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://www.google.com/recaptcha/api.js?render=6LdIzNEUAAAAAJPp55-3Bve0vGcrmK3KtN6uel8t"></script>
<script>
// grecaptcha.ready(function() {
//     grecaptcha.execute('6LcpydEUAAAAAM64RUA79v2r61qEpfS-FDyIQlg_', {action: 'homepage'}).then(function(token) {
//        ...
//     });
// });
</script>
<?php wp_head(); ?>

<?php if(is_page( 'Contact Us' ) ) { ?>
<script>

jQuery(document).ready(function($){

   $('iframe').attr("src", $('iframe').attr('src').replace("http:","https:") );

});

</script>
<?php } else { ?>
<?php } ?>
<!-- mobile nav -->
<script type="text/javascript" language="JavaScript"><!--

function HideContent(d) {

document.getElementById(d).style.display = "none";

}

function ShowContent(d) {

document.getElementById(d).style.display = "block";

}

function ReverseDisplay(d) {

if(document.getElementById(d).style.display == "none") { document.getElementById(d).style.display = "block"; }

else { document.getElementById(d).style.display = "none"; }

}

//-->
</script>
<!-- mobile nav -->
<!-- sticky nav -->
<script type="text/javascript">

$(window).scroll(function() {

    if ($(this).scrollTop() > 130) { //I just used 200 for testing

        $("#tester").css({ "position": "fixed", "top": 0 });

    } else {

        $("#tester").css({ "position": "absolute", "top": "130px" }); //same here

    }   			

});

</script>
<!-- sticky nav -->
<?php //the_field('google_analytics', 'option'); ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-48745607-1"></script>
<script type="text/javascript">
   window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-48745607-1');
</script>
<!-- liquid web -->
</head>
<body <?php body_class($customClass); ?>>
<!-- volunteer button -->
<?php 

	// if is not page "Donate" or "Become a "Volunteer"
    $showBtn = get_field('show_volunteer_button');

	if ( $showBtn !== 'no' ) : ?>
        <div id="volunteer-button">
            <a href="<?php bloginfo('url'); ?>/volunteers/become-a-volunteer/">Become A Volunteer!<br>
            <img src="<?php bloginfo('template_url'); ?>/images/blank.png" alt="" width="70" height="65" border="0">
            </a>
        </div><!-- volunteer-button -->
    <?php endif; // end if not pages ?>
<!-- volunteer button -->

<div id="main-header-wrapper">
    <?php if( have_rows('top_buttons', 'option') ): ?>
        <div class="cta-btns">
            <div class="btn-place">
                <?php while( have_rows('top_buttons', 'option') ): the_row(); 
                    $btnLink = get_sub_field('button', 'option');
                ?>
                    <div class="btnlink">
                        <a href="<?php echo $btnLink['url']; ?>"><?php echo $btnLink['title']; ?></a>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
    <div id="main-header">
            <div id="logo">
                <a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/heart-math-tutoring.png" alt="" border="0"></a> 
            </div><!-- #logo -->
        <!-- <div id="tester"> -->
            <div id="navigation">
                <nav id="access" role="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                </nav>
            </div><!-- navigation -->
        <!--</div>tester  -->
    </div><!-- #main header -->
</div>  <!-- main-header-wrapper --> 

<div id="mobile-navigation">
    <a href="javascript:ReverseDisplay('uniquename')" id="mobileMenuTxt"> MENU <span class="arrow"></span>
    </a>
    <div id="uniquename" style="display:none;">
        <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>    
    </div><!-- uniquename -->
</div><!-- #navigation -->    
</div> <!--  -->