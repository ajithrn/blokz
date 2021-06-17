<?php 
/**
 * Register/enqueue custom scripts and styles
 */
add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'bricks-child', get_stylesheet_uri(), ['bricks-frontend'], filemtime( get_stylesheet_directory() . '/style.css' ) );
} );

/**
 * Register custom elements
 */
add_action( 'init', function() {
  $element_files = [
    __DIR__ . '/elements/title.php',
  ];

  foreach ( $element_files as $file ) {
    \Bricks\Elements::register_element( $file );
  }
}, 11 );

/**
 * Filter which elements to show in the builder
 * 
 * Simple outcomment (prefix: //) the elements you don't want to use in Bricks
 */
function bricks_filter_builder_elements( $elements ) {
	$elements = [
		// Basic
	  'container', // since 1.2
	  'heading',
		'text',
		'button',
		'icon',
		'image',
		'video',

		// General
		'divider',
		'icon-box',
		'list',
		'accordion',
		'tabs',
		'form',
		'map',
		'alert',
		'animated-typing',
		'countdown',
		'counter',
		'pricing-tables',
		'progress-bar',
		'pie-chart',
		'team-members',
		'testimonials',
		'html',
		'code',
		'logo',

		// Media
		'image-gallery',
		'audio',
		'carousel',
		'slider',
		'svg',

		// Social
		'social-icons',
		'facebook-page',
		'instagram-feed',

		// WordPress
		'wordpress',
		'posts',
		'nav-menu',
		'sidebar',
		'search',
		'shortcode',

		// Single
		'post-title',
		'post-excerpt',
		'post-meta',
		'post-content',
		'post-sharing',
		'post-related-posts',
		'post-author',
		'post-comments',
		'post-taxonomy',
		'post-navigation',

		// Hidden in builder panel
		'section',
		'row',
		'column',
	];

	return $elements;
}
// add_filter( 'bricks/builder/elements', 'bricks_filter_builder_elements' );

/**
 * Add text strings to builder
 */
add_filter( 'bricks/builder/i18n', function( $i18n ) {
  // For element category 'custom'
  $i18n['custom'] = esc_html__( 'Custom', 'bricks' );

  return $i18n;
} );

/**
 * Custom save messages
 */
add_filter( 'bricks/builder/save_messages', function( $messages ) {
	// First option: Add individual save message
	$messages[] = 'Yasss';

	// Second option: Replace all save messages
	$messages = [
		'Done',
		'Cool',
		'High five!',
	];

  return $messages;
} );

/**
 * Customize standard fonts
 */
// add_filter( 'bricks/builder/standard_fonts', function( $standard_fonts ) {
// 	// First option: Add individual standard font
// 	$standard_fonts[] = 'Verdana';

// 	// Second option: Replace all standard fonts
// 	$standard_fonts = [
// 		'Georgia',
// 		'Times New Roman',
// 		'Verdana',
// 	];

//   return $standard_fonts;
// } );

/** 
 * Add custom map style
 */
// add_filter( 'bricks/builder/map_styles', function( $map_styles ) {
//   // Shades of grey (https://snazzymaps.com/style/38/shades-of-grey)
//   $map_styles['shadesOfGrey'] = [
//     'label' => esc_html__( 'Shades of grey', 'bricks' ),
//     'style' => '[ { "featureType": "all", "elementType": "labels.text.fill", "stylers": [ { "saturation": 36 }, { "color": "#000000" }, { "lightness": 40 } ] }, { "featureType": "all", "elementType": "labels.text.stroke", "stylers": [ { "visibility": "on" }, { "color": "#000000" }, { "lightness": 16 } ] }, { "featureType": "all", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative", "elementType": "geometry.fill", "stylers": [ { "color": "#000000" }, { "lightness": 20 } ] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [ { "color": "#000000" }, { "lightness": 17 }, { "weight": 1.2 } ] }, { "featureType": "landscape", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 20 } ] }, { "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 21 } ] }, { "featureType": "road.highway", "elementType": "geometry.fill", "stylers": [ { "color": "#000000" }, { "lightness": 17 } ] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [ { "color": "#000000" }, { "lightness": 29 }, { "weight": 0.2 } ] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 18 } ] }, { "featureType": "road.local", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 16 } ] }, { "featureType": "transit", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 19 } ] }, { "featureType": "water", "elementType": "geometry", "stylers": [ { "color": "#000000" }, { "lightness": 17 } ] } ]'
//   ];

//   return $map_styles;
// } );