<?php
/**
 * Standardinhalte für eine frisch umgestellte Seite.
 *
 * Solange auf der Website noch nichts Eigenes eingerichtet ist, zeigt das Theme die Startseite und das Logo
 * so, wie sie auf Staging gestaltet wurden. Sobald eigene Inhalte vorhanden sind, haben diese Vorrang.
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Hat die statische Startseite eigenen Block-Inhalt?
 *
 * Nein, wenn keine Startseite festgelegt ist, sie leer ist, nur klassischen Inhalt hat oder mit Elementor
 * gebaut wurde (z. B. die bisherige Startseite "Dashboard").
 *
 * @return bool
 */
function hejlejo_front_page_has_block_content() {
	if ( 'page' !== get_option( 'show_on_front' ) ) {
		return false;
	}

	$page_id = (int) get_option( 'page_on_front' );
	$page    = $page_id ? get_post( $page_id ) : null;

	if ( ! $page || ! has_blocks( $page->post_content ) ) {
		return false;
	}

	return 'builder' !== get_post_meta( $page_id, '_elementor_edit_mode', true );
}

/**
 * Startseite: Hat die Startseite (noch) keinen Block-Inhalt, gibt der Inhaltsbereich des Templates
 * "Titelseite" das Pattern "Hej Lejo / Seite: Startseite" aus.
 *
 * Eigene Startseite: Seite anlegen, Pattern einfügen und unter Einstellungen → Lesen als Startseite wählen.
 *
 * @param string|null $pre_render   Vorab gerenderter Inhalt (null = normal rendern).
 * @param array       $parsed_block Geparster Block.
 * @return string|null
 */
function hejlejo_front_page_fallback( $pre_render, $parsed_block ) {
	if ( null !== $pre_render || 'core/post-content' !== $parsed_block['blockName'] || ! is_front_page() ) {
		return $pre_render;
	}

	if ( hejlejo_front_page_has_block_content() ) {
		return $pre_render;
	}

	$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( 'hejlejo/page-home' );
	if ( ! $pattern || empty( $pattern['content'] ) ) {
		return $pre_render;
	}

	// Gleiche Hülle wie der Block "Inhalt" im Template front-page (volle Breite, Layout "constrained").
	return '<div class="entry-content alignfull wp-block-post-content has-global-padding is-layout-constrained wp-block-post-content-is-layout-constrained">'
		. do_blocks( $pattern['content'] )
		. '</div>';
}
add_filter( 'pre_render_block', 'hejlejo_front_page_fallback', 10, 2 );

/**
 * Logo: Ist kein Website-Logo gesetzt, zeigt der Block "Website-Logo" das Hej-Lejo-Logo aus dem Theme.
 *
 * Ein im Website-Editor oder unter Design → Customizer gewähltes Logo hat immer Vorrang.
 *
 * @param string $block_content HTML des Blocks.
 * @param array  $block         Geparster Block.
 * @return string
 */
function hejlejo_default_logo( $block_content, $block ) {
	if ( '' !== trim( $block_content ) ) {
		return $block_content;
	}

	$width = isset( $block['attrs']['width'] ) ? (int) $block['attrs']['width'] : 120;

	return sprintf(
		'<div class="wp-block-site-logo"><a href="%1$s" class="custom-logo-link" rel="home"><img src="%2$s" class="custom-logo" alt="%3$s" width="%4$d" height="%4$d" decoding="async"/></a></div>',
		esc_url( home_url( '/' ) ),
		hejlejo_image( 'content/logo.png' ),
		esc_attr( get_bloginfo( 'name' ) ),
		$width
	);
}
add_filter( 'render_block_core/site-logo', 'hejlejo_default_logo', 10, 2 );
