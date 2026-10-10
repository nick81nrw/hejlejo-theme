<?php
/**
 * Bilder: verkleinerte Varianten als WebP – die Originale bleiben unverändert.
 *
 * - Zu jedem PNG/JPEG-Bild werden die Zwischengrößen (150 … 2048 px) zusätzlich als WebP (Qualität 90) erzeugt
 *   und in den Bilddaten eingetragen; WordPress liefert sie dann im srcset aus.
 * - Das hochgeladene Original und die Vollgröße bleiben PNG/JPEG; die bisherigen Zwischengrößen bleiben auf dem
 *   Server und werden pro Bild gesichert ("Zurücksetzen" stellt den alten Zustand wieder her).
 * - Neue Uploads werden kurz nach dem Hochladen im Hintergrund umgewandelt.
 * - Bestehende Bilder: Medien → WebP-Varianten (Test einzelner IDs oder alle im Hintergrund).
 * - Großansicht der Produktgalerie (Klick) nutzt die 2048er-Variante statt des Originals.
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

const HEJLEJO_WEBP_QUALITY = 90;
const HEJLEJO_WEBP_STATUS  = '_hejlejo_webp';
const HEJLEJO_WEBP_BACKUP  = '_hejlejo_webp_backup';
const HEJLEJO_WEBP_BULK    = 'hejlejo_webp_bulk';

/**
 * Bild-IDs, die noch nicht verarbeitet wurden.
 *
 * @param int $limit Anzahl.
 * @return int[]
 */
function hejlejo_webp_pending_ids( $limit = 5 ) {
	return get_posts(
		array(
			'post_type'      => 'attachment',
			'post_status'    => 'inherit',
			'post_mime_type' => array( 'image/png', 'image/jpeg' ),
			'posts_per_page' => $limit,
			'orderby'        => 'ID',
			'order'          => 'DESC',
			'fields'         => 'ids',
			'no_found_rows'  => true,
			'meta_query'     => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				array(
					'key'     => HEJLEJO_WEBP_STATUS,
					'compare' => 'NOT EXISTS',
				),
			),
		)
	);
}

/**
 * Qualität für WebP während der Umwandlung.
 *
 * @param int    $quality   Qualität.
 * @param string $mime_type Ausgabeformat.
 * @return int
 */
function hejlejo_webp_quality( $quality, $mime_type ) {
	return 'image/webp' === $mime_type ? HEJLEJO_WEBP_QUALITY : $quality;
}

/**
 * Ausgabeformat während der Umwandlung: PNG/JPEG → WebP.
 *
 * @param array $formats Zuordnung Quell- zu Zielformat.
 * @return array
 */
function hejlejo_webp_output_format( $formats ) {
	$formats['image/png']  = 'image/webp';
	$formats['image/jpeg'] = 'image/webp';
	return $formats;
}

/**
 * WebP-Zwischengrößen für ein Bild erzeugen.
 *
 * @param int $id Anhang-ID.
 * @return array|WP_Error Ergebnis je Größe: name => [ vorher, nachher ] in Bytes.
 */
