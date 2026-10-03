<?php
/**
 * Title: Hej Lejo / Seite: Startseite (Variante B – Greige & Grün)
 * Slug: hejlejo/page-home-b
 * Categories: hejlejo-pages
 * Keywords: startseite, home, landingpage, variante, greige, grün
 * Block Types: core/post-content
 * Post Types: page, wp_template
 * Viewport Width: 1400
 * Description: Alternative Startseite im Farbklima der bisherigen Seite: Greige-Hintergrund, grüne Bereiche mit hellen Buttons, Kategorie-Karten überlappen den Hero, großer Bereich für Schranklädchen-Betreiber.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"align":"full","className":"hejlejo-home-b","style":{"spacing":{"blockGap":"0","padding":{"top":"0","bottom":"0"}}},"backgroundColor":"greige","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-home-b has-greige-background-color has-background" style="padding-top:0;padding-bottom:0">
	<!-- wp:pattern {"slug":"hejlejo/hero-b"} /-->
	<!-- wp:pattern {"slug":"hejlejo/categories-overlap"} /-->
	<!-- wp:pattern {"slug":"hejlejo/trust-line"} /-->
	<!-- wp:pattern {"slug":"hejlejo/products-new"} /-->
	<!-- wp:pattern {"slug":"hejlejo/occasions-green"} /-->
	<!-- wp:pattern {"slug":"hejlejo/steps"} /-->
	<!-- wp:pattern {"slug":"hejlejo/business-feature"} /-->
	<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|30"}}},"layout":{"type":"constrained","contentSize":"1100px"}} -->
	<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--30)">
		<!-- wp:pattern {"slug":"hejlejo/freebie"} /-->
	</div>
	<!-- /wp:group -->
	<!-- wp:pattern {"slug":"hejlejo/instagram"} /-->
</div>
<!-- /wp:group -->
