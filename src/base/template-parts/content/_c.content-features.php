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
*	Features
*	Display the outer wrap for a grid listing
*
 ---------------------------------------------------------- */

	// Get vars
	$features = mttr_get_template_var( 'features' );
	$style = mttr_get_template_var( 'style' );
	$listing_data = mttr_get_template_var( 'listing_data' );
	$modifiers = mttr_get_template_var( 'modifiers' );

	$wrap = $listing_data[ 'listing_wrap' ];
	$toggle = $listing_data[ 'listing_toggle' ];
	$identifier = $listing_data[ 'listing_identifier' ];

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}



	/*
	*	Begin outputting block
	*/
	if ( $features ) {

		if ( $wrap ) {

			echo '<div class="wrap' . esc_html( $modifiers ) . '">';

		}


			// Output a helper to toggle the ENTIRE list
			if ( $toggle ) {

				echo '<div class="u-line-length  listing-toggle  listing-toggle--' . esc_attr( $style ) . '  listing-toggle--' . $identifier . '  js-toggle-all" data-toggle-class="' . $toggle[ 'class' ] . '" data-toggle-target=".' . $identifier . ' ' . $toggle[ 'target' ] . '">';

					echo '<a href="#" class="listing-toggle__label  u-link--no-decoration"></a>';

				echo '</div>';

			}


			$data = array(

				'listing_data' => $listing_data,
				'listing_modifiers' => 'listing--' . esc_attr( $style ) . $listing_data[ 'listing_modifiers' ] . '  ' . $identifier,
				'item_modifiers' => $listing_data[ 'item_modifiers' ],

				'features' => $features,
				'feature_modifiers' => $listing_data[ 'feature_modifiers' ],
				'feature_template' => $listing_data[ 'feature_template' ],
				
			);

			mttr_get_template( 'template-parts/content/_c.content-listing', $data );

			wp_reset_postdata();


		if ( $wrap ) {

			echo '</div><!-- /.wrap -->';

		}

	}
