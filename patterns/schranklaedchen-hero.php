<?php
/**
 * Title: Hej Lejo / Schranklädchen Hero
 * Slug: hejlejo/schranklaedchen-hero
 * Categories: hejlejo-sections
 * Keywords: schranklädchen, sb-schrank, laden, hero, geschichte
 * Viewport Width: 1400
 * Description: Großes Bild mit der Botschaft "Hier hat alles angefangen." und kurzer Geschichte.
 *
 * @package HejLejo
 */

?>
<!-- wp:cover {"url":"<?php echo hejlejo_image( 'placeholders/schranklaedchen.svg' ); ?>","dimRatio":0,"isUserOverlayColor":true,"minHeight":560,"contentPosition":"center left","isDark":false,"align":"full","className":"is-style-hero","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained","contentSize":"1320px"}} -->
<div class="wp-block-cover alignfull is-light has-custom-content-position is-position-center-left is-style-hero" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);min-height:560px"><img class="wp-block-cover__image-background" alt="" src="<?php echo hejlejo_image( 'placeholders/schranklaedchen.svg' ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container">
	<!-- wp:group {"className":"hejlejo-hero__content","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"540px","justifyContent":"left"}} -->
	<div class="wp-block-group hejlejo-hero__content">
		<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
		<p class="is-style-eyebrow">Das Schranklädchen</p>
		<!-- /wp:paragraph -->
		<!-- wp:heading {"level":1,"fontSize":"huge"} -->
		<h1 class="wp-block-heading has-huge-font-size">Hier hat alles angefangen.</h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"fontSize":"large"} -->
		<p class="has-large-font-size">Ein kleiner Schrank, ein paar Kerzen und ganz viel Herzblut: Im Schranklädchen findest du ausgewählte Lieblingsstücke zum Mitnehmen – ganz unkompliziert.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div></div>
<!-- /wp:cover -->
