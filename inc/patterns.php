<?php
/**
 * Pattern-Kategorien.
 *
 * Die Patterns selbst liegen als PHP-Dateien in /patterns und werden von WordPress automatisch registriert.
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Pattern-Kategorien registrieren.
 */
function hejlejo_register_pattern_categories() {
	$categories = array(
		'hejlejo-sections' => array(
			'label'       => __( 'Hej Lejo – Abschnitte', 'hejlejo' ),
			'description' => __( 'Wiederverwendbare Abschnitte im Hej-Lejo-Design.', 'hejlejo' ),
		),
		'hejlejo-shop'     => array(
			'label'       => __( 'Hej Lejo – Shop', 'hejlejo' ),
			'description' => __( 'Produktbereiche und Shop-Bausteine.', 'hejlejo' ),
		),
		'hejlejo-pages'    => array(
			'label'       => __( 'Hej Lejo – Ganze Seiten', 'hejlejo' ),
			'description' => __( 'Komplette Seitenvorlagen, z. B. Startseite, Schranklädchen, Über uns.', 'hejlejo' ),
		),
	);

	foreach ( $categories as $slug => $args ) {
		register_block_pattern_category( $slug, $args );
	}
}
add_action( 'init', 'hejlejo_register_pattern_categories', 9 );

/**
 * URL einer Bilddatei aus dem Theme (für Platzhalterbilder in Patterns).
 *
 * @param string $file Dateiname relativ zu assets/images/.
 * @return string
 */
function hejlejo_image( $file ) {
	return esc_url( HEJLEJO_URI . '/assets/images/' . ltrim( $file, '/' ) );
}

/**
 * Shop-URL (WooCommerce-Shopseite, sonst /shop/).
 *
 * @return string
 */
function hejlejo_shop_url() {
	$url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : '';
	return esc_url( $url ? $url : home_url( '/shop/' ) );
}

/**
 * URL einer Seite anhand ihres Slugs (Fallback: /slug/).
 *
 * @param string $slug Seiten-Slug.
 * @return string
 */
function hejlejo_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	return esc_url( $page ? get_permalink( $page ) : home_url( '/' . $slug . '/' ) );
}

/**
 * Link für Kacheln: erste vorhandene Produktkategorie aus der Liste – sonst eine Produktsuche.
 *
 * So funktionieren die Links mit den vorhandenen Shop-Daten, ohne Kategorien anzulegen oder zu ändern.
 * Alle Links lassen sich anschließend im Editor frei ändern.
 *
 * @param string[] $category_slugs Mögliche Kategorie-Slugs.
 * @param string   $search         Suchbegriff als Fallback.
 * @return string
 */
function hejlejo_shop_link( $category_slugs, $search ) {
	if ( taxonomy_exists( 'product_cat' ) ) {
		foreach ( (array) $category_slugs as $slug ) {
			$term = get_term_by( 'slug', $slug, 'product_cat' );
			if ( $term && ! is_wp_error( $term ) ) {
				$link = get_term_link( $term );
				if ( ! is_wp_error( $link ) ) {
					return esc_url( $link );
				}
			}
		}
	}

	return esc_url(
		add_query_arg(
			array(
				's'         => $search,
				'post_type' => 'product',
			),
			home_url( '/' )
		)
	);
}

/**
 * URL einer Rechtstext-Seite: zuerst Germanized/WooCommerce-Zuordnung, dann Seiten-Slug.
 *
 * @param string $key  Germanized-Seitenschlüssel (imprint, data_security, terms, revocation, shipping_costs, payment_methods).
 * @param string $slug Fallback-Slug.
 * @return string
 */
function hejlejo_legal_url( $key, $slug ) {
	$url = '';

	if ( function_exists( 'wc_gzd_get_page_permalink' ) ) {
		$url = wc_gzd_get_page_permalink( $key );
	} elseif ( 'terms' === $key && function_exists( 'wc_get_page_permalink' ) ) {
		$url = wc_get_page_permalink( 'terms' );
	}

	if ( ! $url || home_url( '/' ) === trailingslashit( $url ) ) {
		return hejlejo_page_url( $slug );
	}

	return esc_url( $url );
}

