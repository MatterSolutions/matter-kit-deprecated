// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.
function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
}

/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

	// Use this variable to set up the common and page specific functions. If you
	// rename this variable, you will also need to rename the namespace below.
	var mttr = {

		//*	=Common
		common: {

			init: function( ) {

				// JavaScript to be fired on all pages

				/*
				*	Smoothly scroll to an element
				*/
				$( '.js-smooth-scroll' ).on( 'click', function(e) {

					e.preventDefault();

					var target = $( this ).attr( 'data-scroll-target' );
					var $target = $(target);

					$('html, body').stop().animate({
						 'scrollTop': $target.offset().top
					}, 900, 'swing');

				});




				/*{% include: 'partials/_c.masthead-a.js' %}*/

				




				/*
				*  render_map
				*
				*  This function will render a Google Map onto the selected jQuery element
				*
				*  @type	function
				*  @date	8/11/2013
				*  @since	4.3.0
				*
				*  @param	$el (jQuery element)
				*  @return	n/a
				*/

				function render_map( $el ) {

					// var
					var $markers = $el.find('.marker');

					var stylesArray = [
						{
							"featureType": "landscape",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"lightness": 65
								},
								{
									"visibility": "on"
								}
							]
						},
						{
							"featureType": "poi",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"lightness": 51
								},
								{
									"visibility": "simplified"
								}
							]
						},
						{
							"featureType": "road.highway",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"visibility": "simplified"
								}
							]
						},
						{
							"featureType": "road.arterial",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"lightness": 30
								},
								{
									"visibility": "on"
								}
							]
						},
						{
							"featureType": "road.local",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"lightness": 40
								},
								{
									"visibility": "on"
								}
							]
						},
						{
							"featureType": "transit",
							"stylers": [
								{
									"saturation": -100
								},
								{
									"visibility": "simplified"
								}
							]
						},
						{
							"featureType": "administrative.province",
							"stylers": [
								{
									"visibility": "off"
								}
							]
						},
						{
							"featureType": "water",
							"elementType": "labels",
							"stylers": [
								{
									"visibility": "on"
								},
								{
									"lightness": -25
								},
								{
									"saturation": -100
								}
							]
						},
						{
							"featureType": "water",
							"elementType": "geometry",
							"stylers": [
								{
									"hue": "#ffff00"
								},
								{
									"lightness": -25
								},
								{
									"saturation": -97
								}
							]
						}
					];

					// vars
					var args = {
						zoom		: 16,
						center		: new google.maps.LatLng(0, 0),
						mapTypeId	: google.maps.MapTypeId.ROADMAP,
						scrollwheel	: false,
						draggable	: false,
						styles 		: stylesArray
					};

					// create map	        	
					var map = new google.maps.Map( $el[0], args);

					// add a markers reference
					map.markers = [];

					// add markers
					$markers.each(function(){

						add_marker( $(this), map );

					});

					// center map
					center_map( map );

				}

				/*
				*  add_marker
				*
				*  This function will add a marker to the selected Google Map
				*
				*  @type	function
				*  @date	8/11/2013
				*  @since	4.3.0
				*
				*  @param	$marker (jQuery element)
				*  @param	map (Google Map object)
				*  @return	n/a
				*/

				function add_marker( $marker, map ) {

					// var
					var latlng = new google.maps.LatLng( $marker.attr( 'data-lat' ), $marker.attr( 'data-lng' ) ),
						markericon = $marker.attr( 'data-marker-image' );

					// create marker
					var marker = new google.maps.Marker({
						position	: latlng,
						map			: map,
						icon 		: markericon
					});

					// add to array
					map.markers.push( marker );

					// if marker contains HTML, add it to an infoWindow
					if( $marker.html() )
					{
						// create info window
						var infowindow = new google.maps.InfoWindow({
							content		: $marker.html()
						});

						// show info window when marker is clicked
						google.maps.event.addListener(marker, 'click', function() {

							infowindow.open( map, marker );

						});
					}

				}

				/*
				*  center_map
				*
				*  This function will center the map, showing all markers attached to this map
				*
				*  @type	function
				*  @date	8/11/2013
				*  @since	4.3.0
				*
				*  @param	map (Google Map object)
				*  @return	n/a
				*/

				function center_map( map ) {

					// vars
					var bounds = new google.maps.LatLngBounds();

					// loop through all markers and create bounds
					$.each( map.markers, function( i, marker ){

						var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

						bounds.extend( latlng );

					});

					// only 1 marker?
					if( map.markers.length == 1 )
					{
						// set center of map
						map.setCenter( bounds.getCenter() );
						map.setZoom( 16 );

					}
					else
					{
						// fit to bounds
						map.fitBounds( bounds );
					}

				}



				/*
				*  document ready
				*
				*  This function will render each map when the document is ready (page has loaded)
				*
				*  @type	function
				*  @date	8/11/2013
				*  @since	5.0.0
				*
				*  @param	n/a
				*  @return	n/a
				*/

				$(document).ready(function(){

					$( '.map__body' ).each(function(){

						render_map( $(this) );

					});

				});



				/*
				*	Gallery Lightbox
				*/
				$(document).ready(function() {

					$( '.js-popup-gallery' ).magnificPopup({
						delegate: 'a',
						type: 'image',
						tLoading: 'Loading image #%curr%...',
						mainClass: 'mfp-img-mobile',
						gallery: {
							enabled: true,
							navigateByImgClick: true,
							preload: [0,1] // Will preload 0 - before current, and 1 after the current image
						},
						image: {
							tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
							titleSrc: function(item) {
								return item.el.attr('title');
							}
						}
					});

				});


				// Show video in a modal box
				$( '.popup-video' ).magnificPopup({

					type:"iframe"
				
				});
				


				// Set row items to equal heights
				$( '.js-match-height' ).matchHeight();


				// Make nice dropdowns
				$( '.gfield_select' ).select2();



				/*
				*	Basic Toggle
				*/				
				$( '.js-toggle' ).on( 'click', function( event ) {

					var target = $( this ).attr( 'data-toggle-target' ),
						target_class = $( this ).attr( 'data-toggle-class' ),
						$target = $( target );

					$target.toggleClass( target_class );

				});


				/*
				*	Basic Toggle ALL
				*/				
				$( '.js-toggle-all' ).on( 'click', function( event ) {

					event.preventDefault();

					var target = $( this ).attr( 'data-toggle-target' ),
						target_class = $( this ).attr( 'data-toggle-class' ),
						$target = $( target );

					if ( $( this ).hasClass( target_class ) ) {

						$target.removeClass( target_class );
						$( this ).removeClass( target_class );

					} else {

						$target.addClass( target_class );
						$( this ).addClass( target_class );

					}

				});



				



				//*	=SVG

				var SVGsToInject = document.querySelectorAll( '.js-inject-svg' );

				// Options
				var SVGsInjectorOptions	= {
					evalScripts	: 'once',
					pngFallback	: 'assets/img/png',
					each		: function ( svg ) {
						// Callback after each SVG is injected
						// if (svg) console.log('SVG injected: ' + svg.getAttribute('id'));
					}
				};

				// Trigger the injection
				SVGInjector( SVGsToInject, SVGsInjectorOptions, function ( totalSVGsInjected ) {
					// Callback after all SVGs are injected
					// console.log('We injected ' + totalSVGsInjected + ' SVG(s)!');
				});

			}

		},

		page__archive: {

			init: function( ) {

			}

		},

		//*	=Home
		page__home: {

			init: function( ) {

				// JavaScript to be fired on the about us page

			}

		},

		//*	=Landing
		page__landing: {

			init: function( ) {

				

			}

		},

		//*	=Contact
		page__contact: {

			init: function( ) {

				// JavaScript to be fired on the contact page

			}

		},

	};

	// The routing fires all common scripts, followed by the page specific scripts.
	// Add additional events for more control over timing e.g. a finalize event
	var UTIL = {
		fire: function(func, funcname, args) {
			var namespace = mttr;
			funcname = (funcname === undefined) ? 'init' : funcname;
			if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
				namespace[func][funcname](args);
			}
		},
		loadEvents: function() {
			UTIL.fire('common');
			$.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
				UTIL.fire(classnm);
			});
		}
	};

	$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.