<?php
/**
 * Serverseitige Ausgabe "Produkt-Vorteile".
 *
 * Quelle sind ausschließlich vorhandene Produktdaten:
 * - "Herunterladbar" / "Virtuell" aus den Produktdaten,
 * - sichtbare Eigenschaften (Attribute), deren Name z. B. "Format", "Lizenz" oder "Material" enthält.
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

$hejlejo_items = array();

if ( $hejlejo_product->is_downloadable() ) {
	$hejlejo_items[] = array(
		'icon' => 'download',
		'text' => __( 'Sofort-Download nach Zahlungseingang', 'hejlejo' ),
	);
} elseif ( $hejlejo_product->is_virtual() ) {
	$hejlejo_items[] = array(
		'icon' => 'file',
		'text' => __( 'Digitales Produkt – kein Versand', 'hejlejo' ),
	);
} elseif ( ! $hejlejo_product->is_type( 'variable' ) ) {
	$hejlejo_items[] = array(
		'icon' => 'package',
		'text' => __( 'Sorgfältig verpackt & versendet', 'hejlejo' ),
	);
}

/**
 * Schlüsselwörter für Produkteigenschaften, die als Vorteil angezeigt werden.
 * Schlüssel = Suchbegriff im Eigenschaftsnamen, Wert = Icon.
 *
 * @param array $keywords Suchbegriffe.
 */
$hejlejo_keywords = apply_filters(
	'hejlejo_product_highlight_attribute_keywords',
	array(
		'format'   => 'file',
		'datei'    => 'file',
		'lizenz'   => 'license',
		'nutzung'  => 'license',
		'material' => 'hand',
		'handmade' => 'hand',
	)
);

foreach ( $hejlejo_product->get_attributes() as $hejlejo_attribute ) {
	if ( ! $hejlejo_attribute instanceof WC_Product_Attribute || ! $hejlejo_attribute->get_visible() || $hejlejo_attribute->get_variation() ) {
		continue;
	}

	$hejlejo_label = wc_attribute_label( $hejlejo_attribute->get_name(), $hejlejo_product );
	$hejlejo_icon  = '';

	foreach ( $hejlejo_keywords as $hejlejo_keyword => $hejlejo_keyword_icon ) {
		if ( false !== stripos( $hejlejo_label, $hejlejo_keyword ) ) {
			$hejlejo_icon = $hejlejo_keyword_icon;
			break;
		}
	}

	if ( ! $hejlejo_icon ) {
		continue;
	}

	if ( $hejlejo_attribute->is_taxonomy() ) {
		$hejlejo_values = wc_get_product_terms( $hejlejo_product->get_id(), $hejlejo_attribute->get_name(), array( 'fields' => 'names' ) );
	} else {
		$hejlejo_values = $hejlejo_attribute->get_options();
	}

	if ( empty( $hejlejo_values ) ) {
		continue;
	}

	$hejlejo_items[] = array(
		'icon'  => $hejlejo_icon,
		'label' => $hejlejo_label,
		'text'  => implode( ', ', array_map( 'wp_strip_all_tags', $hejlejo_values ) ),
	);
}

if ( ! empty( $attributes['promise'] ) ) {
	$hejlejo_items[] = array(
		'icon' => 'heart',
		'text' => $attributes['promise'],
	);
}

/**
 * Vorteile vor der Ausgabe anpassen.
 *
 * @param array      $items   Liste mit icon, text und optional label.
 * @param WC_Product $product Produkt.
 */
$hejlejo_items = apply_filters( 'hejlejo_product_highlights', $hejlejo_items, $hejlejo_product );

if ( empty( $hejlejo_items ) ) {
	return;
}
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'hejlejo-highlights' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<ul class="hejlejo-highlights__list">
		<?php foreach ( $hejlejo_items as $hejlejo_item ) : ?>
			<li class="hejlejo-highlights__item">
				<?php echo hejlejo_icon( $hejlejo_item['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span>
					<?php if ( ! empty( $hejlejo_item['label'] ) ) : ?>
						<strong><?php echo esc_html( $hejlejo_item['label'] ); ?>:</strong>
					<?php endif; ?>
					<?php echo esc_html( $hejlejo_item['text'] ); ?>
				</span>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
