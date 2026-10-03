<?php
/**
 * Title: Hej Lejo / Service-Leiste
 * Slug: hejlejo/trust-bar
 * Categories: hejlejo-sections
 * Keywords: trust, service, vertrauen, icons
 * Viewport Width: 1400
 * Description: Vier Service-Versprechen mit Icons, z. B. über dem Footer.
 *
 * @package HejLejo
 */

$hejlejo_items = array(
	array( 'lock', 'Sicher einkaufen', 'SSL-verschlüsselt' ),
	array( 'download', 'Sofort-Download', 'Nach dem Kauf verfügbar' ),
	array( 'heart', 'Mit Liebe gestaltet', 'Eigene Designs' ),
	array( 'chat', 'Fragen?', 'Wir helfen dir gerne!' ),
);
?>
<!-- wp:group {"align":"full","className":"hejlejo-trust-bar","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50"}}},"backgroundColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-trust-bar has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50)">
	<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","minimumColumnWidth":"14rem"}} -->
	<div class="wp-block-group alignwide">
		<?php foreach ( $hejlejo_items as $hejlejo_item ) : ?>
		<!-- wp:group {"className":"hejlejo-icon-item","style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"nowrap","verticalAlignment":"center"}} -->
		<div class="wp-block-group hejlejo-icon-item">
			<!-- wp:image {"width":"36px","height":"36px","sizeSlug":"full","className":"hejlejo-icon-img"} -->
			<figure class="wp-block-image size-full is-resized hejlejo-icon-img"><img src="<?php echo hejlejo_image( 'icons/' . $hejlejo_item[0] . '.svg' ); ?>" alt="" style="width:36px;height:36px"/></figure>
			<!-- /wp:image -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
			<div class="wp-block-group">
				<!-- wp:paragraph {"className":"hejlejo-icon-item__title","fontSize":"small"} -->
				<p class="hejlejo-icon-item__title has-small-font-size"><strong><?php echo esc_html( $hejlejo_item[1] ); ?></strong></p>
				<!-- /wp:paragraph -->
				<!-- wp:paragraph {"textColor":"muted","fontSize":"x-small"} -->
				<p class="has-muted-color has-text-color has-x-small-font-size"><?php echo esc_html( $hejlejo_item[2] ); ?></p>
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
