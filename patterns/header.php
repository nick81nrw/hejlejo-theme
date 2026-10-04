<?php
/**
 * Title: Hej Lejo / Header
 * Slug: hejlejo/header
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 * Description: Schlanker Header mit Logo, Hauptnavigation (WordPress-Menü "Main"), Suche, Konto und Warenkorb.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"className":"hejlejo-header","style":{"spacing":{"padding":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}},"backgroundColor":"surface","layout":{"type":"constrained","contentSize":"1320px"}} -->
<div class="wp-block-group hejlejo-header has-surface-background-color has-background" style="padding-top:var(--wp--preset--spacing--20);padding-bottom:var(--wp--preset--spacing--20)">
	<!-- wp:group {"className":"hejlejo-header__inner","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
	<div class="wp-block-group hejlejo-header__inner">
		<!-- wp:group {"className":"hejlejo-header__brand","style":{"spacing":{"blockGap":"0.75rem"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group hejlejo-header__brand">
			<!-- wp:site-logo {"width":140,"shouldSyncIcon":false} /-->
			<!-- wp:site-title {"level":0,"className":"hejlejo-wordmark"} /-->
		</div>
		<!-- /wp:group -->

		<?php $hejlejo_menu = hejlejo_primary_menu(); ?>
		<?php if ( $hejlejo_menu && isset( $hejlejo_menu['ref'] ) ) : ?>
		<!-- wp:navigation {"ref":<?php echo (int) $hejlejo_menu['ref']; ?>,"overlayMenu":"mobile","overlayBackgroundColor":"surface","overlayTextColor":"contrast","className":"hejlejo-header__nav","ariaLabel":"Hauptmenü","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} /-->
		<?php else : ?>
		<!-- wp:navigation {"overlayMenu":"mobile","overlayBackgroundColor":"surface","overlayTextColor":"contrast","className":"hejlejo-header__nav","ariaLabel":"Hauptmenü","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
		<?php if ( $hejlejo_menu ) : ?>
			<?php echo $hejlejo_menu['inner']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Block-Markup aus WordPress-Menü. ?>
		<?php else : ?>
			<!-- wp:navigation-link {"label":"Shop","url":"<?php echo hejlejo_shop_url(); ?>","kind":"custom","isTopLevelLink":true} /-->
			<!-- wp:navigation-submenu {"label":"Ideen &amp; Anlässe","url":"<?php echo hejlejo_shop_url(); ?>","kind":"custom"} -->
				<!-- wp:navigation-link {"label":"Geburtstag","url":"<?php echo hejlejo_shop_link( array( 'geburtstag' ), 'Geburtstag' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Kleine Aufmerksamkeit","url":"<?php echo hejlejo_shop_link( array( 'kleine-aufmerksamkeit', 'mitbringsel' ), 'Mitbringsel' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Danke sagen","url":"<?php echo hejlejo_shop_link( array( 'danke' ), 'Danke' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Familie &amp; Freunde","url":"<?php echo hejlejo_shop_link( array( 'familie', 'freunde' ), 'Familie' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Schulstart","url":"<?php echo hejlejo_shop_link( array( 'schulstart', 'einschulung' ), 'Schule' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Frühling &amp; Ostern","url":"<?php echo hejlejo_shop_link( array( 'ostern', 'fruehling' ), 'Ostern' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Sommer","url":"<?php echo hejlejo_shop_link( array( 'sommer' ), 'Sommer' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Herbst &amp; Cozy","url":"<?php echo hejlejo_shop_link( array( 'herbst' ), 'Herbst' ); ?>","kind":"custom"} /-->
				<!-- wp:navigation-link {"label":"Weihnachten","url":"<?php echo hejlejo_shop_link( array( 'weihnachten' ), 'Weihnachten' ); ?>","kind":"custom"} /-->
			<!-- /wp:navigation-submenu -->
			<!-- wp:navigation-link {"label":"Neuheiten","url":"<?php echo esc_url( add_query_arg( 'orderby', 'date', hejlejo_shop_url() ) ); ?>","kind":"custom","isTopLevelLink":true} /-->
			<!-- wp:navigation-link {"label":"Schranklädchen","url":"<?php echo hejlejo_page_url( 'schranklaedchen' ); ?>","kind":"custom","isTopLevelLink":true} /-->
			<!-- wp:navigation-link {"label":"Über uns","url":"<?php echo hejlejo_page_url( 'ueber-uns' ); ?>","kind":"custom","isTopLevelLink":true} /-->
		<?php endif; ?>
		<!-- /wp:navigation -->
		<?php endif; ?>

		<!-- wp:group {"className":"hejlejo-header__actions","style":{"spacing":{"blockGap":"0.25rem"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"right"}} -->
		<div class="wp-block-group hejlejo-header__actions">
			<!-- wp:search {"label":"Produkte suchen","showLabel":false,"placeholder":"Wonach suchst du?","buttonText":"Suchen","buttonPosition":"button-only","buttonUseIcon":true,"isSearchFieldHidden":true,"query":{"post_type":"product"},"className":"hejlejo-header-search"} /-->
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<!-- wp:woocommerce/customer-account {"displayStyle":"icon_only","iconStyle":"line","iconClass":"wc-block-customer-account__account-icon","className":"hejlejo-header__account"} /-->
			<!-- wp:woocommerce/mini-cart {"miniCartIcon":"bag","className":"hejlejo-header__cart"} /-->
			<?php endif; ?>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