function hejlejo_webp_convert( $id ) {
	$id   = absint( $id );
	$mime = get_post_mime_type( $id );

	if ( ! in_array( $mime, array( 'image/png', 'image/jpeg' ), true ) ) {
		update_post_meta( $id, HEJLEJO_WEBP_STATUS, 'skip' );
		return new WP_Error( 'hejlejo_webp_mime', 'Kein PNG/JPEG.' );
	}

	$meta = wp_get_attachment_metadata( $id );
	$file = get_attached_file( $id );

	if ( ! $file || ! file_exists( $file ) ) {
		update_post_meta( $id, HEJLEJO_WEBP_STATUS, 'error: Datei fehlt' );
		return new WP_Error( 'hejlejo_webp_file', 'Datei fehlt.' );
	}

	if ( empty( $meta['sizes'] ) || ! is_array( $meta['sizes'] ) ) {
		update_post_meta( $id, HEJLEJO_WEBP_STATUS, 'skip' );
		return array();
	}

	if ( ! wp_image_editor_supports( array( 'mime_type' => 'image/webp' ) ) ) {
		return new WP_Error( 'hejlejo_webp_support', 'Der Server kann kein WebP erzeugen.' );
	}

	add_filter( 'image_editor_output_format', 'hejlejo_webp_output_format', 99 );
	add_filter( 'wp_editor_set_quality', 'hejlejo_webp_quality', 99, 2 );

	$editor = wp_get_image_editor( $file );

	if ( is_wp_error( $editor ) ) {
		remove_filter( 'image_editor_output_format', 'hejlejo_webp_output_format', 99 );
		remove_filter( 'wp_editor_set_quality', 'hejlejo_webp_quality', 99 );
		update_post_meta( $id, HEJLEJO_WEBP_STATUS, 'error: ' . $editor->get_error_message() );
		return $editor;
	}

	$dir        = trailingslashit( dirname( $file ) );
	$registered = wp_get_registered_image_subsizes();
	$backup     = get_post_meta( $id, HEJLEJO_WEBP_BACKUP, true );
	$backup     = is_array( $backup ) ? $backup : array();
	$base       = preg_replace( '/-scaled$/', '', pathinfo( $file, PATHINFO_FILENAME ) );
	$report     = array();
	$made       = array(); // Bereits erzeugte Abmessungen dieses Laufs (mehrere Größen können dieselbe Datei nutzen).

	foreach ( $meta['sizes'] as $name => $size ) {
		if ( isset( $size['mime-type'] ) && 'image/webp' === $size['mime-type'] ) {
			continue;
		}

		// Nicht (mehr) registrierte Größen, z. B. vom früheren Theme, bleiben unverändert.
		if ( ! isset( $registered[ $name ] ) ) {
			continue;
		}

		$crop = $registered[ $name ]['crop'];
		$key  = (int) $size['width'] . 'x' . (int) $size['height'] . ( $crop ? 'c' : '' );

		if ( isset( $made[ $key ] ) ) {
			if ( ! isset( $backup[ $name ] ) ) {
				$backup[ $name ] = $size;
			}
			$meta['sizes'][ $name ] = $made[ $key ];
			continue;
		}

		$saved = $editor->make_subsize(
			array(
				'width'  => (int) $size['width'],
				'height' => (int) $size['height'],
				'crop'   => $crop,
			)
		);

		if ( is_wp_error( $saved ) || empty( $saved['file'] ) ) {
			continue;
		}

		// Dateiname wie bei WordPress üblich (ohne "-scaled"): name-600x600.webp.
		$target = $base . '-' . $saved['width'] . 'x' . $saved['height'] . '.webp';
		if ( $target !== $saved['file'] && ! file_exists( $dir . $target ) && @rename( $dir . $saved['file'], $dir . $target ) ) { // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged, WordPress.WP.AlternativeFunctions.rename_rename
			$saved['file'] = $target;
		}
		$saved['filesize'] = (int) filesize( $dir . $saved['file'] );

		if ( ! isset( $backup[ $name ] ) ) {
			$backup[ $name ] = $size;
		}

		$before          = isset( $size['filesize'] ) ? (int) $size['filesize'] : ( file_exists( $dir . $size['file'] ) ? (int) filesize( $dir . $size['file'] ) : 0 );
		$report[ $name ] = array( $before, $saved['filesize'] );

		$meta['sizes'][ $name ] = array(
			'file'      => $saved['file'],
			'width'     => (int) $saved['width'],
			'height'    => (int) $saved['height'],
			'mime-type' => 'image/webp',
			'filesize'  => $saved['filesize'],
		);
		$made[ $key ]           = $meta['sizes'][ $name ];
	}

	remove_filter( 'image_editor_output_format', 'hejlejo_webp_output_format', 99 );
	remove_filter( 'wp_editor_set_quality', 'hejlejo_webp_quality', 99 );

	update_post_meta( $id, HEJLEJO_WEBP_BACKUP, $backup );
	wp_update_attachment_metadata( $id, $meta );
	update_post_meta( $id, HEJLEJO_WEBP_STATUS, 'done' );

	return $report;
}

/**
 * Ursprüngliche Zwischengrößen wiederherstellen und die WebP-Dateien entfernen.
 *
 * @param int $id Anhang-ID.
 * @return bool
 */
