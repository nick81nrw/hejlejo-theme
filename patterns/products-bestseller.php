<?php
/**
 * Title: Hej Lejo / Bestseller
 * Slug: hejlejo/products-bestseller
 * Categories: hejlejo-shop, hejlejo-sections
 * Keywords: produkte, bestseller, beliebt, woocommerce
 * Viewport Width: 1400
 * Description: Die meistverkauften Produkte im Hej-Lejo-Kartenstil.
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
		<h2 class="wp-block-heading has-x-large-font-size">Eure Lieblinge ♡</h2>
		<!-- /wp:heading -->
		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button {"className":"is-style-text-link"} -->
			<div class="wp-block-button is-style-text-link"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( add_query_arg( 'orderby', 'popularity', hejlejo_shop_url() ) ); ?>">Alle Bestseller</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
	<?php echo hejlejo_product_collection_markup( array( 'collection' => 'best-sellers', 'order_by' => 'popularity', 'per_page' => 4, 'columns' => 4 ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
<!-- /wp:group -->
