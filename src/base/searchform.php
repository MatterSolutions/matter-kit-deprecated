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
*   Site Search Template
*
 ---------------------------------------------------------- */

?><form role="search" method="get" class="searchform  searchform--mini" action="<?php echo esc_url( home_url( '/' ) ); ?>">

	<label class="u-screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
	<input class="searchform__input" placeholder="Keyword search..." type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />

	<div class="searchform__submit">
	
		<button class="toggle  btn  btn--transparent" type="submit"><i class="icon"><?php echo mttr_get_icon( 'magnifying-glass.svg' ); ?></i></button>

	</div>

</form>