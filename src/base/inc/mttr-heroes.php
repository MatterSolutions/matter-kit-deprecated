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
*   Hero Units
*   List out the config for the different hero types
*	These are automagically listed out on the styleguide page
*
 ---------------------------------------------------------- */


/*
*	Get data for a specific feature
*/
function mttr_get_hero_data( $type ) {

	$data_array = mttr_get_hero_data_array();

	if ( isset( $data_array[ $type ] ) ) {

		return $data_array[ $type ];

	} else {

		return $data_array[ 'standard' ];

	}

}



/*
*	Get the whole feature data array
*/
function mttr_get_hero_data_array() {

	$mttr_hero_config = array(

		'home' => array(

			'label' => 'Home Page',
			'template' => 'template-parts/hero/_c.hero-standard',
			'elements' => array(

				'title' => mttr_get_contextual_title(),
				'image' => mttr_get_hero_image(),
				'image_mobile' => mttr_get_hero_image( 'mobile' ),
				'identifier' => 'main',
				'indicator' => '.hero-standard + .band',
				'modifiers' => 'hero-standard--wide  hero-standard--overlay  hero-standard--fullscreen  hero-standard--center  hero-standard--petite',

			),

		),
		
		// Standard hero, used as THE default style
		'standard' => array(

			'label' => 'Standard',
			'template' => 'template-parts/hero/_c.hero-standard',
			'elements' => array(

				'title' => mttr_get_contextual_title(),
				'image' => mttr_get_hero_image(),
				'image_mobile' => mttr_get_hero_image( 'mobile' ),
				'identifier' => 'main',
				'modifiers' => 'hero-standard--overlay  hero-standard--wide  hero-standard--center',

			),

		),

		'image' => array(

			'label' => 'Image Only',
			'template' => 'template-parts/hero/_c.hero-standard',
			'elements' => array(

				'image' => mttr_get_hero_image(),
				'image_mobile' => mttr_get_hero_image( 'mobile' ),
				'identifier' => 'main',
				'modifiers' => 'hero-standard--wide  hero-standard--large  hero-standard--overlay  hero-standard--center',

			),

		),

		'text' => array(

			'label' => 'Text',
			'template' => 'template-parts/hero/_c.hero-b',
			'elements' => array(

				'title' => mttr_get_contextual_title(),
				'subheading' => mttr_get_contextual_subheading(),
				'modifiers' => 'band  band--large  u-hard--bottom  u-negate-btm-margin  u-overhang-half--bottom',

			),

		),

	);

	return $mttr_hero_config; 

}




/*
*	Get the featured image
*/
function mttr_get_hero_image( $post_id = null, $size = 'full' ) {

	$hero_image_url = false;

	if ( empty( $post_id ) ) {

		$post_id = get_the_ID();

	}

	if ( has_post_thumbnail( $post_id ) ) {

		$hero_image = get_post_thumbnail_id( $post_id );

		if ( $size == 'mobile' ) {

			$hero_image_url = wp_get_attachment_image_src( $hero_image, 'mttr_square' );

		} else {

			$hero_image_url = wp_get_attachment_image_src( $hero_image, 'mttr_hero' );

		}

		$hero_image_url = $hero_image_url[0];

	}

	return $hero_image_url;

}



/*
*	Check we get the data requested
*/
function mttr_filter_hero_data( $type, $data ) {

	$hero_config = mttr_get_hero_data( $type );
	$hero_data = array();

	foreach ( $hero_config[ 'elements' ] as $element ) {

		if ( isset( $data[ esc_attr( $element ) ] ) ) {

			$hero_data[] = $data[ esc_attr( $element ) ];

		}

	}

	return $hero_data;

}