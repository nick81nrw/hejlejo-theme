<?php
/**
 * VORÜBERGEHEND: Diagnose, wer "wc-product-gallery-zoom" anmeldet.
 *
 * Nur bei Aufruf der REST-Route /wp-json/hejlejo/v1/diag-zoom (oder per MCP) aktiv und nur für Administratorinnen
 * und Administratoren lesbar. Wird nach der Fehlersuche wieder entfernt.
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

// Auch bei MCP-Anfragen aktiv: MCP ruft die REST-Route intern auf, die URL ist dann die MCP-Adresse.
$hejlejo_diag_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

if ( false !== strpos( $hejlejo_diag_uri, 'hejlejo/v1/diag-zoom' ) || false !== strpos( $hejlejo_diag_uri, '/mcp' ) ) {
	$GLOBALS['hejlejo_diag_zoom'] = array(
		'at_theme_load' => isset( $GLOBALS['_wp_theme_features']['wc-product-gallery-zoom'] ),
		'added_during'  => null,
		'callbacks'     => array(),
	);

	/*
	 * Vor jeder Aktion prüfen, ob die Unterstützung inzwischen angemeldet ist.
	 * Beim ersten Umschalten ist die vorherige Aktion die gesuchte.
	 */
	add_action(
		'all',
		function () {
			static $last = null;
			static $done = false;

			// Nur direkt auf die Liste zugreifen – keine Funktionen, die selbst Hooks auslösen (sonst Endlosschleife).
			if ( $done ) {
				return;
			}
			$diag = &$GLOBALS['hejlejo_diag_zoom'];

			if ( $diag['at_theme_load'] ) {
				$done = true;
				return;
			}

			if ( isset( $GLOBALS['_wp_theme_features']['wc-product-gallery-zoom'] ) ) {
				$done = true;
				$diag['added_during'] = $last;

				// Aufruf-Stapel im Moment des Umschaltens (löst keine Hooks aus).
				foreach ( debug_backtrace( DEBUG_BACKTRACE_IGNORE_ARGS, 30 ) as $frame ) { // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_debug_backtrace
					$diag['backtrace'][] = ( isset( $frame['class'] ) ? $frame['class'] . '::' : '' ) . $frame['function']
						. ( isset( $frame['file'] ) ? ' @ ' . str_replace( ABSPATH, '', $frame['file'] ) . ':' . $frame['line'] : '' );
				}

				if ( $last && isset( $GLOBALS['wp_filter'][ $last ] ) ) {
					foreach ( $GLOBALS['wp_filter'][ $last ]->callbacks as $priority => $callbacks ) {
						foreach ( $callbacks as $callback ) {
							$diag['callbacks'][] = $priority . ' ' . hejlejo_diag_callback_source( $callback['function'] );
						}
					}
				}
			}
			$last = current_filter();
		}
	);
}

/**
 * Name und Datei eines Callbacks.
 *
 * @param callable $fn Callback.
 * @return string
 */
function hejlejo_diag_callback_source( $fn ) {
	try {
		if ( is_string( $fn ) && false !== strpos( $fn, '::' ) ) {
			$fn = explode( '::', $fn );
		}
		if ( is_array( $fn ) ) {
			$ref  = new ReflectionMethod( $fn[0], $fn[1] );
			$name = ( is_object( $fn[0] ) ? get_class( $fn[0] ) : $fn[0] ) . '::' . $fn[1];
		} else {
			$ref  = new ReflectionFunction( $fn );
			$name = is_string( $fn ) ? $fn : 'Closure';
		}
		return $name . ' @ ' . str_replace( ABSPATH, '', (string) $ref->getFileName() ) . ':' . $ref->getStartLine();
	} catch ( Throwable $e ) {
		return 'unbekannt';
	}
}

add_action(
	'rest_api_init',
	function () {
		register_rest_route(
			'hejlejo/v1',
			'/diag-zoom',
			array(
				'methods'             => 'GET',
				'permission_callback' => function () {
					return current_user_can( 'manage_options' );
				},
				'callback'            => function () {
					$diag = isset( $GLOBALS['hejlejo_diag_zoom'] ) ? $GLOBALS['hejlejo_diag_zoom'] : array();

					$diag['now']      = isset( $GLOBALS['_wp_theme_features']['wc-product-gallery-zoom'] );
					$diag['features'] = array_keys( $GLOBALS['_wp_theme_features'] );

					return $diag;
				},
			)
		);
	}
);
