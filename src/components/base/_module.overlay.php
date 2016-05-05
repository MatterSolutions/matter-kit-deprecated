<?php

/*
*	Module for displaying an overlay, usually used with a band
*/

$content = mttr_get_template_var( 'content' );
$modifiers = mttr_get_template_var( 'modifiers' );

// Add spaces before modifiers
if ( $modifiers ) {

	$modifiers = '  ' . $modifiers;

}


// Begin opening band class
echo '<div class="overlay' . esc_html( $modifiers ) . '">';

	echo '<div class="overlay__body">';

		if ( $content ) {

			echo apply_filters( 'the_content', $content );

		}

	echo '</div>';

echo '</div><!-- /.overlay -->';