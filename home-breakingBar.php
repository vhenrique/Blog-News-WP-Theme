<?php
/**
 * Breaking bar
 * It appears at home page
 *
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 */

	global $redux_options, $themePrefix;	
	echo '<section id="breaking-bar" class="row">';
		if( isset($redux_options[$themePrefix . 'breakingBarTitle']) ){
			echo '<div class="col-md-4 col-sm-5 col-xs-4">';
				echo '<h2 class="breaking-title">' . $redux_options[$themePrefix . 'breakingBarTitle'] . '</h2>';
			echo '</div>';
		}

		$breakings = get_posts(array(
				'post_type'			=> 'post',
				'posts_per_page'	=> 1,
				'meta_key'			=> $themePrefix . 'breaking',
				'meta_value'		=> 'on'
			)
		);

		if( ! empty($breakings) ){
			foreach($breakings as $breaking){
				echo '<div class="col-md-8 col-sm-7 col-xs-8">';
					echo '<a href="' . get_permalink($breaking->ID) . '"><h2>' . $breaking->post_title . '</h2></a>';
				echo '</div>';
			}
		}
	echo '</section>';

?>