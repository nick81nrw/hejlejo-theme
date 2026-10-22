<?php
/**
 * Freebies: kostenlose Produkte mit Laufzeit, beworben über Instagram.
 *
 * - Ein Freebie ist ein normales Produkt (0 €) in der Produktkategorie "Freebie" (Slug "freebie").
 * - Im Produkt gibt es unter "Produktdaten → Allgemein" zwei Felder: "Freebie verfügbar bis" und "Instagram-Beitrag".
 * - Freebies sind im Shop unsichtbar (Katalog-Sichtbarkeit "Versteckt"), nur über Startseite und Instagram erreichbar.
 * - Nach Ablauf lässt sich das Produkt nicht mehr kaufen; die Produktseite verweist dann auf Instagram.
 * - Der Block "Freebie-Hinweis" (hejlejo/freebie-status) zeigt das aktuelle Freebie oder einen Instagram-Hinweis.
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

const HEJLEJO_FREEBIE_CAT       = 'freebie';
const HEJLEJO_FREEBIE_UNTIL     = '_hejlejo_freebie_until';
const HEJLEJO_FREEBIE_INSTAGRAM = '_hejlejo_freebie_instagram';

/**
 * Instagram-Profil für Hinweise ohne aktives Freebie.
 *
 * @return string
 */
function hejlejo_instagram_profile_url() {
	/**
	 * Link zum Instagram-Profil.
	 *
	 * @param string $url URL.
	 */
	return apply_filters( 'hejlejo_instagram_profile_url', 'https://www.instagram.com/hej.lejo/' );
}

/**
 * Ist das Produkt ein Freebie (Kategorie "Freebie")?
 *
 * @param WC_Product|int $product Produkt oder ID.
 * @return bool
 */
function hejlejo_is_freebie( $product ) {
	$id = $product instanceof WC_Product ? $product->get_id() : absint( $product );
	if ( $product instanceof WC_Product && $product->get_parent_id() ) {
		$id = $product->get_parent_id();
	}
	return $id && has_term( HEJLEJO_FREEBIE_CAT, 'product_cat', $id );
}

/**
 * Ende der Freebie-Laufzeit als Zeitstempel (0 = unbegrenzt).
 *
 * Gespeichert wird die Eingabe in Ortszeit ("2026-11-15T23:59"); ein reines Datum gilt bis 23:59 Uhr.
 *
 * @param WC_Product|int $product Produkt oder ID.
 * @return int
 */
function hejlejo_freebie_end( $product ) {
	$id    = $product instanceof WC_Product ? ( $product->get_parent_id() ? $product->get_parent_id() : $product->get_id() ) : absint( $product );
	$value = trim( (string) get_post_meta( $id, HEJLEJO_FREEBIE_UNTIL, true ) );

	if ( '' === $value ) {
		return 0;
	}

	if ( preg_match( '/^\d{4}-\d{2}-\d{2}$/', $value ) ) {
		$value .= 'T23:59';
	}

	$date = date_create_immutable( str_replace( ' ', 'T', $value ), wp_timezone() );

	return $date ? $date->getTimestamp() : 0;
}

/**
 * Ist die Laufzeit des Freebies abgelaufen?
 *
 * @param WC_Product|int $product Produkt oder ID.
 * @return bool
 */
function hejlejo_freebie_expired( $product ) {
	$end = hejlejo_freebie_end( $product );
	return $end && $end < time();
}

/**
 * Enddatum lesbar ausgeben, z. B. "15. November 2026, 23:59 Uhr".
 *
 * @param int $timestamp Zeitstempel.
 * @return string
 */
function hejlejo_freebie_date( $timestamp ) {
	return wp_date( get_option( 'date_format' ), $timestamp ) . ', ' . wp_date( 'G:i', $timestamp ) . ' Uhr';
}

/**
 * Das aktuell laufende Freebie (neuestes zuerst) – oder null.
 *
 * Private Freebies sind nur für eingeloggte Personen sichtbar, die private Produkte sehen dürfen (zum Testen).
 *
 * @return WC_Product|null
 */
