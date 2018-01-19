<?php
/**
 * Shows the post title and author name
 * 
 * @category BAEDaily
 * @package  template-parts/page
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 */
	
	// Post title
	echo '<h1 class="post-title">' . get_the_title() . '</h1>';

	// Post author and date 
	printf( '<p class="post-meta">By <a href="%s"><b>%s</b></a> on %s</p>',
		get_author_posts_url( get_the_author_meta('ID') ),
		get_the_author(),
		get_the_date( 'F d, Y' )
	);

?>