<?php
/**
 * Title: Hej Lejo / Ähnliche Produkte
 * Slug: hejlejo/hidden-related
 * Inserter: no
 *
 * @package HejLejo
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}
?>
<!-- wp:group {"align":"wide","className":"hejlejo-related","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","contentSize":"1320px"}} -->
<div class="wp-block-group alignwide hejlejo-related" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--30)">
	<!-- wp:heading {"fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-x-large-font-size">Das könnte dir auch gefallen ♡</h2>
	<!-- /wp:heading -->
	<?php
	echo hejlejo_product_collection_markup( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		array(
			'collection' => 'related',
			'per_page'   => 4,
			'columns'    => 4,
			'order_by'   => 'title',
			'order'      => 'asc',
		)
	);
	?>
</div>
<!-- /wp:group -->
