<?php

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Plugin Name: Matter Solutions UX Enhancements
 * Description: Mothing intrusive, just simple visual enhancements for better UX
 * Version: 1.0.0
 * Author: Matter Solutions
 * Author URI: http://www.mattersolutions.com.au
 */




/*
*	Add a dropdown to the editor
*/
function mttr_text_editor_add_style_dropdown( $buttons ) {

	array_unshift( $buttons, 'styleselect' );
	return $buttons;

}
add_filter( 'mce_buttons_2', 'mttr_text_editor_add_style_dropdown' );





/*
* Callback function to filter the MCE settings
*/
function mttr_editor_before_init_insert_class_options( $settings ) {  


	// Create array of new styles
		$new_styles = array(

			array(

				'title'	=> __( 'Text', 'mttr-text-styles' ),
				'items'	=> array(

					array(  

						'title' => 'Lede',  
						'block' => 'p',  
						'classes' => 'lede',
						'wrapper' => false,

					),


					array(  

						'title' => 'Text Columns',  
						'block' => 'div',  
						'classes' => 'u-text-columns',
						'wrapper' => true,

					),


					array(

						'title' => 'Subheading',  
						'block' => 'h6',
						'classes' => 'subheading  u-flush--bottom',
						'wrapper' => false,
						
					), 

					array(

						'title' => 'Display Heading',  
						'block' => 'h3',
						'classes' => 'display-heading',
						'wrapper' => false,
						
					), 

					array(

						'title' => 'Large Display Heading',  
						'block' => 'h2',
						'classes' => 'display-heading  display-heading--beta',
						'wrapper' => false,
						
					), 
				),
			),

			array(

				'title'	=> __( 'Buttons', 'mttr-buttons' ),
				'items'	=> array(

					array(  

						'title' => 'Primary Button',  
						'selector' => 'a',  
						'classes' => 'btn  btn--primary',
						'wrapper' => false,

					),

					array(  

						'title' => 'Secondary Button',  
						'selector' => 'a',  
						'classes' => 'btn  btn--secondary',
						'wrapper' => false,

					),


					array(  

						'title' => 'Ghosted Button',  
						'selector' => 'a',  
						'classes' => 'btn  btn--ghost',
						'wrapper' => false,

					),

				),
			),
		);

		// Merge old & new styles
		$settings['style_formats_merge'] = false;

		// Add new styles
		$settings['style_formats'] = json_encode( $new_styles );

		// Return New Settings
		return $settings;
  
} 

// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'mttr_editor_before_init_insert_class_options' ); 




/*
*	Display images in WPadmin
*/

// Add featured image column
function mttr_add_featured_image_admin_columns( $defaults ) {

	$defaults = array( 'featured_image' => 'Image') + $defaults;
    return $defaults;

}
 
// Display the featured image
function mttr_display_featured_image_admin_column( $column_name, $post_ID ) {
    
    if ( $column_name == 'featured_image' ) {

        if ( has_post_thumbnail( $post_ID ) ) {

            echo the_post_thumbnail( 'thumbnail' );
       
        }

    }

}



// Add featured image to the admin columns
add_filter( 'manage_posts_columns', 'mttr_add_featured_image_admin_columns' );
add_action( 'manage_posts_custom_column', 'mttr_display_featured_image_admin_column', 10, 2 );


// Add featured image to pages as well
add_filter('manage_page_posts_columns', 'mttr_add_featured_image_admin_columns', 10);
add_action('manage_page_posts_custom_column', 'mttr_display_featured_image_admin_column', 10, 2);






/**
 * Add the abilty to edit menus as an EDITOR role
 */
$roleObject = get_role( 'editor' );
if ( !$roleObject->has_cap( 'edit_theme_options' ) ) {

    $roleObject->add_cap( 'edit_theme_options' );
    
}




/*
*	Add styling for ACF etc in the admin
*/
add_action( 'admin_enqueue_scripts', 'mttr_add_admin_stylesheets' );
function mttr_add_admin_stylesheets() {

	if ( is_admin() ) {

		$plugin_name = plugin_basename( __FILE__ );

		// ACF stylesheet
		$acf_stylesheet = '/wp-content/plugins/' . plugin_dir_path( $plugin_name ) . 'css/matter-acf-styles.css';
		wp_enqueue_style( 'mttr_acf_styles', $acf_stylesheet, false, '1.0.0' );


		// Column stylesheet
		$acf_stylesheet = '/wp-content/plugins/' . plugin_dir_path( $plugin_name ) . 'css/matter-admin-styles.css';
		wp_enqueue_style( 'mttr_admin_styles', $acf_stylesheet, false, '1.0.0' );

	}

}



function mttr_tiny_mce_before_init( $init_array ) {
    $init_array['body_class'] = 'mttr-wysiwyg';
    return $init_array;
}
add_filter('tiny_mce_before_init', 'mttr_tiny_mce_before_init');



