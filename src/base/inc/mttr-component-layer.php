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
*   Component API Layer
*   Handles getting templates and getting data from the templates
*
 ---------------------------------------------------------- */


// Get a template
function mttr_get_template( $slug, $data = array() ) {

    set_query_var( 'mttr_template_data', $data );
    get_template_part( $slug );

}



// Get a template variable
function mttr_get_template_var( $var_name = null ) {

    if ( $var_name != '' ) {

        $vars = get_query_var( 'mttr_template_data' );

        if ( isset( $vars[ $var_name ] ) ) {

            return $vars[ $var_name ];

        } else {

            return false;

        }

    // Return the whole array
    } else {

        return get_query_var( 'mttr_template_data' );

    }

}