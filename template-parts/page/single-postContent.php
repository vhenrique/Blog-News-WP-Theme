<?php
/**
 * Post content
 * 
 * @category BAEDaily
 * @package  template-parts/page
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 */

	echo '<div class="post-content">';


		get_template_part( 'template-parts/page/single', 'postThumbnail' );

		echo '<article class="col-md-11 col-sm-11 col-xs-12 text-justify">';
			the_content();
		echo '</article>';

		get_template_part( 'template-parts/page/share', 'buttonsBottom' );

	echo '</div>';
?>