/*
*	Populate ACF icon choices
*/
function mttr_acf_load_icons( $field ) {

	$icon_dir = get_stylesheet_directory() . '/assets/img/icons/';
	$icon_arr = glob( $icon_dir . '*.svg' );

	$field[ 'choices' ] = array();

	foreach( $icon_arr as $icon ) {

		$field[ 'choices' ][ esc_attr( basename( $icon ) ) ] = basename( $icon );

	}

    return $field;
    
}

// name
add_filter('acf/load_field/name=mttr_feature_icon', 'mttr_acf_load_icons');

// key
add_filter('acf/load_field/key=field_56f66fd5f8b45', 'mttr_acf_load_icons');




/*
*	Populate ACF feature choices
*/
/*
*	Populate ACF feature choices
*/
function mttr_acf_load_features( $field ) {

	if ( function_exists ( 'mttr_get_feature_data_array' ) ) {

		$feature_types = mttr_get_feature_data_array();
		
	    $field[ 'choices' ] = array();

		foreach( $feature_types as $key => $value ) {

			$field[ 'choices' ][ esc_attr( $key ) ] = esc_html( $value[ 'listing_label' ] );

		}

   		return $field;

   	}

   	return false;
    
}

// key
add_filter( 'acf/load_field/key=field_56f669dc451a7', 'mttr_acf_load_features' );









/* --------------------------------------------------------
*        __ __  __
*      /  /   /   /     __/__/__
*      \ /   /   /  __   /  /  __  (/__
*       /   /   / /  /  /  /  /__) /  /
*      /   /   / (__/__/_ /__/____/  /_/
*              \
*                SOLUTIONS
*
*   Shortcodes
*   Declare shortcodes
*
 ---------------------------------------------------------- */


/*
*	Shortcode for the head office phone number
*/

add_shortcode( 'mttr_phone_number', 'mttr_phone_number_shortcode' );

function mttr_phone_number_shortcode( $atts ) {

	$phone_number = mttr_get_phone_number();

	$a = shortcode_atts( array(
		'tel' => '',
		'number' => $phone_number,
	), $atts );

	if ( $phone_number && $a['tel'] != '' ) {

		return mttr_tel_filter_phone_number( esc_attr( $a[ 'number' ] ) );

	}

	return esc_attr( $a[ 'number' ] );

}




/*
*	Shortcode for the head office email address
*/

add_shortcode( 'mttr_email_address', 'mttr_email_address_shortcode' );

function mttr_email_address_shortcode( $atts ) {

	$email_address = mttr_get_email_address( );

	$a = shortcode_atts( array(
		'mailto' => '',
		'address' => $email_address,
	), $atts );

	if ( $email_address && $a['mailto'] != '' ) {

		return mttr_tel_filter_phone_number( esc_attr( $a[ 'address' ] ) );

	}

	return esc_attr( $a[ 'address' ] );

}



/*
*	Shortcode for the head office fax number
*/

add_shortcode( 'mttr_fax_number', 'mttr_fax_number_shortcode' );

function mttr_fax_number_shortcode( $atts ) {

	$fax_number = mttr_get_fax_number( );

	$a = shortcode_atts( array(
		'tel' => '',
		'number' => $fax_number,
	), $atts );

	if ( $fax_number  &&  $a['tel'] != '' ) {

		return mttr_tel_filter_phone_number( esc_attr( $a[ 'number' ] ) );

	}

	return esc_attr( $a[ 'number' ] );

}



/*
*	Shortcode for the head office physical address
*/

add_shortcode( 'mttr_address', 'mttr_address_shortcode' );

function mttr_address_shortcode( $atts ) {

	$detail = get_field( 'mttr_options_contact_physical_address', 'options' );

	$a = shortcode_atts( array(
		'address' => $detail,
	), $atts );

	return apply_filters( 'the_content', $a[ 'address' ] );

}




/*
*	Shortcode for the head office postal address
*/

add_shortcode( 'mttr_postal_address', 'mttr_postal_address_shortcode' );

function mttr_postal_address_shortcode( $atts ) {

	// Get the postal address
	$detail = get_field( 'mttr_options_contact_postal_address', 'options' );

	// If the postal address is empty, get the physical address
	if ( empty( $detail ) ) {

		$detail = get_field( 'mttr_options_contact_physical_address', 'options' );

	}

	$a = shortcode_atts( array(
		'address' => $detail,
	), $atts );

	return apply_filters( 'the_content', $a[ 'address' ] );

}




/*
*	Shortcode for adding icons - this is connected with the JS SVG Injector
*/
add_shortcode( 'mttr_icon', 'mttr_icon_shortcode' );

function mttr_icon_shortcode( $atts ) {

	$a = shortcode_atts( array(
		'icon' => '',
		'size' => '',
		'before' => '',
	), $atts );



	if ( $a[ 'icon' ] != '' ) {

		$icon = '<i class="icon';

			if ( $a[ 'size' ] != '' ) {

				$icon .= '  icon--' . esc_attr( $a[ 'size' ] );

			}

			if ( $a[ 'before' ] != '' ) {

				$icon .= '  icon--before';

			}

			$icon .= '">';

			$icon .= mttr_get_icon( esc_attr( $a[ 'icon' ] ) . '.svg' );

		$icon .= '</i>';

		return $icon;

	} else {

		return false;

	}

}