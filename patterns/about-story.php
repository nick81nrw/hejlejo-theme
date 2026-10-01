<?php
/**
 * Title: Hej Lejo / Unsere Geschichte
 * Slug: hejlejo/about-story
 * Categories: hejlejo-sections
 * Keywords: geschichte, story, entwicklung, schranklädchen, online-shop, handmade
 * Viewport Width: 1400
 * Description: Die Geschichte von Hej Lejo in drei Stationen – vom Schranklädchen zum Online-Shop – plus Abschnitt zu eigenen Designs.
 *
 * @package HejLejo
 */

$hejlejo_milestones = array(
	array( 'Der Anfang', 'Das Schranklädchen', 'Ein kleiner Schrank vor der Tür, gefüllt mit selbst gestalteten Kerzen und Geschenkideen – so hat Hej Lejo begonnen.' ),
	array( 'Der nächste Schritt', 'Eigene Designs', 'Aus der Freude am Gestalten wurden eigene Motive: Kerzentattoos, Druckvorlagen und Dateien für kreative Projekte.' ),
	array( 'Heute', 'Der Online-Shop', 'Heute findest du alle Lieblingsstücke auch online – zum Selbermachen, Verschenken und Weitergeben.' ),
);
?>
<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40)">
	<!-- wp:heading {"textAlign":"center"} -->
	<h2 class="wp-block-heading has-text-align-center">Vom Schranklädchen zum Online-Shop</h2>
	<!-- /wp:heading -->
	<!-- wp:group {"align":"wide","className":"hejlejo-timeline","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","minimumColumnWidth":"16rem"}} -->
	<div class="wp-block-group alignwide hejlejo-timeline">
		<?php foreach ( $hejlejo_milestones as $hejlejo_milestone ) : ?>
		<!-- wp:group {"className":"hejlejo-timeline__item","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group hejlejo-timeline__item">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow"><?php echo esc_html( $hejlejo_milestone[0] ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":3} -->
			<h3 class="wp-block-heading"><?php echo esc_html( $hejlejo_milestone[1] ); ?></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p><?php echo esc_html( $hejlejo_milestone[2] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center">
		<!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
			<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large"} -->
			<figure class="wp-block-image size-large"><img src="<?php echo hejlejo_image( 'placeholders/category-diy.svg' ); ?>" alt="Eigene Designs auf Papier mit Schere" style="aspect-ratio:1;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"55%","style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">
			<!-- wp:heading -->
			<h2 class="wp-block-heading">Eigene Designs. Mit Liebe gemacht.</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>Jedes Motiv entsteht bei uns – vom ersten Entwurf bis zur fertigen Datei. Uns ist wichtig, dass unsere Designs einfach anzuwenden sind und lange Freude machen.</p>
			<!-- /wp:paragraph -->
			<!-- wp:list {"className":"is-style-heart"} -->
			<ul class="wp-block-list is-style-heart">
				<!-- wp:list-item -->
				<li>Eigene Illustrationen &amp; Schriftzüge</li>
				<!-- /wp:list-item -->
				<!-- wp:list-item -->
				<li>Handmade-Produkte in kleinen Mengen</li>
				<!-- /wp:list-item -->
				<!-- wp:list-item -->
				<li>Digitale Vorlagen zum sofortigen Download</li>
				<!-- /wp:list-item -->
			</ul>
			<!-- /wp:list -->
			<!-- wp:buttons -->
			<div class="wp-block-buttons">
				<!-- wp:button -->
				<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo hejlejo_shop_url(); ?>">Zum Shop</a></div>
				<!-- /wp:button -->
			</div>
			<!-- /wp:buttons -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
