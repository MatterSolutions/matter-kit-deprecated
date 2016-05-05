<?php

/*
*	Module for displaying an overlay, usually used with a band
*/

$image = mttr_get_template_var( 'image' );
$modifiers = mttr_get_template_var( 'modifiers' );

// Add spaces before modifiers
if ( $modifiers ) {

	$modifiers = '  ' . $modifiers;

}


if ( $image ) {

	// Begin opening band class
	echo '<div class="avatar' . esc_html( $modifiers ) . '">';

		echo '<div class="avatar__body" style="background-image: url( \''. esc_url( $image ) . '\' );">';

		echo '</div>';

	echo '</div><!-- /.avatar -->';

}