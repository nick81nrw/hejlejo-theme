<?php
/**
 * Editor-Erfahrung: einfach halten und vor versehentlichem "Kaputt-Editieren" schützen.
 *
 * Farben, Schriftgrößen und Abstände sind bereits in theme.json auf die Theme-Presets begrenzt.
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

/**
 * Editor-Einstellungen begrenzen.
 *
 * @param array $settings Editor-Einstellungen.
 * @return array
 */
function hejlejo_editor_settings( $settings ) {
	// Keine Schriften aus der Font Library (lädt sonst ggf. Google Fonts nach).
	$settings['fontLibraryEnabled'] = false;

	// Keine externen Openverse-Bilder im Medien-Inserter.
	$settings['enableOpenverseMediaCategory'] = false;

	// Code-Editor nur für Administratorinnen und Administratoren.
	if ( ! current_user_can( 'manage_options' ) ) {
		$settings['codeEditingEnabled'] = false;
	}

	return $settings;
}
add_filter( 'block_editor_settings_all', 'hejlejo_editor_settings' );

/**
 * Editor-Script: entfernt Stilvarianten, die nicht zum Design passen.
 */
function hejlejo_enqueue_editor_assets() {
	wp_enqueue_script(
		'hejlejo-editor',
		HEJLEJO_URI . '/assets/js/editor.js',
		array( 'wp-blocks', 'wp-dom-ready' ),
		HEJLEJO_VERSION,
		true
	);
}
add_action( 'enqueue_block_editor_assets', 'hejlejo_enqueue_editor_assets' );
