<?php
/**
 * WooCommerce-Integration.
 *
 * Bewusst schlank: Shop, Produktseite, Warenkorb und Kasse laufen über WooCommerce-Blöcke und -Templates.
 * Hier stehen nur Anpassungen, die sich nicht über theme.json oder Templates lösen lassen.
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Header-Suche: Ist FiboSearch aktiv, ersetzt dessen Suchfeld den Core-Suchblock mit der Klasse
 * "hejlejo-header-search". Ohne FiboSearch bleibt die normale WordPress-Produktsuche aktiv.
 *
 * @param string $block_content HTML des Blocks.
 * @param array  $block         Geparster Block.
 * @return string
 */
function hejlejo_header_search_fibosearch( $block_content, $block ) {
	$class = isset( $block['attrs']['className'] ) ? $block['attrs']['className'] : '';

	if ( false === strpos( $class, 'hejlejo-header-search' ) || ! shortcode_exists( 'fibosearch' ) ) {
		return $block_content;
	}

	/**
	 * Shortcode für die Header-Suche, z. B. um das FiboSearch-Layout zu ändern.
	 *
	 * @param string $shortcode Shortcode.
	 */
	$shortcode = apply_filters( 'hejlejo_header_search_shortcode', '[fibosearch layout="icon-flexible" layout_breakpoint="782" mobile_overlay="1"]' );

	return '<div class="hejlejo-header-search hejlejo-header-search--fibosearch">' . do_shortcode( $shortcode ) . '</div>';
}
add_filter( 'render_block_core/search', 'hejlejo_header_search_fibosearch', 10, 2 );

/**
 * Anzahl verwandter Produkte an das 4er-Raster anpassen.
 *
 * @param array $args Argumente.
 * @return array
 */
function hejlejo_related_products_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'hejlejo_related_products_args' );

/**
 * Produkt-Tabs: "Zusätzliche Informationen" klarer benennen.
 *
 * Die Inhalte bleiben unverändert – es werden nur Beschriftungen angepasst.
 *
 * @param array $tabs Tabs.
 * @return array
 */
function hejlejo_product_tabs( $tabs ) {
	if ( isset( $tabs['additional_information'] ) ) {
		$tabs['additional_information']['title'] = __( 'Details', 'hejlejo' );
	}
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'hejlejo_product_tabs', 20 );

/**
 * Mini-Cart auf der Warenkorbseite weglassen.
 *
 * Dort ist der Drawer überflüssig, und der Block löst auf der Warenkorbseite
 * eine fehlerhafte Store-API-Anfrage aus (404 auf ".../undefinedwc/store/v1/cart").
 *
 * @param string $block_content HTML des Blocks.
 * @return string
 */
function hejlejo_hide_mini_cart_on_cart_page( $block_content ) {
	return is_cart() ? '' : $block_content;
}
add_filter( 'render_block_woocommerce/mini-cart', 'hejlejo_hide_mini_cart_on_cart_page' );

/**
 * WooCommerce fügt Konto- und Mini-Cart-Block automatisch in Header ein ("Block Hooks").
 * Der Hej-Lejo-Header enthält beide Blöcke bereits – ohne diesen Filter erschienen sie doppelt.
 *
 * @param string[] $hooked_block_types Automatisch eingefügte Blöcke.
 * @return string[]
 */
function hejlejo_remove_hooked_woocommerce_blocks( $hooked_block_types ) {
	return array_values( array_diff( $hooked_block_types, array( 'woocommerce/customer-account', 'woocommerce/mini-cart' ) ) );
}
add_filter( 'hooked_block_types', 'hejlejo_remove_hooked_woocommerce_blocks', 20 );

/**
 * Standard-Produktkategorie ("Unkategorisiert") im Frontend nicht als Kategorie anzeigen.
 *
 * Betrifft nur die Ausgabe (z. B. Dachzeile der Produktkarten); die Zuordnung der Produkte bleibt unverändert.
 *
 * @param WP_Term[]|false|WP_Error $terms    Begriffe.
 * @param int                      $post_id  Beitrags-ID.
 * @param string                   $taxonomy Taxonomie.
 * @return WP_Term[]|false|WP_Error
 */
function hejlejo_hide_default_product_cat( $terms, $post_id, $taxonomy ) {
	if ( 'product_cat' !== $taxonomy || is_admin() || ! is_array( $terms ) || count( $terms ) < 2 ) {
		return $terms;
	}

	$default = (int) get_option( 'default_product_cat', 0 );

	return array_values(
		array_filter(
			$terms,
			function ( $term ) use ( $default ) {
				return (int) $term->term_id !== $default;
			}
		)
	);
}
add_filter( 'get_the_terms', 'hejlejo_hide_default_product_cat', 10, 3 );

/**
 * Produktbilder ohne Lupe beim Überfahren – vergrößert wird nur per Klick (Lightbox).
 *
 * Das Weglassen der Theme-Unterstützung allein reicht nicht – WooCommerce schaltet den Zoom bei Block-Themes selbst ein:
 * - WC_Template_Loader::init (init, Priorität 10) meldet für Block-Themes "wc-product-gallery-zoom" an
 *   → wird danach wieder entfernt; ohne sie lädt der Galerie-Block das Skript jquery.zoom nicht.
 * - Der Block "Produktbildergalerie" setzt beim Rendern
 *   add_filter( 'woocommerce_single_product_zoom_enabled', '__return_true' ) → unser Filter läuft danach.
 */
add_filter( 'woocommerce_single_product_zoom_enabled', '__return_false', PHP_INT_MAX );

/**
 * Zoom-Unterstützung entfernen, nachdem WooCommerce sie bei "init" angemeldet hat.
 */
function hejlejo_remove_gallery_zoom() {
	remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'init', 'hejlejo_remove_gallery_zoom', 20 );

/**
 * Angebots-Schild an der Produktbildergalerie: "Angebot" statt "Angebot!" – gleiche Schreibweise wie die Theme-Badges.
 *
 * @return string
 */
function hejlejo_sale_flash() {
	return '<span class="onsale">' . esc_html__( 'Angebot', 'hejlejo' ) . '</span>';
}
add_filter( 'woocommerce_sale_flash', 'hejlejo_sale_flash' );
