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
*	Share links
*	Display links to share the article on social media
*
 ---------------------------------------------------------- */

$order = mttr_get_template_var( 'order' );
$modifiers = mttr_get_template_var( 'modifiers' );

if ( $modifiers ) {

	$modifiers = '  ' . $modifiers;

}


/*	
*	Begin outputting block
*/
if ( $order && is_array( $order ) && count( $order ) >= 1 ) {

	echo '<ul class="social-share' . esc_html( $modifiers ) . '">';

		foreach ( $order as $social ) {

			$social_data = mttr_get_social_share_data( $social );

			if ( $social_data ) {

				echo '<li class="social-share__item">';

					echo '<a href="' . esc_url( $social_data[ 'link' ] ) . '">';

						echo '<i class="icon">' . mttr_get_icon( esc_html( $social_data[ 'icon' ] ) ) . '</i>';

						echo '<i class="u-accessibility">Share this on ' . $social_data[ 'name' ] . '</i>';

					echo '</a>';

				echo '</li>';

			}

		}

	echo '</ul>';

}


