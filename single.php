<?php get_header();
	echo '<main class="container">';

		global $redux_options, $themePrefix;

		if( have_posts() ){
			echo '<section id="single-post" class="col-md-9 col-sm-9 col-xs-12">';
				while( have_posts() ){
					the_post();

					get_breadcrumbs();

					get_template_part( 'template-parts/page/single', 'postTitle' );

					get_template_part( 'template-parts/page/share', 'buttons' );

					get_template_part( 'template-parts/page/single', 'postContent' );
				}
			
				get_template_part( 'template-parts/page/single', 'postPagination' );

			 	if( isset($redux_options[$themePrefix . 'ad_taboolaBelowArticle']) ){
					echo $redux_options[$themePrefix . 'ad_taboolaBelowArticle'];
				}

				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}

				get_template_part( 'template-parts/page/single', 'adBelowArticle' );

				get_template_part( 'template-parts/page/single', 'ramdomCategories' );

			echo '</section>';
		}

		get_sidebar();

	echo '</main>';
get_footer(); ?>