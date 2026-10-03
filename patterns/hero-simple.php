<?php
/**
 * Title: Hej Lejo / Hero (schlicht)
 * Slug: hejlejo/hero-simple
 * Categories: hejlejo-sections, featured
 * Keywords: hero, banner, startseite, schlicht, titelbild
 * Viewport Width: 1400
 * Description: Ruhiger Einstieg: Greige-Fläche mit Dachzeile, Überschrift und Button, daneben (mobil darunter) ein Foto, das unten aus der Fläche herausragt.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"align":"full","className":"hejlejo-hero-simple","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-hero-simple" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:0">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"44%","className":"hejlejo-hero-simple__text","style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column is-vertically-aligned-center hejlejo-hero-simple__text" style="flex-basis:44%">
			<!-- wp:paragraph {"className":"hejlejo-hero-simple__eyebrow","fontSize":"medium"} -->
			<p class="hejlejo-hero-simple__eyebrow has-medium-font-size">Mit Liebe gestaltet</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":1,"fontSize":"huge"} -->
			<h1 class="wp-block-heading has-huge-font-size">Kleine Dinge. Große Freude.</h1>
			<!-- /wp:heading -->
			<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
			<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--20)">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo hejlejo_shop_url(); ?>">Zum Sortiment</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"56%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:56%">
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","className":"hejlejo-hero-simple__image"} -->
			<figure class="wp-block-image size-large hejlejo-hero-simple__image"><img src="<?php echo hejlejo_image( 'placeholders/step-candle.svg' ); ?>" alt="Eine gestaltete Kerze mit dem Schriftzug Glück" style="aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
