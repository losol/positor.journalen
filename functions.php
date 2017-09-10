<?php
/**
 * Functions.php
 *
 * @package journalen
 */

/**
 * Enqueue styles
 */
function journalen_enqueue_styles() {
	wp_enqueue_style( 'journalen-bootstrap',
		get_stylesheet_directory_uri() . '/assets/stylesheets/journalen.min.css',
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style( 'journalen-style',
	get_stylesheet_directory_uri() . '/style.css',
	wp_get_theme()->get( 'Version' )

	wp_dequeue_style( 'positor-bootstrap' );
	wp_deregister_style( 'positor-bootstrap' );
	wp_dequeue_style( 'positor-style' );
	wp_deregister_style( 'positor-style' );
);
}
add_action( 'wp_enqueue_scripts', 'journalen_enqueue_styles' );
