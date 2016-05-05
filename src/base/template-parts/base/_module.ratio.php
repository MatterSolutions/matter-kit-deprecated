<?php

/*
*	Module for displaying a ratio component
*/

$body = mttr_get_template_var( 'body' );
$modifiers = mttr_get_template_var( 'modifiers' );

// Add spaces before modifiers
if ( $modifiers ) {

	$modifiers = '  ' . $modifiers;

}


// Begin opening band class
echo '<div class="ratio' . esc_html( $modifiers ) . '">';

	echo '<div class="ratio__body">';

		if ( $body ) {

			echo apply_filters( 'the_content', $body );

		}

	echo '</div>';

echo '</div><!-- /.ratio -->';