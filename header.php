<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">

	<?php 

	global $redux_options, $themePrefix;

	// Show meta tag from current page
	custom_page_metaTag();

	// Make page title
	echo '<title>';
		echo wp_title( ' | ', true, 'right' ); 
	echo '</title>';
	?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if(is_singular() && comments_open() && get_option('thread_comments')){
		wp_enqueue_script('comment-reply');
	}

	// Loads the main script of the Ads
	if (function_exists ('adinserter')) echo adinserter (16);
	if( isset($redux_options[$themePrefix . 'ad_mainScript']) ){
		echo $redux_options[$themePrefix . 'ad_mainScript'];
	}

	wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header id="site-header" class="col-md-12 col-sm-12 col-xs-12">
		<div class="container">
			<div class="col-md-4 col-sm-6 col-xs-6 text-center">
				<?php 

					// Site logo
					if ( function_exists( 'the_custom_logo' ) ) {
						the_custom_logo();
					}
				?>
			</div>

			<div class="col-md-8 col-sm-6 col-xs-6">
				<?php
					// Main menu
					echo '<nav id="main-menu">';
						echo '<a href="javascript:void(0);" class="showMenu"><i class="fa fa-bars" aria-hidden="true"></i></a>';
						wp_nav_menu( array(								
								'theme_location'	=> 'main',
								'menu_class'		=> 'hover-menu text-center pull-right',
								'container'			=> ''
							)
						);
					echo '</nav>';
				?>
			</div>
       </div>
    </header>