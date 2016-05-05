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


if ( $link ) {

	echo '<a href="' . esc_url( $link ) . '" class="icon-list-b">';

} else {

	echo '<div class="icon-list-b">';

}

	
	echo '<ul class="listing  layout">';

		echo '<li class="listing__item  layout__item  g-one-quarter">';

		echo '</li>';

	echo '</ul>';



if ( $link ) {

	echo '</a>';

} else {

	echo '</div>';

}
	