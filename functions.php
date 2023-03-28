<?php 
// Enqueueing all the java script in a no conflict mode
function bellaworks_scripts() {
  wp_enqueue_style( 'bellaworks-style', get_template_directory_uri() . '/style.css', array(), '2.14' );
  //wp_enqueue_style( 'bellaworks-style', get_stylesheet_uri()  );

  wp_deregister_script('jquery');
  wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', false, '3.4.1', false);
  wp_enqueue_script('jquery');

  wp_enqueue_script( 
      'bellaworks-jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', 
      array(), '20120206', 
      false 
    );

  wp_enqueue_script( 
      'acstarter-blocks', 
      get_template_directory_uri() . '/assets/js/vendors.js', 
      array(), '1.2', 
      true 
    );

  wp_enqueue_script( 
      'acstarter-custom', 
      get_template_directory_uri() . '/assets/js/custom.js', 
      array(), '1.31', 
      true 
    );
}
add_action( 'wp_enqueue_scripts', 'bellaworks_scripts' );




define('THEMEURI',get_template_directory_uri() . '/');

require get_template_directory() . '/inc/post-types.php';

function bellaworks_body_classes( $classes ) {
    global $post;
    $slug = ( isset($post->post_name) && $post->post_name ) ? ' page-' . $post->post_name : '';
    
    // Adds a class of group-blog to blogs with more than 1 published author.
    if ( is_multi_author() ) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    if ( is_front_page() || is_home() ) {
        $classes[] = 'homepage';
    } else {
        $classes[] = 'subpage'.$slug;
    }

    $browsers = ['is_iphone', 'is_chrome', 'is_safari', 'is_NS4', 'is_opera', 'is_macIE', 'is_winIE', 'is_gecko', 'is_lynx', 'is_IE', 'is_edge'];
    $classes[] = join(' ', array_filter($browsers, function ($browser) {
        return $GLOBALS[$browser];
    }));

    return $classes;
}
add_filter( 'body_class', 'bellaworks_body_classes' );

function shortenText($string, $limit, $break=".", $pad="...") {
  // return with no change if string is shorter than $limit
  if(strlen($string) <= $limit) return $string;

  // is $break present between $limit and the end of the string?
  if(false !== ($breakpoint = strpos($string, $break, $limit))) {
    if($breakpoint < strlen($string) - 1) {
      $string = substr($string, 0, $breakpoint) . $pad;
    }
  }

  return $string;
}


function parse_external_url( $url = '', $internal_class = 'internal-link', $external_class = 'external-link') {

    $url = trim($url);

    // Abort if parameter URL is empty
    if( empty($url) ) {
        return false;
    }

    //$home_url = parse_url( $_SERVER['HTTP_HOST'] );     
    $home_url = parse_url( home_url() );  // Works for WordPress
    $target = '_self';
    $class = $internal_class;
    $baseName = ($url) ? basename($url) : '';

    if( $url!='#' ) {
        if (filter_var($url, FILTER_VALIDATE_URL)) {

            $link_url = parse_url( $url );
            
            // Decide on target
            if( empty($link_url['host']) ) {
              // Is an internal link
              $target = '_self';
              $class = $internal_class;

            } elseif( $link_url['host'] == $home_url['host'] ) {
              // Is an internal link
              $target = '_self';
              $class = $internal_class;

            } else {
              // Is an external link
              $target = '_blank';
              $class = $external_class;
            }

        } 
    }

    // Return array
    $output = array(
        'class'     => $class,
        'target'    => $target,
        'url'       => $url
    );

    return $output;
}


/*-------------------------------------
  Move Yoast to the Bottom
---------------------------------------*/
function yoasttobottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


if( function_exists('acf_add_options_page') ) { acf_add_options_page();}

// Add support for thumbnails
function custom_theme_setup() {
	add_theme_support( 'post-thumbnails' );
}
add_action( 'after_setup_theme', 'custom_theme_setup' ); 

// add a favicon from your themes images folder
function mytheme_favicon() { ?> <link rel="shortcut icon" href="<?php echo bloginfo('stylesheet_directory') ?>/images/favicon.png" > <?php } add_action('wp_head', 'mytheme_favicon');

// Pagination
function pagi_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}

// Add Thumbnail Image Supoort
// Must have to do featured images.
add_theme_support( 'post-thumbnails' ); 
add_image_size( 'portsmall', 200, 9999 );
add_image_size( 'homepage', 270, 270, true );
add_image_size( 'postimage', 470, 9999 );

// catch that image
function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];

  if(empty($first_img)) {
    $first_img = "https://hearttutoring.org/bw/wp-content/themes/bellaworks/images/news-default.png";
  }
  return $first_img;
}

// Changing WordPress admin Menu Names
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'News';
    $submenu['edit.php'][5][0] = 'News';
    $submenu['edit.php'][10][0] = 'Add a News Post';
   // $submenu['edit.php'][15][0] = 'Status'; // Change name for categories
    //$submenu['edit.php'][16][0] = 'Labels'; // Change name for tags
    echo '';
}

function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'News';
        $labels->singular_name = 'News';
        $labels->add_new = 'Add a News Post';
        $labels->add_new_item = 'Add a News Post';
        $labels->edit_item = 'Edit News';
        $labels->new_item = 'News';
        $labels->view_item = 'View News';
        $labels->search_items = 'Search News';
        $labels->not_found = 'No posts found';
        $labels->not_found_in_trash = 'No posts found in Trash';
    }
    add_action( 'init', 'change_post_object_label' );
    add_action( 'admin_menu', 'change_post_menu_label' );


