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
*   Site Wide Header Template
*
 ---------------------------------------------------------- */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php

	/*
	*	Output Google Tag Manager
	*/

	$gtm_id = get_field( 'mttr_google_tag_manager_id', 'options' );

	if ( $gtm_id ) {

		?><!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=<?php echo esc_html( $gtm_id ); ?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','<?php echo esc_html( $gtm_id ); ?>');</script>
<!-- End Google Tag Manager --><?php

	}

?>

<i class="site-blocker"></i>

<div class="hfeed site">

	<a class="skip-link  u-screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'mttr' ); ?></a>

	<?php 

		// get_template_part( 'template-parts/header/_c.top', 'bar');

		// Masthead data
		$data = array(

			'primary_menu' => array(

				'theme_location' => 'primary',
				'menu_id' => 'primary-menu',
				'menu_class' => 'navigation  navigation--sliding  navigation--horizontal  navigation--primary  u-flush--bottom',
				'after' => '<span class="menu-item-trigger  js-toggle--sub-menu"></span>'

			),
			'secondary_menu' => array(

				'theme_location' => 'secondary',
				'menu_id' => 'secondary-menu-mobile',
				'menu_class' => 'navigation  navigation--sliding  navigation--horizontal  navigation--secondary  navigation--mobile  u-flush--bottom  u-hide@desk',
				'after' => '<span class="menu-item-trigger  js-toggle--sub-menu"></span>'						

			),
			'search' => false,
			'modifiers' => false,

		);

		mttr_get_template( 'template-parts/header/_c.masthead-a', $data );

		// Search
		//get_template_part( 'template-parts/header/_c.search', 'bar');

	?>

	<div id="content" class="site-content">

	<?php

		if ( is_page( 'styleguide' ) ) {

			mttr_get_template( 'template-parts/content/_c.content-styleguide' );

		}

	?>
