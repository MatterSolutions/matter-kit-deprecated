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
*	Primary icon list
*	Displays icon above a heading/subheading and content
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
	

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}


/*
*	Begin outputting element
*/

if ( $link ) {

	echo '<a href="' . esc_url( $link ) . '" class="icon-list-a">';

} else {

	echo '<div class="icon-list-a">';

}

	echo '<ul class="layout  layout--center  listing">';

		echo '<li class="layout__item  listing__item  icon-list-a__media  u-text--center">'; 

			if ( $icon  ||  $icon_image ) { 

				echo '<div class="u-soft  u-hard--bottom">';

					echo '<i class="icon  icon--huge">';

						if ( $icon_image ) {

							echo '<img alt="" src="' . esc_url( $icon_image ) . '">';

						} else {

							echo mttr_get_icon( esc_html( $icon ) .'.svg' ); 

						}

					echo '</i>';

				echo '</div>';

			} 

		echo '</li><li class="layout__item  listing__item  icon-list-a__content  u-text--center">'; 

			if ( $heading ) {

				echo '<h4>' . esc_html( $heading ) . '</h4>';

			}


			if ( $subheading ) {

				echo '<h6>' . esc_html( $subheading ) . '</h6>';

			}

			if ( $content ) {

				echo apply_filters( 'the_content', $content );

			}

		echo '</li>';

	echo '</ul><!-- /.layout -->';

if ( $link ) {

	echo '</a><!-- /.icon-list-a -->';

} else {

	echo '</div><!-- /.icon-list-a -->';

}