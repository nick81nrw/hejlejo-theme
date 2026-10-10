<?php
/**
 * Title: Hej Lejo / Freebie
 * Slug: hejlejo/freebie
 * Categories: hejlejo-sections
 * Keywords: freebie, gratis, instagram, vorlage, aktion
 * Viewport Width: 900
 * Description: Freebie-Karte: Läuft ein Freebie (Produkt in der Kategorie "Freebie"), führt der Button dorthin – sonst erscheint ein Hinweis auf Instagram. Texte in der Seitenleiste des Blocks "Freebie-Hinweis".
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"align":"wide","className":"is-style-panel hejlejo-cta hejlejo-cta--freebie","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0"}},"backgroundColor":"base","layout":{"type":"grid","columnCount":2,"minimumColumnWidth":null}} -->
<div class="wp-block-group alignwide is-style-panel hejlejo-cta hejlejo-cta--freebie has-base-background-color has-background" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0">
	<!-- wp:group {"className":"hejlejo-cta__body","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|20"},"elements":{"link":{"color":{"text":"var:preset|color|green"}}}},"backgroundColor":"base","textColor":"green","layout":{"type":"flex","orientation":"vertical","justifyContent":"left","verticalAlignment":"center"}} -->
	<div class="wp-block-group hejlejo-cta__body has-green-color has-base-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
		<!-- wp:hejlejo/freebie-status /-->
	</div>
	<!-- /wp:group -->
	<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","className":"hejlejo-cta__image"} -->
	<figure class="wp-block-image size-large hejlejo-cta__image"><img src="<?php echo hejlejo_image( 'content/freebie.png' ); ?>" alt="" style="aspect-ratio:1;object-fit:cover"/></figure>
	<!-- /wp:image -->
</div>
<!-- /wp:group -->
