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
*	Secondary icon list
*	Displays icon to the left of the text by default
*
 ---------------------------------------------------------- */

	// Get vars
	$icon = mttr_get_template_var( 'icon' );
	$icon_image = mttr_get_template_var( 'icon_image' );
	$heading = mttr_get_template_var( 'heading' );
	$subheading = mttr_get_template_var( 'subheading' );
	$content = mttr_get_template_var( 'content' );
	$link = mttr_get_template_var( 'cta_link' );
	$modifiers = mttr_get_template_var( 'modifiers' );

	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}


	// Check to see if content is supplied
	// If no content, we'll change the block alignment based on this
	if ( empty( $content ) ) {

		$modifiers .= '  icon-list-b--v-center';

	}



/*
*	Begin outputting module
*/

	// Open element
	echo '<div class="icon-list-b' . esc_html( $modifiers ) . '">';		
		

		// Icon
		echo '<div class="icon-list-b__media">';

			if ( $icon  ||  $icon_image ) { 

				if ( $link ) {

					echo '<a href="' . esc_url( $link ) . '" class="u-link--no-decoration">';

				}

				echo '<i class="icon  icon--large  icon--middle">';

					if ( $icon_image ) {

						echo '<img alt="" src="' . esc_url( $icon_image ) . '">';

					} else {

						echo mttr_get_icon( esc_html( $icon ) .'.svg' ); 

					}

				echo '</i>';

				if ( $link ) {

					echo '</a>';

				}

			} 

		echo '</div><!-- /.icon-list-b__media -->';

		echo '<div class="icon-list-b__content">';

			if ( $heading ) {

				if ( $link ) {

					echo '<a href="' . esc_url( $link ) . '" class="u-link--no-decoration  u-block">';

				}

					echo '<h4>' . esc_html( $heading ) . '</h4>';

				if ( $link ) {

					echo '</a>';

				}

			}


			if ( $subheading ) {

				echo '<h6>' . esc_html( $subheading ) . '</h6>';

			}

			if ( $content ) {

				echo '<div class="u-text--small">';

					echo apply_filters( 'the_content', $content );

				echo '</div>';

			}

		echo '</div><!-- /.icon-list-b__content -->';

	echo '</div><!-- /.icon-list-b -->';