<?php
/**
 * Title: Hej Lejo / Kategorien
 * Slug: hejlejo/categories
 * Categories: hejlejo-sections, hejlejo-shop
 * Keywords: kategorien, kacheln, einstieg, produktwelten
 * Viewport Width: 1400
 * Description: Vier große Einstiegskacheln "Was möchtest du gestalten?". Die Links sind normale Gutenberg-Links und frei änderbar.
 *
 * @package HejLejo
 */

$hejlejo_tiles = array(
	array( 'category-candles', 'Kerzen gestalten', 'Kerzentattoos, Wasserschiebefolie &amp; Vorlagen', hejlejo_shop_link( array( 'kerzentattoos', 'wasserschiebefolie', 'kerzen' ), 'Kerze' ) ),
	array( 'category-gifts', 'Kleine Geschenke', 'Mitbringsel, Produktkarten &amp; liebe Kleinigkeiten', hejlejo_shop_link( array( 'geschenke', 'kleine-geschenke', 'papeterie' ), 'Geschenk' ) ),
	array( 'category-diy', 'DIY &amp; Kreativ', 'Plotter-, Laser- &amp; Druckdateien', hejlejo_shop_link( array( 'plotterdateien', 'druckvorlagen', 'diy' ), 'Datei' ) ),
	array( 'category-seasonal', 'Saisonale Lieblingsstücke', 'Frühling, Sommer, Herbst &amp; Weihnachten', hejlejo_shop_link( array( 'saisonal', 'herbst', 'weihnachten' ), 'Herbst' ) ),
);
?>
<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"textAlign":"center"} -->
	<h2 class="wp-block-heading has-text-align-center">Was möchtest du gestalten?</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"align":"wide","className":"hejlejo-tiles","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","minimumColumnWidth":"15rem"}} -->
	<div class="wp-block-group alignwide hejlejo-tiles">
		<?php foreach ( $hejlejo_tiles as $hejlejo_tile ) : ?>
		<!-- wp:group {"className":"is-style-card hejlejo-tile","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
		<div class="wp-block-group is-style-card hejlejo-tile">
			<!-- wp:image {"aspectRatio":"4/3","scale":"cover","sizeSlug":"large","className":"hejlejo-tile__image"} -->
			<figure class="wp-block-image size-large hejlejo-tile__image"><img src="<?php echo hejlejo_image( 'placeholders/' . $hejlejo_tile[0] . '.svg' ); ?>" alt="" style="aspect-ratio:4/3;object-fit:cover"/></figure>
			<!-- /wp:image -->
			<!-- wp:group {"className":"hejlejo-tile__body","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","right":"var:preset|spacing|30","bottom":"var:preset|spacing|30","left":"var:preset|spacing|30"},"blockGap":"0.25rem"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group hejlejo-tile__body" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
				<!-- wp:heading {"level":3,"className":"hejlejo-tile__title","fontSize":"medium"} -->
				<h3 class="wp-block-heading hejlejo-tile__title has-medium-font-size"><a href="<?php echo $hejlejo_tile[3]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- bereits escaped. ?>"><?php echo $hejlejo_tile[1]; // phpcs:ignore ?></a></h3>
				<!-- /wp:heading -->
				<!-- wp:paragraph {"textColor":"muted","fontSize":"x-small"} -->
				<p class="has-muted-color has-text-color has-x-small-font-size"><?php echo $hejlejo_tile[2]; // phpcs:ignore ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
