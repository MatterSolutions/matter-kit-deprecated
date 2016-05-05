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
*	Map
*	Output a map with location maker
*	If no locations are supplied, it will output a map with the 
*	global head office data.
*
 ---------------------------------------------------------- */

	// Get vars
	$locations = mttr_get_template_var( 'locations' );
	$modifiers = mttr_get_template_var( 'modifiers' );

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}
	


	/*
	*	Output the content
	*/
	if ( $locations ) {

		echo '<div class="js-google-map  map' . esc_html( $modifiers ) . '">';

			echo '<div class="map__body">';

				if ( is_array( $locations  &&  isset( $locations[ 0 ][ 'location' ][ 'lat' ] ) ) ) {

					foreach( $locations as $location ) {

						echo '<div class="marker" data-marker-image="' . get_stylesheet_directory_uri() . '/assets/img/location-pin.png" data-lat="' . esc_html( $location['location']['lat'] ) . '" data-lng="' . esc_html( $location['location']['lng'] ) . '">';

							echo '<div class="marker__body">';

								echo '<h4 class="marker__title">' . esc_html( $location['location_name'] ) . '</h4>';

								echo '<div class="marker__address">';

									if ( $location[ 'postal_address' ] ) {
								
										echo apply_filters( 'the_content', $location['postal_address'] );

									} else {

										echo do_shortcode( '[mttr_address]' );
										
									}

								echo '</div>';

								echo '<ul class="u-flush--bottom  list list--bare  marker__details">';

								if ( $location['phone_number'] ) {

									echo '<li><strong>Phone:</strong> <a href="tel:' . do_shortcode( '[mttr_phone_number tel="true" number="' . $location['phone_number'] . '"]' ) . '">' . do_shortcode( '[mttr_phone_number number="' . $location['phone_number'] . '"]' ) . '</a></li>';
								
								} else {

									echo '<li><strong>Phone:</strong> <a href="tel:' . do_shortcode( '[mttr_phone_number tel="true"]' ) . '">' . do_shortcode( '[mttr_phone_number]' ) . '</a></li>';

								}

								if ( $location['fax_number'] ) {

									echo '<li><strong>Fax:</strong> <a href="tel:' . do_shortcode( '[mttr_phone_number tel="true" number="' . $location['fax_number'] . '"]' ) . '">' . do_shortcode( '[mttr_phone_number number="' . $location['fax_number'] . '"]' ) . '</a></li>';
								
								}

								if ( $location['email_address'] ) {

									echo '<li><strong>Email:</strong> <a href="mailto:' . antispambot( esc_html( $location['email_address'] ) ) . '">' . antispambot( esc_html( $location['email_address'] ) ) . '</a></li>';
								
								} else {

									echo '<li><strong>Email:</strong> <a href="mailto:' . do_shortcode( '[mttr_email_address]' ) . '">' . do_shortcode( '[mttr_email_address]' ) . '</a></li>';

								}

								echo '</ul>';

							echo '</div>';

						echo '</div><!-- /.marker -->';

					} 		

				} else {

					$map_location = get_field( 'mttr_options_contact_map_location', 'options' );

					echo '<div class="marker" data-marker-image="' . get_stylesheet_directory_uri() . '/assets/img/location-pin.png" data-lat="' . esc_html( $map_location['lat'] ) . '" data-lng="' . esc_html( $map_location['lng'] ) . '">';

						echo '<div class="marker__body">';

							echo '<h4 class="flush--top">' . get_bloginfo( 'name' ) . '</h4>';
							echo do_shortcode( '[mttr_address]' );

							echo '<ul class="flush--bottom  list  list--bare">';
								echo '<li><strong>Phone:</strong> <a href="tel:' . do_shortcode( '[mttr_phone_number tel="true"]' ) . '">' . do_shortcode( '[mttr_phone_number]' ) . '</a></li>';
								echo '<li><strong>Email:</strong> <a href="mailto:' . do_shortcode( '[mttr_email_address]' ) . '">' . do_shortcode( '[mttr_email_address]' ) . '</a></li>';
							echo '</ul>';

						echo '</div>';

					echo '</div><!-- /.marker -->';

				}	

			echo '</div><!-- /.map__body -->';
		
		echo '</div><!-- /.map -->';

	}