<?php

/*
*	Module for displaying a box component
*/

$content = mttr_get_template_var( 'content' );
$badge = mttr_get_template_var( 'badge' );
$title = mttr_get_template_var( 'title' );
$link = mttr_get_template_var( 'link' );
$modifiers = mttr_get_template_var( 'modifiers' );

// Add spaces before modifiers
if ( $modifiers ) {

	$modifiers = '  ' . $modifiers;

}

// Begin opening band class
echo '<div class="box' . esc_html( $modifiers ) . '">';

	// Output title, if supplied
	if ( $title ) {

		echo '<div class="box__title">';

			if ( $badge ) {

				echo '<ul class="layout  listing">';

					echo '<li class="layout__item  listing__item  g-one-half">';

			}

				// Box link open
				if ( $link ) {

					echo '<a class="u-link--no-decoration" href="' . esc_url( $link ) . '">';

				}

					// Box Title
					echo '<h4>' . esc_html( $title ) . '</h4>';

				// Box link close
				if ( $link ) {

					echo '</a>';

				}

			if ( $badge ) {

					echo '</li>';

					echo '<li class="layout__item  listing__item  g-one-half  u-text--right">';

						mttr_get_template( 'template-parts/base/_module.badge', $badge );

					echo '</li>';
				
				echo '</ul>';

			}

		echo '</div>';

	}

	// Output content, if supplied
	if ( $content ) {

		if ( is_array( $content ) ) {

			foreach( $content as $content_item ) {

				echo '<div class="box__content">';

					echo apply_filters( 'the_content', $content_item );

				echo '</div>';

			}

		} else {

			echo '<div class="box__content">';

				echo apply_filters( 'the_content', $content );

			echo '</div>';

		}

	}

echo '</div><!-- /.box -->';