		<footer id="site-footer" class="col-md-12 col-sm-12 col-xs-12">
			<section class="container">
				<?php
					global $redux_options, $themePrefix;

					echo '<div class="col-md-12 col-sm-12 col-xs-12">';
						// Main menu
						wp_nav_menu( array(
								'menu'				=> 'footer',
								'theme_location'	=> 'footer',
								'menu_class'		=> 'hover-menu text-center mOffsetSmall',
								'container'			=> 'nav',
								'container_id'		=> 'footer-menu'
							)
						);
					echo '</div>';

					// Social Networks
					echo '<div class="col-md-12 col-sm-12 col-xs-12">';
						if( isset($redux_options[$themePrefix . 'socialNetworks']) && ! empty($redux_options[$themePrefix . 'socialNetworks']) ){
							echo '<ul id="social" class="text-center">';
							foreach($redux_options[$themePrefix . 'socialNetworks'] as $social){
								echo '<li>';
									echo '<a href="' . $social['url'] . '" title="' . $social['title'] . '" target="_BLANK">' . $social['description'] . '</a>';
								echo '</li>';
							}
							echo '</ul>';
						}
					echo '</div>';
				?>

				<div class="col-md-12 col-sm-12 col-xs-12 text-center">
					<?php
						echo '<span>';

							// Copright
							if( isset($redux_options[$themePrefix . 'copright']) ){
								echo $redux_options[$themePrefix . 'copright'] . ' ' . date('Y') . ' ' . get_option('blogname');
							}
						echo '</span>';

						// Main menu
						wp_nav_menu( array(
								'menu'				=> 'terms',
								'theme_location'	=> 'terms',
								'menu_class'		=> 'hover-menu text-center',
								'container'			=> 'nav',
								'container_id'		=> 'terms-menu'
							)
						);
						?>
				</div>
			</section>
	    </footer>
	    <?php 
	    	wp_footer();

	    	// Ad script
	    	if( isset($redux_options[$themePrefix . 'ad_bodyEnds']) ){
				echo $redux_options[$themePrefix . 'ad_bodyEnds'];
			}

			if( isset($redux_options[$themePrefix . 'analyticsCode']) && ! empty($redux_options[$themePrefix . 'analyticsCode']) ){
				echo $redux_options[$themePrefix . 'analyticsCode'];
			}
	    ?>
	</body>
</html>