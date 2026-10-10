<?php
/**
 * Integrationen mit optionalen Plugins (ohne harte Abhängigkeit).
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Instagram: Ist "Smash Balloon Instagram Feed" aktiv, ersetzt der echte Feed (die letzten 4 Beiträge)
 * den Bildraster im Pattern "Hej Lejo / Instagram-Raster". Ohne Plugin bleiben die Bilder aus dem Editor sichtbar.
 *
 * Das Theme ruft Instagram nicht selbst ab – Konto-Verbindung und Zwischenspeicherung übernimmt das Plugin.
 *
 * @param string $block_content HTML des Blocks.
 * @param array  $block         Geparster Block.
 * @return string
 */
function hejlejo_instagram_feed( $block_content, $block ) {
	$class = isset( $block['attrs']['className'] ) ? $block['attrs']['className'] : '';

	if ( false === strpos( $class, 'hejlejo-social__grid' ) || ! shortcode_exists( 'instagram-feed' ) ) {
		return $block_content;
	}

	/**
	 * Shortcode für den Instagram-Feed.
	 *
	 * @param string $shortcode Shortcode.
	 */
	$shortcode = apply_filters( 'hejlejo_instagram_shortcode', '[instagram-feed num=4 cols=4 colsmobile=2 showheader=false showbutton=false showfollow=false imagepadding=4]' );
	$feed      = do_shortcode( $shortcode );

	// Noch kein Feed angelegt/verbunden: Smash Balloon liefert dann nur eine Fehlermeldung → Bilder aus dem Editor behalten.
	if ( false === strpos( $feed, 'sb_instagram' ) || false !== strpos( $feed, 'sbi_mod_error' ) ) {
		return $block_content;
	}

	return '<div class="hejlejo-social__grid hejlejo-social__feed">' . $feed . '</div>';
}
add_filter( 'render_block_core/group', 'hejlejo_instagram_feed', 10, 2 );

/**
 * Hinweisleiste über ein WordPress-Menü steuern.
 *
 * Gibt es unter Design → Menüs ein Menü namens "Hinweisleiste", werden dessen Einträge als
 * Hinweise angezeigt (Navigationsbeschriftung = Text, URL = optionaler Link; "#" oder leer = kein Link).
 * Ein vorhandenes, aber leeres Menü blendet die Leiste aus. Ohne Menü bleibt der Inhalt aus dem
 * Template-Teil "Hinweisleiste" (Website-Editor) sichtbar.
 *
 * @param string $block_content HTML des Blocks.
 * @param array  $block         Geparster Block.
 * @return string
 */
function hejlejo_announcement_from_menu( $block_content, $block ) {
	$class = isset( $block['attrs']['className'] ) ? $block['attrs']['className'] : '';

	if ( false === strpos( $class, 'hejlejo-announcement' ) ) {
		return $block_content;
	}

	/**
	 * Name des Menüs, das die Hinweisleiste befüllt.
	 *
	 * @param string $name Menüname.
	 */
	$locations = (array) get_nav_menu_locations();
	$menu      = ! empty( $locations['announcement'] )
		? wp_get_nav_menu_object( $locations['announcement'] )
		: wp_get_nav_menu_object( apply_filters( 'hejlejo_announcement_menu_name', 'Hinweisleiste' ) );

	if ( ! $menu ) {
		return $block_content;
	}

	$items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );

	if ( empty( $items ) ) {
		return '';
	}

	$messages = '';
	foreach ( $items as $item ) {
		if ( (int) $item->menu_item_parent ) {
			continue;
		}

		$text = esc_html( $item->title );
		$url  = trim( (string) $item->url );

		if ( '' !== $url && '#' !== $url ) {
			$text = sprintf( '<a href="%1$s">%2$s</a>', esc_url( $url ), $text );
		}

		$messages .= '<p>' . $text . '</p>';
	}

	// Nur die Absätze ersetzen, Hülle mit Farben und Abständen aus dem Editor beibehalten.
	$open = strpos( $block_content, '>' );
	if ( false === $open ) {
		return $block_content;
	}

	$tag = isset( $block['attrs']['tagName'] ) ? tag_escape( $block['attrs']['tagName'] ) : 'div';

	return substr( $block_content, 0, $open + 1 ) . $messages . '</' . $tag . '>';
}
add_filter( 'render_block_core/group', 'hejlejo_announcement_from_menu', 10, 2 );