function hejlejo_webp_restore( $id ) {
	$id     = absint( $id );
	$backup = get_post_meta( $id, HEJLEJO_WEBP_BACKUP, true );
	$meta   = wp_get_attachment_metadata( $id );
	$file   = get_attached_file( $id );

	if ( is_array( $backup ) && is_array( $meta ) && $file ) {
		$dir = trailingslashit( dirname( $file ) );

		foreach ( $backup as $name => $size ) {
			if ( isset( $meta['sizes'][ $name ]['mime-type'] ) && 'image/webp' === $meta['sizes'][ $name ]['mime-type'] ) {
				wp_delete_file( $dir . $meta['sizes'][ $name ]['file'] );
			}
			$meta['sizes'][ $name ] = $size;
		}
		wp_update_attachment_metadata( $id, $meta );
	}

	delete_post_meta( $id, HEJLEJO_WEBP_BACKUP );
	delete_post_meta( $id, HEJLEJO_WEBP_STATUS );

	return true;
}

/**
 * Beim Löschen eines Bildes auch die gesicherten alten Zwischengrößen löschen.
 *
 * @param int $id Anhang-ID.
 */
function hejlejo_webp_delete_backup_files( $id ) {
	$backup = get_post_meta( $id, HEJLEJO_WEBP_BACKUP, true );
	$file   = get_attached_file( $id );

	if ( is_array( $backup ) && $file ) {
		$dir = trailingslashit( dirname( $file ) );
		foreach ( $backup as $size ) {
			if ( ! empty( $size['file'] ) ) {
				wp_delete_file( $dir . $size['file'] );
			}
		}
	}
}
add_action( 'delete_attachment', 'hejlejo_webp_delete_backup_files' );

/**
 * Neue Uploads (und neu erzeugte Bilddaten) kurz danach im Hintergrund umwandeln.
 *
 * @param array $metadata Bilddaten.
 * @param int   $id       Anhang-ID.
 * @return array
 */
function hejlejo_webp_schedule_new( $metadata, $id ) {
	if ( in_array( get_post_mime_type( $id ), array( 'image/png', 'image/jpeg' ), true ) ) {
		delete_post_meta( $id, HEJLEJO_WEBP_STATUS );
		delete_post_meta( $id, HEJLEJO_WEBP_BACKUP );
		if ( ! wp_next_scheduled( 'hejlejo_webp_single', array( (int) $id ) ) ) {
			wp_schedule_single_event( time() + 60, 'hejlejo_webp_single', array( (int) $id ) );
		}
	}
	return $metadata;
}
add_filter( 'wp_generate_attachment_metadata', 'hejlejo_webp_schedule_new', 20, 2 );
add_action( 'hejlejo_webp_single', 'hejlejo_webp_convert' );

/**
 * Hintergrund-Lauf über alle Bilder: Pakete von bis zu 5 Bildern bzw. 20 Sekunden.
 */
function hejlejo_webp_batch() {
	if ( 'running' !== get_option( HEJLEJO_WEBP_BULK ) ) {
		return;
	}

	$start = time();
	foreach ( hejlejo_webp_pending_ids( 5 ) as $id ) {
		hejlejo_webp_convert( $id );
		if ( time() - $start > 20 ) {
			break;
		}
	}

	if ( hejlejo_webp_pending_ids( 1 ) ) {
		wp_schedule_single_event( time() + 15, 'hejlejo_webp_batch' );
	} else {
		update_option( HEJLEJO_WEBP_BULK, 'done', false );
	}
}
add_action( 'hejlejo_webp_batch', 'hejlejo_webp_batch' );

/**
 * Hintergrund-Lauf starten bzw. stoppen.
 *
 * @param bool $run Starten (true) oder stoppen (false).
 */
function hejlejo_webp_bulk( $run ) {
	wp_clear_scheduled_hook( 'hejlejo_webp_batch' );
	update_option( HEJLEJO_WEBP_BULK, $run ? 'running' : 'stopped', false );
	if ( $run ) {
		wp_schedule_single_event( time() + 5, 'hejlejo_webp_batch' );
	}
}

/**
 * Stand der Umwandlung.
 *
 * @return array
 */
