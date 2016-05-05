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
*	Author Box
*	Display information about an author
*
 ---------------------------------------------------------- */

$id = mttr_get_template_var( 'id' );
$avatar = mttr_get_template_var( 'avatar' );
$name = mttr_get_template_var( 'name' );
$description = mttr_get_template_var( 'description' );
$link = mttr_get_template_var( 'link' );
$modifiers = mttr_get_template_var( 'modifiers' );

if ( empty( $id ) ) {

	$id = get_the_ID();

}

$meta_categories = get_the_category_list( ', ', false, $id );
$meta_date = get_the_date( $date, $id );
$meta_author = get_the_author_link();

// Add spaces before modifiers
if ( $modifiers ) {

	$modifiers = '  ' . $modifiers;

}

if ( empty( $description ) ) {

	$modifiers .= '  layout--middle';

}

if ( $name ) {

	echo '<ul class="layout' . esc_html( $modifiers ) . '">';


		if ( $avatar ) {

			echo '<li class="layout__item  g-one-third">';

				mttr_get_template( 'template-parts/base/_module.avatar', $avatar );

			echo '</li>';

		}


		echo '<li class="layout__item  g-two-thirds">';

			if ( $link ) {

				echo '<a href="' . esc_url( $link ) . '">';

			}

				if ( $name ) {

					echo esc_html( $name );

				}

			if ( $link ) {

				echo '</a>';

			}

			if ( $description ) {

				echo '<div class="u-text--small  u-negate-btm-margin">';

					echo apply_filters( 'the_content', $description );

				echo '</div>';

			}

		echo '</li>';

	echo '</ul>';

}