/**
 * Leeren Template-Teil der Hinweisleiste nicht ausgeben (sonst bliebe ein leerer Streifen).
 *
 * @param string $block_content HTML des Blocks.
 * @param array  $block         Geparster Block.
 * @return string
 */
function hejlejo_hide_empty_announcement( $block_content, $block ) {
	if ( isset( $block['attrs']['slug'] ) && 'announcement' === $block['attrs']['slug']
		&& '' === trim( wp_strip_all_tags( $block_content, true ) ) ) {
		return '';
	}

	return $block_content;
}
add_filter( 'render_block_core/template-part', 'hejlejo_hide_empty_announcement', 10, 2 );

/**
 * Germanized: Steuerhinweis (und ggf. Hinweis zu Streichpreisen) im Footer des Themes ausgeben.
 *
 * Der Absatz mit der Klasse "hejlejo-footer__tax" zeigt den Text aus Germanized
 * (WooCommerce → Einstellungen → Germanized; bei Kleinunternehmern der §-19-Hinweis) plus Link zu den
 * Versandkosten. Germanized gibt den Hinweis sonst zusätzlich als eigene Zeile unter dem Footer aus –
 * diese Ausgabe wird dann entfernt. Ohne Germanized bleibt der Text aus dem Editor stehen.
 *
 * @param string $block_content HTML des Blocks.
 * @param array  $block         Geparster Block.
 * @return string
 */
function hejlejo_footer_tax_notice( $block_content, $block ) {
	$class = isset( $block['attrs']['className'] ) ? $block['attrs']['className'] : '';

	if ( false === strpos( $class, 'hejlejo-footer__tax' ) || ! function_exists( 'wc_gzd_is_small_business' ) || ! shortcode_exists( 'gzd_vat_info' ) ) {
		return $block_content;
	}

	$notices = array( trim( wp_strip_all_tags( do_shortcode( '[gzd_vat_info]' ) ) ) );

	if ( 'yes' === get_option( 'woocommerce_gzd_display_footer_sale_price_notice' ) && shortcode_exists( 'gzd_sale_info' ) ) {
		$notices[] = trim( wp_strip_all_tags( do_shortcode( '[gzd_sale_info]' ) ) );
	}

	$notices = array_filter( $notices );
	if ( ! $notices ) {
		return $block_content;
	}

	// Germanized-eigene Ausgabe am Seitenende entfernen, sonst stünde der Hinweis doppelt da.
	foreach ( array( 'woocommerce_gzd_template_footer_vat_info', 'woocommerce_gzd_template_footer_sale_info' ) as $callback ) {
		$priority = has_action( 'wp_footer', $callback );
		if ( false !== $priority ) {
			remove_action( 'wp_footer', $callback, $priority );
		}
	}

	$text = implode( ' ', array_map( 'esc_html', $notices ) );

	if ( function_exists( 'hejlejo_legal_url' ) ) {
		$text .= ' ' . sprintf(
			/* translators: %s: Link "Versandkosten" */
			esc_html__( 'Preise zzgl. %s', 'hejlejo' ),
			'<a href="' . hejlejo_legal_url( 'shipping_costs', 'versandarten' ) . '">' . esc_html__( 'Versandkosten', 'hejlejo' ) . '</a>'
		);
	}

	return preg_replace( '#(<p\b[^>]*>).*</p>#s', '$1' . str_replace( array( '\\', '$' ), array( '\\\\', '\\$' ), $text ) . '</p>', $block_content, 1 );
}
add_filter( 'render_block_core/paragraph', 'hejlejo_footer_tax_notice', 10, 2 );
