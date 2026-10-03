<?php
/**
 * Title: Hej Lejo / Vorteile (Zeile)
 * Slug: hejlejo/trust-line
 * Categories: hejlejo-sections
 * Keywords: vorteile, trust, icons, zeile
 * Viewport Width: 1400
 * Description: Vier kurze Vorteile mittig in einer Zeile, z. B. unter den Kategorie-Karten.
 *
 * @package HejLejo
 */

$hejlejo_trust = array(
	array( 'heart', 'Mit Liebe gestaltet' ),
	array( 'pen', 'Eigene Designs' ),
	array( 'download', 'Sofort-Downloads' ),
	array( 'sparkle', 'Für kreative Menschen' ),
);
?>
<!-- wp:group {"align":"full","className":"hejlejo-section hejlejo-trust-line","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section hejlejo-trust-line" style="padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"center"}} -->
	<div class="wp-block-group alignwide">
		<?php foreach ( $hejlejo_trust as $hejlejo_item ) : ?>
		<!-- wp:group {"className":"hejlejo-icon-item","style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group hejlejo-icon-item">
			<!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","className":"hejlejo-icon-img"} -->
			<figure class="wp-block-image size-full is-resized hejlejo-icon-img"><img src="<?php echo hejlejo_image( 'icons/' . $hejlejo_item[0] . '.svg' ); ?>" alt="" style="width:24px;height:24px"/></figure>
			<!-- /wp:image -->
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size"><?php echo esc_html( $hejlejo_item[1] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
