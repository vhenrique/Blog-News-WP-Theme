<?php
	
	/**
	 * Custom column to default post type
	 */
		
		add_filter('manage_posts_columns' , 'customColumnPosts');
		function customColumnPosts( $columns ) {

			// New columns to add to table
		  	$new_columns = array(
				'custom_template' => 'Template',
		  	);
		  
		  	// Combine existing columns with new columns
		  	$filtered_columns = array_merge( $columns, $new_columns );

		  	// Return our filtered array of columns
		  	return $filtered_columns;
		}

		add_action( 'manage_posts_custom_column', 'customColumnPostsContent' );
		function customColumnPostsContent( $column ) {  
		  	global $post;
		  
		  	// Check to see if $column matches our custom column names
		  	switch ( $column ) {

			    case 'custom_template' :
			      	echo get_page_template_slug( $post->ID ) ? str_replace( '.php', '', ucfirst( basename( get_page_template_slug( $post->ID ) ) ) ) : 'Default';
			    break;
		  	}
		}

		function customColumnPostsSortable( $columns ) {
		    // Add our columns to $columns array
		    $columns['custom_template'] = 'custom_template';
		    return $columns;
		}

		// Let WordPress know to use our filter
		add_filter( 'manage_edit-post_sortable_columns', 'customColumnPostsSortable' );



	
	/**
	 * Remove width and height from images content
	 */
	add_filter( 'the_content', 'the_content_filter', 20 );

	function the_content_filter( $content ) {
	    $content = preg_replace('#<figure.*?>(.*?)</figure>#i', '<figure>\1</figure>', $content);
	    $content = preg_replace('#<img.*?>(.*?)</img>#i', '<img>\1</img>', $content);
	    return $content;
	}
	/**
	 * Include a default image class from bootstrap in the WordPress's the_content()
	 */
	function add_image_responsive_class($content) {
	   global $post;
	   $pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
	   $replacement = '<img$1class="$2 img-responsive"$3>';
	   $content = preg_replace($pattern, $replacement, $content);
	   return $content;
	}
	add_filter('the_content', 'add_image_responsive_class');

// Custom search form (Used by Widget)
	add_filter('get_search_form', 'vhs_searchForm');
	function vhs_searchForm( $form ) {
		global $redux_options, $themePrefix;

	    $form = '<form role="search" method="get" class="searchForm" action="' . home_url( '/' ) . '" >';
	    	$form .= '<div class="form-group">';

	    		if( isset($redux_options[$themePrefix . 'searchPlaceholder']) && ! empty($redux_options[$themePrefix . 'searchPlaceholder']) ){
	    			$placeholder = $redux_options[$themePrefix . 'searchPlaceholder'];
	    		}
	    		else {
	    			$placeholder = 'Search';
	    		}

	    		$form .= '<input type="text" value="' . get_search_query() . '" name="s" class="searchField form-control" placeholder="' . $placeholder . '" required="required" />';
	    		$form .= '<button type="submit" class="searchSubmit"><i class="fa fa-search" aria-hidden="true"></i><button>';
	    	$form .= '</div>';
	    $form .= '</form>';

	    return $form;
	}

// Remove junk from head
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'feed_links', 2);
	remove_action('wp_head', 'index_rel_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'feed_links_extra', 3);
	remove_action('wp_head', 'start_post_rel_link', 10, 0);
	remove_action('wp_head', 'parent_post_rel_link', 10, 0);
	remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// Remove the WP version from the header
	add_filter('the_generator', 'vhs_remove_wp_version');
	function vhs_remove_wp_version(){
		return '';
	}

// Add a class to the navigation buttons
	add_filter('next_posts_link_attributes', 'vhs_posts_link_attributes');
	add_filter('previous_posts_link_attributes', 'vhs_posts_link_attributes');
	function vhs_posts_link_attributes(){
		return 'class="nav-links"';
	}


// WP Login
	add_action( 'login_enqueue_scripts', 'vhs_wp_login' );
	function vhs_wp_login() {
		global $redux_options, $themePrefix;

		$logo = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src($logo, 'full');
		
		echo '<style type="text/css">';
			echo 'body.login #login{
				padding: 2% 0 0; }';
			echo 'body.login h1 a{
				background-image: url(' . $image[0] . ');
				background-repeat:no-repeat; 
				background-size: 100%;
				min-width: 300px; }';
			echo 'body.login form{
				background:#434343; }';
			echo 'body.login form input{
				color:#999; }';
			echo 'body.login form p label{
				color:#FFF; }';

			echo 'body.login p#nav, body.login p#backtoblog{
				background-color: #434343; 
				margin: 0px; 
				padding: 10px 13px; 
				text-align: center; }';
			echo 'body.login p#nav a, body.login p#backtoblog a{
				color: #FFF; }';

			echo 'body.login div#login::after{
				content:"Developped by vhenrique.com"; 
				color: #434343; }';
			echo 'body.login div#login::after{
				background-image: url(' . TEMPLATEURL . '/assets/img/screenshot.png); 
				background-repeat:no-repeat; 
				background-size: 50%; 
				background-position: 50%; 
				height: 200px; 
				display: block; 
				text-align: center; 
				margin: 20px 0; }';
			
		echo '</style>';        
	}

// Admin footer info
	function admin_footer(){
		echo '<div id="wpfooter" role="contentinfo">';
		echo sprintf('<p id="footer-left" class="alignleft"><span id="footer-thankyou">Theme developped by <a href="%s" title="%s" target="_BLANK">vhenrique</a>. Thanks for use!</span></p>', 'http://vhenrique.com', 'Vhenrique portfolio.');
		echo sprintf('<p id="footer-upgrade" class="alignright"><a href="%s" title="%s"><img src="%s" width="50px"/></a></p>', 'http://vhenrique.com', 'Vhenrique portfolio.', TEMPLATEURL.'/assets/img/screenshot.png');
		echo '<div class="clear"></div></div>';
	}
	add_action( 'admin_footer', 'admin_footer' );
	add_filter( 'update_footer', '__return_empty_string', 11 );
?>