<?php
/**
 * Title: Hej Lejo / Bildergalerie
 * Slug: hejlejo/gallery
 * Categories: hejlejo-sections
 * Keywords: galerie, bilder, fotos, einblicke
 * Viewport Width: 1400
 * Description: Ruhige Bildergalerie mit Überschrift, z. B. für Einblicke ins Schranklädchen.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">Einblicke</h2>
	<!-- /wp:heading -->
	<!-- wp:gallery {"columns":3,"linkTo":"none","sizeSlug":"large","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|20"}}}} -->
	<figure class="wp-block-gallery alignwide has-nested-images columns-3 is-cropped">
		<?php foreach ( array( 'social-1', 'social-2', 'social-4', 'social-6', 'business', 'social-5' ) as $hejlejo_img ) : ?>
		<!-- wp:image {"sizeSlug":"large"} -->
		<figure class="wp-block-image size-large"><img src="<?php echo hejlejo_image( 'placeholders/' . $hejlejo_img . '.svg' ); ?>" alt=""/></figure>
		<!-- /wp:image -->
		<?php endforeach; ?>
	</figure>
	<!-- /wp:gallery -->
</div>
<!-- /wp:group -->
