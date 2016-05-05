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
*   Functions
*   Helper functions for use within template parts
*
 ---------------------------------------------------------- */



/*
*	Output the brand image
*/
function mttr_brand( $alt = false ) {

	$brand = mttr_get_brand( $alt );

	if ( $brand ) {

		echo $brand;

	}

	return false;

}






/*
*	Get the brand image
*/
function mttr_get_brand( $alt = false ) {

	if ( $alt ) {

		$logo = get_field( 'mttr_options_brand_logo_alt', 'options' );

	} else {

		$logo = get_field( 'mttr_options_brand_logo', 'options' );

	}

	if ( $logo ) {

		return '<img class="brand-image" alt="' . get_bloginfo( 'name' ) . ' Logo" src="' . esc_url( $logo ) . '">';

	} else {

		return '<img class="brand-image" alt="' . get_bloginfo( 'name' ) . ' Logo" src="' . get_stylesheet_directory_uri( ) . '/assets/img/matter-solutions-logo.svg">';

	}

}






/*
*	Return the file size of a given file
*/
function mttr_get_file_size( $file ) {

	$bytes = filesize( $file );
	$s = array('b', 'Kb', 'Mb', 'Gb');
	$e = floor( log( $bytes ) / log( 1024 ) );

	return sprintf( '%.2f '.$s[$e], ( $bytes / pow( 1024, floor( $e ) ) ) );

}






/*
*	Output the social menu
*/
function mttr_social_menu( ) {

	$social_menu = get_field( 'mttr_option_social_media', 'options' );

	if ( $social_menu ) {

		$output = '';

		$output .= '<ul class="social-menu  layout  layout--auto  layout--small  list  list--inline">';

			foreach( $social_menu as $social_media ) {

				$output .= '<li class="layout__item  list__item  social-menu__item">';

					$output .= '<a class="ga--social" href="' . esc_url( $social_media['url'] ) . '">';

						$output .= '<i class="icon">';

							$output .= mttr_get_icon( esc_html( $social_media['account_type'] ) . '.svg' );

						$output .= '</i>';

						if ( !empty( $social_media['name'] ) ) {

							$output .= '<span class="u-screen-reader-text">';

								$output .= esc_html( $social_media['name'] );

							$output .= '</span>';

						}

					$output .= '</a>';

				$output .= '</li>';

			}

		$output .= '</ul>';

		return $output;

	}

	return false;

}







/*
*	Output a link to the HEAD OFFICE phone number
*/
function mttr_phone_number( $icon = false ) {

	$detail = mttr_get_phone_number( );

	if ( $detail ) {

		echo '<a href="tel:' . esc_html( mttr_tel_filter_phone_number( $detail ) ) . '">';

			if ( $icon ) mttr_icon( 'icon-phone.svg' );
			echo $detail;

		echo '</a>';

		return true;

	}

	return false;

}






/*
*	Return the HEAD OFFICE phone number
*/
function mttr_get_phone_number( ) {

	$detail = get_field( 'mttr_options_contact_phone_number', 'options' );

	if ( $detail ) {

		return $detail;

	}

	return false;

}






/*
*	Run a tel: filter over the phone number
*/
function mttr_tel_filter_phone_number( $phone_number ) {

	return preg_replace( '/[^0-9]/', '', $phone_number );

}






/*
*	Output the fax number
*/
function mttr_fax_number( $icon = false ) {

	$detail = mttr_get_fax_number( );

	if ( $detail ) {

		echo '<a href="tel:' . esc_html( mttr_tel_filter_phone_number( $detail ) ) . '">';

			if ( $icon ) mttr_icon( 'icon-fax.svg' );
			echo $detail;

		echo '</a>';

		return true;

	}

	return false;

}







/*
*	Get the fax number
*/
function mttr_get_fax_number( ) {

	$detail = get_field( 'mttr_options_contact_fax_number', 'options' );

	if ( $detail ) {

		return $detail;

	}

	return false;

}






