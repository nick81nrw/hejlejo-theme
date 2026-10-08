<?php
/**
 * Title: Hej Lejo / Seite: Für dein Lädchen
 * Slug: hejlejo/page-business
 * Categories: hejlejo-pages
 * Keywords: business, lädchen, gewerbe, landingpage, sb-schrank
 * Block Types: core/post-content
 * Post Types: page
 * Viewport Width: 1400
 * Description: Landingpage für kleine Shops und SB-Schränke – reine Darstellung, ohne B2B-Funktionen.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"}},"backgroundColor":"green","layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group alignfull hejlejo-section has-green-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40)">
	<!-- wp:paragraph {"align":"center","className":"is-style-eyebrow","style":{"elements":{"link":{"color":{"text":"var:preset|color|surface"}}}},"textColor":"surface"} -->
	<p class="has-text-align-center is-style-eyebrow has-surface-color has-text-color has-link-color">Für kleine Shops &amp; SB-Schränke</p>
	<!-- /wp:paragraph -->
	<!-- wp:heading {"textAlign":"center","level":1,"style":{"elements":{"link":{"color":{"text":"var:preset|color|surface"}}}},"textColor":"surface","fontSize":"huge"} -->
	<h1 class="wp-block-heading has-text-align-center has-surface-color has-text-color has-link-color has-huge-font-size">Du hast selbst ein kleines Lädchen?</h1>
	<!-- /wp:heading -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"><img src="<?php echo hejlejo_image( 'content/business-feature.jpg' ); ?>" alt="" style="aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"50%","style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
			<!-- wp:paragraph {"fontSize":"large"} -->
			<p class="has-large-font-size">Designs und Vorlagen, mit denen dein Angebot noch liebevoller aussieht – von Produktkarten über Banderolen bis zu saisonalen Kerzendesigns.</p>
			<!-- /wp:paragraph -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo hejlejo_shop_url(); ?>">Mehr entdecken</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
<!-- wp:pattern {"slug":"hejlejo/faq"} /-->
