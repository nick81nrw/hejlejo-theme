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

	if ( '' === trim( wp_strip_all_tags( $feed, true ) ) && false === strpos( $feed, '<img' ) && false === strpos( $feed, 'sbi' ) ) {
		return $block_content;
	}

	return '<div class="hejlejo-social__grid hejlejo-social__feed">' . $feed . '</div>';
}
add_filter( 'render_block_core/group', 'hejlejo_instagram_feed', 10, 2 );