/*
*	Output a link to the HEAD OFFICE email address
*/
function mttr_email_address( $icon = false ) {

	$detail = mttr_get_email_address( );

	if ( $detail ) {

		echo '<a href="mailto:' . antispambot( $detail ) . '">';

			if ( $icon ) mttr_icon( 'icon-mail.svg' );
			echo $detail;

		echo '</a>';

		return true;

	}

	return false;

}






/*
*	Get the HEAD OFFICE email address
*/
function mttr_get_email_address( ) {

	$detail = get_field( 'mttr_options_contact_email_address', 'options' );

	if ( $detail ) {

		return $detail;

	}

	return false;

} 






/*
*	Output the HEAD OFFICE physical address
*/
function mttr_physical_address( $icon = false ) {

	$detail = mttr_get_physical_address( );

	if ( $detail ) {

		if ( $icon ) mttr_icon( 'icon-location.svg' );
		echo apply_filters( 'the_content', $detail );

		return true;

	}

	return false;

}






/*
*	Get the HEAD OFFICE physical address
*/
function mttr_get_physical_address( $address = null ) {

	$detail = get_field( 'mttr_options_contact_physical_address', 'options' );

	if ( $detail ) {

		return $detail;

	}

	return false;

}





/*
*	Unformat an address (remove tags and BRs)
*/
function mttr_unformat_address( $address = null ) {

	if ( $address ) {

		$address = strip_tags( $address );
		$address = str_replace( '<br>', '', $address );
		$address = str_replace( '<br />', '', $address );

		return $address;

	}

	return false;

}





/*
*	Get the link to the google maps directions
*/
function mttr_get_directions_uri( $address ) {

	$address = mttr_unformat_address( mttr_get_physical_address( ) );

	if ( $address ) {

		return esc_url( 'https://maps.google.com?daddr=' . urlencode( $address ) );

	}

	return false;

}





/*
*	Output an icon 
*/
function mttr_get_icon( $icon, $fallback = false ) {

	if ( $icon ) {

		// Check to see if the icon exists
		$file = 'assets/img/icons/' . esc_html( $icon );

		$stylesheet_directory = trailingslashit( get_stylesheet_directory() );
		$stylesheet_directory_uri = trailingslashit( get_stylesheet_directory_uri() );
		

		// If file exists, create new path
		if ( file_exists( ( $stylesheet_directory . $file ) ) ) {

			$file_path_info = pathinfo( ( $stylesheet_directory_uri . $file ) );
			$file_uri = $stylesheet_directory_uri . 'assets/img/icons/' . esc_html( $icon );

			if ( strtolower( $file_path_info['extension'] ) == 'svg' ) {

				$file_fallback = 'assets/img/icons/png/' . esc_html( $file_path_info['filename'] . '.png' );

				if ( file_exists( ( $stylesheet_directory . $file_fallback ) ) && $fallback ) {

					return '<img src="' . ( $stylesheet_directory_uri . $file_fallback ) . '" class="js-inject-svg" alt="" data-src="' . ( $stylesheet_directory_uri . $file ) . '">';

				} else {

					return '<img src="" class="js-inject-svg" alt="" data-src="' . ( $stylesheet_directory_uri . $file ) . '">';

				}
				

			} else {

				return '<img alt="" src="' . ( $stylesheet_directory_uri . $file ) . '">';

			}

		}

	}

	return false;

}





/*
*	Output an icon
*/
function mttr_icon( $icon, $fallback = false ) {

	echo mttr_get_icon( $icon, $fallback );

}





/*
*	Useful if you need to limit words for an area
*/
function mttr_excerpt( $text, $trim_length = 30 ) {

	return wp_trim_words( $text, $trim_length, '' );

}





