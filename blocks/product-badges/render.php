<?php
/**
 * Serverseitige Ausgabe "Produkt-Badges".
 *
 * Es wird keine eigene Badge-Verwaltung benötigt:
 * - Schlagwörter (product_tag) mit den Slugs aus dem Filter "hejlejo_badge_tag_slugs" werden zu Badges,
 * - "Angebot" und "Sofort-Download" ergeben sich aus den Produktdaten.
 *
 * @package HejLejo
 *
 * @var array    $attributes Block-Attribute.
 * @var WP_Block $block      Block-Instanz.
 */

defined( 'ABSPATH' ) || exit;

$hejlejo_product = hejlejo_get_block_product( $block );

if ( ! $hejlejo_product ) {
	return;
}

$hejlejo_badges = array();

/*
 * Auf der Produktseite selbst zeigt die Bildergalerie bereits das Schild "Angebot" –
 * dort also kein zweites. In Produktkarten (Query-Loop) erscheint es wie gewohnt.
 */
$hejlejo_in_loop      = isset( $block->context['queryId'] );
$hejlejo_main_product = ! $hejlejo_in_loop && is_singular( 'product' ) && get_queried_object_id() === $hejlejo_product->get_id();

if ( ! empty( $attributes['showSale'] ) && ! $hejlejo_main_product && $hejlejo_product->is_on_sale() ) {
	$hejlejo_badges['sale'] = __( 'Angebot', 'hejlejo' );
}

$hejlejo_new_days = isset( $attributes['newDays'] ) ? absint( $attributes['newDays'] ) : 0;
$hejlejo_created  = $hejlejo_product->get_date_created();

if ( $hejlejo_new_days && $hejlejo_created && $hejlejo_created->getTimestamp() > time() - $hejlejo_new_days * DAY_IN_SECONDS ) {
	$hejlejo_badges['neu'] = __( 'Neu', 'hejlejo' );
}

/**
 * Schlagwort-Slugs, die als Badge angezeigt werden.
 *
 * @param string[] $slugs Slugs.
 */
$hejlejo_slugs = apply_filters( 'hejlejo_badge_tag_slugs', array( 'neu', 'bestseller', 'handmade', 'sofortdownload' ) );
$hejlejo_terms = get_the_terms( $hejlejo_product->get_id(), 'product_tag' );

if ( is_array( $hejlejo_terms ) ) {
	foreach ( $hejlejo_terms as $hejlejo_term ) {
		if ( in_array( $hejlejo_term->slug, $hejlejo_slugs, true ) ) {
			$hejlejo_badges[ $hejlejo_term->slug ] = $hejlejo_term->name;
		}
	}
}

if ( ! empty( $attributes['showDownload'] ) && $hejlejo_product->is_downloadable() && ! isset( $hejlejo_badges['sofortdownload'] ) ) {
	$hejlejo_badges['sofortdownload'] = __( 'Sofort-Download', 'hejlejo' );
}

/**
 * Badges vor der Ausgabe anpassen.
 *
 * @param array      $badges  Slug => Beschriftung.
 * @param WC_Product $product Produkt.
 */
$hejlejo_badges = apply_filters( 'hejlejo_product_badges', $hejlejo_badges, $hejlejo_product );

if ( empty( $hejlejo_badges ) ) {
	return;
}
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'hejlejo-badges' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php foreach ( $hejlejo_badges as $hejlejo_slug => $hejlejo_label ) : ?>
		<span class="hejlejo-badge hejlejo-badge--<?php echo esc_attr( sanitize_html_class( $hejlejo_slug ) ); ?>"><?php echo esc_html( $hejlejo_label ); ?></span>
	<?php endforeach; ?>
</div>