function hejlejo_webp_status() {
	global $wpdb;

	$total = (int) $wpdb->get_var( "SELECT COUNT(ID) FROM {$wpdb->posts} WHERE post_type = 'attachment' AND post_mime_type IN ('image/png','image/jpeg')" ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery
	$rows  = $wpdb->get_results( $wpdb->prepare( "SELECT LEFT(meta_value, 5) AS s, COUNT(*) AS n FROM {$wpdb->postmeta} WHERE meta_key = %s GROUP BY s", HEJLEJO_WEBP_STATUS ), OBJECT_K ); // phpcs:ignore WordPress.DB.DirectDatabaseQuery

	$done  = isset( $rows['done'] ) ? (int) $rows['done']->n : 0;
	$skip  = isset( $rows['skip'] ) ? (int) $rows['skip']->n : 0;
	$error = isset( $rows['error'] ) ? (int) $rows['error']->n : 0;

	return array(
		'total'     => $total,
		'done'      => $done,
		'skipped'   => $skip,
		'errors'    => $error,
		'remaining' => max( 0, $total - $done - $skip - $error ),
		'bulk'      => (string) get_option( HEJLEJO_WEBP_BULK, '' ),
		'webp'      => wp_image_editor_supports( array( 'mime_type' => 'image/webp' ) ),
	);
}

/**
 * Großansicht der Produktgalerie (Klick): 2048er-Variante statt Original.
 * Ist ein Bild kleiner, nutzt WordPress automatisch die Vollgröße.
 *
 * @return string
 */
function hejlejo_gallery_full_size() {
	return '2048x2048';
}
add_filter( 'woocommerce_gallery_full_size', 'hejlejo_gallery_full_size' );

/**
 * REST: Test einzelner IDs und Stand abfragen (nur Administratorinnen und Administratoren).
 */
function hejlejo_webp_rest_routes() {
	$admin = function () {
		return current_user_can( 'manage_options' );
	};

	register_rest_route(
		'hejlejo/v1',
		'/webp',
		array(
			array(
				'methods'             => 'GET',
				'permission_callback' => $admin,
				'callback'            => 'hejlejo_webp_status',
			),
			array(
				'methods'             => 'POST',
				'permission_callback' => $admin,
				'args'                => array(
					'action' => array(
						'type' => 'string',
						'enum' => array( 'convert', 'restore', 'bulk-start', 'bulk-stop' ),
					),
					'ids'    => array(
						'type'    => 'array',
						'items'   => array( 'type' => 'integer' ),
						'default' => array(),
					),
				),
				'callback'            => function ( WP_REST_Request $request ) {
					$action = $request['action'];
					$result = array();

					if ( 'bulk-start' === $action || 'bulk-stop' === $action ) {
						hejlejo_webp_bulk( 'bulk-start' === $action );
						return hejlejo_webp_status();
					}

					foreach ( array_slice( array_map( 'absint', (array) $request['ids'] ), 0, 10 ) as $id ) {
						if ( 'restore' === $action ) {
							$result[ $id ] = hejlejo_webp_restore( $id );
						} else {
							$converted     = hejlejo_webp_convert( $id );
							$result[ $id ] = is_wp_error( $converted ) ? $converted->get_error_message() : $converted;
						}
					}
					return $result;
				},
			),
		)
	);
}
add_action( 'rest_api_init', 'hejlejo_webp_rest_routes' );

/**
 * Admin-Seite: Medien → WebP-Varianten.
 */
function hejlejo_webp_admin_menu() {
	add_media_page( __( 'WebP-Varianten', 'hejlejo' ), __( 'WebP-Varianten', 'hejlejo' ), 'manage_options', 'hejlejo-webp', 'hejlejo_webp_admin_page' );
}
add_action( 'admin_menu', 'hejlejo_webp_admin_menu' );

/**
 * Formular-Aktionen der Admin-Seite.
 */
function hejlejo_webp_admin_action() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Keine Berechtigung.', 'hejlejo' ) );
	}
	check_admin_referer( 'hejlejo_webp' );

	$do  = isset( $_POST['do'] ) ? sanitize_key( wp_unslash( $_POST['do'] ) ) : '';
	$ids = isset( $_POST['ids'] ) ? array_filter( array_map( 'absint', preg_split( '/[\s,;]+/', sanitize_text_field( wp_unslash( $_POST['ids'] ) ) ) ) ) : array();
	$msg = '';

	if ( 'start' === $do || 'stop' === $do ) {
		hejlejo_webp_bulk( 'start' === $do );
		$msg = 'start' === $do ? 'gestartet' : 'gestoppt';
	} elseif ( 'convert' === $do || 'restore' === $do ) {
		foreach ( array_slice( $ids, 0, 10 ) as $id ) {
			'restore' === $do ? hejlejo_webp_restore( $id ) : hejlejo_webp_convert( $id );
		}
		$msg = 'restore' === $do ? 'zurueckgesetzt' : 'umgewandelt';
	}

	wp_safe_redirect( add_query_arg( array( 'page' => 'hejlejo-webp', 'msg' => $msg ), admin_url( 'upload.php' ) ) );
	exit;
}
add_action( 'admin_post_hejlejo_webp', 'hejlejo_webp_admin_action' );