/*
*	Get featured image URL
*/
function mttr_get_post_thumbnail_url( $id, $imgsize = 'mttr_hero' ){

	if ( has_post_thumbnail( $id ) ) {
		
		$img_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $imgsize );

		if ( isset( $img_arr[0] ) ) {

			return $img_arr[0];

		}
		
		return false;		

	} else {

		return false;

	}

}






/*
*	Get the GLOBAL default featured image URL
*/
function mttr_get_default_image( $imgsize = 'mttr_hero' ){

	$default_hero = get_field( 'mttr_options_hero_default_image', 'options' );

	if ( $default_hero ) {
		
		$img_arr = wp_get_attachment_image_src( get_field( 'mttr_options_hero_default_image', 'options' ), $imgsize );

		if ( isset( $img_arr[0] ) ) {

			return $img_arr[0];

		}
		
		return false;		

	} else {

		return false;

	}

}




function mttr_setup_feature_post_data_array( $array = array(), $listing_type ) {

	$data = array();

	foreach( $array as $value ) {

		$data[] = mttr_setup_feature_post_data( $value, esc_attr( $listing_type ), $listing_identifier );

	}

	return $data;

}



function mttr_setup_feature_static_data( $features, $feature_style ) {

	$hero_image_url = false;

	if ( !empty( $features[ 'image' ] ) ) {

		$hero_image_url = wp_get_attachment_image_src( $features[ 'image' ], 'mttr_square' );
		$hero_image_url = $hero_image_url[0];

	}

	$data = array(

		'content' => $features[ 'content' ],
		'cta_link' => $features[ 'link' ],
		'cta_text' => $features[ 'cta_text' ],
		'heading' => $features[ 'heading' ],
		'subheading' => $features[ 'subheading' ],
		'icon' => $features[ 'icon' ],
		'icon_image' => $features[ 'icon_image' ],
		'image' => $hero_image_url,
		'modifiers' => $feature_modifiers

	);

	$data = mttr_setup_feature_data_array( $data, $feature_style );

	return $data;

}



function mttr_setup_feature_data_array( $feature, $feature_style, $listing_identifier = null ) {

	$listing_data = mttr_get_feature_data( esc_attr( $feature_style ) );

	if ( $listing_data ) {

		$heading = false;
		$identifier = false;
		$subheading = false;
		$image = false;
		$content = false;
		$icon = false;
		$icon_image = false;
		$modifiers = false;
		$cta_link = false;
		$cta_text = false;
		$meta = false;
		$categories = false;
		$author = false;
		$tags = false;
		$id = false;

		if ( $listing_data[ 'feature_elements' ][ 'identifier' ] ) {

			if ( $feature[ 'id' ] ) {

				$identifier = ( $listing_identifier . '-' . intval( $feature[ 'id' ] ) );

			} else {

				$identifier = ( $listing_identifier . '-' . rand( 00000, 99999 ) );

			}

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'heading' ] ) {

			$heading = $feature[ 'heading' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'subheading' ] ) {

			$subheading = $feature[ 'subheading' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'image' ] ) {

			$image = $feature[ 'image' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'content' ] ) {

			$content = $feature[ 'content' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'icon' ] ) {

			$icon = $feature[ 'icon' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'icon_image' ] ) {

			$icon_image = $feature[ 'icon_image' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'modifiers' ] ) {

			$modifiers = $feature[ 'modifiers' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'cta_link' ] ) {

			$cta_link = $feature[ 'cta_link' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'cta_text' ] ) {

			$cta_text = $feature[ 'cta_text' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'meta' ] ) {

			$meta = $feature[ 'meta' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'categories' ] ) {

			$categories = $feature[ 'categories' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'tags' ] ) {

			$tags = $feature[ 'tags' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'author' ] ) {

			$author = $feature[ 'author' ];

		}

		// Set up the elements
		if ( $listing_data[ 'feature_elements' ][ 'id' ] ) {

			$id = $feature[ 'id' ];

		}


		$data = array(

			'id' => $id,
			'identifier' => $identifier,
			'author' => $author,
			'categories' => $categories,
			'content' => $content,
			'cta_link' => $cta_link,
			'cta_text' => $cta_text,
			'date' => $date,
			'heading' => $heading,
			'icon' => $icon,
			'icon_image' => $icon_image,
			'image' => $image,
			'meta' => $meta,
			'tags' => $tags,
			'modifiers' => $modifiers,

		);

		return $data;

	}

	return false;

}



