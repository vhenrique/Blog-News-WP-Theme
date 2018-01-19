<?php
/**
 * Share button at the post bottom
 * 
 * @category BAEDaily
 * @package  template-parts/page
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 */

	// Share button
	echo '<div class="col-md-12 col-sm-12 col-xs-12">';
		$shares = get_shareButtons( get_the_id(), 'single-page' );
		foreach($shares as $share ){
			echo $share;
		}
	echo '</div>';
?>