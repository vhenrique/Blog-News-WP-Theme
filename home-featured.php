<?php 
	
	global $redux_options, $themePrefix;

	echo '<section id="featured" class="container pOffsetSmall">';
		$highlights = get_posts(array(
				'post_type'			=> 'post',
				'posts_per_page'	=> 3,
				'meta_key'			=> $themePrefix . 'featured',
				'meta_value'		=> 'on'
			)
		);

		if( ! empty($highlights) ){
			foreach( $highlights as $key =>  $highlight ){
				if( $key == 0 ){
					echo '<div class="col-md-9 col-sm-12 col-xs-12 post-box big">';
						echo '<div class="post-content">';
							// echo get_post_meta($highlight->ID, $themePrefix . 'featured', true);
							echo '<a href="' . get_permalink($highlight->ID) . '" title="' . $highlight->post_title . '" alt="' . $highlight->post_excerpt . '">';
								echo get_the_post_thumbnail($highlight->ID, $themePrefix . 'featuredPost', array(
										'class'		=> 'img-center full'
									)
								);
							echo '</a>';

							// Share button
							echo '<a href="javascript:void(0);" class="showShare"><i class="fa fa-share-square-o" aria-hidden="true"></i></a>';
							echo '<div class="shareContent col-md-12 col-sm-12 col-xs-12">';
								echo '<a href="javascript:void(0);" class="closeShare pull-right"><i class="fa fa-times" aria-hidden="true"></i></a>';
								echo '<div class="vertical-center">';
									echo '<div class="vertical">';
										if( isset($redux_options[$themePrefix . 'shareLabel']) ){
											echo '<h2 class="text-center">' . $redux_options[$themePrefix . 'shareLabel'] . '</h2>';
										}
										$shareButtons = get_shareButtons($highlight->ID, 'home');
										echo '<ul id="social" class="text-center">';
											foreach($shareButtons as $button){
												echo '<li>' . $button . '</li>';
											}
										echo '</ul>';
									echo '</div>';
								echo '</div>';
							echo '</div>';


							$primaryTerm = getPrimaryTerm($highlight->ID);
							if(! empty($primaryTerm)){
								echo '<a href="' . $primaryTerm['url'] . '" class="primary-tax dark">' . $primaryTerm['name'] . '</a>';
							}

							echo '<div class="post-title">';
								echo '<h3>Feature</h3>';
								echo '<h1>';
									echo '<a href="' . get_permalink($highlight->ID) . '" title="' . $highlight->post_title . '" alt="' . $highlight->post_excerpt . '">';
										echo $highlight->post_title;
									echo '</a>';
								echo '</h1>';
							echo '</div>';
						echo '</div>';

						// Ad space
						if( isset($redux_options[$themePrefix . 'adFirst']) ){
							echo '<div class="mOffsetSmall">';
								bae_adsense();
							echo '</div>';
						}
					echo '</div>';
				}
				else{
					echo '<div class="col-md-3 col-sm-6 col-xs-6 post-box">';
						echo '<div class="post-content">';
							echo '<a href="' . get_permalink($highlight->ID) . '" title="' . $highlight->post_title . '" alt="' . $highlight->post_excerpt . '">';
								echo get_the_post_thumbnail($highlight->ID, $themePrefix . 'featuredPostSmall', array(
										'class'		=> 'img-center full'
									)
								);
							echo '</a>';

							// Share button
							echo '<a href="javascript:void(0);" class="showShare"><i class="fa fa-share-square-o" aria-hidden="true"></i></a>';
							echo '<div class="shareContent col-md-12 col-sm-12 col-xs-12">';
								echo '<a href="javascript:void(0);" class="closeShare pull-right"><i class="fa fa-times" aria-hidden="true"></i></a>';
								echo '<div class="vertical-center">';
									echo '<div class="vertical">';
										if( isset($redux_options[$themePrefix . 'shareLabel']) ){
											echo '<h2 class="text-center">' . $redux_options[$themePrefix . 'shareLabel'] . '</h2>';
										}
										$shareButtons = get_shareButtons($highlight->ID, 'home');
										echo '<ul id="social" class="text-center">';
											foreach($shareButtons as $button){
												echo '<li>' . $button . '</li>';
											}
										echo '</ul>';
									echo '</div>';
								echo '</div>';
							echo '</div>';

							$primaryTerm = getPrimaryTerm($highlight->ID);
							if(! empty($primaryTerm)){
								echo '<a href="' . $primaryTerm['url'] . '" class="primary-tax dark">' . $primaryTerm['name'] . '</a>';
							}

							echo '<a href="' . get_permalink($highlight->ID) . '" title="' . $highlight->post_title . '" alt="' . $highlight->post_excerpt . '" class="post-title"><h3>' . $highlight->post_title . '</h3></a>';
						echo '</div>';		
					echo '</div>';
				}
			}

			// Ad space
			echo '<div class="col-md-3 col-sm-4 col-xs-12">';

			if( isset($redux_options[$themePrefix . 'adRightFirst']) && ! empty($redux_options[$themePrefix . 'adRightFirst']) ){
				echo do_shortcode($redux_options[$themePrefix . 'adRightFirst']);
			}
			echo '</div>';
		}
	echo '</section>';
?>