<?php
/**
 * Title: Hej Lejo / Footer
 * Slug: hejlejo/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Inserter: no
 * Description: Footer mit Service-Leiste, Navigation, Rechtlichem und Social-Links.
 *
 * @package HejLejo
 */

?>
<!-- wp:pattern {"slug":"hejlejo/trust-bar"} /-->

<!-- wp:group {"align":"full","className":"hejlejo-footer","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|40"}}},"backgroundColor":"green","textColor":"surface","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-footer has-surface-color has-green-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40)">
	<!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|50"}}}} -->
	<div class="wp-block-columns alignwide">
		<!-- wp:column {"width":"34%"} -->
		<div class="wp-block-column" style="flex-basis:34%">
			<!-- wp:site-title {"level":0,"className":"hejlejo-wordmark"} /-->
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size">Kreative Designs, DIY-Ideen und besondere Kleinigkeiten – liebevoll gestaltet und für dich vorbereitet.</p>
			<!-- /wp:paragraph -->
			<!-- wp:social-links {"iconColor":"surface","iconColorValue":"#FFFFFF","className":"is-style-logos-only","style":{"spacing":{"blockGap":{"left":"var:preset|spacing|20"}}}} -->
			<ul class="wp-block-social-links has-icon-color is-style-logos-only">
				<!-- wp:social-link {"url":"https://www.instagram.com/hej.lejo/","service":"instagram","label":"Hej Lejo auf Instagram"} /-->
				<!-- wp:social-link {"url":"https://www.pinterest.de/","service":"pinterest","label":"Hej Lejo auf Pinterest"} /-->
			</ul>
			<!-- /wp:social-links -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":2,"className":"hejlejo-footer__heading"} -->
			<h2 class="wp-block-heading hejlejo-footer__heading">Shop</h2>
			<!-- /wp:heading -->
			<!-- wp:navigation {"overlayMenu":"never","ariaLabel":"Shop","className":"hejlejo-footer__nav","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.5rem"}}} -->
				<!-- wp:navigation-link {"label":"Alle Produkte","url":"<?php echo hejlejo_shop_url(); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Neuheiten","url":"<?php echo esc_url( add_query_arg( 'orderby', 'date', hejlejo_shop_url() ) ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Kerzen gestalten","url":"<?php echo hejlejo_shop_link( array( 'kerzentattoos', 'wasserschiebefolie', 'kerzen' ), 'Kerze' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Für dein Lädchen","url":"<?php echo hejlejo_page_url( 'fuer-dein-laedchen' ); ?>","kind":"custom"} /-->
			<!-- /wp:navigation -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":2,"className":"hejlejo-footer__heading"} -->
			<h2 class="wp-block-heading hejlejo-footer__heading">Service</h2>
			<!-- /wp:heading -->
			<!-- wp:navigation {"overlayMenu":"never","ariaLabel":"Service","className":"hejlejo-footer__nav","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.5rem"}}} -->
				<!-- wp:navigation-link {"label":"Mein Konto","url":"<?php echo hejlejo_account_url(); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Versand &amp; Lieferung","url":"<?php echo hejlejo_legal_url( 'shipping_costs', 'versandarten' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Zahlungsarten","url":"<?php echo hejlejo_legal_url( 'payment_methods', 'zahlungsarten' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Schranklädchen","url":"<?php echo hejlejo_page_url( 'schranklaedchen' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Über uns","url":"<?php echo hejlejo_page_url( 'ueber-uns' ); ?>","kind":"custom"} /-->
			<!-- /wp:navigation -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:heading {"level":2,"className":"hejlejo-footer__heading"} -->
			<h2 class="wp-block-heading hejlejo-footer__heading">Rechtliches</h2>
			<!-- /wp:heading -->
			<!-- wp:navigation {"overlayMenu":"never","ariaLabel":"Rechtliches","className":"hejlejo-footer__nav","layout":{"type":"flex","orientation":"vertical"},"style":{"spacing":{"blockGap":"0.5rem"}}} -->
				<!-- wp:navigation-link {"label":"Impressum","url":"<?php echo hejlejo_legal_url( 'imprint', 'impressum' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Datenschutz","url":"<?php echo hejlejo_legal_url( 'data_security', 'datenschutz' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"AGB","url":"<?php echo hejlejo_legal_url( 'terms', 'agb' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Widerrufsbelehrung","url":"<?php echo hejlejo_legal_url( 'revocation', 'widerrufsbelehrung' ); ?>","kind":"custom"} /-->
			<!-- /wp:navigation -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->

	<!-- wp:separator {"align":"wide","className":"is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|30"}}}} -->
	<hr class="wp-block-separator alignwide has-alpha-channel-opacity is-style-wide" style="margin-top:var(--wp--preset--spacing--50);margin-bottom:var(--wp--preset--spacing--30)"/>
	<!-- /wp:separator -->

	<!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:paragraph {"fontSize":"x-small"} -->
		<p class="has-x-small-font-size">© <?php echo esc_html( gmdate( 'Y' ) ); ?> Hej Lejo · Mit Liebe gestaltet in Deutschland ♡</p>
		<!-- /wp:paragraph -->
		<?php if ( function_exists( 'wc_gzd_is_small_business' ) && wc_gzd_is_small_business() ) : ?>
		<!-- wp:paragraph {"fontSize":"x-small"} -->
		<p class="has-x-small-font-size">Gemäß § 19 UStG wird keine Umsatzsteuer berechnet. Preise zzgl. <a href="<?php echo hejlejo_legal_url( 'shipping_costs', 'versandarten' ); ?>">Versandkosten</a></p>
		<!-- /wp:paragraph -->
		<?php else : ?>
		<!-- wp:paragraph {"fontSize":"x-small"} -->
		<p class="has-x-small-font-size">Alle Preise inkl. gesetzl. MwSt., zzgl. <a href="<?php echo hejlejo_legal_url( 'shipping_costs', 'versandarten' ); ?>">Versandkosten</a></p>
		<!-- /wp:paragraph -->
		<?php endif; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
