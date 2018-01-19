<?php
	global $themePrefix;

	// All custom taxonomies
	$allTaxonomies = array( 
		// Diamonds
		'ev_stone_shape',
		'ev_color',
		'ev_clarity',
		'ev_grading_report',

		// Jewels
		'ev_style',
		'ev_metal_type',

		// Watches
		'ev_brand',
		'ev_case_material',
		'ev_band_material',
		'ev_condition',
		'ev_original_box'
	);

	/**
	 * Product Category custom meta Configiguration
	 */
	$productTermsConfig = array(
		'id'				=> $themePrefix . 'productCategory',
		'pages'				=> $allTaxonomies,
		'context'			=> 'normal',
		'fields'			=> array(),
		'local_images'		=> false,
		'use_with_theme'	=> true
	);
	$productTermsMeta = new Tax_Meta_Class( $productTermsConfig );

		// Evaluation taxonomies relation to default product categories
		$productTermsMeta->addTaxonomy(
			$themePrefix . 'parentEvaluationCat',

			array( 
				'taxonomy' 		=> 'evaluation_category',
				'type'			=> 'checkbox_list'
			),
			array( 
				'name' 	=> 'Categorias pai',
				'desc'	=> 'Selecione a quais categorias de avaliação este termo está relacionado. O formulário de avaliação cruza esses termos para montar os campos corretamente,',
				'style'	=> 'display: inline-block'
			)
		);

		// Product taxonomies that appears at evaluation form
		$productTermsMeta->addSelect(
			$themePrefix . 'termToEvaluation',
			array(
				'no'	=> 'Não',
				'yes'	=> 'Sim'
			),
			array( 
				'name' 	=> 'Exibir no formulário de avaliação?',
				'desc'	=> 'Selecione esta caixa caso este termo faça parte do formulário de avaliação.',
				'std'	=> 'yes'
			)
		);

	/**
	 * Product style parent
	 */
	$allTaxonomies2 = array( 
		// Diamonds
		'ev_stone_shape',
		'ev_color',
		'ev_clarity',
		'ev_grading_report',
	);

	/**
	 * Product Category custom meta Configiguration
	 */
	$productParentStyleConfig = array(
		'id'				=> $themePrefix . 'productStyle',
		'pages'				=> $allTaxonomies2,
		'context'			=> 'normal',
		'fields'			=> array(),
		'local_images'		=> false,
		'use_with_theme'	=> true
	);
	$productParentStyle = new Tax_Meta_Class( $productParentStyleConfig );

		// Product taxonomies relation to default product categories
		$productParentStyle->addTaxonomy(
			$themePrefix . 'parentStyle',
			array( 
				'taxonomy' 		=> 'ev_style',
				'type'			=> 'checkbox_list'
			),
			array( 
				'name' 	=> 'Estilo pai',
				'desc'	=> 'Selecione a quais estilos de produto este termo está relacionado. Esta informação é relevante pois os filtros de busca do site dependem desta informação para cruzar todas as taxonomias de produto. Além disso o formulário de avaliação cruza esses termos para montar os campos corretamente,',
				'style'	=> 'display: inline-block'
			)
		);


	/**
	 * Product priority
	 */
	$allTaxonomies[] = 'evaluation_category';
	$productPriorityConfig = array(
		'id'				=> $themePrefix . 'categoryPriority',
		'pages'				=> $allTaxonomies,
		'context'			=> 'normal',
		'fields'			=> array(),
		'local_images'		=> false,
		'use_with_theme'	=> true
	);
	$productPriorityMetaMeta = new Tax_Meta_Class( $productPriorityConfig );

	$productPriorityMetaMeta->addSelect(
		$themePrefix . 'termPriority',
		range(0, 15),
		array( 
			'name' 	=> 'Prioridade',
			'desc'	=> 'Quanto maior o número, maior a prioridade na exibição no formulário.',
			'std'	=> '10'
		)
	);

	/**
	 * Product brand blacklist
	 */
	$productBrandsConfig = array(
		'id'				=> $themePrefix . 'productBrands',
		'pages'				=> array('ev_brand'),
		'context'			=> 'normal',
		'fields'			=> array(),
		'local_images'		=> false,
		'use_with_theme'	=> true
	);
	$productBrandsMeta = new Tax_Meta_Class( $productBrandsConfig );

		// Set in black list or not
		$productBrandsMeta->addSelect(
			$themePrefix . 'brandBlackList',
			array(
				'no'	=> 'Não',
				'yes'	=> 'Sim'
			),
			array( 
				'name' 	=> 'Faz parte da black list?',
				'desc'	=> 'Marque a caixa caso a Vecchio não avalie esta marca.'
			)
		);


	/**
	 * Taxonomy custom icon
	 */
	$productTermsIconConfig = array(
		'id'				=> $themePrefix . 'taxIconConfig',
		'pages'				=> array('ev_style', 'ev_stone_shape', 'evaluation_category'),
		'context'			=> 'normal',
		'fields'			=> array(),
		'local_images'		=> false,
		'use_with_theme'	=> true
	);
	$productTermsIcon = new Tax_Meta_Class( $productTermsIconConfig );
		// Taxonomy icon
		$productTermsIcon->addImage(
			$themePrefix . 'termIcon',
			array( 
				'name' 	=> 'Ícone',
				'desc'	=> 'Selecione o ícone deste termo.'
			)
		);