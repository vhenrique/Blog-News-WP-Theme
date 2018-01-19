<?php 
/**
 * Single post pagination
 * 
 * @category BAEDaily
 * @package  template-parts/page
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 */
	
	global $multipage, $page, $numpages;

	if( $multipage ) {

		echo '<div class="row" id="pagination"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">';

			// Prev link
			if( $page != 1 ) {
				printf( '<a href="%s" class="prev">Previous</a>',
					get_permalink() . ($page - 1)
				);
			}

			// Page counter
			echo '<span>' . $page . ' of ' . $numpages . '</span>';

			// Next link
			if( $page < $numpages ) {
				printf( '<a href="%s" class="next">Next</a>',
					get_permalink() . ($page + 1)
				);
			}
		    
		echo '</div></div>';
 	}
?>