<?php

	// Get vars
	$icon = mttr_get_template_var( 'icon' );
	$icon_image = mttr_get_template_var( 'icon_image' );
	$heading = mttr_get_template_var( 'heading' );
	$subheading = mttr_get_template_var( 'subheading' );
	$content = mttr_get_template_var( 'content' );
	$link = mttr_get_template_var( 'cta_link' );
	$modifiers = mttr_get_template_var( 'modifiers' );
	

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}


if ( $link ) {

	echo '<a href="' . esc_url( $link ) . '" class="icon-list-b">';

} else {

	echo '<div class="icon-list-b">';

}

?>
<ul class="layout  layout--center  listing">

	<li class="layout__item  listing__item  icon-list-b__media  u-text--center">

		<?php 

			if ( $icon  ||  $icon_image ) { 

				echo '<div class="u-soft  u-hard--bottom">';

					echo '<i class="icon  icon--huge">';

						if ( $icon_image ) {

							echo '<img alt="" src="' . esc_url( $icon_image ) . '">';

						} else {

							echo mttr_get_icon( esc_html( $icon ) .'.svg' ); 

						}

					echo '</i>';

				echo '</div>';

			} 

		?>

	</li><li class="layout__item  listing__item  icon-list-b__content  u-text--center">

		<?php 

			if ( $heading ) {

				echo '<h4>' . esc_html( $heading ) . '</h4>';

			}


			if ( $subheading ) {

				echo '<h6>' . esc_html( $subheading ) . '</h6>';

			}

			if ( $content ) {

				echo '<div class="u-text--small">';

					echo apply_filters( 'the_content', $content );

				echo '</div>';

			}

		?>

	</li>

</ul><?php 

if ( $link ) {

	echo '</a>';

} else {

	echo '</div>';

}