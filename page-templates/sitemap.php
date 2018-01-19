<?php 
/*
* Template name: Sitemap
*/

get_header();
	echo '<main class="container">';
		if( have_posts() ){
			echo '<section id="site-map" class="col-md-9 col-sm-9 col-xs-12">';
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

						echo '<div class="col-md-6 col-sm-6 col-xs-6">';
							echo '<h2>Categories</h2>';
							$parents = get_categories( array(
						    	'parent'		=> '0',
							) );
							
							echo '<ul class="map-list">';
							if( ! empty($parents) ){
								foreach( $parents as $parent ) {

									$listFormat = '<li><a href="%s" title="%s">%s</a></li>';
									echo sprintf($listFormat,
										get_category_link( $parent->term_id ),
										'View all posts in ' . $parent->name,
										$parent->name
									);

									$children = get_term_children($parent->term_id, $parent->taxonomy);
									if( ! empty($children) ){
										echo '<ul class="sub-menu">';

										foreach($children as $childId){

											$child = get_term_by('id', $childId, $parent->taxonomy);

											if( ! empty($child) ){
												
												echo sprintf($listFormat,
													get_category_link( $child->term_id ),
													'View all posts in ' . $child->name,
													$child->name
												);
											}
										}
										echo '</ul>';
									}
								     
								}
							}
							echo '</ul>'; 
						echo '</div>';

						echo '<div class="col-md-6 col-sm-6 col-xs-6">';
							echo '<h2>Pages</h2>';
							$pages = get_posts( array(
									'post_type'    		=> 'page',
							    	'posts_per_page'	=> -1
								) 
							);
								 
							echo '<ul class="map-list">';
							foreach( $pages as $page ) {
							   echo sprintf($listFormat,
									get_permalink($page->ID),
									$page->post_title,
									$page->post_title
								);
							}
							echo '</ul>'; 
						echo '</div>';
					echo '</div>';
				}
			echo '</section>';
		}

		get_sidebar();

	echo '</main>';

get_footer(); ?>