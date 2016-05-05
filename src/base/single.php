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
*   Single
*	Template for displaying individual posts
*
 ---------------------------------------------------------- */

get_header(); 

if ( have_posts() ) {

	while ( have_posts() ) {

		the_post(); 


		/*
		*	Hero Data
		*/

		$hide_hero_data = get_field( 'mttr_hide_hero_image' );

		if ( $hide_hero_data ) {

			$data = array(

				'title' => mttr_get_contextual_title(),
				'modifiers' => 'band  band--large  u-hard--bottom  u-negate-btm-margin  u-overhang-half--bottom',

			);

			mttr_get_template( 'template-parts/hero/_c.hero-b', $data );

		} else {

			$hero_image_url = false;

			if ( has_post_thumbnail( get_the_ID() ) ) {

				$hero_image = get_post_thumbnail_id( get_the_ID() );

				$hero_image_url = wp_get_attachment_image_src( $hero_image, 'mttr_hero' );
				$hero_image_mobile_url = wp_get_attachment_image_src( $hero_image, 'mttr_square' );

				$hero_image_url = $hero_image_url[0];			
				$hero_image_mobile_url = $hero_image_mobile_url[0];

			}

			$data = array(

				// 'title' => mttr_get_contextual_title(),
				'image' => $hero_image_url,
				'image_mobile' => $hero_image_mobile_url,
				//'meta' => array('date' => 'jS F, Y', 'categories' => true),
				'identifier' => 'main',
				'modifiers' => 'hero-standard--wide  hero-standard--large  hero-standard--overlay  hero-standard--center',

			);

			mttr_get_template( 'template-parts/hero/_c.hero-standard', $data );

		}


		/*
		*	Include Content Sidebar
		*/
		echo '<main>';

			$taxonomy_type = get_query_var( 'taxonomy' );

			if ( empty( $taxonomy_type ) ) {

				$taxonomy_type = 'category';

			}

			$terms = get_terms( $taxonomy_type );

			$post_tags = get_the_tags();

			$data = array(

				'content' => get_the_content(),
				'heading' => get_the_title(),
				'meta' => array(
					'date' => 'l, jS F, Y', 
					'categories' => true,
					'category_prefix' => 'In ',
					'icons' => false,
					'modifiers' => 'list--fancy-delimited  layout--flush',
				),
				'categories' => $terms,
				'tags' => $post_tags,
				'share' => array(
					'order' => array(
						'facebook',
						'twitter',
						'linkedin',
						'mail',
					),
					'modifiers' => 'listing--outlined  listing--small  layout--small',
				),
				'author' => array(
					'name' => get_the_author(),
					'description' => get_the_author_meta( 'description' ),
					'link' => get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ),
					'avatar' => array(

						'image' => get_avatar_url( get_post_field ( 'post_author', get_the_ID() ) ),
						'modifiers' => 'avatar--round',

					),
				),
				'modifiers' => false,
				
			);

			// Output content sidebar
			if ( $data[ 'content' ] ) {

				echo '<div class="band  band--large">';

					echo '<div class="band__body">';

						mttr_get_template( 'template-parts/content/_c.content-sidebar', $data );

					echo '</div><!-- /.band__body -->';

				echo '</div><!-- /.band -->';

			}

			/*
			*	Pull featured posts
			*/

			$related_posts = mttr_get_related_posts( get_the_ID(), 3 );

			if ( $related_posts ) {

				echo '<div class="band  band--large">';

					echo '<div class="band__body">';

						echo '<div class="wrap"><h4 class="display-heading  u-flush  u-soft-half--bottom">Related</h4></div>';

						$data = array(

							'style' => 'listing',
							'features' => mttr_setup_feature_post_data_array( $related_posts, 'listing', 'listing--listing-index' ),
							'listing_data' => mttr_get_feature_data( 'listing' ),
							'modifiers' => false,

						);

						mttr_get_template( 'template-parts/content/_c.content-features', $data );

					echo '</div><!-- /.band__body -->';

				echo '</div><!-- /.band -->';

			}

			// Output flexible content
			// mttr_get_template( 'template-parts/content/_c.content-flexible' );

			// After content hook
			do_action( 'mttr_after_content' );

		echo '</main>';

	}

}

get_footer(); 