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
*	Feature B
*	Displays an image above text content
*
 ---------------------------------------------------------- */


	// Get vars
	$id = mttr_get_template_var( 'id' );
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

echo '<div class="feature-b' . esc_html( $modifiers ) . '">';

	echo '<div class="feature-b__body  u-flush--bottom">';


		/*
		*	Grid feature media and title
		*/

		echo '<div class="feature-b__header  effect  effect--scale">';

			echo '<div class="effect__item">';

		?>

			<a href="<?php echo esc_url( $link ); ?>" style="background-image: url( '<?php echo esc_url( $image_url ); ?>' );" class="band  u-hard--top  ratio  effect__content"></a>
			
			<?php

			echo '</div><!-- /.effect__item -->';

		echo '</div><!-- /.feature-b__header -->';


		/*
		*	Grid feature excerpt and link
		*/

		echo '<div data-mh="feature-b-content" class="feature-b__content  band  band--small  js-match-height">';

			/*
			*	Begin Post Meta
			*/

			if ( $meta ) {

				echo '<div class="feature-b__meta  u-soft-half--bottom  u-text--small">';

					$meta_data = array(

						'date' => 'd/m/Y', 
						'categories' => true,
						'icons' => true,
						'modifiers' => 'list--fancy-delimited  layout--flush',

					);

					mttr_get_template( 'template-parts/misc/_c.post-meta-primary', $meta_data );

				echo '</div><!-- /.feature-b__meta -->';

			}


			if ( $heading ) {

				echo '<h4 class="feature-b__title  display-heading  u-flush--bottom">';

					echo '<a class="u-link--no-decoration" href="' . esc_url( $link ) . '">';

						echo esc_html( $heading );

					echo '</a>';

				echo '</h4><!-- /.feature-b__title -->';

			}


			if ( $content ) {

				echo '<div class="u-negate-btm-margin  u-soft-half--top">';

					echo apply_filters( 'the_content', $content );

				echo '</div>';

			}


		echo '</div><!-- /.feature__content -->';

		if ( $cta ) {

			echo '<div class="feature-b__cta">';
					
				echo '<p class="u-flush--bottom  u-keyline"><a class="subheading  u-link--no-decoration" href="' . esc_url( $link ) . '">Read More</a></p>';

			echo '</div><!-- /.feature-b__cta -->';

		}

	echo '</div><!-- /.feature__body -->';

echo '</div><!-- /.feature -->';
