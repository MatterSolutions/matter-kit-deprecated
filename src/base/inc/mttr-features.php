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
*   Features
*   List out the config for the different feature types
*	The feature array is used to populate the feature options for ACF
*
 ---------------------------------------------------------- */


/*
*	Get data for a specific feature
*/
function mttr_get_feature_data( $type ) {

	$data_array = mttr_get_feature_data_array();

	if ( isset( $data_array[ $type ] ) ) {

		return $data_array[ $type ];

	} else {

		return $data_array[ 'listing' ];

	}

}




/*
*	Get the whole feature data array
*/
function mttr_get_feature_data_array() {

	$mttr_feature_config = array(

		// 'listing_modifiers' adds modifiers to the <ul> element
		// 'listing_wrap' determines whether the block is full width or has a .wrap
		// 'item_modifiers' applies to each layout__item element, widths go here
		// 'feature_modifiers' applies to the features themselves
		// 'feature_template' determines which template to repeat
		// 'feature_elements' is an array of elements accepted for that specific type

		
		'a' => array(

			'listing_label' => 'Primary Grid',
			'listing_modifiers' => '  listing--flush  layout--flush  listing--outlined',
			'listing_wrap' => false,
			'item_modifiers' => 'g-one-third@lap',
			'feature_modifiers' => 'feature-a--square  feature-a--bottom  feature-a--left  feature-a--overlay  overlay--light',
			'feature_template' => 'template-parts/feature/_c.feature-a',
			'feature_elements' => array(

				'heading' => true,
				'date' => 'd/m/Y',
				'image' => true,
				'cta_link' => true,

			),

		),


		// 'b' => array(

		// 	'listing_label' => 'Secondary Grid',
		// 	'listing_modifiers' => false,
		// 	'listing_wrap' => true,
		// 	'item_modifiers' => 'g-one-third@lap',
		// 	'feature_modifiers' => '',
		// 	'feature_template' => 'template-parts/feature/_c.feature-b',
		// 	'feature_elements' => array(

		// 		'heading' => true,
		// 		'date' => 'd/m/Y',
		// 		'meta' => true,
		// 		'image' => true,
		// 		'categories' => true,
		// 		'content' => true,
		// 		'cta_link' => true,

		// 	),

		// ),


		// Icon list, this doesn't use any css so it's included in the base
		'icon-a' => array(

			'listing_label' => 'Primary Icon Listing',
			'listing_modifiers' => '  layout--large',
			'listing_wrap' => true,
			'item_modifiers' => 'g-one-third@lap',
			'feature_modifiers' => false,
			'feature_template' => 'template-parts/feature/_c.icon-list-a',
			'feature_elements' => array(

				'heading' => true,
				'icon' => true,
				'content' => true,
				'cta_link' => true,

			),

		),


		// Mini Features
		'b' => array(

			'listing_label' => 'Related Posts',
			'listing_modifiers' => false,
			'listing_wrap' => true,
			'item_modifiers' => 'g-one-half@lap  g-one-third@desk',
			'feature_modifiers' => false,
			'feature_template' => 'template-parts/feature/_c.feature-b',
			'feature_elements' => array(

				'heading' => true,
				'meta' => true,
				'date' => 'jS F, Y',
				'image' => true,
				'categories' => true,
				'cta_link' => true,

			),

		),


		// Listing is our vanilla 'listing type', used for the blog by default
		'listing' => array(

			'listing_label' => 'Listing',
			'listing_modifiers' => '  listing--line-length  listing--huge',
			'listing_wrap' => true,
			'item_modifiers' => 'g-one-half@lap  g-one-whole@desk',
			'feature_modifiers' => false,
			'feature_template' => 'template-parts/feature/_c.listing-a',
			'feature_elements' => array(

				'heading' => true,
				'meta' => true,
				'date' => 'jS F, Y',
				'image' => true,
				'categories' => true,
				'content' => true,
				'cta_link' => true,

			),

		),


		// Document listing
		'document-listing' => array(

			'listing_label' => 'Document Listing',
			'listing_modifiers' => '  listing--line-length  listing--flush  listing--keylines-between  listing--keylines',
			'listing_wrap' => 'u-line-length',
			'item_modifiers' => false,
			'feature_modifiers' => 'band  band--small',
			'feature_template' => 'template-parts/feature/_c.document-listing-a',
			'feature_elements' => array(

				'id' => true,
				'heading' => true,
				'date' => 'jS F, Y',
				'image' => true,
				'categories' => true,
				'content' => true,
				'cta_link' => true,

			),

		),


		// Add an accordion listing
		'accordion' => array(

			'listing_label' => 'Accordion Listing',
			'listing_modifiers' => '  listing--line-length  listing--keylines  listing--keylines-between',
			'listing_wrap' => true,
			'listing_toggle' => array(

				'label' => 'Expand All',
				'target' => '.accordion-a',
				'class' => 'is-open',

			),
			'item_modifiers' => false,
			'feature_modifiers' => false,
			'feature_template' => 'template-parts/feature/_c.accordion-a',
			'feature_elements' => array(

				'heading' => true,
				'content' => true,
				'identifier' => true,

			),

		),

	);

	return $mttr_feature_config; 

}