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
*	Grid Feature - A
*	Large Image, title over image
*	Content can be centered, left or right aligned vertically and horizontally
*
 ---------------------------------------------------------- */

	// Get vars
	$author = mttr_get_template_var( 'author' );
	$categories = mttr_get_template_var( 'categories' );
	$content = mttr_get_template_var( 'content' );
	$date = mttr_get_template_var( 'date' );
	$heading = mttr_get_template_var( 'heading' );
	$image = mttr_get_template_var( 'image' );
	$tags = mttr_get_template_var( 'tags' );
	$meta = mttr_get_template_var( 'meta' );
	$link = mttr_get_template_var( 'cta_link' );


	$modifiers = mttr_get_template_var( 'modifiers' );


	// Ensure an image is always used
	if ( !$image ) {

		$image = get_field( 'mttr_options_hero_default_image', 'options' );
		$image_url = wp_get_attachment_image_src( $image, 'mttr_square' );
		$image_url = $image_url[0];

	} else {

		$image_url = $image;

	}
	

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}



	/*
	*	Begin outputting block
	*/

	if ( $link ) {

		echo '<a href="' . esc_url( $link ) . '" class="feature-a' . $modifiers . '  effect  effect--scale">';

	} else {

		echo '<div class="feature-a' . $modifiers . '  effect  effect--scale">';

	}

		echo '<figure class="feature-a__body  effect__item">';

			if ( $image ) {

				echo '<div style="background-image: url( \'' . esc_url( $image_url ) . '\' );" class="band  effect__content  u-hard--top  feature-a__media">';

					echo '<img alt="" src="' . esc_url( $image_url ) . '">';

				echo '</div>';

			}
			

			echo '<figcaption class="feature-a__content">';

				if ( $heading ) {

					echo '<h3 class="display-heading  feature-a__title  u-flush--bottom"><span class="u-link--no-decoration">' . esc_html( $heading ) . '</span></h3>';

				}

			echo '</figcaption><!-- /.feature-a__content -->';

		echo '</figure><!-- /.feature-a__body -->';

	echo '</a><!-- /.feature-a -->';
