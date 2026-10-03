<?php
/**
 * Hej Lejo – Theme-Funktionen.
 *
 * Das Design wird über theme.json, Templates, Template Parts und Patterns gesteuert.
 * Hier liegen nur die PHP-Bausteine, die sich nicht deklarativ lösen lassen.
 *
 * @package HejLejo
 */

defined( 'ABSPATH' ) || exit;

define( 'HEJLEJO_VERSION', wp_get_theme( get_template() )->get( 'Version' ) );
define( 'HEJLEJO_DIR', get_template_directory() );
define( 'HEJLEJO_URI', get_template_directory_uri() );

require_once HEJLEJO_DIR . '/inc/setup.php';
require_once HEJLEJO_DIR . '/inc/block-styles.php';
require_once HEJLEJO_DIR . '/inc/patterns.php';
require_once HEJLEJO_DIR . '/inc/editor.php';
require_once HEJLEJO_DIR . '/inc/blocks.php';
require_once HEJLEJO_DIR . '/inc/integrations.php';

if ( class_exists( 'WooCommerce' ) ) {
	require_once HEJLEJO_DIR . '/inc/woocommerce.php';
}
