<?php
/**
 * Title: Hej Lejo / Seite: Startseite (schlicht)
 * Slug: hejlejo/page-home-simple
 * Categories: hejlejo-pages
 * Keywords: startseite, home, schlicht, minimal, landingpage
 * Block Types: core/post-content
 * Post Types: page, wp_template
 * Viewport Width: 1400
 * Description: Reduzierte Startseite: ruhiger Hero, vier Einstiegskarten, Neuheiten und ein kurzer Hinweis für Lädchen-Betreiber.
 *
 * @package HejLejo
 */

?>
<!-- wp:pattern {"slug":"hejlejo/hero-simple"} /-->
<!-- wp:pattern {"slug":"hejlejo/categories"} /-->
<!-- wp:pattern {"slug":"hejlejo/products-new"} /-->

<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained","contentSize":"1100px"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:pattern {"slug":"hejlejo/business"} /-->
</div>
<!-- /wp:group -->