function hejlejo_get_active_freebie() {
	static $cache = array();

	$statuses = current_user_can( 'read_private_products' ) ? array( 'publish', 'private' ) : array( 'publish' );
	$key      = implode( ',', $statuses );
	if ( array_key_exists( $key, $cache ) ) {
		return $cache[ $key ];
	}

	$ids = get_posts(
		array(
			'post_type'      => 'product',
			'post_status'    => $statuses,
			'posts_per_page' => 10,
			'orderby'        => 'date',
			'order'          => 'DESC',
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'tax_query'      => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => HEJLEJO_FREEBIE_CAT,
				),
			),
		)
	);

	$cache[ $key ] = null;
	foreach ( $ids as $id ) {
		$product = wc_get_product( $id );
		if ( $product && ! hejlejo_freebie_expired( $product ) && $product->is_in_stock() ) {
			$cache[ $key ] = $product;
			break;
		}
	}

	return $cache[ $key ];
}

/**
 * Restlaufzeit als kurzer Hinweis: "Nur noch heute", "Nur noch bis morgen", "Noch 9 Tage".
 *
 * Gezählt werden Kalendertage in der Zeitzone der Website. view.js rechnet im Browser nach,
 * falls die Seite aus einem Cache kommt.
 *
 * @param int $timestamp Ende der Laufzeit (0 = unbegrenzt).
 * @return string
 */
function hejlejo_freebie_countdown( $timestamp ) {
	if ( ! $timestamp ) {
		return '';
	}

	$timezone = wp_timezone();
	$today    = new DateTimeImmutable( 'today', $timezone );
	$end      = ( new DateTimeImmutable( '@' . $timestamp ) )->setTimezone( $timezone )->setTime( 0, 0 );
	$days     = (int) $today->diff( $end )->format( '%r%a' );

	if ( $days <= 0 ) {
		return __( 'Nur noch heute', 'hejlejo' );
	}
	if ( 1 === $days ) {
		return __( 'Nur noch bis morgen', 'hejlejo' );
	}
	/* translators: %d: Anzahl Tage */
	return sprintf( _n( 'Noch %d Tag', 'Noch %d Tage', $days, 'hejlejo' ), $days );
}

/**
 * Felder registrieren, damit sie auch über die REST-API (und damit z. B. per MCP) gesetzt werden können.
 */
function hejlejo_register_freebie_meta() {
	foreach ( array( HEJLEJO_FREEBIE_UNTIL, HEJLEJO_FREEBIE_INSTAGRAM ) as $key ) {
		register_post_meta(
			'product',
			$key,
			array(
				'type'              => 'string',
				'single'            => true,
				'show_in_rest'      => true,
				'sanitize_callback' => HEJLEJO_FREEBIE_INSTAGRAM === $key ? 'esc_url_raw' : 'sanitize_text_field',
				'auth_callback'     => function ( $allowed, $meta_key, $post_id ) {
					return current_user_can( 'edit_post', $post_id );
				},
			)
		);
	}
}
add_action( 'init', 'hejlejo_register_freebie_meta' );

/**
 * Felder im Produkt: "Produktdaten → Allgemein".
 */
function hejlejo_freebie_product_fields() {
	global $product_object;

	$id     = $product_object instanceof WC_Product ? $product_object->get_id() : get_the_ID();
	$until  = (string) get_post_meta( $id, HEJLEJO_FREEBIE_UNTIL, true );
	$is_cat = $id && hejlejo_is_freebie( $id );
	$hint   = $is_cat
		? __( 'Dieses Produkt ist ein Freebie und im Shop ausgeblendet.', 'hejlejo' )
		: __( 'Die Felder wirken nur, wenn das Produkt in der Kategorie „Freebie“ ist.', 'hejlejo' );

	echo '<div class="options_group hejlejo-freebie-fields">';
	echo '<p class="form-field"><strong>' . esc_html__( 'Freebie', 'hejlejo' ) . '</strong><br><span class="description">' . esc_html( $hint ) . '</span></p>';

	woocommerce_wp_text_input(
		array(
			'id'          => HEJLEJO_FREEBIE_UNTIL,
			'label'       => __( 'Freebie verfügbar bis', 'hejlejo' ),
			'type'        => 'datetime-local',
			'value'       => str_replace( ' ', 'T', $until ),
			'desc_tip'    => true,
			'description' => __( 'Danach ist das Freebie nicht mehr erhältlich; die Startseite zeigt dann den Instagram-Hinweis. Leer = unbegrenzt.', 'hejlejo' ),
		)
	);

	woocommerce_wp_text_input(
		array(
			'id'          => HEJLEJO_FREEBIE_INSTAGRAM,
			'label'       => __( 'Instagram-Beitrag', 'hejlejo' ),
			'type'        => 'url',
			'placeholder' => 'https://www.instagram.com/p/…',
			'desc_tip'    => true,
			'description' => __( 'Link zum Instagram-Beitrag der Aktion – erscheint auf der Produktseite.', 'hejlejo' ),
		)
	);

	echo '</div>';
}
add_action( 'woocommerce_product_options_general_product_data', 'hejlejo_freebie_product_fields' );

