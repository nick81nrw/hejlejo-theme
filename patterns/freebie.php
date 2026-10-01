<?php
/**
 * Title: Hej Lejo / Freebie & Newsletter
 * Slug: hejlejo/freebie
 * Categories: hejlejo-sections
 * Keywords: freebie, newsletter, anmeldung, gratis, vorlage
 * Viewport Width: 900
 * Description: "Eine kleine Freude für dich ♡" – Freebie-Bereich. Den Button bei Bedarf durch den Shortcode- oder Formular-Block des Newsletter-Plugins ersetzen.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"align":"wide","className":"is-style-panel hejlejo-cta hejlejo-cta--freebie","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0"}},"backgroundColor":"rose-light","layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide is-style-panel hejlejo-cta hejlejo-cta--freebie has-rose-light-background-color has-background" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
	<!-- wp:group {"className":"hejlejo-cta__body","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"left","verticalAlignment":"center"}} -->
	<div class="wp-block-group hejlejo-cta__body" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"fontSize":"x-large"} -->
		<h2 class="wp-block-heading has-x-large-font-size">Eine kleine Freude für dich ♡</h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"fontSize":"small"} -->
		<p class="has-small-font-size">Hol dir eine kostenlose Vorlage und erfahre als Erste von neuen Designs &amp; Freebies.</p>
		<!-- /wp:paragraph -->
		<!-- wp:group {"className":"hejlejo-newsletter","layout":{"type":"constrained"}} -->
		<div class="wp-block-group hejlejo-newsletter">
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo hejlejo_page_url( 'newsletter' ); ?>">Freebie sichern</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:group -->
		<!-- wp:paragraph {"textColor":"muted","fontSize":"x-small"} -->
		<p class="has-muted-color has-text-color has-x-small-font-size">Kein Spam. Abmeldung jederzeit möglich.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
	<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","className":"hejlejo-cta__image"} -->
	<figure class="wp-block-image size-large hejlejo-cta__image"><img src="<?php echo hejlejo_image( 'placeholders/freebie.svg' ); ?>" alt="Eine Karte mit der Aufschrift kleine Freude für dich" style="aspect-ratio:1;object-fit:cover"/></figure>
	<!-- /wp:image -->
</div>
<!-- /wp:group -->
