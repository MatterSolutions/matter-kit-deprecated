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
*   Generic Page template
*	This displays a content-sidebar layout by default
*
 ---------------------------------------------------------- */

get_header(); 

if ( have_posts() ) {			

	/*
	*	Include Content Sidebar
	*/
	echo '<main>';


		/*
		*	Hero Data
		*/

		/*
		*	Hero Data
		*/

		$hide_hero_data = get_field( 'mttr_hide_hero_image' );

		if ( $hide_hero_data ) {

			$hero = mttr_get_hero_data( 'text' );
			mttr_get_template( $hero[ 'template' ], $hero[ 'elements' ] );

		} else {

			$hero = mttr_get_hero_data( 'standard' );
			mttr_get_template( $hero[ 'template' ], $hero[ 'elements' ] );

		}

			



		/*
		*	Content Data
		*/

		$menu = false;

		if ( has_nav_menu( 'sidebar' ) ) {

			$menu = array(

				'theme_location' => 'sidebar',
				'menu_class' => 'navigation  navigation--sidebar  u-flush--bottom',

			);

		}

		$data = array(

			'menu' => $menu,
			'content' => get_the_content(),
			'modifiers' => false,
			
		);

		// Check to negate space below sidebar content etc
		$band_class = '';
		$flexible_content = get_field( 'mttr_flexible_bands' );

		if ( $flexible_content && $flexible_content[ 0 ][ 'size' ] != 'flush' ) {

			$band_class = '  u-hard--bottom';

		}

		// Output content sidebar
		if ( $data[ 'menu' ] || $data[ 'content' ] ) {

			echo '<div class="band  band--large' . esc_html( $band_class ) . '">';

				echo '<div class="band__body">';

					mttr_get_template( 'template-parts/content/_c.content-sidebar', $data );

				echo '</div><!-- /.band__body -->';

			echo '</div><!-- /.band -->';

		}

		// Output flexible content
		mttr_get_template( 'template-parts/content/_c.content-flexible', $data );

	echo '</main>';

} else {

	mttr_get_template( 'template-parts/content/_c.content-none', $data );

}

get_footer(); 