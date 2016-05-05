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
*	Content Sidebar
*	Display content with sidebar content displayed AFTER the 
*	main content area.
*
 ---------------------------------------------------------- */

	// Get vars
	$heading = mttr_get_template_var( 'heading' );
	$meta = mttr_get_template_var( 'meta' );
	$content = mttr_get_template_var( 'content' );
	$listing = mttr_get_template_var( 'listing' );
	$author = mttr_get_template_var( 'author' );
	$share = mttr_get_template_var( 'share' );
	$sidebar = mttr_get_template_var( 'sidebar' );
	$reverse = mttr_get_template_var( 'reverse' );
	$categories = mttr_get_template_var( 'categories' );
	$tags = mttr_get_template_var( 'tags' );
	$menu = mttr_get_template_var( 'menu' );
	$modifiers = mttr_get_template_var( 'modifiers' );

	if ( $reverse ) {

		$modifiers = '  layout--rev' . $modifiers;

	}

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}


	/*
	*	Begin output of elements
	*/
	if ( $content || $listing || $sidebar || $menu ) {

		echo '<div class="wrap">';

			echo '<div class="layout  layout--large  listing  listing--large' . esc_html( $modifiers ) . '">';

				if ( $sidebar || $menu || $categories ) {

					echo '<div class="layout__item  listing__item  g-one-third@desk">';

						echo '<ul class="listing  listing--large">';

						if ( $share ) {

							echo '<li class="listing__item">';

								echo '<h6>Share</h6>';
								mttr_get_template( 'template-parts/misc/_c.share-a', $share );

							echo '</li>';

						}

						if ( $author ) {

							echo '<li class="listing__item">';

								echo '<h6>Posted by</h6>';

								echo '<div class="u-soft-half--top">';

									mttr_get_template( 'template-parts/misc/_c.author-a', $author );

								echo '</div>';

							echo '</li>';

						}


						if ( $menu ) {

							echo '<li class="listing__item">';

								wp_nav_menu( $menu );

							echo '</li>';

						}

						if ( $categories  &&  is_array( $categories ) ) {

							echo '<li class="listing__item">';

								echo '<h6 class="u-soft-half--bottom">Categories</h6>';

								echo '<ul class="listing  listing--flush  listing--keylines-between  listing--keylines">';

								foreach ( $categories as $category ) {

									echo '<li class="listing__item">';

										echo '<div class="listing__content">';

											echo '<a class="u-block  band  band--tiny  u-link--no-decoration" href="' . esc_url( get_category_link( $category->term_id ) ) . '">';

												echo esc_html( $category->name );

											echo '</a>';

										echo '</div>';

									echo '</li>';

								}

								echo '</ul>';

							echo '</li>';

						}

						if ( $sidebar ) {

							echo '<li class="listing__item">';

								echo '<div class="u-negate-btm-margin">';

									echo apply_filters( 'the_content', $sidebar );

								echo '</div>';

							echo '</li>';

						}

						echo '</ul>';

					echo '</div><!-- /.layout__item -->';

				}


				if ( $content  ||  $tags ||  $listing ) {

					echo '<div class="layout__item  listing__item  g-two-thirds@desk">';

						echo '<div class="u-negate-btm-margin">';

							if ( $heading ) {

								echo '<h2 class="display-heading  display-heading--beta">' . esc_html( $heading ) . '</h2>';

							}

							if ( $meta ) {

								echo '<div class="u-soft--bottom">';

									mttr_get_template( 'template-parts/misc/_c.post-meta-primary', $meta );

								echo '</div>';

							}

							if ( $content ) {

								echo apply_filters( 'the_content', $content );

							}

							if ( $tags  &&  is_array( $tags ) ) {

								echo '<h6>Tagged</h6>';

								echo '<ul class="list  list--bare  list--comma-delimited  list--inline  u-inline">';

								foreach ( $tags as $tag ) {

									echo '<li class="list__item">';

										echo '<a href="' . esc_url( get_category_link( $tag->term_id ) ) . '">#';

											echo esc_html( $tag->name );

										echo '</a>';

									echo '</li> ';

								}

								echo '</ul>';

							}

							// Show listing items
							if ( $listing ) {

								mttr_get_template( 'template-parts/content/_c.content-features', $listing );
								mttr_paged_navigation();

							}

						echo '</div>';

					echo '</div><!-- /.layout__item -->';

				}

			echo '</div><!-- /.layout -->';	

		echo '</div><!-- /.wrap -->';

	} // end if have any content