<?php 

/**
* Not found page template
*/
get_header();
	
	global $redux_options, $themePrefix;

	echo '<main class="container">';
		echo '<section class="col-md-12 col-sm-12 col-xs-12">';

				get_breadcrumbs();

				// Title
				if( isset( $redux_options[$themePrefix . '404Title'] ) ) {
					printf( '<h1 class="post-title">%s</h1>',
						$redux_options[$themePrefix . '404Title']	
					);
				}

				echo '<div class="post-content">';

					// Content
					if( isset( $redux_options[$themePrefix . '404Content'] ) ) {
						printf( '<article>%s</article>',
							$redux_options[$themePrefix . '404Content']	
						);
					}

					// Button
					if( isset( $redux_options[$themePrefix . '404BtnLabel'] ) ) {
						printf( '<a href="%s" class="btn mOffsetSmall">%s</a>',
							get_home_url(),
							$redux_options[$themePrefix . '404BtnLabel']	
						);
					}
					
				echo '</div>';
			echo '</section>';
	echo '</main>';
	
get_footer(); ?>