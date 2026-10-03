<?php
/**
 * Block-Stilvarianten.
 *
 * Die Varianten erscheinen im Editor unter "Stile" und ersetzen freie Gestaltungsoptionen.
 * Das CSS dazu liegt in assets/css/theme.css (Klassen .is-style-*).
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Block-Stile registrieren.
 */
function hejlejo_register_block_styles() {
	$styles = array(
		'core/button'     => array(
			'secondary' => __( 'Sekundär (weiß)', 'hejlejo' ),
			'light'     => __( 'Hell (für grüne Flächen)', 'hejlejo' ),
			'text-link' => __( 'Textlink mit Pfeil', 'hejlejo' ),
		),
		'core/cover'      => array(
			'hero' => __( 'Hero (mobil: Bild oben)', 'hejlejo' ),
		),
		'core/group'      => array(
			'card'  => __( 'Karte', 'hejlejo' ),
			'panel' => __( 'Fläche (abgerundet)', 'hejlejo' ),
		),
		'core/columns'    => array(
			'panel' => __( 'Fläche (abgerundet)', 'hejlejo' ),
		),
		'core/image'      => array(
			'arch'   => __( 'Bogen', 'hejlejo' ),
			'circle' => __( 'Kreis', 'hejlejo' ),
		),
		'core/site-logo'  => array(
			'dark' => __( 'Dunkel einfärben (für helle Logos)', 'hejlejo' ),
		),
		'core/paragraph'  => array(
			'eyebrow' => __( 'Dachzeile', 'hejlejo' ),
		),
		'core/list'       => array(
			'check' => __( 'Häkchen', 'hejlejo' ),
			'heart' => __( 'Herzchen', 'hejlejo' ),
		),
		'core/post-terms' => array(
			'badges' => __( 'Badges', 'hejlejo' ),
		),
		'core/details'    => array(
			'accordion' => __( 'Akkordeon', 'hejlejo' ),
		),
	);

	foreach ( $styles as $block => $block_styles ) {
		foreach ( $block_styles as $name => $label ) {
			register_block_style(
				$block,
				array(
					'name'  => $name,
					'label' => $label,
				)
			);
		}
	}
}
add_action( 'init', 'hejlejo_register_block_styles' );
