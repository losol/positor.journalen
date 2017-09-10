<?php
/**
 * Functions.php
 *
 * @package journalen
 */

/**
 * Enqueue styles
 */
function my_theme_enqueue_styles() {

	$parent_style = 'positor-style';
	wp_dequeue_style( 'positor-bootstrap' );
	wp_dequeue_style( 'positor-style' );

	wp_enqueue_style( 'journalen-bootstrap',
		get_stylesheet_directory_uri() . '/assets/stylesheets/journalen.min.css',
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style( 'journalen-style',
	get_stylesheet_directory_uri() . '/style.css',
	wp_get_theme()->get( 'Version' )
);
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
