<?php
/**
 * Post thumbnail
 * 
 * @category BAEDaily
 * @package  template-parts/page
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 */



	// Show the feature image only at the first page						
	if( $multipage && $page <= 1 ){
		echo get_the_post_thumbnail(get_the_id(), $themePrefix . 'singlePostthumbnail', array(
				'title'		=> get_the_title(),
				'alt'		=> get_the_excerpt()
			)
		);
	}
?>