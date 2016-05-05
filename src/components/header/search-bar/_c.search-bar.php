<div class="site-search  band  band--small  js-slide-toggle--target">

	<div class="wrap">

		<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<div>
				<label class="search-label" for="s">Type your keywords and hit enter</label>
				<input class="search-field" type="text" placeholder="Type your search here..." value="<?php echo get_search_query(); ?>" name="s" id="s" />
				<input class="search-submit" type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
			</div>
		</form>

	</div>

</div>