function mttr_setup_feature_post_data( $id, $feature_style, $listing_identifier ) {

	global $post;

	$post = $id;
	setup_postdata( $post );

	$hero_image_url = false;

	if ( has_post_thumbnail( get_the_ID() ) ) {

		$hero_image = get_post_thumbnail_id( get_the_ID() );
		$hero_image_url = wp_get_attachment_image_src( $hero_image, 'mttr_square' );
		$hero_image_url = $hero_image_url[0];

	}

	$display_meta = false;

	if ( get_post_type() == 'post' ) {

		$display_meta = true;

	}

	$content = get_the_excerpt();

	if ( !$content ) {

		$content_output = '';

		if ( have_rows( 'mttr_content_flexible' ) ) {

			while ( have_rows( 'mttr_content_flexible' ) ) {

				the_row();

				if ( get_row_layout() == 'standard_content' ) {

					$content_output .= get_sub_field( 'content', false, false );
					$content_output .= get_sub_field( 'content_right_column', false, false );

				}

				if ( get_row_layout() == 'features' ) {

					$content_output .= get_sub_field( 'section_title' );
					$content_output .= get_sub_field( 'section_content', false, false );

				}

			}

		}


		$content = wp_trim_words( strip_tags( $content_output ), mttr_excerpt_length( false ) );

	}

	$data = array(

		'id' => get_the_ID(),
		'author' => false,
		'categories' => get_the_category_list( ', ' ),
		'content' => $content,
		'cta_link' => get_the_permalink(),
		'cta_text' => get_field( 'mttr_feature_cta_text' ),
		'date' => get_the_date(),
		'heading' => get_the_title(),
		'icon' => get_field( 'mttr_feature_icon' ),
		'icon_image' => get_field( 'mttr_feature_icon_image' ),
		'image' => $hero_image_url,
		'meta' => $display_meta,
		'tags' => get_the_tags(),
		'modifiers' => $feature_modifiers,

	);

	wp_reset_postdata();

	$data = mttr_setup_feature_data_array( $data, $feature_style, $listing_identifier );

	return $data;

}



