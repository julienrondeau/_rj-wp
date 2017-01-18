<?php
/**
 * _rj functions and definitions.
 * Author: Julien Rondeau
 * url http://www.julienrondeau.fr
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package _rj
 */

 /******************************************

 TABLE OF CONTENTS

 1. Include Files
 2. Theme setup
 3. Register Sidebar
 4. Register Google Fonts
 5. Scripts & Enqueueing
 6. Change Name of Post Types in Admin Backend
 7. Add First and Last Classes to Menu & Sidebar
 8. Add First and Last Classes to Posts
 9. Custom Functions

 ******************************************/

 /*********************
   1. INCLUDE FILES
 *********************/

 /**
  * Implement the Custom Header feature.
  */
 //require get_template_directory() . '/inc/custom-header.php';

 /**
  * Implement Custom Post Types.
  */
 //require get_template_directory() . '/inc/custom-post-type.php';
//require get_template_directory() . '/inc/custom-functions.php';

 /**
  * Custom Woocommerce functions.
  */
 //require get_template_directory() . '/inc/woocustoms.php';


 /**
  * Custom template tags for this theme.
  */
 require get_template_directory() . '/inc/template-tags.php';

 /**
  * Custom functions that act independently of the theme templates.
  */
 require get_template_directory() . '/inc/extras.php';

 /**
  * Customizer additions.
  */
 require get_template_directory() . '/inc/customizer.php';

 /**
  * Load Jetpack compatibility file.
  */
 require get_template_directory() . '/inc/jetpack.php';


 /*********************
  2. _rj theme setup
 *********************/

if ( ! function_exists( '_rj_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _rj_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _rj, use a find and replace
	 * to change '_rj' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( '_rj', get_template_directory() . '/languages' );

	/*
	 * DECLARE WOOCOMMERCE SUPPORT if needed
	 */
	//add_theme_support( 'woocommerce' );

	/*
	 *  ACF - CREATE AN OPTION PAGE FOR THE THEME
	 */

	if( function_exists('acf_add_options_page') ) {

	 acf_add_options_page('Options');

	}

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Thumbnail sizes
	//add_image_size( 'kilic-galerie', 240, 175, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', '_rj' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

    // Enable support for Theme Logos
    add_theme_support( 'custom-logo', array(
        'width'       => 300,
        'height'      => 80,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_rj_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // _rj_setup
add_action( 'after_setup_theme', '_rj_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _rj_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_rj_content_width', 640 );
}
add_action( 'after_setup_theme', '_rj_content_width', 0 );


/*********************
	3. REGISTER SIDEBAR
*********************/
function _rj_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '_rj' ),
		'id'            => 'sidebar-1',
		'description'   => 'Content sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	) );
   register_sidebar( array(
	 	'name'          => esc_html__( 'Sidebar - bas de page', '_rj' ),
	 	'id'            => 'sidebar-2',
	 	'description'   => 'Footer sidebar',
	 	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	 	'after_widget'  => '</aside>',
	 	'before_title'  => '<div class="widget-title">',
	 	'after_title'   => '</div>',
	 ) );

}
add_action( 'widgets_init', '_rj_widgets_init' );



/*********************
 4. REGISTER GOOGLE FONTS
 * @return string Google fonts URL for the theme.
*********************/

if ( ! function_exists( '_rj_fonts_url' ) ) :

function _rj_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Roboto font: on or off', '_rj' ) ) {
		$fonts[] = 'Roboto:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', '_rj' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;

        }
endif;

/*********************
	5. ENQUEUE SCRIPTS AND STYLES
*********************/

