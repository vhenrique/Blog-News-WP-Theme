<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @package  Custom Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 *
 * @author  Vitor Henrique da Silva <vhenrique.vhs@gmail.com>
 * @see     http://vhenrique.com My oficial portfolio
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {
	
	global $themePrefix;

	// User newsletter
	$meta_boxes['postbox'] = array(
		'id'         => $themePrefix . 'postbox ',
		'title'      => 'Featured',
		'pages'      => array( 'post' ),
		'context'    => 'side',
		'priority'   => 'high',
		'show_names' => true,
		'fields'     => array(
			array(
				'name' 		=> 'Feature',
				'desc' 		=> 'Check to set this post as a feature.',
				'id'   		=> $themePrefix . 'featured',
				'type' 		=> 'select',
				'options'	=> array(
					array(
						'name'	=> 'Yes',
						'value'	=> 'on',
					),
					array(
						'name'	=> 'No',
						'value'	=> 'off'
					)
				),
				'default'	=> 'off'
			),
			array(
				'name' => 'Breaking',
				'desc' => 'Check set this post as a breaking.',
				'id'   => $themePrefix . 'breaking',
				'type' => 'checkbox'
			),
		)
	);
		
	return $meta_boxes;
}