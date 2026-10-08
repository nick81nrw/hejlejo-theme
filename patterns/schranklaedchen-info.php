<?php
/**
 * Title: Hej Lejo / Schranklädchen Infos
 * Slug: hejlejo/schranklaedchen-info
 * Categories: hejlejo-sections
 * Keywords: öffnungszeiten, standort, adresse, bezahlung, schranklädchen
 * Viewport Width: 1400
 * Description: Öffnungszeiten, Standort und Zahlungsinformationen als drei Karten.
 *
 * @package HejLejo
 */

$hejlejo_cards = array(
	array( 'clock', 'Öffnungszeiten', 'Täglich von 10 bis 19 Uhr geöffnet.' ),
	array( 'pin', 'Standort', 'Ginsterweg 20<br>58675 Hemer' ),
	array( 'coins', 'Bezahlung', 'Bar in die Kasse oder bequem per PayPal – die Infos hängen direkt am Schrank.' ),
);
?>
<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|50"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"grid","minimumColumnWidth":"16rem"}} -->
	<div class="wp-block-group alignwide">
		<?php foreach ( $hejlejo_cards as $hejlejo_card ) : ?>
		<!-- wp:group {"className":"is-style-card","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
		<div class="wp-block-group is-style-card" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
			<!-- wp:image {"width":"40px","height":"40px","sizeSlug":"full","className":"hejlejo-icon-img"} -->
			<figure class="wp-block-image size-full is-resized hejlejo-icon-img"><img src="<?php echo hejlejo_image( 'icons/' . $hejlejo_card[0] . '.svg' ); ?>" alt="" style="width:40px;height:40px"/></figure>
			<!-- /wp:image -->
			<!-- wp:heading {"level":2,"fontSize":"large"} -->
			<h2 class="wp-block-heading has-large-font-size"><?php echo esc_html( $hejlejo_card[1] ); ?></h2>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size"><?php echo wp_kses( $hejlejo_card[2], array( 'br' => array() ) ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
