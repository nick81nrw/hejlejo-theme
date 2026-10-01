<?php
/**
 * Title: Hej Lejo / Anlässe
 * Slug: hejlejo/occasions
 * Categories: hejlejo-sections, hejlejo-shop
 * Keywords: anlässe, momente, geburtstag, weihnachten, icons
 * Viewport Width: 1400
 * Description: "Für welchen Moment suchst du etwas?" – visuelle Links zu Anlässen. Die Links zeigen zunächst auf Kategorien oder die Produktsuche und können frei geändert werden.
 *
 * @package HejLejo
 */

$hejlejo_occasions = array(
	array( 'gift', 'Geburtstag', array( 'geburtstag' ), 'Geburtstag' ),
	array( 'heart', 'Kleine Aufmerksamkeit', array( 'kleine-aufmerksamkeit', 'mitbringsel' ), 'Mitbringsel' ),
	array( 'thanks', 'Danke sagen', array( 'danke' ), 'Danke' ),
	array( 'family', 'Familie &amp; Freunde', array( 'familie', 'freunde' ), 'Familie' ),
	array( 'school', 'Schulstart', array( 'schulstart', 'einschulung' ), 'Schule' ),
	array( 'spring', 'Frühling &amp; Ostern', array( 'ostern', 'fruehling' ), 'Ostern' ),
	array( 'sun', 'Sommer', array( 'sommer' ), 'Sommer' ),
	array( 'leaf', 'Herbst &amp; Cozy', array( 'herbst' ), 'Herbst' ),
	array( 'tree', 'Weihnachten', array( 'weihnachten' ), 'Weihnachten' ),
);
?>
<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"align":"wide","className":"is-style-panel","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|40","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|40"}},"backgroundColor":"cream","layout":{"type":"constrained","contentSize":"1200px"}} -->
	<div class="wp-block-group alignwide is-style-panel has-cream-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
		<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">Für welchen Moment suchst du etwas?</h2>
		<!-- /wp:heading -->

		<!-- wp:group {"className":"hejlejo-occasions","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","minimumColumnWidth":"6.5rem"}} -->
		<div class="wp-block-group hejlejo-occasions">
			<?php foreach ( $hejlejo_occasions as $hejlejo_item ) : ?>
			<?php $hejlejo_link = hejlejo_shop_link( $hejlejo_item[2], $hejlejo_item[3] ); ?>
			<!-- wp:group {"className":"hejlejo-occasion","style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
			<div class="wp-block-group hejlejo-occasion">
				<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","className":"is-style-circle hejlejo-occasion__icon"} -->
				<figure class="wp-block-image size-full is-resized is-style-circle hejlejo-occasion__icon"><img src="<?php echo hejlejo_image( 'icons/' . $hejlejo_item[0] . '.svg' ); ?>" alt="" style="width:40px;height:40px"/></figure>
				<!-- /wp:image -->
				<!-- wp:paragraph {"align":"center","className":"hejlejo-occasion__label","fontSize":"x-small"} -->
				<p class="has-text-align-center hejlejo-occasion__label has-x-small-font-size"><a href="<?php echo $hejlejo_link; // phpcs:ignore ?>"><?php echo $hejlejo_item[1]; // phpcs:ignore ?></a></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<?php endforeach; ?>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
