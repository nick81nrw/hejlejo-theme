<?php
/**
 * Title: Hej Lejo / Produktraster (Shop-Archiv)
 * Slug: hejlejo/hidden-product-grid
 * Inserter: no
 * Description: Produktraster für Shop, Kategorien, Schlagwörter und Suchergebnisse – übernimmt die Abfrage des Templates.
 *
 * @package HejLejo
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

echo hejlejo_product_collection_markup( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	array(
		'inherit'    => true,
		'per_page'   => 15,
		'columns'    => 3,
		'order_by'   => 'title',
		'order'      => 'asc',
		'pagination' => true,
		'heading'    => '2',
	)
);
