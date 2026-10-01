<?php
/**
 * Title: Hej Lejo / Drei-Schritte-Anleitung
 * Slug: hejlejo/steps
 * Categories: hejlejo-sections
 * Keywords: anleitung, schritte, erklärung, so geht's, kerze
 * Viewport Width: 1400
 * Description: "So einfach wird aus einer Kerze dein Lieblingsstück" – drei Schritte mit Bildern links und rechts.
 *
 * @package HejLejo
 */

$hejlejo_steps = array(
	array( 'pointer', '1. Design auswählen', 'Dein Lieblingsmotiv im Shop finden.' ),
	array( 'layers', '2. Aufbringen', 'Mit Wasserschiebefolie, Rub-On oder als Druck.' ),
	array( 'gift', '3. Freude schenken', 'Für dich selbst oder liebe Menschen.' ),
);
?>
<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","className":"is-style-panel hejlejo-steps","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|50"}}},"backgroundColor":"cream"} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center is-style-panel hejlejo-steps has-cream-background-color has-background">
		<!-- wp:column {"verticalAlignment":"center","width":"25%","className":"hejlejo-steps__media"} -->
		<div class="wp-block-column is-vertically-aligned-center hejlejo-steps__media" style="flex-basis:25%">
			<!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"><img src="<?php echo hejlejo_image( 'placeholders/step-apply.svg' ); ?>" alt="Eine Kerze wird mit einem Kerzentattoo gestaltet" style="aspect-ratio:4/5;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"50%","style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
			<!-- wp:heading {"fontSize":"x-large"} -->
			<h2 class="wp-block-heading has-x-large-font-size">So einfach wird aus einer Kerze dein Lieblingsstück.</h2>
			<!-- /wp:heading -->

			<!-- wp:group {"className":"hejlejo-steps__list","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","minimumColumnWidth":"9rem"}} -->
			<div class="wp-block-group hejlejo-steps__list">
				<?php foreach ( $hejlejo_steps as $hejlejo_step ) : ?>
				<!-- wp:group {"className":"hejlejo-step","style":{"spacing":{"blockGap":"0.4rem"}},"layout":{"type":"flex","orientation":"vertical"}} -->
				<div class="wp-block-group hejlejo-step">
					<!-- wp:image {"width":"28px","height":"28px","sizeSlug":"full","className":"is-style-circle hejlejo-step__icon"} -->
					<figure class="wp-block-image size-full is-resized is-style-circle hejlejo-step__icon"><img src="<?php echo hejlejo_image( 'icons/' . $hejlejo_step[0] . '.svg' ); ?>" alt="" style="width:28px;height:28px"/></figure>
					<!-- /wp:image -->
					<!-- wp:heading {"level":3,"fontSize":"small","className":"hejlejo-step__title"} -->
					<h3 class="wp-block-heading hejlejo-step__title has-small-font-size"><?php echo esc_html( $hejlejo_step[1] ); ?></h3>
					<!-- /wp:heading -->
					<!-- wp:paragraph {"textColor":"muted","fontSize":"x-small"} -->
					<p class="has-muted-color has-text-color has-x-small-font-size"><?php echo esc_html( $hejlejo_step[2] ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
				<?php endforeach; ?>
			</div>
			<!-- /wp:group -->

			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo hejlejo_shop_link( array( 'kerzentattoos', 'wasserschiebefolie', 'kerzen' ), 'Kerze' ); ?>">Alle Kerzendesigns entdecken</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","width":"25%","className":"hejlejo-steps__media"} -->
		<div class="wp-block-column is-vertically-aligned-center hejlejo-steps__media" style="flex-basis:25%">
			<!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"><img src="<?php echo hejlejo_image( 'placeholders/step-candle.svg' ); ?>" alt="Fertig gestaltete Kerze mit dem Schriftzug Glück" style="aspect-ratio:4/5;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
