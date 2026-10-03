<?php
/**
 * Title: Hej Lejo / Kategorien (überlappend)
 * Slug: hejlejo/categories-overlap
 * Categories: hejlejo-sections, hejlejo-shop
 * Keywords: kategorien, kacheln, einstieg, produktwelten
 * Viewport Width: 1400
 * Description: Vier zentrierte Einstiegskarten, die auf großen Bildschirmen den Hero darüber überlappen (direkt unter "Hej Lejo / Hero (für überlappende Karten)" einsetzen) mit Illustration und "Alles ansehen". Die ganze Karte ist klickbar; Links sind normale Gutenberg-Links und frei änderbar.
 *
 * @package HejLejo
 */

$hejlejo_tiles = array(
	array( 'candles', 'Kerzen gestalten', hejlejo_shop_link( array( 'kerzentattoo', 'wasserschiebefolie', 'kerzentattoos' ), 'Kerze' ) ),
	array( 'gifts', 'Kleine Geschenke', hejlejo_shop_link( array( 'papeterie', 'baggies', 'geschenke' ), 'Geschenk' ) ),
	array( 'diy', 'DIY &amp; Kreativ', hejlejo_shop_link( array( 'plotter-und-laserdateien', 'plotterdateien', 'diy' ), 'Datei' ) ),
	array( 'seasonal', 'Saisonale Lieblinge', hejlejo_shop_link( array( 'anlass', 'herbst-2', 'herbst' ), 'Herbst' ) ),
);
?>
<!-- wp:group {"align":"full","className":"hejlejo-section hejlejo-categories is-overlap","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section hejlejo-categories is-overlap" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)">
	<!-- wp:group {"align":"wide","className":"hejlejo-tiles","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","columnCount":4,"minimumColumnWidth":null}} -->
	<div class="wp-block-group alignwide hejlejo-tiles">
		<?php foreach ( $hejlejo_tiles as $hejlejo_tile ) : ?>
		<!-- wp:group {"className":"is-style-card hejlejo-tile","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|30","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
		<div class="wp-block-group is-style-card hejlejo-tile" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)">
			<!-- wp:image {"sizeSlug":"full","align":"center","className":"hejlejo-tile__image"} -->
			<figure class="wp-block-image aligncenter size-full hejlejo-tile__image"><img src="<?php echo hejlejo_image( 'illustrations/' . $hejlejo_tile[0] . '.svg' ); ?>" alt=""/></figure>
			<!-- /wp:image -->
			<!-- wp:heading {"textAlign":"center","className":"hejlejo-tile__title","fontSize":"x-large"} -->
			<h2 class="wp-block-heading has-text-align-center hejlejo-tile__title has-x-large-font-size"><a href="<?php echo $hejlejo_tile[2]; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- bereits escaped. ?>"><?php echo $hejlejo_tile[1]; // phpcs:ignore ?></a></h2>
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
