<?php
/**
 * Title: Hej Lejo / Schranklädchen-Business (groß)
 * Slug: hejlejo/business-feature
 * Categories: hejlejo-sections
 * Keywords: business, lädchen, schranklädchen, sb-schrank, handmade-shop, gewerbe
 * Viewport Width: 1400
 * Description: Prägnanter, großer Bereich "Du hast selbst ein Schranklädchen?" auf grüner Fläche mit Bild, Vorteilen und hellem Button.
 *
 * @package HejLejo
 */

$hejlejo_points = array(
	'Produktkarten &amp; Anhänger, die verkaufen',
	'Banderolen &amp; Kerzendesigns für dein Sortiment',
	'Saisonale Vorlagen – immer rechtzeitig',
	'Mit Gewerbelizenz für dein Lädchen',
);
?>
<!-- wp:group {"align":"full","className":"hejlejo-section hejlejo-section--green hejlejo-business","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"green","textColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section hejlejo-section--green hejlejo-business has-surface-color has-green-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"46%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:46%">
			<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","className":"hejlejo-business__image"} -->
			<figure class="wp-block-image size-large hejlejo-business__image"><img src="<?php echo hejlejo_image( 'placeholders/business.svg' ); ?>" alt="Ein Schranklädchen mit Kerzen und kleinen Geschenken" style="aspect-ratio:1;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"54%","style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:54%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow">Für Lädchen, SB-Schränke &amp; Handmade-Shops</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"textColor":"surface","fontSize":"huge"} -->
			<h2 class="wp-block-heading has-surface-color has-text-color has-huge-font-size">Du hast selbst ein Schranklädchen?</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"fontSize":"large"} -->
			<p class="has-large-font-size">Dann mach es zu einem Ort, an dem man gerne stehen bleibt. Unsere Vorlagen sind genau dafür gemacht – erprobt in unserem eigenen Schranklädchen.</p>
			<!-- /wp:paragraph -->
			<!-- wp:list {"className":"is-style-check hejlejo-business__list"} -->
			<ul class="wp-block-list is-style-check hejlejo-business__list">
				<?php foreach ( $hejlejo_points as $hejlejo_point ) : ?>
				<!-- wp:list-item -->
				<li><?php echo $hejlejo_point; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></li>
				<!-- /wp:list-item -->
				<?php endforeach; ?>
			</ul>
			<!-- /wp:list -->
			<!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} -->
			<div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--20)">
				<!-- wp:button {"className":"is-style-light"} -->
				<div class="wp-block-button is-style-light"><a class="wp-block-button__link wp-element-button" href="<?php echo hejlejo_page_url( 'fuer-dein-laedchen' ); ?>">Vorlagen für dein Lädchen entdecken</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