/**
 * Felder speichern; Freebies automatisch im Katalog verstecken.
 *
 * @param WC_Product $product Produkt.
 */
function hejlejo_freebie_save_product( $product ) {
	// phpcs:disable WordPress.Security.NonceVerification.Missing -- WooCommerce prüft die Nonce vor diesem Hook.
	if ( isset( $_POST[ HEJLEJO_FREEBIE_UNTIL ] ) ) {
		$product->update_meta_data( HEJLEJO_FREEBIE_UNTIL, sanitize_text_field( wp_unslash( $_POST[ HEJLEJO_FREEBIE_UNTIL ] ) ) );
	}
	if ( isset( $_POST[ HEJLEJO_FREEBIE_INSTAGRAM ] ) ) {
		$product->update_meta_data( HEJLEJO_FREEBIE_INSTAGRAM, esc_url_raw( wp_unslash( $_POST[ HEJLEJO_FREEBIE_INSTAGRAM ] ) ) );
	}
	// phpcs:enable

	$cats = $product->get_category_ids();
	$term = get_term_by( 'slug', HEJLEJO_FREEBIE_CAT, 'product_cat' );
	if ( $term && in_array( (int) $term->term_id, array_map( 'intval', $cats ), true ) ) {
		$product->set_catalog_visibility( 'hidden' );
	}
}
add_action( 'woocommerce_admin_process_product_object', 'hejlejo_freebie_save_product' );

/**
 * Abgelaufene Freebies sind nicht mehr kaufbar.
 *
 * @param bool       $purchasable Kaufbar.
 * @param WC_Product $product     Produkt.
 * @return bool
 */
function hejlejo_freebie_purchasable( $purchasable, $product ) {
	if ( $purchasable && hejlejo_is_freebie( $product ) && hejlejo_freebie_expired( $product ) ) {
		return false;
	}
	return $purchasable;
}
add_filter( 'woocommerce_is_purchasable', 'hejlejo_freebie_purchasable', 10, 2 );
add_filter( 'woocommerce_variation_is_purchasable', 'hejlejo_freebie_purchasable', 10, 2 );

/**
 * Produktseite: Hinweis unter dem Warenkorb-Button (Laufzeit + Instagram-Beitrag bzw. "Aktion vorbei").
 *
 * @param string $block_content HTML des Blocks.
 * @return string
 */
function hejlejo_freebie_product_notice( $block_content ) {
	if ( ! is_singular( 'product' ) ) {
		return $block_content;
	}

	$product = wc_get_product( get_queried_object_id() );
	if ( ! $product || ! hejlejo_is_freebie( $product ) ) {
		return $block_content;
	}

	$end = hejlejo_freebie_end( $product );

	if ( hejlejo_freebie_expired( $product ) ) {
		$text   = __( 'Diese Freebie-Aktion ist leider vorbei. Folge uns auf Instagram, damit du die nächste nicht verpasst ♡', 'hejlejo' );
		$link   = hejlejo_instagram_profile_url();
		$button = __( 'Zu Instagram', 'hejlejo' );
		$class  = 'is-expired';
	} else {
		$text   = $end
			/* translators: %s: Enddatum */
			? sprintf( __( 'Dieses Freebie gibt’s dank unserer Instagram-Aktion – nur bis %s.', 'hejlejo' ), hejlejo_freebie_date( $end ) )
			: __( 'Dieses Freebie gibt’s dank unserer Instagram-Aktion.', 'hejlejo' );
		$post   = (string) get_post_meta( $product->get_id(), HEJLEJO_FREEBIE_INSTAGRAM, true );
		$link   = $post ? $post : hejlejo_instagram_profile_url();
		$button = $post ? __( 'Zum Instagram-Beitrag', 'hejlejo' ) : __( 'Zu Instagram', 'hejlejo' );
		$class  = 'is-active';
	}

	$notice = sprintf(
		'<div class="hejlejo-freebie-notice %1$s"><p>%2$s</p><a class="hejlejo-freebie-notice__link" href="%3$s" target="_blank" rel="noopener">%4$s</a></div>',
		esc_attr( $class ),
		esc_html( $text ),
		esc_url( $link ),
		esc_html( $button )
	);

	return $block_content . $notice;
}
add_filter( 'render_block_woocommerce/add-to-cart-form', 'hejlejo_freebie_product_notice' );