function _rj_scripts() {

	/*-------- _rj fonts --------*/
	wp_enqueue_style( '_rj-fonts', _rj_fonts_url(), array(), null );
    
	// Font Awesome css
	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"', array(), null );
    
    // Register Jquery the right way!
    wp_deregister_script('jquery');
    wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-1.12.2.min.js', array(), '', true );
    wp_enqueue_script( 'jquery-migrate', '//code.jquery.com/jquery-migrate-1.4.0.min.js',  array(),'', true );

	// modernizr (without media query polyfill)
	wp_enqueue_script( '_rj-modernizr', '//cdnjs.cloudflare.com/ajax/libs/modernizr/2.7.1/modernizr.min.js', false, null );
	
        //Jquery-easing
        //wp_enqueue_script( '_rj-jquery.easing.1.3', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array('jquery'), '1.3', true );

        //Infinite Ajax scroll
        //wp_enqueue_script( 'infinite-ajax-scroll', get_template_directory_uri() . '/js/jquery-ias.min.js', array('jquery'), '', true );

        // Owl Carousel
//    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '', true );
	
	// jquery TouchSwipe
	//wp_enqueue_script( 'TouchSwipe',  get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), '1.6', true );
	
	// rSlider
	//wp_enqueue_script( 'unslider-js', get_template_directory_uri() . '/js/unslider-min.js', array(), '', true );
	
	//Headroom js
	//wp_enqueue_script( 'headroom-js', get_template_directory_uri() . '/js/headroom.js', array(), '', true );
	
	wp_enqueue_script( '_rj-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( '_rj-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	//adding scripts file in the footer
	wp_enqueue_script( '_rj-js', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
    // If using a child theme, auto-load the parent theme style.
    // Props to Justin Tadlock for this recommendation - http://justintadlock.com/archives/2014/11/03/loading-parent-styles-for-child-themes
    if ( is_child_theme() ) {
        wp_enqueue_style( '_rj-parent-style', trailingslashit( get_template_directory_uri() ) . 'style.css' );
    }
        
	// _rj styles 
	wp_enqueue_style( '_rj-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', '_rj_scripts' );

// Update CSS within in Admin

function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

/**
 * Displays the optional custom logo. If no logo is available, it displays the Site Title
 *
 * @since Sitepoint Base 1.0
 *
 * @return void
 */
if ( ! function_exists( '_rj_the_custom_logo' ) ) {
	function _rj_the_custom_logo() {
		$siteTitleStr = "";

		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			the_custom_logo();
		}
		else {
			$siteTitleStr .= '<h1><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">';
			$siteTitleStr .= get_bloginfo( 'name' );
			$siteTitleStr .= '</a></h1>';
			echo $siteTitleStr;
		}
	}
}


/*********************
  6. CHANGE NAME OF POSTS TYPE IN ADMIN BACKEND
*********************/
/* //Currently commented out. This is useful for improving UX in the WP backend
function _rj_change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'News';
	$submenu['edit.php'][5][0] = 'All News Entries';
	$submenu['edit.php'][10][0] = 'Add News Entries';
	$submenu['edit.php'][15][0] = 'Categories'; // Change name for categories
	$submenu['edit.php'][16][0] = 'Tags'; // Change name for tags
	echo '';
}

function _rj_change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'News';
	$labels->singular_name = 'News';
	$labels->add_new = 'Add News Entry';
	$labels->add_new_item = 'Add News Entry';
	$labels->edit_item = 'Edit News Entry';
	$labels->new_item = 'News Entry';
	$labels->view_item = 'View Entry';
	$labels->search_items = 'Search News Entries';
	$labels->not_found = 'No News Entries found';
	$labels->not_found_in_trash = 'No News Entries found in Trash';
}
add_action( 'init', '_rj_change_post_object_label' );
add_action( 'admin_menu', '_rj_change_post_menu_label' );
*/

/*********************
  7. ADD FIRST AND LAST CLASSES TO MENU & SIDEBAR
/*********************/

function _rj_add_first_and_last($output) {
	$output = preg_replace('/class="menu-item/', 'class="first-item menu-item', $output, 1);
	$last_pos = strripos($output, 'class="menu-item');
	if($last_pos !== false) {
		$output = substr_replace($output, 'class="last-item menu-item', $last_pos, 16 /* 16 = hardcoded strlen('class="menu-item') */);
	}
	return $output;
}
add_filter('wp_nav_menu', '_rj_add_first_and_last');

// Add "first" and "last" CSS classes to dynamic sidebar widgets. Also adds numeric index class for each widget (widget-1, widget-2, etc.)
function _rj_widget_first_last_classes($params) {

	global $my_widget_num; // Global a counter array
	$this_id = $params[0]['id']; // Get the id for the current sidebar we're processing
	$arr_registered_widgets = wp_get_sidebars_widgets(); // Get an array of ALL registered widgets

	if(!$my_widget_num) {// If the counter array doesn't exist, create it
		$my_widget_num = array();
	}

	if(!isset($arr_registered_widgets[$this_id]) || !is_array($arr_registered_widgets[$this_id])) { // Check if the current sidebar has no widgets
		return $params; // No widgets in this sidebar... bail early.
	}

	if(isset($my_widget_num[$this_id])) { // See if the counter array has an entry for this sidebar
		$my_widget_num[$this_id] ++;
	}
	else { // If not, create it starting with 1
		$my_widget_num[$this_id] = 1;
	}

	$class = 'class="widget-' . $my_widget_num[$this_id] . ' '; // Add a widget number class for additional styling options

	if($my_widget_num[$this_id] == 1) { // If this is the first widget
		$class .= 'first-widget ';
	}
	elseif($my_widget_num[$this_id] == count($arr_registered_widgets[$this_id])) { // If this is the last widget
		$class .= 'last-widget ';
	}

	$params[0]['before_widget'] = str_replace('class="', $class, $params[0]['before_widget']); // Insert our new classes into "before widget"

	return $params;

}
add_filter( 'dynamic_sidebar_params', '_rj_widget_first_last_classes' );


/*********************
	8. ADD FIRST AND LAST CLASSES TO POSTS
/*********************/

function _rj_post_classes( $classes ) {
	global $wp_query;
	if($wp_query->current_post == 0) {
		$classes[] = 'first-post';
	} elseif(($wp_query->current_post + 1) == $wp_query->post_count) {
		$classes[] = 'last-post';
	}

	return $classes;
}
add_filter( 'post_class', '_rj_post_classes' );


/*********************
  9. CUSTOM FUNCTIONS
*********************/

/*
 *  CUSTOMIZE WORDPRESS LOGIN PAGE
 */

// custom logo image on login page
function login_style() {
    echo "<style type='text/css'>
        html {background: #fff;}
        body {background: #fff;}
        body.login #login h1 a { background:url('".get_template_directory_uri()."/images/logo-login.png') no-repeat scroll center top transparent !important; height: 221px; width: 313px;}
    </style>";
}
add_action('login_head','login_style');

// link the login logo to the site root
function login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'login_logo_url' );

// display site title on logo:hover
function login_logo_url_title() {
    return '_rj';
}
add_filter( 'login_headertitle', 'login_logo_url_title' );


/*
 *  DO NOT DISPLAY ADMIN BAR IN THE FRONT-END
 */

add_filter( 'show_admin_bar', '__return_false' );


/*
 * BLOCK WORDPRESS VERSION DISPLAY
 */

function masquer_version() {
return '';
}
add_filter('the_generator', 'masquer_version');


/*
* REMOVE WP VERSION FROM SCRIPTS
*/

function _rj_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

add_filter( 'style_loader_src', '_rj_remove_wp_ver_css_js', 9999 );	// remove WP version from css
add_filter( 'script_loader_src', '_rj_remove_wp_ver_css_js', 9999 );// remove WP version from scripts


/*
* THIS REMOVES THE ANNOYING […] TO A READ MORE LINK
*/
function _rj_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a href="'. get_permalink($post->ID) . '" title="'. __('Read', '_rj') . get_the_title($post->ID).'" class="readmore">'. __('Read more &raquo;', '_rj') .'</a>';
}
	add_filter('excerpt_more', '_rj_excerpt_more');


/*
* CHANGE EXCERPT LEGNTH - BY DEFAULT 55 WORDS
*/
function _rj_excerpt_length( $length ) {
  return 25;
}
add_filter( 'excerpt_length', '_rj_excerpt_length', 999 );



/*
* RETURN THE SEARCH RESULTS PAGE EVEN IF THE QUERY IS EMPTY - HTTP://VINAYP.COM.NP/HOW-TO-SHOW-BLANK-SEARCH-ON-WORDPRESS/
*/

function _rj_make_blank_search ($query){
	global $wp_query;
	if (isset($_GET['s']) && $_GET['s']==''){  //if search parameter is blank, do not return false
		$wp_query->set('s',' ');
		$wp_query->is_search=true;
	}
	return $query;
}
add_action('pre_get_posts','_rj_make_blank_search');


/*
* REMOVE THE P FROM AROUND IMGS (HTTP://CSS-TRICKS.COM/SNIPPETS/WORDPRESS/REMOVE-PARAGRAPH-TAGS-FROM-AROUND-IMAGES/)
*/
function _rj_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/*
 * Custom navigation text links for post list navigation 
 */
function custom_nav(){
	$navigation = '';
	$previous   = get_previous_post_link( '<div class="nav-previous">%link</div>', '<i class="fa fa-angle-left fa-lg"></i> previous', true );
	$next       = get_next_post_link( '<div class="nav-next">%link</div>', 'next <i class="fa fa-angle-right fa-lg"></i>', true );

	// Only add markup if there's somewhere to navigate to.
	if ( $previous || $next ) {
		$navigation = _navigation_markup( $previous . $next, 'custom-post-navigation' );
	}

	echo $navigation;
}