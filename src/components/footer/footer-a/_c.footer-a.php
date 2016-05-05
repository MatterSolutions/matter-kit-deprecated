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
*	Footer A
*	Displays the footer menu in columns
*
 ---------------------------------------------------------- */

	// Get vars
	$brand = mttr_get_template_var( 'brand' );
	$primary = mttr_get_template_var( 'primary' );
	$secondary = mttr_get_template_var( 'secondary' );
	$contact = mttr_get_template_var( 'contact' );
	$menu = mttr_get_template_var( 'menu' );
	$modifiers = mttr_get_template_var( 'modifiers' );

	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}


	/*
	*	Begin outputting component
	*/
	
	if ( $menu || $brand ) {

		echo '<section class="band  footer-a' . esc_html( $modifiers ) . '">';

			echo '<div class="wrap">';

				echo '<ul class="layout  layout--large  listing">';

					if ( $brand || $contact ) {

						echo '<li class="layout__item  listing__item  footer-a__primary">';

							if ( $primary ) {

								echo '<h6 class="footer-a__subheading">' . esc_html( $primary ) . '</h6>';

							}

							echo '<ul class="listing">';

								if ( $brand ) {

									echo '<li class="listing__item">';

										echo '<div class="avatar  avatar--large">';

											echo mttr_brand();

										echo '</div>';

									echo '</li>';

								}

								if ( mttr_get_phone_number() ) {

									echo '<li class="listing__item">';

										echo '<h6><i class="icon  icon--before  icon--small">' . mttr_get_icon( 'phone-rev.svg' ) . '</i>Phone</h6>';

										// Output phone number
										mttr_phone_number();

									echo '</li>';

								}

								if ( mttr_get_fax_number() ) {

									echo '<li class="listing__item">';

										echo '<h6><i class="icon  icon--before  icon--small">' . mttr_get_icon( 'print.svg' ) . '</i>Fax</h6>';

										// Output fax number
										mttr_fax_number();

									echo '</li>';

								}

								if ( mttr_get_email_address() ) {

									echo '<li class="listing__item">';

										echo '<h6><i class="icon  icon--before  icon--small">' . mttr_get_icon( 'mail.svg' ) . '</i>Email</h6>';

										// Output email address
										mttr_email_address();

									echo '</li>';

								}

								if ( mttr_get_physical_address() ) {

									echo '<li class="listing__item">';

										echo '<h6><i class="icon  icon--before  icon--small">' . mttr_get_icon( 'location-pin.svg' ) . '</i>Address</h6>';

										echo '<div class="u-negate-btm-margin">';

											// Output physical address
											mttr_physical_address();

										echo '</div>';

									echo '</li>';

								}

							echo '</ul>';

							

						echo '</li>';

					}

					if ( $menu ) {

						echo '<li class="layout__item  listing__item  footer-a__secondary">';

							if ( $secondary ) {

								echo '<h6 class="footer-a__subheading">' . esc_html( $secondary ) . '</h6>';

							}

							wp_nav_menu( $menu );

						echo '</li>';

					}

				echo '</ul>';

			echo '</div>';

		echo '</section>';

	}