/**
 * Admin-Seite ausgeben.
 */
function hejlejo_webp_admin_page() {
	$s = hejlejo_webp_status();
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$msg = isset( $_GET['msg'] ) ? sanitize_key( wp_unslash( $_GET['msg'] ) ) : '';
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'WebP-Varianten', 'hejlejo' ); ?></h1>
		<p><?php esc_html_e( 'Erzeugt zu jedem PNG/JPEG-Bild verkleinerte Varianten als WebP (Qualität 90). Originale und bisherige Varianten bleiben erhalten; „Zurücksetzen“ stellt den alten Zustand wieder her.', 'hejlejo' ); ?></p>
		<?php if ( $msg ) : ?>
			<div class="notice notice-success"><p><?php echo esc_html( 'Aktion ausgeführt: ' . $msg ); ?></p></div>
		<?php endif; ?>
		<?php if ( ! $s['webp'] ) : ?>
			<div class="notice notice-error"><p><?php esc_html_e( 'Der Server kann kein WebP erzeugen.', 'hejlejo' ); ?></p></div>
		<?php endif; ?>
		<table class="widefat striped" style="max-width:32rem">
			<tr><td><?php esc_html_e( 'Bilder (PNG/JPEG)', 'hejlejo' ); ?></td><td><?php echo esc_html( $s['total'] ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Umgewandelt', 'hejlejo' ); ?></td><td><?php echo esc_html( $s['done'] ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Übersprungen (keine Varianten)', 'hejlejo' ); ?></td><td><?php echo esc_html( $s['skipped'] ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Fehler', 'hejlejo' ); ?></td><td><?php echo esc_html( $s['errors'] ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Offen', 'hejlejo' ); ?></td><td><?php echo esc_html( $s['remaining'] ); ?></td></tr>
			<tr><td><?php esc_html_e( 'Hintergrund-Lauf', 'hejlejo' ); ?></td><td><?php echo esc_html( $s['bulk'] ? $s['bulk'] : '–' ); ?></td></tr>
		</table>

		<h2><?php esc_html_e( 'Test mit einzelnen Bildern', 'hejlejo' ); ?></h2>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'hejlejo_webp' ); ?>
			<input type="hidden" name="action" value="hejlejo_webp">
			<p><label><?php esc_html_e( 'Bild-IDs (max. 10, durch Komma getrennt):', 'hejlejo' ); ?> <input type="text" name="ids" class="regular-text" placeholder="2578, 2391"></label></p>
			<p>
				<button class="button button-primary" name="do" value="convert"><?php esc_html_e( 'Umwandeln', 'hejlejo' ); ?></button>
				<button class="button" name="do" value="restore"><?php esc_html_e( 'Zurücksetzen', 'hejlejo' ); ?></button>
			</p>
		</form>

		<h2><?php esc_html_e( 'Alle Bilder', 'hejlejo' ); ?></h2>
		<p><?php esc_html_e( 'Läuft im Hintergrund in kleinen Paketen (WP-Cron). Vorher eine Sicherung inklusive Uploads machen.', 'hejlejo' ); ?></p>
		<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
			<?php wp_nonce_field( 'hejlejo_webp' ); ?>
			<input type="hidden" name="action" value="hejlejo_webp">
			<button class="button button-primary" name="do" value="start"><?php esc_html_e( 'Alle umwandeln', 'hejlejo' ); ?></button>
			<button class="button" name="do" value="stop"><?php esc_html_e( 'Stoppen', 'hejlejo' ); ?></button>
		</form>
	</div>
	<?php
}
