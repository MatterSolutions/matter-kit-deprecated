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
*	Document Listing A
*	Display information about a document for downloading
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

	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers; 

	}

	$file_url = wp_get_attachment_url( $id );
 	$filetype = wp_check_filetype( $file_url );
 	$filesize = size_format( filesize( get_attached_file( $id ) ) );

 	$file_description = get_post( 'post_content', $id );


	/*
	*	Begin outputting the block
	*/

	echo '<div class="document-listing-a' . esc_html( $modifiers ) . '">';

		echo '<ul class="layout  layout--middle  listing">';

			echo '<li class="layout__item  listing__item  g-two-thirds@lap">';

				echo '<h6 class="u-flush--bottom">' . esc_html( $heading ) . '</h6>';

				if ( $file_description ) {

					echo apply_filters( 'the_content', $file_description );

				}

			echo '</li>';

			if ( $filetype || $filesize || $file_url ) {

				echo '<li class="layout__item  listing__item  g-one-third@lap">';

					echo '<ul class="layout  listing">';

						if ( $filetype || $filesize ) {

							echo '<li class="layout__item  listing__item  g-one-half">';

								if ( $filetype ) {

									echo '<strong class="u-text--uppercase">' . esc_html( $filetype[ 'ext' ] ) . '</strong> ';

								}

								if ( $filesize ) {

									echo esc_html( $filesize );

								}

							echo '</li>';

						}

						if ( $file_url ) {

							echo '<li class="layout__item  listing__item  g-one-half  u-text--right">';

								echo '<a target="_blank" class="u-link--no-decoration" href="' . esc_url( $file_url ) . '"><i class="icon  icon--middle  icon--before">' . mttr_get_icon( 'download.svg' ) . '</i>Download</a>';

							echo '</li>';

						}

					echo '</ul>';

				echo '</li><!-- /.layout__item -->';

			}

		echo '</ul><!-- /.layout -->';

	echo '</div><!-- /.document-listing-a -->';