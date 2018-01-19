<?php
// Theme prefix
	global $redux_options, $themePrefix;
	$themePrefix = "vhs_";

// Define templateurl
	define( 'TEMPLATEURL', get_template_directory_uri() );

// Location defaults
	date_default_timezone_set('America/Vancouver');
	setlocale(LC_ALL, 'english');
	define("CHARSET", "utf-8");

// Theme supports
add_theme_support('nav-menus');
add_theme_support('html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
add_theme_support('custom-logo', array(
		'width'       => 260,
		'height'      => 50,
		'flex-width' => true,
		'header-text' => array( 'site-title', 'site-description' ),
	)
);

// Register navigation menus
	register_nav_menus( array(
		'main'				=> 'Main menu',
		'footer'			=> 'Footer navigation',
		'terms'				=> 'Terms menu (Last line at the footer)'
		)
	);

// Register sidebar
	if( function_exists('register_sidebar') ){
		register_sidebar( array(
				'name'			=> 'Sidebar',
				'before_widget'	=> '<div class="col-md-12 col-sm-12 col-xs-12 mOffsetSmall">',
				'after_widget'	=> '</div>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>'
			)
		);

		// Sidebar 2 to implement Outbrain Ad
		register_sidebar( array(
				'name'			=> 'Sidebar 2',
				'before_widget'	=> '<div class="col-md-12 col-sm-12 col-xs-12 mOffsetSmall">',
				'after_widget'	=> '</div>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>'
			)
		);
	}

// Register post thumbnail sizes
	add_theme_support( 'post-thumbnails');
	set_post_thumbnail_size( '1920', '1080' );
	add_image_size( $themePrefix . 'featuredPost', '845', '500', 'center' );
	add_image_size( $themePrefix . 'singlePostthumbnail', '845');
	add_image_size( $themePrefix . 'archivePostthumbnail', '410');
	add_image_size( $themePrefix . 'featuredPostSmall', '285', '170', 'center' );
	add_image_size( $themePrefix . 'homeListBig', '550', '370', 'center' );
	add_image_size( $themePrefix . 'homeListSmall', '270', '180', 'center' );

// Enqueue styles and scripts
	add_action('wp_enqueue_scripts', 'vhs_enqueue_scriptsAndStyles');
	function vhs_enqueue_scriptsAndStyles(){

		$themeSettings = wp_get_theme();

		wp_enqueue_script( 'jquery' );

		// Scripts register
		wp_register_script('main', TEMPLATEURL .'/assets/js/main.min.js', array('jquery'), $themeSettings->version, true );
		 
		// Scripts enqueue
		wp_enqueue_script('main');

		// Styles
		wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap.min.css', array(), $themeSettings->version, 'all');
		wp_enqueue_style('style', get_bloginfo('stylesheet_url'), array('bootstrap'), $themeSettings->version, 'all');
		wp_enqueue_style('fontAwesome', get_template_directory_uri().'/assets/css/font-awesome.min.css', array(), $themeSettings->version, 'all');
	}

/**
 * Require all admin extensions
 */
	$extension_path = TEMPLATEPATH . '/inc/';
	if( ! class_exists( 'ReduxFramework' ) && file_exists( $extension_path . 'redux/framework.php' ) ) require_once( $extension_path . 'redux/framework.php' );
	if( ! class_exists( 'Tax_Meta_Class' ) && file_exists( $extension_path . 'tax-meta-class/tax-meta-class.php' ) ) require_once( $extension_path . 'tax-meta-class/tax-meta-class.php' );

   // Get all php files at the extensions directory
   $files = glob( $extension_path . '*.php' );
	foreach( $files as $file ){
		if( file_exists( $file ) ) {
			require_once( $file );
		}
	}
	
	// Custom Meta boxes init
	if( file_exists( $extension_path . 'custom-metaboxes/init.php' ) ) require_once( $extension_path . 'custom-metaboxes/init.php' );


/**
 * Require all classes of Widgets
 */
    // Directory of widgets
    $pathWidgets = array( TEMPLATEPATH . '/inc/widgets/' );
    foreach( $pathWidgets as $widgets ){

        $classes = glob( $widgets . '*.php' );
        foreach( $classes as $class ){
            if( file_exists( $class ) ) require_once( $class );
        }
    }    

// Widgets ignition
	add_action( 'widgets_init', 'registerCustomWidgets' );
	function registerCustomWidgets() {
	    register_widget( 'CurrentCategory' );    
	}
?>