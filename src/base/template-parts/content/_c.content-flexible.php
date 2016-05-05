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
*	Flexible Content
*	Output the flexible content blocks from ACF
*
 ---------------------------------------------------------- */

// Get the object if specified, this allows us to use this partial on 
// non-standard pages, like archives etc
$obj = get_field( 'object' );

if ( empty( $ojb ) ) {

	$obj = get_the_ID();

}

if ( have_rows( 'mttr_flexible_bands', $obj ) ) {

	$counter = 1;
	$band_data = get_field( 'mttr_flexible_bands', $obj );

	while ( have_rows( 'mttr_flexible_bands', $obj ) ) {

		the_row();

		$band = array(

			'colour' => get_sub_field( 'background_colour' ),
			'image' => get_sub_field( 'background_image' ),
			'size' => get_sub_field( 'size' ),
			'width' => get_sub_field( 'width' ),

		);

		// Empty array to attach modifiers to
		$band_modifiers = array();


		// Band identifier
		$band_modifiers[] = 'band--content-' . $counter;

		// Output the styles for a band background
		if ( $band[ 'image' ] ) {

			$band_modifiers[] = 'band--hero';
			$band_modifiers[] = 'overlay';

			echo '<style>';

				$hero_image_url = wp_get_attachment_image_src( $band[ 'image' ], 'mttr_hero' );
				$hero_image_mobile_url = wp_get_attachment_image_src( $band[ 'image' ], 'mttr_square' );

				$hero_image_url = $hero_image_url[0];			
				$hero_image_mobile_url = $hero_image_mobile_url[0];

				// Output mobile friendly image
				echo '.band--content-' . $counter . '{';

					echo 'background-image: url( \'' . esc_url( $hero_image_mobile_url ) . '\' );';

				echo '}';

				// Output hero image
				echo '@media (min-width: 768px ) {';

					echo '.band--content-' . $counter . '{';

						echo 'background-image: url( \'' . esc_url( $hero_image_url ) . '\' );';

					echo '}';

				echo '}'; // End media query

			echo '</style>';

		}


		// Band colours, set modifiers based on chosen colour
		if ( $band[ 'colour' ] != 'standard' ) {

			$band_modifiers[] = 'band--' . esc_attr( $band[ 'colour' ] );

		}


		// Band sizing, set modifiers based on chosen sizes
		if ( $band[ 'size' ] == 'standard' ) {

			$band_modifiers[] = 'band--large';

		} else if ( $band[ 'size' ] == 'flush' ) {

			$band_modifiers[] = 'u-hard';

		} else if ( $band[ 'size' ] == 'large' ) {

			$band_modifiers[] = 'band--huge';

		} else {

			$band_modifiers[] = 'band--' . esc_attr( $band[ 'size' ] );

		} 


		// Band width, set modifiers based on width
		if ( $band[ 'width' ] == 'extend' ) {

			$band_modifiers[] = 'u-extend';

		}


		// Check bands based on previous colour
		if ( $counter > 1 ) {

			// Set band contextual margins (negate space between like bands)
			if ( $band[ 'image' ] ) {

				// Do nothing....uncomment below for fixed backgrounds
				// $band_modifiers[] = 'u-fixed-background';

			// Remove padding if flush size is chosen
			} else if ( $band[ 'size' ] == 'flush' ) {

				$band_modifiers[] = 'u-hard';

			// Remove the top padding on sequential same-colour bands
			} else if ( $band_data[ $counter - 2 ][ 'background_colour' ]  ==  $band[ 'colour' ] ) {

				$band_modifiers[] = 'u-hard--top';

			}

		}



		$flexible_content = get_sub_field( 'flexible_content' );
		$flexible_content_counter = 0;

		if ( have_rows( 'flexible_content' ) ) {

			$flexible_content_counter++;

			echo '<div class="band  ' . implode( '  ', $band_modifiers ) .  '">';

				echo '<div class="band__body  overlay__body">';

					// Used to create consistent space between each row layout
					echo '<ul class="listing">';

					while ( have_rows( 'flexible_content' ) ) {

						the_row();

						// Wrap each row item in a list item
						echo '<li class="listing__item">';


							
							/*
							*	Get section heading 
							*/
							if ( get_row_layout() == 'section_heading' ) {

								$data = array(

									'content' => get_sub_field( 'content', false, false ),
									'heading' => get_sub_field( 'heading' ),
									'subheading' => get_sub_field( 'subheading' ),

								);

								mttr_get_template( 'template-parts/content/_c.section-heading', $data );								

							}



							/*
							*	Get standard content 
							*/
							if ( get_row_layout() == 'standard_content' ) {

								$data = array(

									'content' => get_sub_field( 'content', false, false ),

								);

								mttr_get_template( 'template-parts/content/_c.content-standard', $data );								

							}


							/*
							*	Get media listing
							*/
							if ( get_row_layout() == 'media' ) {

								$data = array(

									'items' => get_sub_field( 'items' ),

								);

								mttr_get_template( 'template-parts/content/_c.content-media', $data );

							}


							/*
							*	Get content sidebar layout 
							*/
							if ( get_row_layout() == 'content_sidebar' ) {

								$data = array(

									'content' => get_sub_field( 'content', false, false ),
									'sidebar' => get_sub_field( 'sidebar', false, false ),
									'reverse' => get_sub_field( 'reverse' ),

								);

								mttr_get_template( 'template-parts/content/_c.content-sidebar', $data );

							}


							/*
							*	Get sidebar content layout 
							*/
							if ( get_row_layout() == 'sidebar_content' ) {

								$data = array(

									'content' => get_sub_field( 'content', false, false ),
									'sidebar' => get_sub_field( 'sidebar', false, false ),
									'reverse' => get_sub_field( 'reverse' ),

								);

								mttr_get_template( 'template-parts/content/_c.sidebar-content', $data );

							}




							/*
							*	Get Features
							*/
							if ( get_row_layout() == 'features' ) {

								$latest_posts = get_sub_field( 'latest_posts' );
								$per_page = get_sub_field( 'per_page' );
								$style = get_sub_field( 'style' );
								
								// Set up a unique identifier using the band count + the flexible content count
								$listing_identifier = 'listing--' . esc_attr( get_sub_field( 'style' ) ) . '-' . $counter . '-' . $flexible_content_counter;
								
								// Setup empty array for feature data
								$feature_data = array();

								// Check to see if we want the latest posts
								if ( $latest_posts ) {

									if ( empty( $per_page ) ) {

										$per_page = get_option( 'posts_per_page' );

									}

									$args = array(

										'post_type' => 'post',
										'posts_per_page' => intval( $per_page ),

									);

									// The Query
									$the_query = new WP_Query( $args );

									// The Loop
									if ( $the_query->have_posts() ) {

										// Setup new features, using latest posts
										while ( $the_query->have_posts() ) {

											$the_query->the_post();
											$feature_data[] = mttr_setup_feature_post_data( get_the_ID(), $style, $listing_identifier );

										}

									}

								} else {

									if ( have_rows( 'items' ) ) {

										while ( have_rows( 'items' ) ) {

											the_row();

											// Check to see if the item type is static
											if ( get_sub_field( 'type' ) == 'static' ) {

												$data = array(

													'heading' => get_sub_field( 'heading' ),
													'subheading' => get_sub_field( 'subheading' ),
													'content' => get_sub_field( 'content' ),
													'cta_link' => get_sub_field( 'link' ),
													'cta_text' => get_sub_field( 'cta_text' ),
													'icon' => get_sub_field( 'icon' ),
													'icon_image' => get_sub_field( 'icon_image' ),
													'image' => get_sub_field( 'image' ),

												);

												$feature_data[] = mttr_setup_feature_static_data( $data, $style, $listing_identifier );

											// User has chosen post objects
											} else {

												$posts = get_sub_field( 'posts' );

												foreach( $posts as $featured_post ) {

													$feature_data[] = mttr_setup_feature_post_data( $featured_post, $style, $listing_identifier );

												}

											}

										}

									}

								}

								wp_reset_postdata();

								$listing_data = mttr_get_feature_data( esc_attr( get_sub_field( 'style' ) ) );
								$listing_data[ 'listing_identifier' ] = $listing_identifier;

								$data = array(

									'features' => $feature_data,
									'listing_data' => $listing_data,
									'style' => get_sub_field( 'style' ),

								);

								mttr_get_template( 'template-parts/content/_c.content-features', $data );

							}



							/*
							*	Output a google map
							*/
							if ( get_row_layout() == 'map' ) {

								// Enqueue google maps if not enqueued already
								if ( !wp_script_is( 'google-maps', 'enqueued' ) ) {

									wp_register_script( 'google-maps', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array( 'jquery' ), CHILD_THEME_VERSION, true );
									wp_enqueue_script( 'google-maps' );

								}


								$map_location = get_sub_field( 'locations' );

								if ( !$map_location ) {

									$map_location = get_field( 'mttr_options_contact_map_location', 'options' );

								}

								$data = array(

									'locations' => $map_location,

								);

								mttr_get_template( 'template-parts/content/_c.content-map', $data );
								

							}  // map



						echo '</li><!-- /.listing__item -->';

					}

					echo '</ul>';

				echo '</div><!-- /.band__content -->';

			echo '</div><!-- /.band -->';

			// Add to the band counter
			$counter++;

		}

	}

}