<?php

/*
*	Post Meta - very basic, standard meta
*/

$id = mttr_get_template_var( 'id' );
$categories = mttr_get_template_var( 'categories' );
$date = mttr_get_template_var( 'date' );
$author = mttr_get_template_var( 'author' );

if ( empty( $id ) ) {

	$id = get_the_ID();

}

$meta_categories = get_the_category_list( ', ', false, $id );
$meta_date = get_the_date( $date, $id );
$meta_author = get_the_author_link();

$modifiers = get_field( 'modifiers' );

// Add spaces before modifiers
if ( $modifiers ) {

	$modifiers = '  ' . $modifiers;

}

// Check to see if any data has been requested
if ( $categories || $date || $author ) {

	echo '<ul class="layout  layout--auto' . $modifiers . '">';

		if ( $date ) {

			echo '<li class="layout__item">';

				echo '<i class="icon  icon--middle  icon--before">' . mttr_get_icon( 'calendar.svg' ) . '</i>';

				echo $meta_date;

			echo '</li>';

		}

		if ( $categories ) {

			echo '<li class="layout__item">';

				echo '<i class="icon  icon--middle  icon--before">' . mttr_get_icon( 'box.svg' ) . '</i>';

				echo $meta_categories;

			echo '</li>';

		}

		if ( $author ) {

			echo '<li class="layout__item">';

				echo '<i class="icon  icon--before">' . mttr_get_icon( 'pencil.svg' ) . '</i>';

				echo $meta_author;

			echo '</li>';

		}

	echo '</ul>';

}