/**
 * Zum Ende der Laufzeit den Seiten-Cache leeren (LiteSpeed), damit die Startseite umschaltet.
 *
 * Läuft bei jeder Änderung des Felds – im Produkt-Editor ebenso wie über die REST-API.
 *
 * @param int    $meta_id  Meta-ID.
 * @param int    $post_id  Produkt-ID.
 * @param string $meta_key Schlüssel.
 */
function hejlejo_freebie_schedule_expiry( $meta_id, $post_id, $meta_key ) {
	if ( HEJLEJO_FREEBIE_UNTIL !== $meta_key ) {
		return;
	}

	wp_clear_scheduled_hook( 'hejlejo_freebie_expired', array( (int) $post_id ) );

	$end = hejlejo_freebie_end( $post_id );
	if ( $end > time() ) {
		wp_schedule_single_event( $end + 60, 'hejlejo_freebie_expired', array( (int) $post_id ) );
	}
}
add_action( 'added_post_meta', 'hejlejo_freebie_schedule_expiry', 10, 3 );
add_action( 'updated_post_meta', 'hejlejo_freebie_schedule_expiry', 10, 3 );

/**
 * Cache von Produkt und Startseite leeren.
 *
 * @param int $post_id Produkt-ID.
 */
function hejlejo_freebie_purge_cache( $post_id ) {
	do_action( 'litespeed_purge_post', (int) $post_id );

	$front = (int) get_option( 'page_on_front' );
	if ( $front ) {
		do_action( 'litespeed_purge_post', $front );
	}
	do_action( 'litespeed_purge_url', home_url( '/' ) );
}
add_action( 'hejlejo_freebie_expired', 'hejlejo_freebie_purge_cache' );

/*
 * -------------------------------------------------------------------------
 * Startseite: Läuft ein Freebie, steht es als große Aktionsfläche direkt unter dem Bereich "Beliebte Kategorien"
 * (ohne Kategorie-Bereich direkt unter dem Startbild).
 * Die Freebie-Karte weiter unten entfällt dann. Funktioniert auch mit einer gespeicherten Startseite,
 * weil nur die Ausgabe ergänzt wird – am Seiteninhalt ändert sich nichts.
 * ---------------------------------------------------------------------- */

/**
 * Wurde die Aktionsfläche auf dieser Seite schon ausgegeben?
 *
 * @param bool|null $set true = als ausgegeben merken.
 * @return bool
 */
function hejlejo_freebie_spotlight_shown( $set = null ) {
	static $shown = false;
	if ( null !== $set ) {
		$shown = (bool) $set;
	}
	return $shown;
}

/**
 * Hat der Block eine bestimmte CSS-Klasse (genaue Übereinstimmung)?
 *
 * @param array  $block Geparster Block.
 * @param string ...$classes Gesuchte Klassen.
 * @return bool
 */
function hejlejo_block_has_class( $block, ...$classes ) {
	$names = preg_split( '/\s+/', (string) ( $block['attrs']['className'] ?? '' ), -1, PREG_SPLIT_NO_EMPTY );
	return (bool) array_intersect( $classes, $names );
}

/**
 * Texte des Blocks "Freebie-Hinweis" aus dem Startseiten-Inhalt übernehmen (falls dort angepasst).
 *
 * @param array $blocks Geparste Blöcke.
 * @return array
 */
