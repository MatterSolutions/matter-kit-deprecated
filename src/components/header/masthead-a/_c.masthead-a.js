/*
*	Masthead navigation 
*/

$( '.site-blocker' ).on( 'click', function( event ) {

	var bodyEl = $( 'body' );
	
	if ( bodyEl.hasClass( 'off-canvas' ) ) {

		bodyEl.removeClass( 'off-canvas--left' );
		bodyEl.removeClass( 'off-canvas--right' );
		bodyEl.removeClass( 'off-canvas' );

	}

});



$( '.navigation--sliding' ).find( '.sub-menu' ).prepend( '<li class="menu-item  js-toggle--sub-menu-up  js-toggle--sub-menu"><a href="#">Back</a></li>' );
$( '.navigation--sliding' ).find( '.sub-menu' ).hide();



/*
*	Menu subitems
*/				
$( '.js-toggle--sub-menu' ).on( 'click', function( event ) {

	$( '.navigation--sliding  .sub-menu' ).hide();

	var thisEl = $( this ),

		mobileNav = $( this ).closest( '.navigation--sliding' ),
		mobileNavWidth = mobileNav.outerWidth( ),
		mobileNavOffset = mobileNav.attr( 'data-mk-menu-offset' ),
		currentSubNav,
		nearestSubNav,
		newMobileNavOffset;
		

	if ( mobileNavOffset === undefined || mobileNavOffset === false ) {

		mobileNavOffset = 0;

	}

	// Going up a level
	if ( mobileNavOffset > 0  &&  thisEl.hasClass( 'js-toggle--sub-menu-up' ) ) {

		currentSubNav = thisEl.parent();
		nearestSubNav = thisEl.parent().parent().parent();
		
		currentSubNav.show();
		nearestSubNav.show();

		newMobileNavOffset = parseInt( mobileNavOffset ) - parseInt( mobileNavWidth );

	// Going down a level
	} else {

		currentSubNav = thisEl.parent().parent();
		nearestSubNav = thisEl.parent().find( '.sub-menu' );

		currentSubNav.show();
		nearestSubNav.show();

		newMobileNavOffset = parseInt( mobileNavOffset ) + parseInt( mobileNavWidth );

	}

	// Set the primary menu height
	mobileNav.css( 'height', nearestSubNav.outerHeight( ) + 'px' );

	if ( nearestSubNav.hasClass( 'navigation' ) ) {

		mobileNav.css( 'height', 'auto' );

	}
	
	// Set the offset and position
	mobileNav.attr( 'data-mk-menu-offset', newMobileNavOffset );
	mobileNav.css( 'transform', 'translateX( -' + newMobileNavOffset + 'px )' );

});


$( window ).resize( function() {

	var $slidingNavEl = $( '.navigation--sliding' );

	// On resize, remove mobileNav css
	$slidingNavEl.css( 'transform', 'none' );
	$slidingNavEl.css( 'height', 'auto' );
	$slidingNavEl.attr( 'data-mk-menu-offset', 0 );

} );