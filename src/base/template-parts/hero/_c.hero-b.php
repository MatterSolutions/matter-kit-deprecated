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
*	Text Hero
*	Only contains text, no images
*
 ---------------------------------------------------------- */

	// Get vars
	$title = mttr_get_template_var( 'title' );
	$subheading = mttr_get_template_var( 'subheading' );
	$content = mttr_get_template_var( 'content' );
	$modifiers = mttr_get_template_var( 'modifiers' );

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}

?>
<header class="band  band--large  hero-b<?php echo $modifiers; ?>">

	<div class="band__body  hero-b__body">

		<div class="wrap">

			<div class="hero-b__content">

				<div class="u-line-length">

				<?php

					if ( $subheading ) {

						echo '<h6 class="hero-b__subheading">' . esc_html( $subheading ) . '</h6>';

					}

					if ( $title ) {

						echo '<h1 class="hero-b__title  u-flush--bottom  display-heading  display-heading--gamma">' . $title . '</h1>';

					}

					if ( $content ) {

						echo '<div class="u-soft-half--top">';

							echo apply_filters( 'the_content', $content );

						echo '</div>';

					}

				?>

				</div>

			</div><!-- /.hero-text__content -->

		</div><!-- /.wrap -->

	</div><!-- /.band__body -->

</header><!-- /.band -->
