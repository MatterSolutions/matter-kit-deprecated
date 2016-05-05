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
*   404 Template
*
 ---------------------------------------------------------- */


get_header();

echo '<section class="band  band--huge  u-keyline  u-text--center">';

	echo '<div class="wrap">';

		echo '<h1 class="display-heading--delta  u-flush--bottom">404</h1>';

		echo '<h4 class="display-heading  u-soft--bottom">Page not found</h4>';

		echo '<p class="u-soft--top  u-flush--bottom">' . esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'mttr' ) . '</p>';

	echo '</div>';

	echo '<div class="wrap  wrap--petite  u-soft--bottom">';

		get_search_form();

	echo '</div>';

echo '</section>';

get_footer();
