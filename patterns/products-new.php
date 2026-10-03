<?php
/**
 * Title: Hej Lejo / Neuheiten
 * Slug: hejlejo/products-new
 * Categories: hejlejo-shop, hejlejo-sections
 * Keywords: produkte, neuheiten, neu, woocommerce
 * Viewport Width: 1400
 * Description: "Gerade neu eingezogen ♡" – die neuesten Produkte im Hej-Lejo-Kartenstil.
 *
 * @package HejLejo
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}
?>
<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:heading {"fontSize":"x-large"} -->
		<h2 class="wp-block-heading has-x-large-font-size">Gerade neu eingezogen ♡</h2>
		<!-- /wp:heading -->
		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"is-style-text-link"} -->
			<div class="wp-block-button is-style-text-link"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( add_query_arg( 'orderby', 'date', hejlejo_shop_url() ) ); ?>">Alle Neuheiten</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
	<?php echo hejlejo_product_collection_markup( array( 'collection' => 'new-arrivals', 'per_page' => 4, 'columns' => 4 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
<!-- /wp:group -->
