<?php
/**
 * Title: Hej Lejo / FAQ
 * Slug: hejlejo/faq
 * Categories: hejlejo-sections
 * Keywords: faq, fragen, antworten, akkordeon, hilfe
 * Viewport Width: 1000
 * Description: Häufige Fragen als aufklappbare Liste.
 *
 * @package HejLejo
 */

$hejlejo_faq = array(
	array( 'Wann kann ich meine Dateien herunterladen?', 'Direkt nach Zahlungseingang – du bekommst eine E-Mail mit Download-Link und findest die Dateien zusätzlich in deinem Kundenkonto.' ),
	array( 'Wie bringe ich ein Kerzentattoo auf?', 'Motiv ausschneiden, kurz in Wasser legen, auf die Kerze schieben und glatt streichen. Eine ausführliche Anleitung liegt jeder Bestellung bei.' ),
	array( 'Darf ich die Designs gewerblich nutzen?', 'Das hängt vom Produkt ab. In der Produktbeschreibung steht, ob eine Gewerbelizenz enthalten ist oder separat erworben werden kann.' ),
	array( 'Wie lange dauert der Versand?', 'Physische Produkte verschicken wir in der Regel innerhalb weniger Werktage. Die genaue Lieferzeit steht auf jeder Produktseite.' ),
);
?>
<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained","contentSize":"760px"}} -->
<div class="wp-block-group alignfull hejlejo-section" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:heading {"textAlign":"center"} -->
	<h2 class="wp-block-heading has-text-align-center">Häufige Fragen</h2>
	<!-- /wp:heading -->
	<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group">
		<?php foreach ( $hejlejo_faq as $hejlejo_item ) : ?>
		<!-- wp:details {"className":"is-style-accordion"} -->
		<details class="wp-block-details is-style-accordion"><summary><?php echo esc_html( $hejlejo_item[0] ); ?></summary>
			<!-- wp:paragraph -->
			<p><?php echo esc_html( $hejlejo_item[1] ); ?></p>
			<!-- /wp:paragraph -->
		</details>
		<!-- /wp:details -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
