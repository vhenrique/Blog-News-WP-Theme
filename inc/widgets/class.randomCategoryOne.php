<?php
class RandomCategoryOne extends WP_Widget {

	function __construct() {

		parent::__construct(
			'randomCategoryOne',
			'Random category one',
			array('description' => 'Show more posts from different category of the current post.')
		);
	}

	public function widget( $args, $instance ) {
		global $themePrefix, $taxToExclude;

		echo $args['before_widget'];
		
			echo $args['before_title'];
				if( ! empty( $instance['title'] ) ){
					echo $instance['title'];
				}
				else{
					$categories = get_the_category(get_the_id());
					if( ! empty($categories) ){
						foreach($categories as $category){
							$toRemove[] = $category->term_id;
						}
					}

					$toRemove[] = $taxToExclude;

					$terms = get_terms(array(
							'taxonomy'		=> 'category',
							'hide_empty'	=> false,
							'exclude'		=> $toRemove,
							'parent'		=> '0'
						)
					);
					if( ! empty($terms) ){
						foreach($terms as $term){
							echo $term->name . ':';
							$cat_id = $term->term_id;
							break;
						}
					}
				}
			echo $args['after_title'];

			/**
			 * Get posts and make a list from them based on the current category
			 * Instance POSTLIMIT is a parameter setted in widget field
			 * Also remove the current post from query
			 */
			
			$blogPosts = get_posts( array(
					'post_type'			=> 'post',
					'posts_per_page'	=> $instance['postLimit'],
					'post__not_in'		=> array( get_the_id() ),
					'category'			=> $cat_id
				)
			);

			$taxToExclude = $cat_id;

			// Show the posts 
			if( ! empty( $blogPosts ) ){
				foreach( $blogPosts as $blogPost ){
					echo '<div class="post-box">';
						echo '<div class="post-content">';
							echo '<a href="' . get_permalink($blogPost->ID) . '" title="' . $blogPost->post_title . '" alt="' . $blogPost->post_excerpt . '">';
								echo get_the_post_thumbnail($blogPost->ID, $themePrefix . 'homeListSmall', array(
										'class'		=> 'img-center'
									)
								);
							echo '</a>';

							echo '<a href="' . get_permalink($blogPost->ID) . '" title="' . $blogPost->post_title . '" alt="' . $blogPost->post_excerpt . '" class="post-title">';
								echo '<h3>' . $blogPost->post_title . '</h3>';
							echo '</a>';
						echo '</div>';
					echo '</div>';
				}
			}
			
		echo $args['after_widget'];;
	}

	public function form( $instance ) {
		$before = '<p>';
		$after = '</p>';

		echo $before;
			echo '<h1>' . $this->name . '</h1>';
			echo 'Show a list of posts based on the current category of the post.';
		echo $after;

		if( ! empty( $instance['title'] ) ){
			$title = $instance['title'];
		}

		if( ! empty( $instance['postLimit'] ) ){
			$postLimit = (int)$instance['postLimit'];
		}
		
		echo $before;
			// Field title
			echo '<label for="' . $this->get_field_id( 'title' ) . '">';
				echo 'Title';
				echo '<input class="widefat" name="' . esc_attr( $this->get_field_name( 'title' ) ) . '" id="' . esc_attr( $this->get_field_id( 'title' ) ) . '" type="text" value="' . esc_attr( $title ) . '">';
			echo '</label>';

			// Field post limit
			echo '<label for="' . $this->get_field_id( 'postLimit' ) . '">';
				echo 'Limit of posts to show';
				echo '<input class="widefat" name="' . esc_attr( $this->get_field_name( 'postLimit' ) ) . '" id="' . esc_attr( $this->get_field_id( 'postLimit' ) ) . '" type="number" min="1" value="' . esc_attr( $postLimit ) . '">';
			echo '</label>';
		echo $after;
	}


	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['postLimit'] = ( ! empty( $new_instance['postLimit'] ) ) ? strip_tags( $new_instance['postLimit'] ) : '';

		return $instance;
	}
}

?>