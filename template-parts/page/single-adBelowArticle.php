<?php
/**
 * Taboola Ad below the article
 * 
 * @category BAEDaily
 * @package  template-parts/page
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 */
	
	global $redux_options, $themePrefix;

	if( isset($redux_options[$themePrefix . 'ad_belowArticle']) ){
		echo $redux_options[$themePrefix . 'ad_belowArticle'];
	}
?>