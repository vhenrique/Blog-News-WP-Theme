<?php 
/**
 * Ramdom categories from single page
 * This template part loads posts excluding the current post baseed in categories that doesn't have parents
 *
 * @package  template-parts/page
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 * @since 	1.0
 * @version 1.0
 */
	global $themePrefix;

	$currentCats = get_the_category();
	if( ! empty($currentCats) ){
		foreach($currentCats as $currentCat){
			$exclude[] = $currentCat->term_id;
		}
	}

	echo '<div class="row">';
		$terms = get_terms( array(
				'taxonomy'		=> 'category',
				'parent'		=> '0',
				'exclude'		=> $exclude
			)
		);

		if( ! empty($terms) ){
			foreach($terms as $term){

				$blogPosts = get_posts( array(
						'post_type'			=> 'post',
						'posts_per_page'	=> 3,
						'post__not_in'		=> array( get_the_id() ),
						'category'			=> $term->term_id
					)
				);

				// Show the posts 
				if( ! empty( $blogPosts ) ){					
					echo '<div class="ramdom-category">';
						echo '<div class="col-md-12 col-sm-12 col-xs-12">';
							echo '<h3 class="category-title">' . $term->name . ':</h3>';
						echo '</div>';
						foreach( $blogPosts as $blogPost ){
							echo '<div class="post-box col-md-4 col-sm-4 col-xs-12">';
								echo '<div class="post-content">';
									echo '<a href="' . get_permalink($blogPost->ID) . '" title="' . $blogPost->post_title . '" alt="' . $blogPost->post_excerpt . '">';
										echo get_the_post_thumbnail($blogPost->ID, $themePrefix . 'homeListSmall', array(
												'class'		=> 'img-center'
											)
										);
									echo '</a>';

									echo '<a href="' . get_permalink($blogPost->ID) . '" title="' . $blogPost->post_title . '" alt="' . $blogPost->post_excerpt . '" class="post-title">';
										echo '<h3>' . $blogPost->post_title . '</h3>';
									echo '</a>';
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				}
			}
		}
	echo '</div>';
?>