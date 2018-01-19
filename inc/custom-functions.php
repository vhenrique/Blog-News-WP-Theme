<?php
/**
 * All the custom actions, functions and POGs are here
 * This file has been apartted from functions.php only to reduce the line numbers
 * Be careful working here, every single function should be in use at a different file
 *
 * @category BAEDaily
 * @package  Inc
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 */

	/**
	 * Brakes the text by limit
	 * @param  [string]  $t - the text that would be brake
	 * @param  [integer] $limit - The number of the words that would return
	 * @return [string]
	 */
	function limitText($t = null, $limit = 10){

		global $redux_options, $themePrefix;
		if( isset($redux_options[$themePrefix . 'postWordsLimit']) ){
			$limit = $redux_options[$themePrefix . 'postWordsLimit'];
		}

		$text = explode(' ', $t);
		for($i = 0; $i < $limit; $i++){
			$textFinal[] = $text[$i] . ' ';
		}

		$textFinal = implode('', $textFinal);

		return apply_filters('the_content', $textFinal);
	}

	/**
	 * Get primary category
	 */
	function getPrimaryTerm($post_id = null, $taxonomy = 'category') {

		$terms = wp_get_post_terms( $post_id, $taxonomy );
		if( ! empty($terms) ){
			foreach($terms as $term){
				if( $term->parent == 0 ){
					$primary = array('name' => $term->name, 'url' => get_term_link($term->term_id, $taxonomy));
				}
			}
		}
		return $primary;
	}

	/**
	 * Share buttons
	 * @param 	[int] $id - Post ID
	 * @param   [string] $local - Local to show
	 * @return 	Share buttons from Facebook, Twittter and Pinterest
	 * @since 	1.1
	 * @version 1.0
	 * @see 	http://vhenrique.com/
	 * @see  	https://github.com/bradvin/social-share-urls
	 * @author 	Vitor Henrique
	 */
	function get_shareButtons( $id, $local = null ){

		// Get page link
		$link = get_permalink($id);

		switch ($local) {
			case 'home':
				// Facebook 
				$socials[] = '<a href="http://www.facebook.com/sharer.php?u=' . $link . '" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
				// Twitter
				$socials[] = '<a href="https://twitter.com/share?url=' . $link . '&amp;text=' . get_the_title($id) . '" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
				// Google
				$socials[] = '<a href="https://plus.google.com/share?url=' . $link . '" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a>';
				// Pinterest
				$socials[] = '<a href="https://pinterest.com/pin/create/bookmarklet/?url=' .$link . 'description=' . get_the_title($id) . '" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>';
				break;

			case 'single-page':
				// Facebook 
				$facebook .= '<div class="share-button">';
					$facebook .= '<a href="http://www.facebook.com/sharer.php?u=' . $link . '" target="_blank"></a>';
				$facebook .= '</div>';
				$socials[] = $facebook;
				break;

			default:
				$containerBegin = '<li class="col-md-3 col-sm-3 col-xs-6">';
				$containerEnd = '</li>';

				// Facebook 
				$facebook = $containerBegin;
					$facebook .= '<div class="share-button facebook">';
						$facebook .= '<a href="http://www.facebook.com/sharer.php?u=' . $link . '" target="_blank">';
							$facebook .= '<i class="fa fa-facebook" aria-hidden="true"></i>';
							$facebook .= '<label class="text-center">Share It</label>';
						$facebook .= '</a>';
					$facebook .= '</div>';
				$facebook .= $containerEnd;
				$socials[] = $facebook;

				// Twitter				
				$twitter = $containerBegin;
					$twitter .= '<div class="share-button twitter">';
						$twitter .= '<a href="https://twitter.com/share?url=' . $link . '&amp;text=' . get_the_title($id) . '" target="_blank">';
							$twitter .= '<i class="fa fa-twitter" aria-hidden="true"></i>';
							$twitter .= '<label class="text-center">Tweet It</label>';
						$twitter .= '</a>';
					$twitter .= '</div>';
				$twitter .= $containerEnd;
				$socials[] = $twitter;

				// Google
				$google = $containerBegin;
					$google .= '<div class="share-button google">';
						$google .= '<a href="https://plus.google.com/share?url=' . $link  . '" target="_blank">';
							$google .= '<i class="fa fa-google-plus" aria-hidden="true"></i>';
							$google .= '<label class="text-center">Post It</label>';
						$google .= '</a>';
					$google .= '</div>';
				$google .= $containerEnd;
				$socials[] = $google;

				// Pinterest
				$pinterest = $containerBegin;
					$pinterest .= '<div class="share-button pinterest">';
						$pinterest .= '<a href="https://pinterest.com/pin/create/bookmarklet/?url=' .$link . 'description=' . get_the_title($id) . '" target="_blank">';
							$pinterest .= '<i class="fa fa-pinterest-p" aria-hidden="true"></i>';
							$pinterest .= '<label class="text-center">Pin It</label>';
						$pinterest .= '</a>';
					$pinterest .= '</div>';
				$pinterest .= $containerEnd;
				$socials[] = $pinterest;				
				break;
		}

		return $socials;
	}

	/**
	 * Custom numeric pagination
	 */
	function get_numeric_pagination(){
		global $wp_query;
		$total_pages	= $wp_query->max_num_pages;
		$big			= 999999999; // need an unlikely integer
		if($total_pages > 1){
			echo '<div class="row text-center mOffsetSmall">';
			echo paginate_links( array(
					'base'		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
					'format'	=> '/page/%#%',
					'current'	=> max(1, get_query_var('paged')),
					'total'		=> $wp_query->max_num_pages,
					'type'		=> 'list',
					'prev_text'	=> '<i class="fa fa-chevron-left" aria-hidden="true"></i>',
					'next_text'	=> '<i class="fa fa-chevron-right" aria-hidden="true"></i>'
				)
			);
			echo '</div>';
		}
	}



	/**
	 * Construct all the page meta tags, considerer using WooCommerce and their custom taxonomies
	 * @return [type] [description]
	 */
	function custom_page_metaTag(){
		global $post;

		$meta = '<!-- This theme was developped by Vitor Henrique - vhenrique.vhs@gmail.com -->';
		$meta .= '<meta name="author" content="' . get_author_name($post->post_author) . '">';

		// If is Home page from store
		if( is_home() ){
			$meta .= '<meta name="description" content="' . get_bloginfo( 'description' ) . '">';
		}

		// If is Singular product page
		if( is_singular( 'product' ) ){
			$meta .= '<meta name="description" content="' . $post->post_excerpt . '">';

			// Get product tags
			$pTags = wp_get_post_terms( $post->ID, 'product_tag' );
			if( ! empty( $pTags ) ){
				foreach( $pTags as $pTag ){
					$productTag .= $pTag->name . ' ' ;
				}
			}			
			// Get product categories
			$pCategories = wp_get_post_terms( $post->ID, 'product_cat' );
			if( ! empty( $pCategories ) ){
				foreach( $pCategories as $pCategory ){
					$productCategory .= $pCategory->name . ' ' ;
				}
			}
			$meta .= '<meta name="keywords" content="' . $productTag . $productCategory . '" />';
		}

		if( is_singular() ){

			$meta .= '<meta name="description" content="' . $post->post_excerpt . '">';

			// Get post tags
			$tags = wp_get_post_terms( $post->ID, 'tags' );
			if( ! empty( $tags ) ){
				foreach( $tags as $tag ){
					$postTags .= $tag->name . ' ' ;
				}
			}

			// Get post categories
			$categories = wp_get_post_terms( $post->ID, 'category' );
			if( ! empty( $categories ) ){
				foreach( $categories as $category ){
					$postCategories .= $category->name . ' ' ;
				}
			}


			$meta .= '<meta name="keywords" content="' . $postTags . $postCategories . '" />';
		}

		// Show meta tags
		echo $meta;
	}

	/**
	 * get_breadcrumbs
	 * @return [string] [Breandcrumb ul list]
	 */
	function get_breadcrumbs(){
		global $wp_query, $post;

		$before = '<li>';
		$after = '</li>';

		// Post type object
		$ptTitle = get_post_type_object( $wp_query->query_vars['post_type'] );

		echo '<nav>';
			echo '<ul class="breadcrumb">';
			if( ! is_home() &&  ! is_front_page() || is_paged() ){

				// Show home page icon
				echo $before .'<a href="' . get_home_url() . '" title="Home">Home</a>' . $after;

				if( is_single() && is_singular( 'product' ) && ! is_attachment() ){
					// Post type link
					echo $before;
					echo '<a href="'. get_post_type_archive_link( $ptTitle->name ) . '">' . $ptTitle->labels->name . '</a>';
					echo $after;

					// Main Category
					$cat = get_the_terms( get_the_id(), 'product_cat' ); 
					if( ! empty( $cat) ){
						echo $before;
						echo '<a href="' . get_term_link($cat[0]->term_id, 'product_cat') . '" title="' . $cat[0]->name . '">' . $cat[0]->name . '</a>';
						echo $after;
					}

					echo $before . get_the_title() . $after;
				}
				else if( is_archive() && is_tax( 'product_cat' ) ){
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );


					// Main Category
					echo $before;
					echo '<a href="' . get_term_link( $term->term_id, $term->taxonomy ) . '" title="' . $term->name . '">' . $term->name . '</a>';
					echo $after;
				}
				else if( is_tax( 'product_jewels' ) || is_tax( 'product_watches' ) ){
					$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
					
					$parent = get_term_by('id', $term->parent, $term->taxonomy);

					// Main Category
					echo $before;
					echo '<a href="' . get_term_link( $parent->term_id, $parent->taxonomy ) . '" title="' . $parent->name . '">' . $parent->name . '</a>';
					echo $after;

					// Child
					echo $before;
					echo '<a href="' . get_term_link( $term->term_id, $term->taxonomy ) . '" title="' . $term->name . '">' . $term->name . '</a>';
					echo $after;
				}
				else if( is_single() && ! is_attachment() ){

					// Main Category
					$categories = get_the_category();					
					if( ! empty($categories) ){

						// Parent
						foreach($categories as $category){

							if( $category->parent === 0 ){
								echo $before;
								echo '<a href="' . get_term_link($category->term_id, $category->taxonomy) . '">' . $category->name . '</a>';
								echo $after;
								break;
							}
						}

						// Children
						foreach($categories as $category){
							if( $category->parent != 0 ){
								echo $before;
								echo '<a href="' . get_term_link($category->term_id, $category->taxonomy) . '">' . $category->name . '</a>';
								echo $after;
							}
						}
					}

					echo $before . get_the_title() . $after;
				} 
				else if( is_attachment() ){
					$parent = get_post( $post->post_parent );
					$cat = get_the_category( $parent->ID );

					echo $before . get_category_parents($cat[0], TRUE, '') . $after;
					echo $before.'<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>' . $after;
					echo $before . get_the_title() . $after;
				} 
				else if( is_page() && ! $post->post_parent ){
					echo $before . get_the_title() . $after;
				} 
				else if( is_page() && $post->post_parent ){
					$parent_id  = $post->post_parent;
					
					while( $parent_id ) {
						$page = get_page( $parent_id );
						$breadcrumbs[] = $before . '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>' . $after;
						$parent_id  = $page->post_parent;
					}
					$breadcrumbs = array_reverse( $breadcrumbs );
					foreach ( $breadcrumbs as $crumb ) {
						echo $crumb;
					}
					echo $before . get_the_title() . $after;
				} 
				else if( is_search() ){
					echo $before . '<a href="javascript:void(0);">Busca</a>' . $after;
				} 
				else if( is_category() ){
					echo $before;
					echo '<a href="javascript: void(0);">';
						single_cat_title();
					echo '</a>';
					echo $after;
				}				
				else if( is_tag() ){
					echo $before;
					single_tag_title();
					echo $after;
				} 
				else if( is_404() ){
					global $redux_options, $themePrefix;

					if( isset( $redux_options[$themePrefix . '404Title'] ) ) {
						echo $before . $redux_options[$themePrefix . '404Title'] . $after;
					}
					else{
						echo $before . '404' . $after;
					}
				} 
				else if( is_archive() ){
					echo $before . '<a href="javascript:void(0);">' . $ptTitle->labels->name . '</a>' . $after;
				}
			}
			echo '</ul>';
		echo '</nav>';
	}
?>