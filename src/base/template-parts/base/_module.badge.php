<?php

/*
*	Module for displaying a badge
*/

$content = mttr_get_template_var( 'content' );
$title = mttr_get_template_var( 'title' );
$modifiers = mttr_get_template_var( 'modifiers' );

// Add spaces before modifiers
if ( $modifiers ) {

	$modifiers = '  ' . $modifiers;

}


if ( $content ) {

	// Begin opening band class
	echo '<span title="' . esc_html( $title ) . '" class="badge' . esc_html( $modifiers ) . '">';

		if ( $content ) {

			echo esc_html( $content );

		}

	echo '</span><!-- /.badge -->';

}