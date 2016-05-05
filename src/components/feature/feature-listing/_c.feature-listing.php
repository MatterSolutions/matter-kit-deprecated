<?php

	// Get vars
	$author = mttr_get_template_var( 'author' );
	$categories = mttr_get_template_var( 'categories' );
	$content = mttr_get_template_var( 'content' );
	$date = mttr_get_template_var( 'date' );
	$heading = mttr_get_template_var( 'heading' );
	$image = mttr_get_template_var( 'image' );
	$tags = mttr_get_template_var( 'tags' );
	$meta = mttr_get_template_var( 'meta' );
	$link = mttr_get_template_var( 'cta_link' );


	$modifiers = mttr_get_template_var( 'modifiers' );


	// Ensure an image is always used
	if ( !$image ) {

		$image = get_field( 'mttr_options_hero_default_image', 'options' );
		$image_url = wp_get_attachment_image_src( $image, 'mttr_square' );
		$image_url = $image_url[0];

	} else {

		$image_url = $image;

	}
	

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}

	$image_classes = 'u-image-fill';

	echo '<article class="list-feature-a">';

		echo '<div class="list-feature-a__body">';

			echo '<ul class="layout  layout--middle">';

				echo '<li class="layout__item  list-feature-a__alpha">';

					echo '<a style="background-image: url(\'' . esc_url( $image_url ) . '\');" class="list-feature-a__media  band  band--hero  u-hard--top" href="' . esc_url( $link ) . '">';

					echo '</a>';

				echo '</li>';

				echo '<li class="layout__item  list-feature-a__beta">';

					echo '<header>';

						echo '<h3><a class="u-link--no-decoration" href="' . esc_url( $link ) . '">' . esc_html( $heading ) . '</a></h3>';

						if ( $meta ) {

							/*
							*	Begin header post meta
							*/

							echo '<div class="list-feature-a__meta">';

								$post_meta = array(

									'date' => 'jS F, Y',
									'categories' => true,

								);

								mttr_get_template( 'template-parts/misc/_c.post-meta-primary', $post_meta );

							echo '</div><!-- /.listing-feature-a__meta -->';

						}

					echo '</header>';

					echo '<div class="list-feature-a__excerpt  u-negate-btm-margin">';

						echo apply_filters( 'the_content', $content );

					echo '</div><!-- /.list-feature-a__excerpt -->';

					if ( $meta ) {

						/*
						*	Begin Footer post meta
						*/

						if ( $tags ) {

							echo '<footer class="post-meta">';

								echo '<ul class="layout  layout--small">';

									/*
									*	Post Tags
									*/

									echo '<li class="layout__item">';

										echo '<div class="post-meta__tags">';

											echo '<i class="icon  icon--small  icon--before">' . mttr_get_icon( 'icon-tags.svg' ) . '</i>';

											foreach( $tags as $tag ) {

												echo '<span class="tag-item"><a href="' . get_term_link( $tag, 'tag' ) . '">';

													echo $tag->name; 

												echo '</a></span> ';

											}

										echo '</div>';

									echo '</li><!-- /.layout__item -->';

								echo '</ul>';

							echo '</footer>';

						}

					}

				echo '</li><!-- /.layout__item -->';

			echo '</ul><!-- /.layout -->';

		echo '</div><!-- /.feature__body -->';

	echo '</article>';