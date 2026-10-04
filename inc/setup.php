<?php
/**
 * Theme-Setup und Assets.
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Theme-Supports registrieren.
 */
function hejlejo_setup() {
	load_theme_textdomain( 'hejlejo', HEJLEJO_DIR . '/languages' );

	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'editor-styles' );

	// Core- und Remote-Patterns ausblenden: Im Editor sollen nur die Hej-Lejo-Patterns erscheinen.
	remove_theme_support( 'core-block-patterns' );

	add_editor_style(
		array(
			'assets/css/theme.css',
			'assets/css/woocommerce.css',
			'assets/css/editor.css',
		)
	);

	if ( class_exists( 'WooCommerce' ) ) {
		add_theme_support(
			'woocommerce',
			array(
				'thumbnail_image_width' => 600,
				'single_image_width'    => 1000,
				'product_grid'          => array(
					'default_columns' => 4,
					'min_columns'     => 2,
					'max_columns'     => 4,
				),
			)
		);
		// Galerie-Funktionen für den Block "Produktbildergalerie" (WooCommerce-Core).
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
}
add_action( 'after_setup_theme', 'hejlejo_setup' );

add_filter( 'should_load_remote_block_patterns', '__return_false' );

/**
 * Frontend-Styles laden.
 *
 * Bewusst nur zwei kleine Stylesheets und ein kleines Navigations-Skript (ohne jQuery).
 * Mini-Cart und Galerie bringen WordPress bzw. WooCommerce selbst mit.
 */
function hejlejo_enqueue_assets() {
	wp_enqueue_style(
		'hejlejo-theme',
		HEJLEJO_URI . '/assets/css/theme.css',
		array(),
		HEJLEJO_VERSION
	);

	// Kleines Skript für Mega-Menü, Touch-Bedienung und mobiles Akkordeon (ohne Abhängigkeiten).
	wp_enqueue_script(
		'hejlejo-navigation',
		HEJLEJO_URI . '/assets/js/navigation.js',
		array(),
		HEJLEJO_VERSION,
		array(
			'in_footer' => true,
			'strategy'  => 'defer',
		)
	);

	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style(
			'hejlejo-woocommerce',
			HEJLEJO_URI . '/assets/css/woocommerce.css',
			array( 'hejlejo-theme' ),
			HEJLEJO_VERSION
		);
	}
}
add_action( 'wp_enqueue_scripts', 'hejlejo_enqueue_assets', 20 );

/**
 * Die Hauptschrift vorladen (Core Web Vitals / LCP).
 */
function hejlejo_preload_fonts() {
	$fonts = array(
		'assets/fonts/quicksand-latin-wght-normal.woff2',
	);

	foreach ( $fonts as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( HEJLEJO_URI . '/' . $font )
		);
	}
}
add_action( 'wp_head', 'hejlejo_preload_fonts', 1 );

/**
 * Emoji-Skript von WordPress entfernen (lädt sonst Bilder von s.w.org nach) – Emojis zeigt jedes Gerät selbst an.
 */
function hejlejo_disable_emoji() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'hejlejo_disable_emoji' );
