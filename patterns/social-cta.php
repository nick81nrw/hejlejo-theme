<?php
/**
 * Title: Hej Lejo / Social-Hinweis
 * Slug: hejlejo/social-cta
 * Categories: hejlejo-sections
 * Keywords: instagram, social, folgen, link
 * Viewport Width: 1000
 * Description: Kurzer Hinweis mit Link zum Instagram-Profil.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:image {"width":"44px","height":"44px","sizeSlug":"full","align":"center","className":"hejlejo-icon-img"} -->
	<figure class="wp-block-image aligncenter size-full is-resized hejlejo-icon-img"><img src="<?php echo hejlejo_image( 'icons/instagram.svg' ); ?>" alt="" style="width:44px;height:44px"/></figure>
	<!-- /wp:image -->
	<!-- wp:heading {"textAlign":"center","fontSize":"x-large"} -->
	<h2 class="wp-block-heading has-text-align-center has-x-large-font-size">Was gibt's Neues im Schrank?</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center">Neue Ware, besondere Öffnungszeiten und kleine Einblicke teilen wir auf Instagram.</p>
	<!-- /wp:paragraph -->
	<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
	<div class="wp-block-buttons">
		<!-- wp:button {"className":"is-style-secondary"} -->
		<div class="wp-block-button is-style-secondary"><a class="wp-block-button__link wp-element-button" href="https://www.instagram.com/hej.lejo/">@hej.lejo folgen</a></div>
		<!-- /wp:button -->
	</div>
	<!-- /wp:buttons -->
</div>
<!-- /wp:group -->
