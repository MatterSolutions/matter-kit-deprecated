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
*	Post Meta Primary
*	Display post meta in a list
*
 ---------------------------------------------------------- */

$id = mttr_get_template_var( 'id' );
$icons = mttr_get_template_var( 'icons' );
$categories = mttr_get_template_var( 'categories' );
$category_prefix = mttr_get_template_var( 'category_prefix' );
$date = mttr_get_template_var( 'date' );
$author = mttr_get_template_var( 'author' );
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

// Check to see if any data has been requested
if ( $categories || $date || $author ) {

	echo '<ul class="list  layout  layout--auto' . esc_html( $modifiers ) . '">';

		if ( $date ) {

			echo '<li class="list__item  layout__item">';

				if ( $icons ) {

					echo '<i class="icon  icon--middle  icon--before">' . mttr_get_icon( 'calendar.svg' ) . '</i>';

				}

				echo $meta_date;

			echo '</li>';

		}

		if ( $categories ) {

			echo '<li class="list__item  layout__item">';

				if ( $icons ) {

					echo '<i class="icon  icon--middle  icon--before">' . mttr_get_icon( 'box.svg' ) . '</i>';

				}

				if ( $category_prefix ) {

					echo $category_prefix;

				}

				echo $meta_categories;

			echo '</li>';

		}

		if ( $author ) {

			echo '<li class="list__item  layout__item">';

				if ( $icons ) {

					echo '<i class="icon  icon--before">' . mttr_get_icon( 'pencil.svg' ) . '</i>';

				}

				echo $meta_author;

			echo '</li>';

		}

	echo '</ul>';

}