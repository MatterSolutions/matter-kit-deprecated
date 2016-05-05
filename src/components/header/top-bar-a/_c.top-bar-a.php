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
*	Top Bar A
*	Small bar with two columns for secondary menus etc
*	This only appears on desk up by default
*
 ---------------------------------------------------------- */

	// Get vars
	$primary = mttr_get_template_var( 'primary' );
	$menu = mttr_get_template_var( 'menu' );
	$modifiers = mttr_get_template_var( 'modifiers' );

	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}

echo '<div class="band  top-bar  u-show@desk' . esc_html( $modifiers ) . '">';

	echo '<div class="wrap">';
		
		echo '<ul class="layout">';

			echo '<li class="layout__item  g-one-half@desk">';

				if ( $primary ) {

					echo apply_filters( 'the_content', $primary );

				}

			echo '</li><li class="layout__item  g-one-half@desk  u-text--right">';

				echo '<nav role="navigation">';

					if ( $menu ) {

						wp_nav_menu( 

							$menu

						); 

					}

				echo '</nav>';

			echo '</li>';

		echo '</ul><!-- /.layout -->';

	echo '</div><!-- /.wrap -->';

echo '</div><!-- /.band -->';