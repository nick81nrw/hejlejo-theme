<?php
/**
 * Title: Hej Lejo / Instagram-Raster
 * Slug: hejlejo/instagram
 * Categories: hejlejo-sections
 * Keywords: instagram, social, bilder, galerie, raster
 * Viewport Width: 1400
 * Description: "Hej Lejo in echt ♡" – neutraler Bildraster für Instagram-Bilder. Bilder einfach austauschen oder den Block eines Instagram-Plugins einsetzen.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"align":"full","className":"hejlejo-section hejlejo-social","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section hejlejo-social" style="padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"wrap","verticalAlignment":"center"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"className":"hejlejo-social__intro","style":{"spacing":{"blockGap":"0.25rem"}},"layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group hejlejo-social__intro">
			<!-- wp:heading {"fontSize":"x-large"} -->
			<h2 class="wp-block-heading has-x-large-font-size">Hej Lejo in echt ♡</h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"textColor":"muted","fontSize":"small"} -->
			<p class="has-muted-color has-text-color has-small-font-size">Folge <a href="https://www.instagram.com/hej.lejo/">@hej.lejo</a> für neue Ideen, Einblicke &amp; Inspiration.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<!-- wp:group {"className":"hejlejo-social__grid","style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"grid","minimumColumnWidth":"7.5rem"}} -->
		<div class="wp-block-group hejlejo-social__grid">
			<?php for ( $hejlejo_i = 1; $hejlejo_i <= 6; $hejlejo_i++ ) : ?>
			<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"medium","linkDestination":"custom"} -->
			<figure class="wp-block-image size-medium"><a href="https://www.instagram.com/hej.lejo/"><img src="<?php echo hejlejo_image( 'placeholders/social-' . $hejlejo_i . '.svg' ); ?>" alt="Hej Lejo auf Instagram – Bild <?php echo (int) $hejlejo_i; ?>" style="aspect-ratio:1;object-fit:cover"/></a></figure>
			<!-- /wp:image -->
			<?php endfor; ?>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
