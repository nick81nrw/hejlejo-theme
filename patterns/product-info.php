<?php
/**
 * Title: Hej Lejo / Produkt: Gut zu wissen
 * Slug: hejlejo/product-info
 * Categories: hejlejo-shop
 * Keywords: produkt, versand, download, lizenz, akkordeon, faq
 * Viewport Width: 900
 * Description: Allgemeine Hinweise zu Versand/Download, Lizenz und Fragen als Akkordeon – wird auf allen Produktseiten angezeigt.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"className":"hejlejo-product-info","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group hejlejo-product-info">
	<!-- wp:heading {"level":2,"fontSize":"x-large","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|30"}}}} -->
	<h2 class="wp-block-heading has-x-large-font-size" style="margin-bottom:var(--wp--preset--spacing--30)">Gut zu wissen</h2>
	<!-- /wp:heading -->
	<!-- wp:details {"className":"is-style-accordion"} -->
	<details class="wp-block-details is-style-accordion"><summary>Versand &amp; Download</summary>
		<!-- wp:paragraph -->
		<p>Digitale Produkte stehen dir direkt nach Zahlungseingang in deinem Kundenkonto und per E-Mail zum Download bereit. Physische Produkte versenden wir sorgfältig verpackt – alle Infos zu Kosten und Lieferzeiten findest du unter <a href="<?php echo hejlejo_legal_url( 'shipping_costs', 'versandarten' ); ?>">Versand &amp; Lieferung</a>.</p>
		<!-- /wp:paragraph -->
	</details>
	<!-- /wp:details -->
	<!-- wp:details {"className":"is-style-accordion"} -->
	<details class="wp-block-details is-style-accordion"><summary>Lizenz &amp; Nutzung</summary>
		<!-- wp:paragraph -->
		<p>Welche Nutzung erlaubt ist – privat oder gewerblich –, steht in der jeweiligen Produktbeschreibung. Bei Fragen zur Gewerbelizenz melde dich gerne bei uns.</p>
		<!-- /wp:paragraph -->
	</details>
	<!-- /wp:details -->
	<!-- wp:details {"className":"is-style-accordion"} -->
	<details class="wp-block-details is-style-accordion"><summary>Anwendung</summary>
		<!-- wp:paragraph -->
		<p>Eine Schritt-für-Schritt-Anleitung liegt jedem Produkt bei bzw. ist in der Produktbeschreibung verlinkt. Weitere Tipps findest du in unserem Blog.</p>
		<!-- /wp:paragraph -->
	</details>
	<!-- /wp:details -->
	<!-- wp:details {"className":"is-style-accordion"} -->
	<details class="wp-block-details is-style-accordion"><summary>Noch Fragen?</summary>
		<!-- wp:paragraph -->
		<p>Schreib uns gerne über das <a href="<?php echo hejlejo_page_url( 'kontakt' ); ?>">Kontaktformular</a> – wir helfen dir weiter.</p>
		<!-- /wp:paragraph -->
	</details>
	<!-- /wp:details -->
</div>
<!-- /wp:group -->
