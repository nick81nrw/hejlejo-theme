<?php
/**
 * Title: Hej Lejo / Produktfilter
 * Slug: hejlejo/hidden-product-filters
 * Inserter: no
 * Description: WooCommerce-Produktfilter für Shop- und Kategorieseiten: Kategorie, Produktart (Schlagwörter) und Preis.
 *
 * @package HejLejo
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}
?>
<!-- wp:woocommerce/product-filters {"className":"hejlejo-filters"} -->
<div class="wp-block-woocommerce-product-filters wc-block-product-filters hejlejo-filters" style="--wc-product-filters-text-color:#111;--wc-product-filters-background-color:#fff"><!-- wp:heading {"className":"hejlejo-filters__title","style":{"margin":{"top":"0","bottom":"0"},"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
<h2 class="wp-block-heading hejlejo-filters__title" style="margin-top:0;margin-bottom:0">Filter</h2>
<!-- /wp:heading -->

<!-- wp:woocommerce/product-filter-active -->
<div class="wp-block-woocommerce-product-filter-active"><!-- wp:woocommerce/product-filter-removable-chips -->
<div class="wp-block-woocommerce-product-filter-removable-chips wc-block-product-filter-removable-chips"></div>
<!-- /wp:woocommerce/product-filter-removable-chips -->

<!-- wp:woocommerce/product-filter-clear-button -->
<!-- wp:buttons {"layout":{"type":"flex","verticalAlignment":"stretched"}} -->
<div class="wp-block-buttons"><!-- wp:button {"className":"wc-block-product-filter-clear-button is-style-outline","style":{"border":{"width":"1px"},"typography":{"textDecoration":"none"},"outline":"none","fontSize":"medium","spacing":{"padding":{"left":"8px","right":"8px","top":"5px","bottom":"5px"}}}} -->
<div class="wp-block-button wc-block-product-filter-clear-button is-style-outline"><a class="wp-block-button__link wp-element-button" style="border-width:1px;padding-top:5px;padding-right:8px;padding-bottom:5px;padding-left:8px;text-decoration:none">Filter zurücksetzen</a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
<!-- /wp:woocommerce/product-filter-clear-button --></div>
<!-- /wp:woocommerce/product-filter-active -->

<!-- wp:woocommerce/product-filter-taxonomy {"taxonomy":"product_cat","showCounts":true} -->
<div class="wp-block-woocommerce-product-filter-taxonomy"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"0.625rem","top":"0"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:0.625rem">Kategorie</h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/product-filter-checkbox-list -->
<div class="wp-block-woocommerce-product-filter-checkbox-list wc-block-product-filter-checkbox-list"></div>
<!-- /wp:woocommerce/product-filter-checkbox-list --></div>
<!-- /wp:woocommerce/product-filter-taxonomy -->

<!-- wp:woocommerce/product-filter-taxonomy {"taxonomy":"product_tag","showCounts":true} -->
<div class="wp-block-woocommerce-product-filter-taxonomy"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"0.625rem","top":"0"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:0.625rem">Produktart</h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/product-filter-checkbox-list -->
<div class="wp-block-woocommerce-product-filter-checkbox-list wc-block-product-filter-checkbox-list"></div>
<!-- /wp:woocommerce/product-filter-checkbox-list --></div>
<!-- /wp:woocommerce/product-filter-taxonomy -->

<!-- wp:woocommerce/product-filter-price -->
<div class="wp-block-woocommerce-product-filter-price"><!-- wp:heading {"level":3,"style":{"spacing":{"margin":{"bottom":"0.625rem","top":"0"}}}} -->
<h3 class="wp-block-heading" style="margin-top:0;margin-bottom:0.625rem">Preis</h3>
<!-- /wp:heading -->

<!-- wp:woocommerce/product-filter-price-slider -->
<div class="wp-block-woocommerce-product-filter-price-slider wc-block-product-filter-price-slider"></div>
<!-- /wp:woocommerce/product-filter-price-slider --></div>
<!-- /wp:woocommerce/product-filter-price --></div>
<!-- /wp:woocommerce/product-filters -->