function hejlejo_freebie_find_attrs( $blocks ) {
	foreach ( $blocks as $block ) {
		if ( 'hejlejo/freebie-status' === $block['blockName'] ) {
			return (array) $block['attrs'];
		}
		if ( ! empty( $block['innerBlocks'] ) ) {
			$found = hejlejo_freebie_find_attrs( $block['innerBlocks'] );
			if ( $found ) {
				return $found;
			}
		}
	}
	return array();
}

/**
 * Nur bei der normalen Seitenausgabe eingreifen, nicht im Editor oder in der REST-API.
 *
 * @return bool
 */
function hejlejo_freebie_on_front_output() {
	return ! is_admin() && ! wp_is_serving_rest_request() && is_front_page();
}

/**
 * Aktionsfläche hinter dem Kategorie-Bereich einsetzen – oder hinter dem Startbild, wenn die Startseite
 * keinen Kategorie-Bereich hat.
 *
 * @param string $block_content HTML.
 * @param array  $block         Geparster Block.
 * @return string
 */
function hejlejo_freebie_home_spotlight( $block_content, $block ) {
	if ( hejlejo_freebie_spotlight_shown() || ! hejlejo_block_has_class( $block, 'hejlejo-categories', 'hejlejo-hero-simple', 'is-style-hero' ) ) {
		return $block_content;
	}
	if ( ! hejlejo_freebie_on_front_output() || ! hejlejo_get_active_freebie() ) {
		return $block_content;
	}

	$content = (string) get_post_field( 'post_content', get_queried_object_id() );
	$is_hero = ! hejlejo_block_has_class( $block, 'hejlejo-categories' );
	if ( $is_hero && false !== strpos( $content, 'hejlejo-categories' ) ) {
		return $block_content; // Kommt noch: dann hinter die Kategorien.
	}

	hejlejo_freebie_spotlight_shown( true );

	$attrs = hejlejo_freebie_find_attrs( parse_blocks( $content ) );

	return $block_content . render_block(
		array(
			'blockName'    => 'hejlejo/freebie-status',
			'attrs'        => array_merge( $attrs, array( 'variant' => 'spotlight' ) ),
			'innerBlocks'  => array(),
			'innerHTML'    => '',
			'innerContent' => array(),
		)
	);
}
add_filter( 'render_block_core/group', 'hejlejo_freebie_home_spotlight', 10, 2 );
add_filter( 'render_block_core/cover', 'hejlejo_freebie_home_spotlight', 10, 2 );

/**
 * Freebie-Karte (Pattern "Hej Lejo / Freebie"): entfällt, wenn die Aktionsfläche schon oben steht.
 * Sonst zeigt sie das Produktbild statt der Illustration.
 *
 * @param string $block_content HTML.
 * @param array  $block         Geparster Block.
 * @return string
 */
function hejlejo_freebie_home_card( $block_content, $block ) {
	if ( ! hejlejo_block_has_class( $block, 'hejlejo-cta--freebie' ) || is_admin() || wp_is_serving_rest_request() ) {
		return $block_content;
	}
	if ( hejlejo_freebie_spotlight_shown() ) {
		return '';
	}

	$freebie  = hejlejo_get_active_freebie();
	$image_id = $freebie ? (int) $freebie->get_image_id() : 0;
	if ( ! $image_id ) {
		return $block_content;
	}

	$html = new WP_HTML_Tag_Processor( $block_content );
	while ( $html->next_tag( 'figure' ) ) {
		if ( ! $html->has_class( 'hejlejo-cta__image' ) ) {
			continue;
		}
		if ( $html->next_tag( 'img' ) ) {
			$html->set_attribute( 'src', (string) wp_get_attachment_image_url( $image_id, 'woocommerce_single' ) );
			$html->set_attribute( 'srcset', (string) wp_get_attachment_image_srcset( $image_id, 'woocommerce_single' ) );
			$html->set_attribute( 'sizes', '(max-width: 599px) 100vw, 480px' );
			$html->set_attribute( 'alt', '' );
		}
		break;
	}

	return $html->get_updated_html();
}
add_filter( 'render_block_core/group', 'hejlejo_freebie_home_card', 10, 2 );
