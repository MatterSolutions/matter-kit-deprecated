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
*	Accordion A
*	Display a list of accordion items
*	Has a expand all toggle at the top
*
 ---------------------------------------------------------- */

 	$id = mttr_get_template_var( 'id' );
 	$heading = mttr_get_template_var( 'heading' );
	$content = mttr_get_template_var( 'content' );
	$identifier = mttr_get_template_var( 'identifier' );

	$modifiers = mttr_get_template_var( 'modifiers' );

	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers; 

	}


	/*
	*	Begin outputting the block
	*/

	if ( $heading || $content ) {

		echo '<section class="accordion-a' . esc_html( $modifiers ) . '  ' . esc_html( $identifier ) . '">';

			if ( $heading ) {

				echo '<div data-toggle-class="is-open" data-toggle-target=".' . esc_html( $identifier ) . '" class="accordion-a__heading  js-toggle">';

					echo '<h6 class="accordion-a__title  u-flush">' . esc_html( $heading ) .'</h6>';

				echo '</div>';

			}

			if ( $content ) {

				echo '<div class="accordion-a__content">';

					echo '<div class="u-negate-btm-margin">';

						echo apply_filters( 'the_content', $content );

					echo '</div>';

				echo '</div>';

			}

		echo '</section>';

	}