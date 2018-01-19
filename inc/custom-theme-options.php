<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
  To find another icons, visit: http://elusiveicons.com/icons/
 * */

if (!class_exists('Redux_Framework_sample_config')) {

	class Redux_Framework_sample_config {

		public $args		= array();
		public $sections	= array();
		public $theme;
		public $ReduxFramework;

		public function __construct() {

			if (!class_exists('ReduxFramework')) {
				return;
			}

			// This is needed. Bah WordPress bugs.  ;)
			if (  true == Redux_Helpers::isTheme(__FILE__) ) {
				$this->initSettings();
			} else {
				add_action('plugins_loaded', array($this, 'initSettings'), 10);
			}

		}

		public function initSettings() {

			// Just for demo purposes. Not needed per say.
			$this->theme = wp_get_theme();

			// Set the default arguments
			$this->setArguments();

			// Set a few help tabs so you can see how it's done
			$this->setHelpTabs();

			// Create the sections and fields
			$this->setSections();

			if (!isset($this->args['opt_name'])) { // No errors please
				return;
			}
			$this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
		}

		/**

		  This is a test function that will let you see when the compiler hook occurs.
		  It only runs if a field	set with compiler=>true is changed.

		 * */
		function compiler_action($options, $css, $changed_values) {
			echo '<h1>The compiler hook has run!</h1>';
			echo "<pre>";
			print_r($changed_values); // Values that have changed since the last save
			echo "</pre>";
		}

		/**

		  Custom function for filtering the sections array. Good for child themes to override or add to the sections.
		  Simply include this function in the child themes functions.php file.

		  NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
		  so you must use get_template_directory_uri() if you want to use any of the built in icons

		 * */
		function dynamic_section($sections) {
			//$sections = array();
			$sections[] = array(
				'title' => __('Section via hook', 'redux-framework-demo'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
				'icon' => 'el-icon-paper-clip',
				// Leave this as a blank section, no options just some intro text set above.
				'fields' => array()
			);

			return $sections;
		}

		/**

		  Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

		 * */
		function change_arguments($args) {
			//$args['dev_mode'] = true;

			return $args;
		}

		/**

		  Filter hook for filtering the default value of any given field. Very useful in development mode.

		 * */
		function change_defaults($defaults) {
			$defaults['str_replace'] = 'Testing filter hook!';

			return $defaults;
		}

		// Remove the demo link and the notice of integrated demo from the redux-framework plugin
		function remove_demo() {

			// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
			if (class_exists('ReduxFrameworkPlugin')) {
				remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

				// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
				remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
			}
		}

		public function setSections() {

			/**
			  Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
			 * */
			// Background Patterns Reader
			$sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
			$sample_patterns_url	= ReduxFramework::$_url . '../sample/patterns/';
			$sample_patterns		= array();

			if (is_dir($sample_patterns_path)) :

				if ($sample_patterns_dir = opendir($sample_patterns_path)) :
					$sample_patterns = array();

					while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

						if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
							$name = explode('.', $sample_patterns_file);
							$name = str_replace('.' . end($name), '', $sample_patterns_file);
							$sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
						}
					}
				endif;
			endif;

			ob_start();

			$ct			 = wp_get_theme();
			$this->theme	= $ct;
			$item_name	  = $this->theme->get('Name');
			$tags		   = $this->theme->Tags;
			$screenshot	 = $this->theme->get_screenshot();
			$class		  = $screenshot ? 'has-screenshot' : '';

			$customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
			
			?>
			<div id="current-theme" class="<?php echo esc_attr($class); ?>">
			<?php if ($screenshot) : ?>
				<?php if (current_user_can('edit_theme_options')) : ?>
						<a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
							<img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
						</a>
				<?php endif; ?>
					<img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
				<?php endif; ?>

				<h4><?php echo $this->theme->display('Name'); ?></h4>

				<div>
					<ul class="theme-info">
						<li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
						<li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
						<li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
					</ul>
					<p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
			<?php
			if ($this->theme->parent()) {
				printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
			} 
			?>
				</div>
			</div>

			<?php
			$item_info = ob_get_contents();

			ob_end_clean();

			$sampleHTML = '';
			if (file_exists(dirname(__FILE__) . '/info-html.html')) {
				Redux_Functions::initWpFilesystem();
				
				global $wp_filesystem;

				$sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
			}

			/*
			********************************************
			**************** THEME PANELS **************
			********************************************
			*/

			// Theme prefix
			global $themePrefix;

			// Home
			$this->sections[] = array(
				'title'		=> 'Home',
				'heading' 	=> 'Use this section to configure your home page.',
				'icon'    	=> 'el-icon-home',
				'subsection'=> false,
				'fields'	=> array(

					array( // Background
						'id'		=> $themePrefix . 'homeBG',
						'type'		=> 'media',
						'title'		=> 'Background image',
						'subtitle'	=> 'Pick an image to be your background. If you leave blank, your background will be white.',
					),
				),
			);
				// Home top ads
				$this->sections[] = array(
					'title'		=> 'Ad section',
					'heading' 	=> 'Use this section to configure your home page\'s top ads.',
					'icon'    	=> 'el-icon-website',
					'subsection'=> true,
					'fields'	=> array(

						array( // 1st
							'id'		=> $themePrefix . 'adFirst',
							'type'		=> 'switch',
							'title'		=> 'First banner',
							'subtitle'	=> 'Switch on to the Ad after featured post.',
						),

						array( // Right side ad
							'id'		=> $themePrefix . 'adRightFirst',
							'type'		=> 'text',
							'title'		=> 'Right side ad',
							'subtitle'	=> 'At the right side from main featured post.',
							'desc'		=> 'Use the Ad Inserter Shortcode'
						),
					),
				);

				// Posts
				$this->sections[] = array(
					'title'		=> 'Posts',
					'heading' 	=> 'Use this section to configure your posts.',
					'icon'    	=> 'el-icon-star',
					'subsection'=> true,
					'fields'	=> array(

						array( // Post limit
							'id'		=> $themePrefix . 'postLimit',
							'type'		=> 'slider',
							'title'		=> 'Limit posts at Home.',
							'default'	=> 18,
							'min'		=> 0,
							'max'		=> 120,
							'step'		=> 3,
						),
						array( // Share label
							'id'		=> $themePrefix . 'shareLabel',
							'type'		=> 'text',
							'title'		=> 'Share label',
							'subtitle'	=> 'Text label that appears before every post share buttons'
						),
					),
				);

				// Breaking
				$this->sections[] = array(
					'title'		=> 'Breaking',
					'heading' 	=> 'Use this section to configure your breaking bar.',
					'icon'    	=> 'el-icon-star',
					'subsection'=> true,
					'fields'	=> array(

						array( // Background
							'id'		=> $themePrefix . 'breakingBarTitle',
							'type'		=> 'text',
							'title'		=> 'Breaking title'
						),
					),
				);

			// Post
			$this->sections[] = array(
				'title'		=> 'Posts',
				'heading' 	=> 'Use this section to configure your posts field.',
				'icon'    	=> 'el-icon-folder',
				'subsection'=> false,
				'fields'	=> array(

					array( // Limit words in archive
						'id'		=> $themePrefix . 'postWordsLimit',
						'type'		=> 'slider',
						'title'		=> 'Limit words by post at archive\'s page.',
						'default'	=> 35,
						'min'		=> 5,
						'max'		=> 100,
						'step'		=> 1,
					),

					array( // Search field placeholder
						'id'		=> $themePrefix . 'postAdScriptTaboola',
						'type'		=> 'textarea',
						'title'		=> 'Custom ad script to load in specific posts',
						'subtitle'	=> 'This code will only load in posts that has Taboola as page template.'
					),
				),
			);

			// Search
			$this->sections[] = array(
				'title'		=> 'Search',
				'heading' 	=> 'Use this section to configure your search field.',
				'icon'    	=> 'el-icon-search',
				'subsection'=> false,
				'fields'	=> array(

					array( // Search field placeholder
						'id'		=> $themePrefix . 'searchPlaceholder',
						'type'		=> 'text',
						'title'		=> 'Field placeholder',
						'subtitle'	=> 'Inform the field placeholder.'
					),
				),
			);

			// 404
			$this->sections[] = array(
				'title'		=> '404',
				'heading' 	=> 'Use this section to configure your 404 page.',
				'icon'    	=> 'el-icon-hand-up',
				'subsection'=> false,
				'fields'	=> array(

					array( // Title
						'id'		=> $themePrefix . '404Title',
						'type'		=> 'text',
						'title'		=> 'Page title'
					),
					array( // Content
						'id'		=> $themePrefix . '404Content',
						'type'		=> 'editor',
						'title'		=> 'Page content'
					),
					array( // Button label
						'id'		=> $themePrefix . '404BtnLabel',
						'type'		=> 'text',
						'title'		=> 'Button label'
					),
				),
			);

			// Ads
			$this->sections[] = array(
				'title'		=> 'Ads',
				'heading' 	=> 'Use this section to configure your Ads.',
				'icon'    	=> 'el-icon-hand-up',
				'subsection'=> false,
				'fields'	=> array(

					array( // Main ad script
						'id'		=> $themePrefix . 'ad_mainScript',
						'type'		=> 'textarea',
						'title'		=> 'Header',
						'desc'		=> 'This code will be loaded at the main site header in all the pages/posts'
					),

					array( // Below the article
						'id'		=> $themePrefix . 'ad_taboolaBelowArticle',
						'type'		=> 'textarea',
						'title'		=> 'Taboola script tag to load below the article'
					),

					array( // Outbrain code
						'id'		=> $themePrefix . 'ad_OutbrainBelowArticle',
						'type'		=> 'textarea',
						'title'		=> 'Outbrain script tag to load below the article',
					),

					array( // At the end of body
						'id'		=> $themePrefix . 'ad_bodyEnds',
						'type'		=> 'textarea',
						'title'		=> 'Footer',
						'desc'		=> 'This code will be loaded at the main site footer in all the pages/posts'
					),

				),
			);

			// Social networks
			$this->sections[] = array(
				'title'		=> 'Social networks',
				'heading' 	=> 'Use this section to configure your Social networks.',
				'icon'		=> 'el-icon-network',
				'subsection'=> false,
				'fields'	=> array(

					array( // Stores block
						'id'			=> $themePrefix . 'socialNetworks',
						'type'			=> 'slides',
						'title'			=> 'Click in "+" to add',
						'desc'			=> 'This setting uses FontAwesome icons, so take a look at http://fontawesome.io/icons/ and see which icons you can choose.',
						'placeholder'	=> array(
							'description'	=> 'Icon tag.',
						),
					),
				),
			);

			// Contact
			$this->sections[] = array(
				'title'		=> 'Contact',
				'heading' 	=> 'Use this section to configure the contact page.',
				'icon'		=> 'el-icon-laptop',
				'subsection'=> false,
				'fields'	=> array(

					array( // Subject
						'id'			=> $themePrefix . 'contactSubject',
						'type'			=> 'text',
						'title'			=> 'Email subject',
						'subtitle'		=> 'How will be the email subject to the customers',
					),

					array( // Email receptors
						'id'			=> $themePrefix . 'contactEmailReceivers',
						'type'			=> 'multi_text',
						'title'			=> 'People that will receive the messages sent by contact form',
						'desc'			=> 'If there\'s any email here, the main admin will receive the messages.',
						'validate'		=> 'email'
					),

					array( // Email Thanks
						'id'			=> $themePrefix . 'contactThanks',
						'type'			=> 'textarea',
						'title'			=> 'Thanks email',
						'subtitle'		=> 'Thank you email content'
					),
				),
			);

			// Footer
			$this->sections[] = array(
				'title'		=> 'Footer',
				'heading' 	=> 'Use this section to configure the site\'s footer.',
				'icon'    	=> 'el-icon-hand-down',
				'subsection'=> false,
				'fields'	=> array(
					array( // Copright
						'id'		=> $themePrefix . 'copright',
						'type'		=> 'text',
						'title'		=> 'Copright',
						'desc'		=> 'Copright text.'
					),
					array( // Privacy
						'id'		=> $themePrefix . 'analyticsCode',
						'type'		=> 'textarea',
						'title'		=> 'Google Analytics\'s script',
						'desc'		=> 'Insert here your script tag from Google Analytics'
					),
				),
			);


			/************ END THEME PANELS **************/

			if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
				$tabs['docs'] = array(
					'icon'	  => 'el-icon-book',
					'title'	 => __('Documentation', 'redux-framework-demo'),
					'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
				);
			}
		}

		public function setHelpTabs() {

			// Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			$this->args['help_tabs'][] = array(
				'id'		=> 'redux-help-tab-1',
				'title'	 => __('Theme Information 1', 'redux-framework-demo'),
				'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
			);

			$this->args['help_tabs'][] = array(
				'id'		=> 'redux-help-tab-2',
				'title'	 => __('Theme Information 2', 'redux-framework-demo'),
				'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
			);

			// Set the help sidebar
			$this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
		}

		/**

		  All the possible arguments for Redux.
		  For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 * */
		public function setArguments() {

			$theme = wp_get_theme();

			$this->args = array(
				
				'opt_name'		  	=> 'redux_options',			// This is where your data is stored in the database and also becomes your global variable name.
				'display_name'	  	=> $theme->get('Name'),	 // Name that appears at the top of your panel
				'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
				'menu_type'		 	=> 'menu',				  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'	=> true,					// Show the sections below the admin menu item or not
				'menu_title'		=> __('Theme options', 'redux-framework-demo'),
				'page_title'		=> __('Theme options', 'redux-framework-demo'),
				
				// You will need to generate a Google API key to use this feature.
				// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
				'google_api_key' 	=> '', // Must be defined to add google fonts to the typography module
				'async_typography'  => true,					// Use a asynchronous font on the front end or font string
				'admin_bar'		 	=> true,					// Show the panel pages on the admin bar
				'global_variable'   => '',					  // Set a different name for your global variable other than the opt_name
				'dev_mode'		  	=> false,					// Show the time the page took to load, etc
				'customizer'		=> true,					// Enable basic customizer support
				//'open_expanded'	=> true,					// Allow you to start the panel in an expanded way initially.
				//'disable_save_warn' => true,					// Disable the save warning when a user changes a field

				// OPTIONAL -> Give you extra features
				'page_priority'	 	=> null,					// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
				'page_parent'	   	=> 'themes.php',			// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
				'page_permissions' 	=> 'manage_options',		// Permissions needed to access the options panel.
				'menu_icon'		 	=> '',					  // Specify a custom URL to an icon
				'last_tab'		  	=> '',					  // Force your panel to always open to a specific tab (by id)
				'page_icon'		 	=> 'icon-themes',		   // Icon displayed in the admin panel next to your menu_title
				'page_slug'		 	=> '_options',			  // Page slug used to denote the panel
				'save_defaults'	 	=> true,					// On load save the defaults to DB before user clicks save or not
				'default_show'	  	=> false,				   // If true, shows the default value next to each field that is not the default value.
				'default_mark'	  	=> '',					  // What to print by the field's title if the value shown is default. Suggested: *
				'show_import_export' => true,				   // Shows the Import/Export panel when not used as a field.
				
				// CAREFUL -> These options are for advanced use only
				'transient_time'	=> 60 * MINUTE_IN_SECONDS,
				'output'			=> true,					// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
				'output_tag'		=> true,					// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
				// 'footer_credit'	 => '',				   // Disable the footer credit of Redux. Please leave if you can help it.
				
				// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
				'database'			  => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
				'system_info'		   => false, // REMOVE

				// HINTS
				'hints' => array(
					'icon'		  => 'icon-question-sign',
					'icon_position' => 'right',
					'icon_color'	=> 'lightgray',
					'icon_size'	 => 'normal',
					'tip_style'	 => array(
						'color'		 => 'light',
						'shadow'		=> true,
						'rounded'	   => false,
						'style'		 => '',
					),
					'tip_position'  => array(
						'my' => 'top left',
						'at' => 'bottom right',
					),
					'tip_effect'	=> array(
						'show'		  => array(
							'effect'		=> 'slide',
							'duration'	  => '500',
							'event'		 => 'mouseover',
						),
						'hide'	  => array(
							'effect'	=> 'slide',
							'duration'  => '500',
							'event'	 => 'click mouseleave',
						),
					),
				)
			);


			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
			$this->args['share_icons'][] = array(
				'url'   => 'https://github.com/vhenrique.',
				'title' => 'Visit me on GitHub',
				'icon'  => 'el-icon-github'
			);
			$this->args['share_icons'][] = array(
				'url'   => 'https://www.facebook.com/vhenrique.vhs',
				'title' => 'Visite me on Facebook',
				'icon'  => 'el-icon-facebook'
			);
			$this->args['share_icons'][] = array(
				'url'   => 'https://www.linkedin.com/in/vhenriquevhs',
				'title' => 'Find me on LinkedIn',
				'icon'  => 'el-icon-linkedin'
			);

			// Panel Intro text -> before the form
			if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
				if (!empty($this->args['global_variable'])) {
					$v = $this->args['global_variable'];
				} else {
					$v = str_replace('-', '_', $this->args['opt_name']);
				}
				
			} else {
				$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
			}
		}

	}
	
	global $reduxConfig;
	$reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
	function redux_my_custom_field($field, $value) {
		print_r($field);
		echo '<br/>';
		// print_r($value);
	}
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
	function redux_validate_callback_function($field, $value, $existing_value) {
		$error = false;
		$value = 'just testing';

		/*
		  do your validation

		  if(something) {
			$value = $value;
		  } elseif(something else) {
			$error = true;
			$value = $existing_value;
			$field['msg'] = 'your custom error message';
		  }
		 */

		$return['value'] = $value;
		if ($error == true) {
			$return['error'] = $field;
		}
		return $return;
	}
endif;
