<?php
/**
 * Title: Hej Lejo / Kategorien
 * Slug: hejlejo/categories
 * Categories: hejlejo-sections, hejlejo-shop
 * Keywords: kategorien, kacheln, einstieg, produktwelten
 * Viewport Width: 1400
 * Description: Vier zentrierte Einstiegskarten "Beliebte Kategorien" mit Illustration und "Alles ansehen". Die ganze Karte ist klickbar; Links sind normale Gutenberg-Links und frei änderbar.
 *
 * @package HejLejo
 */

$hejlejo_tiles = array(
	array( 'tile-candles.png', 'Kerzen gestalten', hejlejo_shop_link( array( 'kerzentattoo', 'kerzen-diy-dateien', 'wasserschiebefolie' ), 'Kerze' ) ),
	array( 'tile-templates.png', 'Druckvorlagen', hejlejo_shop_link( array( 'vorlagen', 'druckvorlagen' ), 'Druckvorlage' ) ),
	array( 'tile-diy.png', 'DIY &amp; Kreativ', hejlejo_shop_link( array( 'plotter-und-laserdateien', 'kerzen-diy-dateien', 'plotterdateien' ), 'Datei' ) ),
	array( 'tile-seasonal.png', 'Saisonale Lieblinge', hejlejo_shop_link( array( 'anlass', 'herbst' ), 'Herbst' ) ),
);
?>
<!-- wp:group {"align":"full","className":"hejlejo-section hejlejo-categories","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section hejlejo-categories" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"textAlign":"center","className":"hejlejo-categories__title"} -->
	<h2 class="wp-block-heading has-text-align-center hejlejo-categories__title">Beliebte Kategorien</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"align":"wide","className":"hejlejo-tiles","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":null}} -->
	<div class="wp-block-group alignwide hejlejo-tiles">
		<?php foreach ( $hejlejo_tiles as $hejlejo_tile ) : ?>
		<!-- wp:group {"className":"is-style-card hejlejo-tile","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|30","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group is-style-card hejlejo-tile" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)">
			<!-- wp:image {"sizeSlug":"full","align":"center","className":"hejlejo-tile__image"} -->
			<figure class="wp-block-image aligncenter size-full hejlejo-tile__image"><img src="<?php echo hejlejo_image( 'content/' . $hejlejo_tile[0] ); ?>" alt=""/></figure>
			<!-- /wp:image -->
			<!-- wp:heading {"textAlign":"center","level":3,"className":"hejlejo-tile__title","fontSize":"x-large"} -->
			<h3 class="wp-block-heading has-text-align-center hejlejo-tile__title has-x-large-font-size"><a href="<?php echo $hejlejo_tile[2]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- bereits escaped. ?>"><?php echo $hejlejo_tile[1]; // phpcs:ignore ?></a></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"align":"center","className":"hejlejo-tile__more","fontSize":"small"} -->
			<p class="has-text-align-center hejlejo-tile__more has-small-font-size">Alles ansehen</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