/*
*	Get related posts
*/
function mttr_get_related_posts( $post_id, $posts_per_page ) {
	
	$counter = 0;
	$features = array();

	$specified_posts = get_field( 'mttr_posts_related', $post_id );
	$tags = wp_get_post_tags( $post_id );
	$categories = wp_get_post_categories( $post_id );


	// Get specified posts
	if ( $specified_posts ) {

		foreach ( $specified_posts as $featured_post ) {

			$features[] = $featured_post;

		}

	}

	// Get tags
	if ( count( $features ) < intval( $posts_per_page )  &&  $tags ) {

		// Loop through and get all tags
		$tag_ids = array();
		foreach( $tags as $tag ) {

			$tag_ids[] = $tag->term_id;

		}


		/*
		*	Find similar tagged posts
		*/
		$tag_query = new WP_Query( 

			array( 

				'tag__in' => $tag_ids,
				'post__not_in' => array( $post_id ),
				'posts_per_page' => intval( $posts_per_page ),

			) 

		);


		if ( $tag_query->have_posts() ) {

			while ( $tag_query->have_posts() ) {

				$tag_query->the_post();
				$features[] = get_the_ID();

			}

		}

		wp_reset_postdata();

	}


	// Get posts from same categories
	if ( count( $features ) < intval( $posts_per_page ) ) {

		$existing_features = $features;
		$existing_features[] = $post_id;


		/*
		*	Find similar category posts
		*/
		$cat_query = new WP_Query( 

			array( 

				'category__in' => $categories,
				'post__not_in' => $existing_features,
				'posts_per_page' => intval( $posts_per_page - count( $features ) ),

			) 

		);

		if ( $cat_query->have_posts() ) {

			while ( $cat_query->have_posts() ) {

				$cat_query->the_post();
				$features[] = get_the_ID();

			}

		}

		wp_reset_postdata();

	}


	// If there's still not enough, JUST GET MORE POSTS
	if ( count( $features ) < intval( $posts_per_page ) ) {

		$existing_features = $features;
		$existing_features[] = $post_id;


		/*
		*	Find similar category posts
		*/
		$cat_query = new WP_Query( 

			array( 

				'post__not_in' => $existing_features,
				'posts_per_page' => intval( $posts_per_page - count( $features ) ),

			) 

		);

		if ( $cat_query->have_posts() ) {

			while ( $cat_query->have_posts() ) {

				$cat_query->the_post();
				$features[] = get_the_ID();

			}

		}

		wp_reset_postdata();

	}


	// If there's still none, just return false....
	if ( count( $features ) < 1 ) {

		return false;

	}

	return $features;

}




/*
*	Social sharing
*/

function mttr_get_social_share_data( $network ) {

	if ( $network == 'facebook' ) {

		$data = array(

			'link' => 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink(),
			'name' => 'Facebook',
			'icon' => 'facebook.svg',

		);	

		return $data;

	}

	if ( $network == 'twitter' ) {

		$data = array(

			'link' => 'http://twitter.com/share?text=' . get_the_title() . '&url=' . get_the_permalink() . '&hashtags=' . strtolower( get_bloginfo( 'name' ) ),
			'name' => 'Twitter',
			'icon' => 'twitter.svg',

		);	

		return $data;

	}


	if ( $network == 'googleplus' ) {

		$data = array(

			'link' => 'https://plus.google.com/share?url=' . get_the_permalink(),
			'name' => 'Google +',
			'icon' => 'google.svg',

		);	

		return $data;

	}


	if ( $network == 'linkedin' ) {

		$data = array(

			'link' => 'https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink() . '&title=' . get_the_title(),
			'name' => 'LinkedIn',
			'icon' => 'linkedin.svg',

		);	

		return $data;

	}


	if ( $network == 'pinterest' ) {

		if ( has_post_thumbnail() ) {

			$hero_image = wp_get_attachment_image_src( get_post_thumbnail_ID( get_the_ID( ) ), 'mttr_hero' );
			$hero_image = $hero_image[0];

		} else {

			$hero_image = get_field( 'mttr_options_hero_default_image', 'options' );
			$hero_image = wp_get_attachment_image_src( $hero_image, 'mttr_hero' );
			$hero_image = $image_url[0];

		}


		$data = array(

			'link' => 'https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&media=' . esc_url( $hero_image ),
			'name' => 'Pinterest',
			'icon' => 'pinterest.svg',

		);	

		return $data;

	}


	if ( $network == 'mail' ) {

		$data = array(

			'link' => 'mailto:&subject=' . get_the_title() . '&body=' . get_the_permalink(),
			'name' => 'Email',
			'icon' => 'mail.svg',

		);	

		return $data;

	}

	return false;

}





