<?php
/**
 * Title: Hej Lejo / Seite: Über uns
 * Slug: hejlejo/page-about
 * Categories: hejlejo-pages
 * Keywords: über uns, about, geschichte, team
 * Block Types: core/post-content
 * Post Types: page
 * Viewport Width: 1400
 * Description: Über-uns-Seite: Headline mit Portrait, Geschichte vom Schranklädchen zum Online-Shop und persönlicher Gruß.
 *
 * @package HejLejo
 */

?>
<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}}},"backgroundColor":"cream","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull hejlejo-section has-cream-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","className":"hejlejo-about-hero","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|50","left":"var:preset|spacing|60"}}}} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center hejlejo-about-hero">
		<!-- wp:column {"verticalAlignment":"center","width":"55%","style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">
			<!-- wp:paragraph {"className":"is-style-eyebrow"} -->
			<p class="is-style-eyebrow">Über Hej.LEJO</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":1,"fontSize":"huge"} -->
			<h1 class="wp-block-heading has-huge-font-size">Hej, schön, dass du da bist!</h1>
			<!-- /wp:heading -->
			<!-- wp:paragraph -->
			<p>Alles begann mit einem kleinen grünen Schrank. Einem Schranklädchen voller handgemachter, liebevoller Dinge, die Freude schenken sollen: jahreszeitliche Deko, feine Papeterie, kleine Geschenkideen und vieles mehr.</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p>Wer Handgemachtes liebt und sich an kleinen Unebenheiten nicht stört, ist hier genau richtig.</p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph -->
			<p>Jetzt darf das Schranklädchen auch online wachsen. Mit ausgewählten Lieblingsstücken, Designvorlagen für Kerzentattoos und Druckvorlagen startet Hej.LEJO in die nächste Runde.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"verticalAlignment":"center","width":"45%"} -->
		<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
			<!-- wp:image {"aspectRatio":"4/5","scale":"cover","sizeSlug":"large","className":"is-style-arch"} -->
			<figure class="wp-block-image size-large is-style-arch"><img src="<?php echo hejlejo_image( 'content/portrait.jpg' ); ?>" alt="" style="aspect-ratio:4/5;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","className":"hejlejo-section","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"},"blockGap":"var:preset|spacing|30"}},"backgroundColor":"base","layout":{"type":"constrained","contentSize":"720px"}} -->
<div class="wp-block-group alignfull hejlejo-section has-base-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:heading {"textAlign":"center"} -->
	<h2 class="wp-block-heading has-text-align-center">Klein, persönlich und mit ganz viel Herz</h2>
	<!-- /wp:heading -->
	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center">Daran hat sich bis heute nichts geändert. Und ja: Wenn eine Bestellung reinkommt, tanze ich wirklich kurz vor Freude, weil ich liebe, was ich tue.</p>
	<!-- /wp:paragraph -->
	<!-- wp:paragraph {"align":"center"} -->
	<p class="has-text-align-center">Lange Rede, kurzer Sinn: Viel Spaß beim Stöbern wünscht<br><strong>Sabrina von Hej.LEJO</strong></p>
	<!-- /wp:paragraph -->
	<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
	<p class="has-text-align-center has-small-font-size">Mehr Einblicke findest du auf Instagram: <a href="https://www.instagram.com/hej.lejo">@hej.lejo</a></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->
