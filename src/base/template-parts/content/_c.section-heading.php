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
*	Section Heading
*	Used to introduce a new section of content
*
 ---------------------------------------------------------- */

	// Get vars
	$image = mttr_get_template_var( 'image' );
	$heading = mttr_get_template_var( 'heading' );
	$subheading = mttr_get_template_var( 'subheading' );
	$content = mttr_get_template_var( 'content' );
	$modifiers = mttr_get_template_var( 'modifiers' );

	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}


	/*
	*	Begin output of block
	*/
	echo '<div class="section-heading' . esc_html( $modifiers ) . '">';

		if ( $heading ) {

			echo '<div class="wrap">';

				echo '<h2 class="display-heading  display-heading--beta">';

					echo esc_html( $heading );

				echo '</h2>';

			echo '</div>';

		}


		if ( $content || $subheading ) {

			echo '<div class="wrap">';

				echo '<div class="u-line-length">';

					if ( $subheading ) {

						echo '<h6>';

							echo esc_html( $subheading );

						echo '</h6>';

					}

					if ( $content ) {

						echo '<div class="u-negate-btm-margin">';

							echo apply_filters( 'the_content', $content );

						echo '</div>';

					}

				echo '</div>';

			echo '</div>';

		}

	echo '</div><!-- /.section-heading -->';