/*
*	Filter Wordpress Galleries
*/
function mttr_wp_gallery( $output = '', $atts, $instance ) {
	
	$return = $output; // fallback

	// Check to see that there are IDs available
	if ( $atts['ids'] ) {

		$gallery_images = explode( ',', $atts['ids'] );

		$return .= '<ul class="layout  listing  u-soft--bottom  js-popup-gallery">';

			foreach( $gallery_images as $gallery_item ) {

				$image_src = wp_get_attachment_image_src( $gallery_item, 'large' );
				$image_thumb = wp_get_attachment_image_src( $gallery_item, 'mttr_square' );

				// Check to make sure the image src is available
				if ( is_array( $image_src ) ) {
					
					$return .= '<li class="layout__item  listing__item  g-one-third  g-one-fifth@lap">';
						
						$return .= '<a class="image-link  image-link--zoom  overlay" href="' . esc_url( $image_src[0] ) . '">';
							
							$return .=  '<img class="image-link__media" src="' . esc_url( $image_thumb[0] ) . '" alt="" />';

							$return .= '<div class="image-link__content  u-center">';

								$return .= '<i class="image-link__icon  icon  icon--large  overlay__body">' . mttr_get_icon( 'icon-search-masthead.svg' ) . '</i>';

							$return .= '</div>';
						
						$return .= '</a><!-- /.image-link -->';

					$return .= '</li><!-- /.layout__item -->';

				}

			}

		$return .= '</ul><!-- /.layout -->';

	}

	return $return;
}

add_filter( 'post_gallery', 'mttr_wp_gallery', 10, 3 );



function mttr_get_contextual_title() {

	$title = get_the_title();

	if ( is_archive() ) {

		if ( is_category() ) { 

			$title = single_cat_title( '', false );

		} elseif( is_tag() ) { 

			$title = single_tag_title( '', false );

		} elseif ( is_day() ) { 

			$title = 'Archive for ' . date();

		} elseif ( is_month() ) { 

			$title = date( 'F, Y' );

		} elseif( is_year() ) {

			$title = date( 'Y' );

		} elseif( is_author() ) {

			$author = get_userdata( get_query_var( 'author' ) );
			$title = 'Posts by ' . $author->display_name;

		}

	}


	// Blog main
	if ( is_home() && get_option( 'page_for_posts' ) ) {

		$title = get_the_title( get_option( 'page_for_posts' ) );

	}


	// 404
	if ( is_404() ) {

		$title = 'Page not found';

	}


	// Search
	if ( is_search() ) {

		$title = 'Search Results for: ' . get_search_query();

	}


	// Nothing found
	if ( is_search()  &&  !have_posts() ) {

		$title = 'Nothing found';

	}

	return $title;

}



function mttr_get_contextual_subheading() {

	$subheading = '';

	if ( is_archive() ) {

		if ( is_category() ) { 

		} elseif( is_tag() ) { 

		} elseif ( is_day() ) { 

			$subheading = 'Archive for';

		} elseif ( is_month() ) { 

			$subheading = 'Archive for';

		} elseif( is_year() ) {

			$subheading = 'Archive for';

		} elseif( is_author() ) {

			$author = get_userdata( get_query_var( 'author' ) );
			$subheading = 'Posts by ';

		}

	}


	// Search
	if ( is_search() ) {

		$subheading = 'Search Results for: ';

	}


	// Nothing found
	if ( is_search()  &&  !have_posts() ) {

		$subheading = '';

	}

	return $subheading;

}



/*
*	Get the content or description based on what 'page' we're viewing
*/
function mttr_get_contextual_content() {

	$content = get_the_excerpt();

	if ( is_archive() ) {

		if ( is_category() ) { 

			$content = category_description();

		}

		if ( is_tag() ) { 

			$content = tag_description();

		}

		if ( is_author() ) {

			$content = false;

		}

	}


	// Blog main
	if ( is_home() && get_option( 'page_for_posts' ) ) {

		// Blog
		$content = get_post_field( 'post_excerpt', get_option( 'page_for_posts' ) );

	}


	// 404
	if ( is_404() ) {

		$content = 'Sorry, this page doesn\'t seem to exist!';

	}


	// Nothing found
	if ( is_search()  &&  !have_posts() ) {

		$content = 'Please try another search';

	}

	return $content;

}