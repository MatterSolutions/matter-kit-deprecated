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
*   Front Page
*	Template for the static front page (home page)
*
 ---------------------------------------------------------- */

get_header(); 

if ( have_posts() ) {			

	/*
	*	Include Content Sidebar
	*/
	echo '<main>';

		/*
		*	Setup Hero Image Data
		*/
		$hero = mttr_get_hero_data( 'home' );
		mttr_get_template( $hero[ 'template' ], $hero[ 'elements' ] );



		/*
		*	Content Data
		*/

		mttr_get_template( 'template-parts/content/_c.content-flexible' );

	echo '</main>';

}

get_footer(); 