/**
 * URL des Kundenkontos.
 *
 * @return string
 */
function hejlejo_account_url() {
	$url = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'myaccount' ) : '';
	return esc_url( $url ? $url : home_url( '/mein-konto/' ) );
}

/**
 * Einheitliche Produktkarte (Inhalt des Blocks "Produktvorlage").
 *
 * Wird von allen Produkt-Patterns und Shop-Templates verwendet, damit Karten überall gleich aussehen.
 *
 * @param string $heading_level Überschriftenebene des Produkttitels.
 * @param bool   $with_button   Warenkorb-Button anzeigen.
 * @return string Block-Markup.
 */
function hejlejo_product_card_markup( $heading_level = '3', $with_button = false ) {
	$level  = absint( $heading_level );
	$markup = '<!-- wp:group {"className":"hejlejo-card__media","layout":{"type":"default"}} -->
<div class="wp-block-group hejlejo-card__media">
<!-- wp:woocommerce/product-image {"showSaleBadge":false,"imageSizing":"thumbnail","isDescendentOfQueryLoop":true,"aspectRatio":"1"} /-->
<!-- wp:hejlejo/product-badges {"className":"hejlejo-card__badges"} /-->
</div>
<!-- /wp:group -->
<!-- wp:group {"className":"hejlejo-card__body","style":{"spacing":{"blockGap":"0.2rem"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group hejlejo-card__body">
<!-- wp:post-title {"level":' . $level . ',"isLink":true,"className":"hejlejo-card__title","fontSize":"small","__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->
<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true,"className":"hejlejo-card__price","fontSize":"small"} /-->';

	// Pflichtangaben (Grundpreis, MwSt., Versand) – Blöcke von Germanized. Ohne Germanized wird nichts ausgegeben.
	$markup .= '
<!-- wp:group {"className":"hejlejo-legal-info","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group hejlejo-legal-info">
<!-- wp:woocommerce-germanized/product-unit-price {"fontSize":"x-small"} /-->
<!-- wp:woocommerce-germanized/product-tax-info {"fontSize":"x-small"} /-->
<!-- wp:woocommerce-germanized/product-shipping-costs-info {"fontSize":"x-small"} /-->
</div>
<!-- /wp:group -->';

	if ( $with_button ) {
		$markup .= '
<!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true,"className":"hejlejo-card__button","fontSize":"x-small"} /-->';
	}

	$markup .= '
</div>
<!-- /wp:group -->';

	return $markup;
}

/**
 * Block "Produktsammlung" mit einheitlicher Karte.
 *
 * @param array $args {
 *     @type string $collection Sammlungstyp (z. B. "new-arrivals", "best-sellers"), leer = Standard.
 *     @type int    $per_page   Anzahl Produkte.
 *     @type int    $columns    Spalten auf großen Bildschirmen.
 *     @type bool   $inherit    Abfrage vom Template übernehmen (Shop-Archive).
 *     @type string $order_by   Sortierfeld.
 *     @type string $order      asc|desc.
 *     @type bool   $pagination Seitennavigation ausgeben.
 *     @type bool   $button     Warenkorb-Button in der Karte.
 * }
 * @return string Block-Markup.
 */
function hejlejo_product_collection_markup( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'collection' => '',
			'per_page'   => 6,
			'columns'    => 6,
			'inherit'    => false,
			'order_by'   => 'date',
			'order'      => 'desc',
			'pagination' => false,
			'button'     => false,
			'heading'    => '3',
		)
	);

	$attrs = array(
		'queryId'              => 0,
		'query'                => array(
			'perPage'                       => (int) $args['per_page'],
			'pages'                         => 0,
			'offset'                        => 0,
			'postType'                      => 'product',
			'order'                         => $args['order'],
			'orderBy'                       => $args['order_by'],
			'search'                        => '',
			'exclude'                       => array(),
			'inherit'                       => (bool) $args['inherit'],
			'taxQuery'                      => new stdClass(),
			'isProductCollectionBlock'      => true,
			'featured'                      => false,
			'woocommerceOnSale'             => false,
			'woocommerceStockStatus'        => array( 'instock', 'outofstock', 'onbackorder' ),
			'woocommerceAttributes'         => array(),
			'woocommerceHandPickedProducts' => array(),
			'filterable'                    => (bool) $args['inherit'],
		),
		'tagName'              => 'div',
		'displayLayout'        => array(
			'type'          => 'flex',
			'columns'       => (int) $args['columns'],
			'shrinkColumns' => true,
		),
		'dimensions'           => array( 'widthType' => 'fill' ),
		'queryContextIncludes' => array( 'collection' ),
		'align'                => 'wide',
		'className'            => 'hejlejo-products',
	);

	if ( $args['collection'] ) {
		$attrs['collection'] = 'woocommerce/product-collection/' . $args['collection'];
	}

	$markup  = '<!-- wp:woocommerce/product-collection ' . wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . ' -->' . "\n";
	$markup .= '<div class="wp-block-woocommerce-product-collection alignwide hejlejo-products">' . "\n";
	$markup .= '<!-- wp:woocommerce/product-template -->' . "\n" . hejlejo_product_card_markup( $args['heading'], $args['button'] ) . "\n" . '<!-- /wp:woocommerce/product-template -->' . "\n";

	if ( $args['pagination'] ) {
		$markup .= '<!-- wp:query-pagination {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
<!-- wp:query-pagination-previous {"label":"Zurück"} /-->
<!-- wp:query-pagination-numbers /-->
<!-- wp:query-pagination-next {"label":"Weiter"} /-->
<!-- /wp:query-pagination -->' . "\n";
	}

	$markup .= '<!-- wp:woocommerce/product-collection-no-results -->
<!-- wp:group {"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group">
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">Hier gibt es gerade keine passenden Produkte – schau dich gerne im <a href="' . hejlejo_shop_url() . '">Shop</a> um.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
<!-- /wp:woocommerce/product-collection-no-results -->' . "\n";

	$markup .= '</div>' . "\n" . '<!-- /wp:woocommerce/product-collection -->';

	return $markup;
}

/**
 * WordPress-Menü nach Namen finden.
 *
 * Reihenfolge:
 * 1. Klassisches Menü, das der Menüposition $location zugewiesen ist (Design → Menüs → Positionen verwalten).
 * 2. Block-Menü (Navigation) mit diesem Titel – z. B. nach "Klassisches Menü importieren" im Website-Editor.
 * 3. Klassisches Menü mit diesem Namen (Design → Menüs).
 * 4. Optional: das Menü an der ersten belegten Menüposition.
 *
 * @param string $name                Menüname.
 * @param bool   $fallback_location   Erstes zugewiesenes Menü nehmen, wenn keins mit dem Namen existiert.
 * @param string $location            Menüposition des Themes, z. B. "main".
 * @return array|null ['ref' => int] oder ['inner' => string Block-Markup], null wenn keins gefunden.
 */
function hejlejo_find_menu( $name, $fallback_location = false, $location = '' ) {
	$locations = (array) get_nav_menu_locations();

	if ( $location && ! empty( $locations[ $location ] ) && class_exists( 'WP_Classic_To_Block_Menu_Converter' ) ) {
		$assigned = wp_get_nav_menu_object( $locations[ $location ] );
		$inner    = $assigned ? WP_Classic_To_Block_Menu_Converter::convert( $assigned ) : '';
		if ( is_string( $inner ) && '' !== trim( $inner ) ) {
			return array( 'inner' => $inner );
		}
	}

	$navigations = get_posts(
		array(
			'post_type'      => 'wp_navigation',
			'post_status'    => 'publish',
			'posts_per_page' => 20,
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);

	foreach ( $navigations as $navigation ) {
		if ( 0 === strcasecmp( trim( $navigation->post_title ), $name ) ) {
			return array( 'ref' => (int) $navigation->ID );
		}
	}

	$menu = wp_get_nav_menu_object( $name );

	if ( ! $menu && $fallback_location ) {
		foreach ( (array) get_nav_menu_locations() as $menu_id ) {
			if ( $menu_id ) {
				$menu = wp_get_nav_menu_object( $menu_id );
				break;
			}
		}
	}

	if ( $menu && class_exists( 'WP_Classic_To_Block_Menu_Converter' ) ) {
		$inner = WP_Classic_To_Block_Menu_Converter::convert( $menu );
		if ( is_string( $inner ) && '' !== trim( $inner ) ) {
			return array( 'inner' => $inner );
		}
	}

	return null;
}

/**
 * Hauptmenü für den Header ermitteln: Menü "Main" (Block- oder klassisches Menü), sonst das Menü an der
 * ersten belegten Menüposition, sonst null – dann nutzt der Header seine Standardlinks.
 *
 * Name des Menüs per Filter "hejlejo_primary_menu_name" änderbar.
 *
 * @return array|null ['ref' => int] oder ['inner' => string Block-Markup].
 */
function hejlejo_primary_menu() {
	/**
	 * Name des Hauptmenüs.
	 *
	 * @param string $name Menüname.
	 */
	return hejlejo_find_menu( apply_filters( 'hejlejo_primary_menu_name', 'Main' ), true, 'main' );
}

/**
 * Footer-Spalten über WordPress-Menüs steuern.
 *
 * Jede Linkspalte im Footer ist ein Navigationsblock mit der Klasse "hejlejo-footer__nav" und einer
 * Beschriftung (Shop, Service, Rechtliches). Gibt es ein Menü "Footer Shop", "Footer Service" bzw.
 * "Footer Rechtliches" (Design → Menüs oder Block-Menü im Website-Editor), zeigt die Spalte dessen Einträge.
 * Ohne passendes Menü bleiben die Standardlinks des Themes.
 *
 * Läuft beim Rendern, wirkt also auch, wenn der Footer im Website-Editor bereits gespeichert wurde.
 *
 * @param array $parsed_block Geparster Block.
 * @return array
 */
function hejlejo_footer_menus( $parsed_block ) {
	if ( 'core/navigation' !== $parsed_block['blockName'] ) {
		return $parsed_block;
	}

	$attrs = $parsed_block['attrs'];
	$class = isset( $attrs['className'] ) ? $attrs['className'] : '';

	if ( false === strpos( $class, 'hejlejo-footer__nav' ) || empty( $attrs['ariaLabel'] ) || ! empty( $attrs['ref'] ) ) {
		return $parsed_block;
	}

	/**
	 * Name des Menüs für eine Footer-Spalte.
	 *
	 * @param string $name  Menüname, Standard "Footer {Spaltenname}".
	 * @param string $label Beschriftung der Spalte (Shop, Service, Rechtliches).
	 */
	$name = apply_filters( 'hejlejo_footer_menu_name', 'Footer ' . $attrs['ariaLabel'], $attrs['ariaLabel'] );
	$menu = hejlejo_find_menu( $name, false, 'footer-' . sanitize_title( $attrs['ariaLabel'] ) );

	if ( ! $menu ) {
		return $parsed_block;
	}

	// Block-Menü: Inhalt direkt übernehmen (ein nachträglich gesetztes "ref" greift beim Rendern nicht zuverlässig).
	if ( isset( $menu['ref'] ) ) {
		$navigation    = get_post( $menu['ref'] );
		$menu['inner'] = $navigation ? $navigation->post_content : '';
	}

	$inner = array_values(
		array_filter(
			parse_blocks( $menu['inner'] ),
			static function ( $block ) {
				return ! empty( $block['blockName'] );
			}
		)
	);

	if ( ! $inner ) {
		return $parsed_block;
	}

	// Untermenüs im Footer als einfache Links darstellen.
	$flat = array();
	foreach ( $inner as $block ) {
		if ( 'core/navigation-submenu' === $block['blockName'] ) {
			$children              = $block['innerBlocks'];
			$block['blockName']    = 'core/navigation-link';
			$block['innerBlocks']  = array();
			$block['innerContent'] = array();
			$flat[]                = $block;
			foreach ( $children as $child ) {
				$flat[] = $child;
			}
			continue;
		}
		$flat[] = $block;
	}

	$parsed_block['innerBlocks']  = $flat;
	$parsed_block['innerContent'] = array_fill( 0, count( $flat ), null );

	return $parsed_block;
}
add_filter( 'render_block_data', 'hejlejo_footer_menus' );
