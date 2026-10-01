<?php
/**
 * Theme-eigene Blöcke.
 *
 * Nur zwei kleine, serverseitig gerenderte Blöcke für die Produktdarstellung.
 * Sie lesen ausschließlich vorhandene WooCommerce-Daten und legen keine neuen Felder an.
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Blöcke registrieren (nur mit aktivem WooCommerce).
 */
function hejlejo_register_blocks() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	register_block_type( HEJLEJO_DIR . '/blocks/product-highlights' );
	register_block_type( HEJLEJO_DIR . '/blocks/product-badges' );
}
add_action( 'init', 'hejlejo_register_blocks' );

/**
 * Produkt aus dem Block-Kontext ermitteln.
 *
 * @param WP_Block $block Block-Instanz.
 * @return WC_Product|null
 */
function hejlejo_get_block_product( $block ) {
	$post_id = isset( $block->context['postId'] ) ? absint( $block->context['postId'] ) : get_the_ID();
	$product = $post_id ? wc_get_product( $post_id ) : null;

	if ( ! $product && isset( $GLOBALS['product'] ) && $GLOBALS['product'] instanceof WC_Product ) {
		$product = $GLOBALS['product'];
	}

	return $product instanceof WC_Product ? $product : null;
}

/**
 * Schlichte Linien-Icons (24×24, currentColor) für Theme-Blöcke.
 *
 * @param string $name Icon-Name.
 * @return string SVG-Markup.
 */
function hejlejo_icon( $name ) {
	$paths = array(
		'download' => '<path d="M12 4v11m0 0-4.5-4.5M12 15l4.5-4.5M5 19h14"/>',
		'heart'    => '<path d="M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10Z"/>',
		'file'     => '<path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8l-5-5Z"/><path d="M14 3v5h5"/>',
		'license'  => '<path d="M12 3 5 6v5c0 4.5 3 8.3 7 10 4-1.7 7-5.5 7-10V6l-7-3Z"/><path d="m9 12 2 2 4-4"/>',
		'package'  => '<path d="M21 8 12 3 3 8v8l9 5 9-5V8Z"/><path d="m3 8 9 5 9-5M12 13v8"/>',
		'hand'     => '<path d="M8 13V6.5a1.5 1.5 0 0 1 3 0V12m0-1.5v-6a1.5 1.5 0 0 1 3 0V12m0-5.5a1.5 1.5 0 0 1 3 0V14a7 7 0 0 1-7 7 6 6 0 0 1-5.2-3L3.6 15a1.5 1.5 0 0 1 2.6-1.5L8 16"/>',
		'info'     => '<circle cx="12" cy="12" r="9"/><path d="M12 11v5m0-8h.01"/>',
	);

	if ( ! isset( $paths[ $name ] ) ) {
		$name = 'info';
	}

	return '<svg class="hejlejo-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">' . $paths[ $name ] . '</svg>';
}
