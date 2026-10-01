<?php
/**
 * Title: Hej Lejo / Header (Kasse)
 * Slug: hejlejo/header-checkout
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 * Description: Reduzierter Header für die Kasse – ohne Navigation, damit nichts vom Bezahlen ablenkt.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"className":"hejlejo-header hejlejo-header--checkout","style":{"spacing":{"padding":{"top":"var:preset|spacing|30","bottom":"var:preset|spacing|30"}}},"backgroundColor":"base","layout":{"type":"constrained","contentSize":"1120px"}} -->
<div class="wp-block-group hejlejo-header hejlejo-header--checkout has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--30)">
	<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group">
		<!-- wp:group {"className":"hejlejo-header__brand","style":{"spacing":{"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group hejlejo-header__brand">
			<!-- wp:site-logo {"width":140,"shouldSyncIcon":false} /-->
			<!-- wp:site-title {"level":0,"className":"hejlejo-wordmark"} /-->
		</div>
		<!-- /wp:group -->
		<!-- wp:group {"className":"hejlejo-secure-note","style":{"spacing":{"blockGap":"0.5rem"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group hejlejo-secure-note">
			<!-- wp:image {"width":"24px","height":"24px","sizeSlug":"full","className":"hejlejo-icon-img"} -->
			<figure class="wp-block-image size-full is-resized hejlejo-icon-img"><img src="<?php echo hejlejo_image( 'icons/lock.svg' ); ?>" alt="" style="width:24px;height:24px"/></figure>
			<!-- /wp:image -->
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size">Sicher bezahlen – SSL-verschlüsselt</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
