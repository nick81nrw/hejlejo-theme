<?php
/**
 * Title: Hej Lejo / 404-Inhalt
 * Slug: hejlejo/hidden-404
 * Inserter: no
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"600px"}} -->
<div class="wp-block-group hejlejo-section" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:image {"width":"56px","height":"56px","sizeSlug":"full","align":"center","className":"hejlejo-icon-img"} -->
	<figure class="wp-block-image aligncenter size-full is-resized hejlejo-icon-img"><img src="<?php echo hejlejo_image( 'icons/heart.svg' ); ?>" alt="" style="width:56px;height:56px"/></figure>
	<!-- /wp:image -->
	<!-- wp:heading {"textAlign":"center","level":1} -->
	<h1 class="wp-block-heading has-text-align-center">Hoppla – diese Seite gibt es nicht (mehr).</h1>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center">Vielleicht ist das Produkt umgezogen. Probier es mit der Suche oder stöbere im Shop.</p>
	<!-- /wp:paragraph -->
	<!-- wp:search {"label":"Suche","showLabel":false,"placeholder":"Wonach suchst du?","buttonText":"Suchen","query":{"post_type":"product"}} /-->
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button -->
		<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo hejlejo_shop_url(); ?>">Zum Shop</a></div>
		<!-- /wp:button -->
		<!-- wp:button {"className":"is-style-secondary"} -->
		<div class="wp-block-button is-style-secondary"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>">Zur Startseite</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
