<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Positor
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<a class="skip-link sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'positor' ); ?></a>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/nb_NO/sdk.js#xfbml=1&version=v2.10&appId=188841824908856";
	fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<header id="header" class="site-header d-print-none">

	<?php
	/**
	 * Choose large or compact header.
	 * Shows large header on front page if enabled.
	 */
	if ( is_home() && is_front_page() && get_theme_mod( 'positor_header_large_on_front' )) {
		get_template_part( 'components/header/navbar-large' );
	} else {
		get_template_part( 'components/header/navbar' );
	}
	?>
	
	</header>