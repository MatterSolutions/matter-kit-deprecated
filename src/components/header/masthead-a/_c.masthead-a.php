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
*	Masthead A
*	Vanilla masthead, this is really, really basic
*
 ---------------------------------------------------------- */

	// Get vars
	$search = mttr_get_template_var( 'search' );
	$primary_menu = mttr_get_template_var( 'primary_menu' );
	$secondary_menu = mttr_get_template_var( 'secondary_menu' );
	$modifiers = mttr_get_template_var( 'modifiers' );
	$toggle_beta = mttr_get_template_var( 'toggle_beta' );


	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}


	/*
	*	Begin block output
	*/
	echo '<header class="masthead' . esc_html( $modifiers ) . '" role="banner">';

		echo '<div class="masthead__body">';

			echo '<div class="masthead__content">';

				echo '<ul class="list  list--bare  masthead__toggles">';

					echo '<li class="list__item  toggle--alpha">';

						echo '<button data-toggle-class="navigation--primary-is-open  off-canvas  off-canvas--left" data-toggle-target="body" class="menu-icon  btn  btn--transparent  btn--icon  toggle  js-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="menu-icon__body"><i class="menu-icon__bars"></i></span><i class="u-screen-reader-text">Toggle Menu</i></button>';

					echo '</li><li class="list__item  toggle--beta">';

						if ( $toggle_beta && $toggle_beta == 'search' ) {



						} else {

							echo '<a href="tel:' . do_shortcode( '[mttr_phone_number tel="true"]' ) . '" class="btn  btn--transparent  btn--icon  toggle  ga--phone  ga--phone-header">';

								echo '<i class="icon">' . mttr_get_icon( 'phone.svg' ) . '</i>';
								echo '<i class="u-screen-reader-text">Call us on ' . do_shortcode( '[mttr_phone_number]' ) . '</i>';

							echo '</a>';
						}

						

					echo '</li><!-- /.list__item -->';

				echo '</ul><!-- /.masthead__toggles -->';

			echo '</div>';


			echo '<div class="wrap">';

				echo '<ul class="layout  layout--middle  layout--flush">';

					echo '<li class="masthead__primary  layout__item">';

						echo '<a class="brand" href="' . esc_url( home_url( '/' ) ) . '" rel="home">';

							if ( get_field( 'mttr_options_brand_logo_alt', 'options' ) ) {

								echo '<div class="brand__primary  u-show@desk">';

									mttr_brand(); 

								echo '</div>';

								echo '<div class="brand__secondary  u-hide@desk">';

									mttr_brand( true ); 

								echo '</div>';

							} else {

								echo '<div class="brand__primary">';

									mttr_brand(); 

								echo '</div>';

							}

						echo '</a>';

					echo '</li><li class="masthead__secondary  layout__item">';

						echo '<ul class="layout  layout--small  layout--middle  layout--auto">';

							if ( $search ) {

								echo '<li class="layout__item  masthead__search">';

									get_search_form();

								echo '</li><!-- /.masthead__search -->';

							}

								echo '<li class="layout__item  masthead__nav">';

								echo '<nav role="navigation">';

									if ( $primary_menu ) {

										wp_nav_menu( $primary_menu );

									}

									if ( $secondary_menu ) {

										wp_nav_menu( $secondary_menu );

									}

								echo '</nav>';

							echo '</li><!-- /.masthead__nav -->';


							if ( $search ) {

								echo '<li class="layout__item  masthead__toggle">';

									echo '<button data-toggle-class="search--featured-is-open" data-toggle-target="body" class="btn  btn--transparent  btn--icon  toggle  toggle--gamma  js-toggle">';

										echo '<i class="icon">' . mttr_get_icon( 'magnifying-glass.svg' ) . '</i>';
										echo '<i class="u-screen-reader-text">Toggle Search</i>';

									echo '</button>';

								echo '</li><!--/.masthead__toggle -->';

							}

						echo '</ul><!--/.layout -->';

					echo '</li><!-- /.masthead__secondary -->';

				echo '</ul><!--/.layout -->';

			echo '</div><!-- /.wrap -->';

		echo '</div><!-- /.masthead__body -->';

	echo '</header><!-- .masthead -->';