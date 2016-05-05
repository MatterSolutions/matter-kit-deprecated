<?php

/* --------------------------------------------------------
*        __ __  __
*      /  /   /   /     __/__/__
*      \ /   /   /  __   /  /  __  (/__
*       /   /   / /  /  /  /  /__) /  /
*      /   /   / (__/__/_ /__/____/  /_/
*              \
*                SOLUTIONS
*
*   Generic template, used for displaying posts
*
 ---------------------------------------------------------- */

get_header();

if ( have_posts() ) {

	$features = array();

	while ( have_posts() ) {

		the_post();
		$features[] = get_the_ID();

	}

	/*
	*	Include Content Sidebar
	*/
	echo '<main class="u-keyline">';

		$content = false;

		if ( !is_search() ) {

			$content = mttr_get_contextual_content();

		}

		/*
		*	Hero Data
		*/

		$hero = mttr_get_hero_data( 'text' );
		$hero[ 'elements' ][ 'content' ] = $content;

		// Include the hero
		mttr_get_template( $hero[ 'template' ], $hero[ 'elements' ] );



		/*
		*	Content Data
		*/

		echo '<div class="band  band--large">';

			echo '<div class="band__body">';

				if ( is_search() ) {

					$data = array(

						'style' => 'listing',
						'features' => mttr_setup_feature_post_data_array( $features, 'listing', 'listing--listing-index' ),
						'listing_data' => mttr_get_feature_data( 'listing' ),
						'modifiers' => false,

					);

					mttr_get_template( 'template-parts/content/_c.content-features', $data );
					mttr_paged_navigation();


				} else {

					// Pull through the categories lists on the side
					$taxonomy_type = get_query_var( 'taxonomy' );

					if ( empty( $taxonomy_type ) ) {

						$taxonomy_type = 'category';

					}
					
					$terms = get_terms( $taxonomy_type );

					$listing_data = mttr_get_feature_data( 'listing' );
					$listing_data[ 'listing_wrap' ] = false;

					$data = array(

						'categories' => $terms,
						'listing' => array(
							'style' => 'listing',
							'features' => mttr_setup_feature_post_data_array( $features, 'listing', 'listing--listing-index' ),
							'listing_data' => $listing_data,

						),

					);

					mttr_get_template( 'template-parts/content/_c.content-sidebar', $data );

				}

			echo '</div><!-- /.band__body -->';

		echo '</div><!-- /.band -->';

	echo '</main>';

} else {

	mttr_get_template( 'template-parts/content/_c.content-none', $data );

}

get_footer();