/* 
Change the placeholder text for the Title input for a posttype
*/
function accrr_change_default_title( $title ){
    $screen = get_current_screen();
    if ( 'team' == $screen->post_type ){
        $title = 'Enter Team Member Name';
    }
    return $title;
}
add_filter( 'enter_title_here', 'accrr_change_default_title' );
// if you need to deregister styles in plugins
/*add_action( 'wp_print_styles', 'my_deregister_styles', 100 );

function my_deregister_styles() {
	wp_deregister_style( 'soliloquy-style' );
}*/

/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name' => 'Home right sidebar',
		'id' => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );

/*
Plugin Name: Page Excerpt

Description: Adds support for page excerpts - uses WordPress code

*/
add_action( 'edit_page_form', 'pe_add_box');
add_action('init', 'pe_init');
function pe_init() {
	if(function_exists("add_post_type_support")) //support 3.1 and greater
	{add_post_type_support( 'page', 'excerpt' );}
}
function pe_page_excerpt_meta_box($post) {
?>
<label class="hidden" for="excerpt"><?php _e('Excerpt hey') ?></label><textarea rows="1" cols="40" name="excerpt" tabindex="6" id="excerpt"><?php echo $post->post_excerpt ?></textarea>
<p><?php _e('Excerpt go here..........'); ?></p>
<?php
}
function pe_add_box()
{
	if(!function_exists("add_post_type_support")) //legacy
	{		add_meta_box('postexcerpt', __('Page Excerpt'), 'pe_page_excerpt_meta_box', 'page', 'advanced', 'core');}
}

  // Limit the excerpt without truncating the last word.
// use like this > echo get_excerpt(100);
function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = $excerpt.'... <p><a href="'.$permalink.'">continue reading</a>';
  return $excerpt;
}

//
// Custom login function 
//
function custom_login_logo() {
        echo '<style type="text/css">h1 a { background: url('.get_bloginfo('template_directory').'/images/login-logo.png) no-repeat !important; width: 340px!important; height: 140px!important; }</style>';
}
add_action('login_head', 'custom_login_logo'); 

function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Heart Math Tutoring';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' ); 

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'menu1' ) );
	register_nav_menu( 'secondary', __( 'Secondary Menu', 'menu2' ) );

 add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
 // add your extension to the array
 $existing_mimes['vcf'] = 'text/x-vcard';
 return $existing_mimes;
}
/**
* preload Gravity Forms' stylesheets in head
*/
add_action('wp_enqueue_scripts', function() {
    if (function_exists('gravity_form_enqueue_scripts')) {
        // newsletter subscription form
        gravity_form_enqueue_scripts(5);
    }
});
//add_action('acf/init', 'my_acf_init');

/*-------------------------------------
  Adds Options page for ACF.
---------------------------------------*/
if( function_exists('acf_add_options_page') ) {acf_add_options_page();}

function my_acf_api_key() {  
   acf_update_setting('google_api_key', 'AIzaSyBOA-RHy6JvtZYx7etKtQL0-DU7tnrK36Y');
} 
add_action('acf/init', 'my_acf_api_key');


/* Social Media */
function get_social_media() {
  $social['facebook'] = array("facebook_link","fa fa-facebook-f");
  $social['twitter'] = array("twitter_link","fa fa-twitter");
  $social['linkedin'] = array("linkedin_link","fa fa-linkedin");
  $social['instagram'] = array("instagram_link","fa fa-instagram");
  $social_links = array();
  foreach($social as $k=>$data) {
    $fieldname = $data[0];
    $icon = $data[1];
    $val = get_field($fieldname,"option");
    if($val) {
      $social_links[$k] = array($val,$icon);
    }
  }
  return $social_links;
}


function social_media_shortcode( $atts ) {
  $a = shortcode_atts( array(
    'hide' => '',
  ), $atts );

  $hide_items = ($a['hide']) ? explode(",",$a['hide']) : '';
  $output = '';
  if( $social = get_social_media() ) {
    if($hide_items) {
      foreach($social as $type=>$data) {
        if( in_array($type,$hide_items) ) {
          unset($social[$type]);
        }
      }
    }

    if($social) {
      $icon_path = THEMEURI . 'images/icons/';
      foreach($social as $type=>$data) {
        $link = $data[0];
        $output .= '<a href="'.$link.'" target="_blank" class="'.$type.'"><i style="background-image:url('.$icon_path.'icon-'.$type.'.png)"></i><span class="hidden">'.$type.'</span></a>';
      }
    }
  }

  return ($output)  ? '<div class="social-media-links">'.$output.'</div>':'';
}
add_shortcode( 'social_media', 'social_media_shortcode' );


function extract_emails_from($string){
  preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
  return $matches[0];
}

function email_obfuscator($string) {
    $output = '';
    if($string) {
        $emails_matched = ($string) ? extract_emails_from($string) : '';
        if($emails_matched) {
            foreach($emails_matched as $em) {
                $encrypted = antispambot($em,1);
                $replace = 'mailto:'.$em;
                $new_mailto = 'mailto:'.$encrypted;
                $string = str_replace($replace, $new_mailto, $string);
                $rep2 = $em.'</a>';
                $new2 = antispambot($em).'</a>';
                $string = str_replace($rep2, $new2, $string);
            }
        }
        $output = apply_filters('the_content',$string);
    }
    return $output;
}


