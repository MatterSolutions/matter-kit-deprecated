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
*   Base theme functions
*
 ---------------------------------------------------------- */

if ( ! function_exists( 'mttr_setup' ) ) {

	function mttr_setup() {
		
		load_theme_textdomain( 'mttr', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		// Register theme menus
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'mttr' ),
			'secondary' => esc_html__( 'Secondary', 'mttr' ),
			'sidebar' => esc_html__( 'Sidebar', 'mttr' ),
			'footer' => esc_html__( 'Footer', 'mttr' ),
			'legal' => esc_html__( 'Legal', 'mttr' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Post formats
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		// Generic image sizes for layout
		add_image_size( 'mttr_hero', 1500, 800, true );
		add_image_size( 'mttr_square', 800, 800, true );

	}

}
add_action( 'after_setup_theme', 'mttr_setup' );



// Enqueue scripts etc
function mttr_scripts() {

	if (!is_admin()) {

		wp_deregister_script( 'jquery' ); 
		wp_register_script( 'jquery', '//code.jquery.com/jquery-1.11.3.min.js', array(), '1.3.2' ); 
		wp_enqueue_script( 'jquery' );

	}

	// Enqueue styletile css for the styleguide page
	if ( is_page( 'styleguide') ) {

		wp_enqueue_style( 'mttr-styletile-font', '//fonts.googleapis.com/css?family=Montserrat:700,400' );
		wp_enqueue_style( 'mttr-styletile-style', get_template_directory_uri() . '/assets/css/styletile.css' );

	}

	// Base Stylesheet
	wp_enqueue_style( 'mttr-style', get_template_directory_uri() . '/assets/css/main.css' );

	// Serve uncompressed JS on local, but compressed on production
	if ( MTTR_LIVE_ENVIRONMENT == false ) {
    
    	// Base Scripts
		wp_enqueue_script( 'mttr-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '20150623', true );

    } else {

		// Base Scripts
		wp_enqueue_script( 'mttr-scripts', get_template_directory_uri() . '/assets/js/scripts.min.js', array('jquery'), '20150623', true );

	}

}
add_action( 'wp_enqueue_scripts', 'mttr_scripts' );

/**
 * Matter Kit Base Theme Functions
 */
require get_template_directory() . '/inc/mttr-functions.php';

/**
 * Matter Kit Feature Config
 */
require get_template_directory() . '/inc/mttr-features.php';

/**
 * Matter Kit Hero Config
 */
require get_template_directory() . '/inc/mttr-heroes.php';

/**
 * Matter Kit Component API
 */
require get_template_directory() . '/inc/mttr-component-layer.php';



//* Add ACF options page...
if ( function_exists( 'acf_add_options_page' ) ) {

	acf_add_options_page( array(
		'page_title' 	=> 'Theme Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> 'General Theme Settings'
	) );

	acf_add_options_sub_page( array(
		'page_title' 	=> 'General Theme Settings',
		'menu_title'	=> 'General Theme Settings',
		'parent_slug'	=> 'theme-general-settings',
	) );

	acf_add_options_sub_page( array(
		'page_title' 	=> 'Contact Theme Settings',
		'menu_title'	=> 'Contact Theme Settings',
		'parent_slug'	=> 'theme-general-settings',
	) );

}


// Push Gravity Forms to the footer
add_filter( 'gform_init_scripts_footer', '__return_true' );

// Set the tabindex to false
add_filter( 'gform_tabindex', '__return_false' );



// Add excerpt support to pages
add_action( 'init', 'mttr_add_excerpts_to_pages' );
function mttr_add_excerpts_to_pages() {

     add_post_type_support( 'page', 'excerpt' );

}


/*
*	Change the default excerpt length
*/
function mttr_excerpt_length( $length ) {
    
    return 30;
}
add_filter( 'excerpt_length', 'mttr_excerpt_length' );



/*
*	Change the default excerpt [...]
*/
function mttr_excerpt_more($excerpt) {

	return '...';

}
add_filter( 'excerpt_more', 'mttr_excerpt_more' );



// Remove emoji scripts
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );



// Output OG tags
add_action( 'wp_head', 'mttr_open_graph_tags' );
function mttr_open_graph_tags() {

	if ( !is_archive() ) {

		$hero_image = get_field( 'mttr_options_hero_default_image', 'options' );

		// Main front page
		if ( is_front_page() ) {

		// Blog
		} elseif ( is_home() ) {

			if ( has_post_thumbnail( get_option( 'page_for_posts' ) ) ) {

				$hero_image = get_post_thumbnail_id( get_option( 'page_for_posts' ) );

			}

		// Everything else
		} else {
			
			if ( has_post_thumbnail( get_the_ID() ) ) {

				$hero_image = get_post_thumbnail_id( );

			}

		}

		// Get the image URL
		$hero_image_url = wp_get_attachment_image_src( $hero_image, 'hero' );

		if ( $hero_image_url ) {

			$hero_image_url = $hero_image_url[0];

		}

		echo '<meta property="og:title" content="' . get_the_title() . '">';
		echo '<meta property="og:site_name" content="' . get_the_title() . '">';
		echo '<meta property="og:url" content="' . get_the_permalink() . '">';
		echo '<meta property="og:image" content="' . esc_url( $hero_image_url ) . '">';

	}

}






/**
 * Extend WordPress search to include custom fields
 *
 * http://adambalee.com
 * http://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    
    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;
   
    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );


// Add editor stylesheet
add_editor_style( get_stylesheet_directory_uri() . '/assets/css/editor.css' );


// Count the words in a supplied string
function mttr_count_words( $str ) {

    $count = str_word_count( strip_tags( $str ) );
    return $count;
    
}





/**
 * Flush out the transients used in mttr_categorized_blog.
 */
function mttr_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'mttr_categories' );
}
add_action( 'edit_category', 'mttr_category_transient_flusher' );
add_action( 'save_post',     'mttr_category_transient_flusher' );




if ( ! function_exists( 'mttr_paged_navigation' ) ) {
	/**
	 * Display paged navigation.
	 */
	function mttr_paged_navigation( $numpages = '', $pagerange = '', $paged='' ) {

		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}

		$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$query_args   = array();
		$url_parts    = explode( '?', $pagenum_link );

		if ( isset( $url_parts[1] ) ) {
			wp_parse_str( $url_parts[1], $query_args );
		}

		$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
		$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

		$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

		// Set up paginated links.
		$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $GLOBALS['wp_query']->max_num_pages,
			'current'  => $paged,
			'mid_size' => 3,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => __( '&larr; Previous', 'yourtheme' ),
			'next_text' => __( 'Next &rarr;', 'yourtheme' ),
			'type'      => 'list',
		) );

		if ( $links ) {

			echo '<nav class="pagination">';

				echo $links;

			echo '</nav>';

		}

	}

}