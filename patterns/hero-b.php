<?php
/**
 * Title: Hej Lejo / Hero (für überlappende Karten)
 * Slug: hejlejo/hero-b
 * Categories: hejlejo-sections, featured
 * Keywords: hero, banner, startseite, titelbild
 * Viewport Width: 1400
 * Description: Großes Markenbild mit Headline und zwei Buttons, unten Platz für die überlappenden Kategorie-Karten. Mobil steht das Bild über dem Text.
 *
 * @package HejLejo
 */


?>
<!-- wp:cover {"url":"<?php echo hejlejo_image( 'placeholders/hero.svg' ); ?>","dimRatio":0,"isUserOverlayColor":true,"minHeight":620,"contentPosition":"center left","isDark":false,"align":"full","className":"is-style-hero hejlejo-hero--b","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|70"}}},"layout":{"type":"constrained","contentSize":"1320px"}} -->
<div class="wp-block-cover alignfull is-light has-custom-content-position is-position-center-left is-style-hero hejlejo-hero--b" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--70);min-height:620px"><img class="wp-block-cover__image-background" alt="" src="<?php echo hejlejo_image( 'placeholders/hero.svg' ); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><div class="wp-block-cover__inner-container">
	<!-- wp:group {"className":"hejlejo-hero__content","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"560px","justifyContent":"left"}} -->
	<div class="wp-block-group hejlejo-hero__content">
		<!-- wp:heading {"level":1,"fontSize":"huge"} -->
		<h1 class="wp-block-heading has-huge-font-size">Kleine Dinge.<br>Große Freude.</h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"fontSize":"large"} -->
		<p class="has-large-font-size">Kreative Designs, DIY-Ideen und besondere Kleinigkeiten zum Verschenken und Selbstbehalten.</p>
		<!-- /wp:paragraph -->
		<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|30"}}}} -->
		<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--30)">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo hejlejo_shop_url(); ?>">Jetzt entdecken</a></div>
			<!-- /wp:button -->
			<!-- wp:button {"className":"is-style-secondary"} -->
			<div class="wp-block-button is-style-secondary"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( add_query_arg( 'orderby', 'date', hejlejo_shop_url() ) ); ?>">Neuheiten</a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->

</div></div>
<!-- /wp:cover -->
