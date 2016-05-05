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


// Begin opening wrap class
echo '<div class="wrap' . esc_html( $modifiers ) . '">';

	if ( $body ) {

		echo apply_filters( 'the_content', $body );

	}

echo '</div><!-- /.wrap -->';