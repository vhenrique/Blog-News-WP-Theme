<?php
/**
 * Share buttons
 * 
 * @category BAEDaily
 * @package  template-parts/page
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 */

	$socials = get_shareButtons( get_the_id() );
	echo '<ul class="post-share mOffsetSmall">';
		foreach($socials as $social){
			echo $social;
		}
	echo '</ul>';
?>