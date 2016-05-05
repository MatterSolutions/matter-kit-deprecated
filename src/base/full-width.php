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
*   Template Name: Full Width
*	Displays a full width content area without a sidebar
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

		$hide_hero_data = get_field( 'mttr_hide_hero_image' );

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
		$data = array(

			'left_content' => get_the_content(),
			'modifiers' => 'band--large',

		);

		mttr_get_template( 'template-parts/content/_c.content-flexible', $data );

	echo '</main>';

} else {

	mttr_get_template( 'template-parts/content/_c.content-none', $data );

}

get_footer(); 