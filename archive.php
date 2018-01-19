<?php get_header();

	global $themePrefix;

	echo '<main class="container">';
		echo '<section id="archive-post" class="col-md-9 col-sm-9 col-xs-12">';

			if( have_posts() ){
				while(have_posts()){
					the_post();

					echo '<div class="row mOffsetMedium">';
						// Post title
						echo '<h1 class="post-title">';
							echo '<a href="' . get_permalink() . '" title="'.get_the_title().'" alt="'.get_the_excerpt().'">';
								echo get_the_title();
							echo '</a>';
						echo '</h1>';

						// Post meta
						echo '<div class="post-meta">';
							
							// Post sub-title
							echo '<h4>' . get_post_meta( get_the_id(), '_ahjira_subtitle', TRUE ) . '</h4>';

							echo '<div class="mOffsetSmall">';
								printf('%s By <a href="%s"><b>%s</b></a> - ',
									get_the_date('M d, Y'),
									get_author_posts_url(get_the_author_meta('ID')),
									get_the_author()
								);
								comments_number('0 comments', '1 Comment', '% Comments');
							echo '</div>';
						echo '</div>';

						echo '<div class="mOffsetSmall">';
							echo '<a href="' . get_permalink() . '" class="col-md-6 col-sm-6 col-xs-12">';
								echo get_the_post_thumbnail(get_the_id(), $themePrefix.'archivePostthumbnail', array(
										'title'		=> get_the_title(), 
										'alt' 		=> get_the_excerpt()
									)
								);
							echo '</a>';
							echo '<div class="col-md-6 col-sm-6 col-xs-12">';
								echo limitText( get_the_excerpt() );
								echo '<a href="' . get_permalink() . '">[Read more...]</a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( function_exists("get_numeric_pagination") ){
					get_numeric_pagination();
				}
			}
			
		echo '</section>';

		get_sidebar();

	echo '</main>';
get_footer(); ?>