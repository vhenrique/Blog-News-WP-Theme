<?php
	global $redux_options, $themePrefix;

	if( isset($redux_options[$themePrefix . 'homeBG']) && ! empty($redux_options[$themePrefix . 'homeBG']) ){
		echo '<main id="home" class="col-ms-12 col-sm-12 col-xs-12" style="background: url(' . $redux_options[$themePrefix . 'homeBG']['url'] . '); background-size: 100%; background-repeat: repeat-y;">';
	}
	else {
		echo '<main id="home" class="col-ms-12 col-sm-12 col-xs-12" style="background-color: #FFF;">';
	}
	
		echo '<section class="container">';
			if( isset($redux_options[$themePrefix . 'postLimit']) ){
				$postLimit = $redux_options[$themePrefix . 'postLimit'];
			}
			else{
				$postLimit = 18;
			}

			$blogPosts = get_posts(array(
					'post_type'			=> 'post', 
					'posts_per_page'	=> $postLimit,
					'meta_key'			=> $themePrefix . 'featured',
					'meta_value'		=> 'off'
				)
			);

			if( ! empty($blogPosts )){

				for($i = 0; $i < count($blogPosts); $i += 3){					

					if( $i % 6 == 0 || $i == 0 ){
						echo '<div class="col-md-6 col-sm-6 col-xs-12">';

							// Highlighted post
							echo '<div class="col-md-12 col-sm-12 col-xs-12 post-box big">';
								echo '<div class="post-content">';
									echo '<a href="' . get_permalink($blogPosts[$i]->ID) . '" title="' . $blogPosts[$i]->post_title . '" alt="' . $blogPosts[$i]->post_excerpt . '">';
										echo get_the_post_thumbnail($blogPosts[$i]->ID, $themePrefix . 'homeListBig', array(
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
												$shareButtons = get_shareButtons($blogPosts[$i]->ID, 'home');
												echo '<ul id="social" class="text-center">';
													foreach($shareButtons as $button){
														echo '<li>' . $button . '</li>';
													}
												echo '</ul>';
											echo '</div>';
										echo '</div>';
									echo '</div>';

									$primaryTerm = getPrimaryTerm($blogPosts[$i]->ID);
									if(! empty($primaryTerm)){
										echo '<a href="' . $primaryTerm['url'] . '" class="primary-tax">' . $primaryTerm['name'] . '</a>';
									}
									echo '<div class="post-title">';
										echo '<h1>';
											echo '<a href="' . get_permalink($blogPosts[$i]->ID) . '" title="' . $blogPosts[$i]->post_title . '" alt="' . $blogPosts[$i]->post_excerpt . '">';
												echo $blogPosts[$i]->post_title;
											echo '</a>';
										echo '</h1>';
									echo '</div>';
								echo '</div>';
							echo '</div>';

							// Increment counter to the next 2 posts
							$n = $i + 1;

							// Secondary
							echo '<div class="col-md-6 col-sm-6 col-xs-12 post-box">';
								echo '<div class="post-content">';
									echo '<a href="' . get_permalink($blogPosts[$n]->ID) . '" title="' . $blogPosts[$n]->post_title . '" alt="' . $blogPosts[$n]->post_excerpt . '" class="img-container">';
										echo get_the_post_thumbnail($blogPosts[$n]->ID, $themePrefix . 'homeListSmall', array(
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
												$shareButtons = get_shareButtons($blogPosts[$n]->ID, 'home');
												echo '<ul id="social" class="text-center">';
													foreach($shareButtons as $button){
														echo '<li>' . $button . '</li>';
													}
												echo '</ul>';
											echo '</div>';
										echo '</div>';
									echo '</div>';

									$primaryTerm = getPrimaryTerm($blogPosts[$n]->ID);
									if(! empty($primaryTerm)){
										echo '<a href="' . $primaryTerm['url'] . '" class="primary-tax">' . $primaryTerm['name'] . '</a>';
									}

									echo '<a href="' . get_permalink($blogPosts[$n]->ID) . '" title="' . $blogPosts[$n]->post_title . '" alt="' . $blogPosts[$n]->post_excerpt . '" class="post-title">';
										echo '<h3>' . $blogPosts[$n]->post_title . '</h3>';
									echo '</a>';
								echo '</div>';
							echo '</div>';

							$n = $i + 2;
							// Secondary
							echo '<div class="col-md-6 col-sm-6 col-xs-12 post-box">';
								echo '<div class="post-content">';
									echo '<a href="' . get_permalink($blogPosts[$n]->ID) . '" title="' . $blogPosts[$n]->post_title . '" alt="' . $blogPosts[$n]->post_excerpt . '" class="img-container">';
										echo get_the_post_thumbnail($blogPosts[$n]->ID, $themePrefix . 'homeListSmall', array(
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
												$shareButtons = get_shareButtons($blogPosts[$n]->ID, 'home');
												echo '<ul id="social" class="text-center">';
													foreach($shareButtons as $button){
														echo '<li>' . $button . '</li>';
													}
												echo '</ul>';
											echo '</div>';
										echo '</div>';
									echo '</div>';

									$primaryTerm = getPrimaryTerm($blogPosts[$n]->ID);
									if(! empty($primaryTerm)){
										echo '<a href="' . $primaryTerm['url'] . '" class="primary-tax">' . $primaryTerm['name'] .'</a>';
									}

									echo '<a href="' . get_permalink($blogPosts[$n]->ID) . '" title="' . $blogPosts[$n]->post_title . '" alt="' . $blogPosts[$n]->post_excerpt . '" class="post-title">';
										echo '<h3>' . $blogPosts[$n]->post_title . '</h3>';
									echo '</a>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					else{
						echo '<div class="col-md-6 col-sm-6 col-xs-12">';
							// Secondary
							echo '<div class="col-md-6 col-sm-6 col-xs-12 post-box">';
								echo '<div class="post-content">';
									echo '<a href="' . get_permalink($blogPosts[$i]->ID) . '" title="' . $blogPosts[$i]->post_title . '" alt="' . $blogPosts[$i]->post_excerpt . '" class="img-container">';
										echo get_the_post_thumbnail($blogPosts[$i]->ID, $themePrefix . 'homeListSmall', array(
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
												$shareButtons = get_shareButtons($blogPosts[$i]->ID, 'home');
												echo '<ul id="social" class="text-center">';
													foreach($shareButtons as $button){
														echo '<li>' . $button . '</li>';
													}
												echo '</ul>';
											echo '</div>';
										echo '</div>';
									echo '</div>';

									$primaryTerm = getPrimaryTerm($blogPosts[$i]->ID);
									if(! empty($primaryTerm)){
										echo '<a href="' . $primaryTerm['url'] . '" class="primary-tax">' . $primaryTerm['name'] . '</a>';
									}

									echo '<a href="' . get_permalink($blogPosts[$i]->ID) . '" title="' . $blogPosts[$i]->post_title . '" alt="' . $blogPosts[$i]->post_excerpt . '" class="post-title">';
										echo '<h3>' . $blogPosts[$i]->post_title . '</h3>';
									echo '</a>';
								echo '</div>';
							echo '</div>';

							// Increment counter to the next 2 posts
							$n = $i + 1;

							// Secondary
							echo '<div class="col-md-6 col-sm-6 col-xs-12 post-box">';
								echo '<div class="post-content">';

									echo '<a href="' . get_permalink($blogPosts[$n]->ID) . '" title="' . $blogPosts[$n]->post_title . '" alt="' . $blogPosts[$n]->post_excerpt . '" class="img-container">';
										echo get_the_post_thumbnail($blogPosts[$n]->ID, $themePrefix . 'homeListSmall', array(
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
												$shareButtons = get_shareButtons($blogPosts[$n]->ID, 'home');
												echo '<ul id="social" class="text-center">';
													foreach($shareButtons as $button){
														echo '<li>' . $button . '</li>';
													}
												echo '</ul>';
											echo '</div>';
										echo '</div>';
									echo '</div>';

									$primaryTerm = getPrimaryTerm($blogPosts[$n]->ID);
									if(! empty($primaryTerm)){
										echo '<a href="' . $primaryTerm['url'] . '" class="primary-tax">' . $primaryTerm['name'] . '</a>';
									}

									echo '<a href="' . get_permalink($blogPosts[$n]->ID) . '" title="' . $blogPosts[$n]->post_title . '" alt="' . $blogPosts[$n]->post_excerpt . '" class="post-title">';
										echo '<h3>' . $blogPosts[$n]->post_title . '</h3>';
									echo '</a>';
								echo '</div>';
							echo '</div>';

							$n = $i + 2;
							// Highlighted post
							echo '<div class="col-md-12 col-sm-12 col-xs-12 post-box big">';
								echo '<div class="post-content">';
									echo '<a href="' . get_permalink($blogPosts[$n]->ID) . '" title="' . $blogPosts[$n]->post_title . '" alt="' . $blogPosts[$n]->post_excerpt . '">';
										echo get_the_post_thumbnail($blogPosts[$n]->ID, $themePrefix . 'homeListBig', array(
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
												$shareButtons = get_shareButtons($blogPosts[$n]->ID, 'home');
												echo '<ul id="social" class="text-center">';
													foreach($shareButtons as $button){
														echo '<li>' . $button . '</li>';
													}
												echo '</ul>';
											echo '</div>';
										echo '</div>';
									echo '</div>';
									
									$primaryTerm = getPrimaryTerm($blogPosts[$n]->ID);
									if(! empty($primaryTerm)){
										echo '<a href="' . $primaryTerm['url'] . '" class="primary-tax">' . $primaryTerm['name'] . '</a>';
									}
									
									echo '<div class="post-title">';
										echo '<h1>';
											echo '<a href="' . get_permalink($blogPosts[$n]->ID) . '" title="' . $blogPosts[$n]->post_title . '" alt="' . $blogPosts[$n]->post_excerpt . '">';
												echo $blogPosts[$n]->post_title;
											echo '</a>';
										echo '</h1>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				}
			}
		echo '</section>';
	echo '</main>';

?>