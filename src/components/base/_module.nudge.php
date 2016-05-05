<?php

/*
*	Module for displaying a nudge component
*/

$item = mttr_get_template_var( 'item' );
$modifiers = mttr_get_template_var( 'modifiers' );

// Add spaces before modifiers
if ( $modifiers ) {

	$modifiers = '  ' . $modifiers;

}


// Begin opening nudge class
echo '<div class="nudge' . esc_html( $modifiers ) . '">';

	if ( $item ) {

		echo '<div class="nudge__item">';

			echo apply_filters( 'the_content', $item );

		echo '</div>';

	}

echo '</div><!-- /.nudge -->';