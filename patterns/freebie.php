<?php
/**
 * Title: Hej Lejo / Freebie & Newsletter
 * Slug: hejlejo/freebie
 * Categories: hejlejo-sections
 * Keywords: freebie, newsletter, anmeldung, gratis, vorlage
 * Viewport Width: 900
 * Description: Freebie-Bereich mit Button. Den Button bei Bedarf durch den Shortcode- oder Formular-Block des Newsletter-Plugins ersetzen.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"align":"wide","className":"is-style-panel hejlejo-cta hejlejo-cta--freebie","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0"}},"backgroundColor":"base","layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide is-style-panel hejlejo-cta hejlejo-cta--freebie has-base-background-color has-background" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
	<!-- wp:group {"className":"hejlejo-cta__body","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|20"},"elements":{"link":{"color":{"text":"var:preset|color|green"}}}},"backgroundColor":"base","textColor":"green","layout":{"type":"flex","orientation":"vertical","justifyContent":"left","verticalAlignment":"center"}} -->
	<div class="wp-block-group hejlejo-cta__body has-green-color has-base-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"fontSize":"x-large"} -->
		<h2 class="wp-block-heading has-x-large-font-size">Freebie</h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"textColor":"contrast","fontSize":"small"} -->
		<p class="has-contrast-color has-text-color has-small-font-size">Hol dir eine kostenlose Vorlage.</p>
		<!-- /wp:paragraph -->
		<!-- wp:group {"className":"hejlejo-newsletter","layout":{"type":"constrained"}} -->
		<div class="wp-block-group hejlejo-newsletter">
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button {"backgroundColor":"green","textColor":"surface","style":{"elements":{"link":{"color":{"text":"var:preset|color|surface"}}}}} -->
				<div class="wp-block-button"><a class="wp-block-button__link has-surface-color has-green-background-color has-text-color has-background has-link-color wp-element-button" href="<?php echo hejlejo_page_url( 'newsletter' ); ?>">Freebie sichern</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
		<!-- wp:paragraph {"textColor":"contrast","fontSize":"x-small"} -->
		<p class="has-contrast-color has-text-color has-x-small-font-size">Kein Spam. Abmeldung jederzeit möglich.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
	<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","className":"hejlejo-cta__image"} -->
	<figure class="wp-block-image size-large hejlejo-cta__image"><img src="<?php echo hejlejo_image( 'content/freebie.png' ); ?>" alt="" style="aspect-ratio:1;object-fit:cover"/></figure>
	<!-- /wp:image -->
</div>
<!-- /wp:group -->
