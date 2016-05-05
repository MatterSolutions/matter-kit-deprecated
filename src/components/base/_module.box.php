<?php

/*
*	Module for displaying a box component
*/

$content = mttr_get_template_var( 'content' );
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

			// Box link open
			if ( $link ) {

				echo '<a class="u-link--no-decoration" href="' . esc_url( $link ) . '">';

			}

				// Box Title
				echo '<h3>' . esc_html( $title ) . '</h3>';

			// Box link close
			if ( $link ) {

				echo '</a>';

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