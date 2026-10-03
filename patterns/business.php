<?php
/**
 * Title: Hej Lejo / Business CTA
 * Slug: hejlejo/business
 * Categories: hejlejo-sections
 * Keywords: business, lädchen, sb-schrank, handmade-shop, gewerbe, zielgruppe
 * Viewport Width: 900
 * Description: "Du hast selbst ein kleines Lädchen?" – Hinweis auf Vorlagen für SB-Schränke, Handmade-Shops und kreative Kleingewerbe.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"align":"wide","className":"is-style-panel hejlejo-cta hejlejo-cta--business","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0"}},"backgroundColor":"surface","layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide is-style-panel hejlejo-cta hejlejo-cta--business has-surface-background-color has-background" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
	<!-- wp:group {"className":"hejlejo-cta__body","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left","verticalAlignment":"center"}} -->
	<div class="wp-block-group hejlejo-cta__body" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"fontSize":"x-large"} -->
		<h2 class="wp-block-heading has-x-large-font-size">Du hast selbst ein kleines Lädchen?</h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"fontSize":"small"} -->
		<p class="has-small-font-size">Designs und Vorlagen für SB-Schränke, Handmade-Shops &amp; kreative Kleingewerbe.</p>
		<!-- /wp:paragraph -->
		<!-- wp:paragraph {"textColor":"muted","fontSize":"x-small"} -->
		<p class="has-muted-color has-text-color has-x-small-font-size">Produktkarten · Banderolen · Kerzendesigns · saisonale Vorlagen</p>
		<!-- /wp:paragraph -->
		<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
		<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--20)">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo hejlejo_page_url( 'fuer-dein-laedchen' ); ?>">Vorlagen für dein Business entdecken</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
	<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","className":"hejlejo-cta__image"} -->
	<figure class="wp-block-image size-large hejlejo-cta__image"><img src="<?php echo hejlejo_image( 'placeholders/business.svg' ); ?>" alt="Ein Schranklädchen mit Kerzen und kleinen Geschenken" style="aspect-ratio:1;object-fit:cover"/></figure>
	<!-- /wp:image -->
</div>
<!-- /wp:group -->
