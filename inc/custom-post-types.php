<?php
/**
 * Use this file to create new custom post types
 * Follow the information
 * 	1 - Sort the supports array in alphabetical order
 * 	2 - Change de dashicons, try don't use the same twice
 * 	3 - Use plural to declare post type's name
 * 	4 - Use the name of post type to make the function name plus '_register', like 'posts_register'
 *
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 * @since 	1.0
 * @version 1.1
 */

// Banners
	// add_action( 'init', 'slides_register' );
	// function slides_register(){
	// 	$singular_label = 'slide';
	// 	$labels = array(
	// 		'name'					=> 'Slides',
	// 		'singular_name'			=> ucfirst( $singular_label ),
	// 		'add_new'				=> 'Novo',
	// 		'add_new_item'			=> 'Novo' . ' ' . strtolower( $singular_label ),
	// 		'edit_item'				=> 'Editar' . ' ' . strtolower( $singular_label ),
	// 		'new_item'				=> 'Novo' . ' ' . strtolower( $singular_label ),
	// 		'view_item'				=> 'Ver' . ' ' . strtolower( $singular_label ),
	// 		'search_items'			=> 'Buscar' . ' ' . strtolower( $singular_label ),
	// 		'not_found'				=> 'Não encontrado',
	// 		'not_found_in_trash'	=> 'Não encontrado na lixeira',
	// 	);
	// 	$args = array(
	// 		'labels'				=> $labels,
	// 		'public'				=> true,
	// 		'publicly_queryable'	=> true,
	// 		'show_ui'				=> true,
	// 		'query_var'				=> true,
	// 		'show_in_nav_menus' 	=> true,
	// 		'capability_type'		=> 'post',
	// 		'menu_icon' 			=> 'dashicons-images-alt2',
	// 		'hierarchical'			=> true,
	// 		'menu_position'			=> 10,
	// 		'has_archive'			=> true,
	// 		'exclude_from_search'	=> false,
	// 		'supports'				=> array( 'excerpt', 'thumbnail', 'title' )
	// 	);
	// 	register_post_type( 'slides', $args );
	// }
?>