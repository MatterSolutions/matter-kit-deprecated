<?php

	/*
	*	Display a list of boxes
	*/

	// Get vars from partial
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
	$image_url = $image;
	

	// Add spaces before modifiers
	if ( $modifiers ) {

		$modifiers = '  ' . $modifiers;

	}

	// Set up vars and sent to box
	$data = array(

		'title' => $heading,
		'content' => $content,
		'link' => $link,
		'modifiers' => $modifiers . '  box--white  box--outlined  js-match-height',

	);

	mttr_get_template( 'template-parts/base/_module.box', $data );