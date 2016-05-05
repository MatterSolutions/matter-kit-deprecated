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
*	Testimonial A
*	Basic testimonial, showing a blockquote with citation
*	and image beneath
*
 ---------------------------------------------------------- */

	// Get vars
	$image = mttr_get_template_var( 'image' );
	$heading = mttr_get_template_var( 'heading' );
	$subheading = mttr_get_template_var( 'subheading' );
	$content = mttr_get_template_var( 'content' );
	$link = mttr_get_template_var( 'cta_link' );
	$modifiers = mttr_get_template_var( 'modifiers' );

	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}


	// Check to see if content is supplied
	// If no content, we'll change the block alignment based on this
	if ( empty( $content ) ) {

		$modifiers .= '  testimonial-a--v-center';

	}



/*
*	Begin outputting module
*/

	// Open element
	echo '<div class="testimonial-a' . esc_html( $modifiers ) . '">';		
		
		echo '<div class="testimonial-a__content">';

			if ( $content ) {

				echo '<blockquote class="blockquote-b">';

					echo apply_filters( 'the_content', $content );

				echo '</blockquote>';

			}

			if ( $image || $heading || $subheading ) {

				echo '<ul class="layout  layout--large  layout--middle">';

				if ( $image ) {

					echo '<li class="layout__item  g-one-fifth">';

						$avatar = array(

							'image' => $image,
							'modifiers' => 'avatar--round  avatar--large',

						);

						mttr_get_template( 'template-parts/base/_module.avatar', $avatar );

					echo '</li>';

				}

				if ( $heading || $subheading ) {

					echo '<li class="layout__item  g-four-fifths">';

						if ( $heading ) {

							echo '<h6>' .  esc_html( $heading ) . '</h6>';

						}

						if ( $subheading ) {

							echo '<p>' .  esc_html( $subheading ) . '</p>';

						}

					echo '</li>';

				}

				echo '</ul>';

			}

		echo '</div><!-- /.testimonial-a__content -->';

	echo '</div><!-- /.testimonial-a -->';