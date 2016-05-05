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
*	Hero Standard
*	All purpose hero unit, one to rule them all!
*
 ---------------------------------------------------------- */


	// Get vars
	$image = mttr_get_template_var( 'image' );
	$image_mobile = mttr_get_template_var( 'image_mobile' );
	$title = mttr_get_template_var( 'title' );
	$no_image = mttr_get_template_var( 'no_image' );
	$meta = mttr_get_template_var( 'meta' );
	$content = mttr_get_template_var( 'content' );
	$identifier = mttr_get_template_var( 'identifier' );
	$indicator = mttr_get_template_var( 'indicator' );
	$modifiers = mttr_get_template_var( 'modifiers' );
	$search = mttr_get_template_var( 'search' );


	// Ensure an image is always used
	if ( !$image && !$no_image ) {

		$image = get_field( 'mttr_options_hero_default_image', 'options' );
		$image_url = wp_get_attachment_image_src( $image, 'mttr_hero' );
		$image_url = $image_url[0];

	} else {

		$image_url = $image;

	}

	// Ensure an image is always used
	if ( !$image_mobile ) {

		$image = get_field( 'mttr_options_hero_default_image', 'options' );
		$image_url_mobile = wp_get_attachment_image_src( $image, 'mttr_square' );
		$image_url_mobile = $image_url_mobile[0];

	} else {

		$image_url_mobile = $image_mobile;

	}


	// Ensure a unique identifier
	if ( !$identifier ) {

		$identifier = rand( 0000, 9999 ) . date( 'His' );

	}
	

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}


	if ( $image_url ) {

?>
<style>

	.hero-standard--<?php echo $identifier; ?> {

		background-image: url( '<?php echo esc_url( $image_url_mobile ); ?>' );

	}

	@media ( min-width: 768px ) {

		.hero-standard--<?php echo $identifier; ?> {

			background-image: url( '<?php echo esc_url( $image_url ); ?>' );

		}

	}

</style><?php } // End $image_url ?>
<header class="hero-standard<?php echo $modifiers; ?>  hero-standard--<?php echo $identifier; ?>">

	<div class="hero-standard__body">

		<div class="wrap">

			<div class="hero-standard__content">

				<?php

					if ( $title ) {

						echo '<h1 class="hero-standard__title  u-flush--bottom">' . esc_html( $title ) . '</h1>';

					}


					if ( $meta ) {

						mttr_get_template( 'template-parts/misc/_c.post-meta-primary', $meta );

					}


					if ( $content ) {

						echo '<div class="u-negate-btm-margin">';

							echo apply_filters( 'the_content', $content );

						echo '</div>';

					}

					if ( $search ) {

						echo '<div class="u-soft--top  wrap  wrap--petite">';

							get_search_form();

						echo '</div>';

					}

					?>

			</div><!-- /.u-text-center -->

		</div><!-- /.wrap -->

	</div><!-- /.band__body -->

	<?php

		if ( $indicator ) {

			echo '<a data-scroll-target="' . esc_html( $indicator ) . '" class="hero-standard__indicator  js-smooth-scroll" href="#"></a>';

		}

	?>

</header><!-- /.band -->
