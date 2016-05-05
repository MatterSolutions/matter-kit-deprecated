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
*	Media block
*	Image with accompanying content
*
 ---------------------------------------------------------- */

	// Get vars
	$items = mttr_get_template_var( 'items' );
	$modifiers = mttr_get_template_var( 'modifiers' );

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}
	

	/*
	*	Begin outputting block
	*/
	if ( $items ) {

		echo '<div class="wrap">';

			echo '<ul class="listing  listing--large  layout  layout--alternate">';

			foreach ( $items as $item ) {

				$image_url = wp_get_attachment_image_src( $item[ 'image' ], 'medium' );

				// Set the vertical alignment
				$media_modifiers = '  layout--middle';

				// If there's a lot of content, align the elements to the top
				if ( mttr_count_words( $item[ 'content' ] ) > 70 ) {

					$media_modifiers = '  layout--top';

				}

				echo '<li class="listing__item  layout__item">';

					echo '<ul class="layout  ' . esc_html( $media_modifiers ) . '  layout--large  listing">';

						echo '<li class="layout__item  listing__item  g-one-third@lap">';

							echo '<img alt="" src="' . esc_url( $image_url[ 0 ] ) . '">';

						echo '</li>';

						echo '<li class="layout__item  listing__item  g-two-thirds@lap">';

							echo '<div class="u-negate-btm-margin">';

								echo apply_filters( 'the_content', $item[ 'content' ] );

							echo '</div><!-- /.u-negate-btm-margin -->';

						echo '</li><!-- /.layout__item -->';

					echo '</ul><!-- /.layout -->';

				echo '</li><!-- /.listing__item -->';

			}

			echo '</ul><!-- /.listing -->';

		echo '</div><!-- /.wrap -->';

	}