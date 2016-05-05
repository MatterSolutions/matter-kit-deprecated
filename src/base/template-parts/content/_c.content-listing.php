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
*	Listing
*	Display a grid/listing of feature types
*
 ---------------------------------------------------------- */

	// Get vars
	$style = mttr_get_template_var( 'feature_template' );
	$features = mttr_get_template_var( 'features' );
	$feature_modifiers = mttr_get_template_var( 'feature_modifiers' );
	$listing_identifier = mttr_get_template_var( 'listing_identifier' );

	$item_modifiers = mttr_get_template_var( 'item_modifiers' );
	$modifiers = mttr_get_template_var( 'listing_modifiers' );

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}

	if ( $listing_identifier ) {

		$modifiers = $modifiers . '  ' . esc_html( $listing_identifier );

	}

	if ( $item_modifiers ) {

		$item_modifiers = '  ' . $item_modifiers;

	}



	/*
	*	Begin outputting block
	*/
	echo '<ul class="layout  listing' . esc_html( $modifiers ) . '">';

		if ( $features ) {

			foreach ( $features as $feature ) {

				if ( $style ) {

					echo '<li class="listing__item' . esc_html( $item_modifiers ) . '">';

						echo '<div class="listing__content">';

							$feature[ 'modifiers' ] = $feature_modifiers;
							mttr_get_template( $style, $feature );

						echo '</div>';

					echo '</li>';

				}

			}

		}

	echo '</ul><!-- /.listing -->';