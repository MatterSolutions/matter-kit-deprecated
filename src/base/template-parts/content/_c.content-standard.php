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
*	Standard Content
*	The most vanilla of content areas
*	WYSIWYG content in a single column
*
 ---------------------------------------------------------- */

	// Get vars
	$content = mttr_get_template_var( 'content' );
	$modifiers = mttr_get_template_var( 'modifiers' );

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}
	


	/*
	*	Output the content
	*/
	if ( $content ) {

		echo '<div class="wrap">';

			echo '<div class="u-negate-btm-margin  u-line-length">';

				echo apply_filters( 'the_content', $content );

			echo '</div>';

		echo '</div>';

	}