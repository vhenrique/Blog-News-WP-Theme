<?php 
/**
 * Template name: Contact
 */

get_header();
	
	global $redux_options, $themePrefix;

	echo '<main class="container">';
		if( have_posts() ){
			echo '<section class="col-md-12 col-sm-12 col-xs-12">';
				while( have_posts() ){
					the_post();

					get_breadcrumbs();

					echo '<h1 class="post-title">' . get_the_title() . '</h1>';

					echo '<div class="post-content">';
						echo get_the_post_thumbnail(get_the_id(), $themePrefix . 'singlePostthumbnail', array(
								'class'		=> 'img-center',
								'title'		=> get_the_title(),
								'alt'		=> get_the_excerpt()
							)
						);

						echo '<article>';
							the_content();
						echo '</article>';

						get_template_part( 'template-parts/page/contact', 'form' );


						if( isset($redux_options[$themePrefix . 'ad_belowArticle']) ){
							echo $redux_options[$themePrefix . 'ad_belowArticle'];
						}
						
					echo '</div>';
				}
			echo '</section>';
		}

	echo '</main>';
	
get_footer(); ?>