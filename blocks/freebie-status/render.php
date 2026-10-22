<?php
/**
 * Serverseitige Ausgabe "Freebie-Hinweis".
 *
 * Läuft ein Freebie (Kategorie "Freebie", Laufzeit nicht abgelaufen), verlinkt der Button auf das Produkt.
 * Sonst erscheint ein Hinweis mit Link zum Instagram-Profil.
 * Platzhalter in den Texten: {name} (Produktname), {datum} (Ende der Laufzeit).
 *
 * Variante "spotlight": große Aktionsfläche mit Produktbild, die das Theme auf der Startseite direkt unter
 * dem Startbild einsetzt, solange ein Freebie läuft (siehe inc/freebie.php). Ohne Freebie gibt sie nichts aus.
 *
 * @package HejLejo
 *
 * @var array    $attributes Block-Attribute.
 * @var WP_Block $block      Block-Instanz.
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'hejlejo_get_active_freebie' ) ) {
	return;
}

$hejlejo_freebie   = hejlejo_get_active_freebie();
$hejlejo_spotlight = isset( $attributes['variant'] ) && 'spotlight' === $attributes['variant'];
$hejlejo_end       = $hejlejo_freebie ? hejlejo_freebie_end( $hejlejo_freebie ) : 0;
$hejlejo_until     = $hejlejo_end ? hejlejo_freebie_date( $hejlejo_end ) : '';
$hejlejo_countdown = $hejlejo_end ? hejlejo_freebie_countdown( $hejlejo_end ) : '';

if ( $hejlejo_spotlight && ! $hejlejo_freebie ) {
	return;
}

if ( $hejlejo_freebie ) {
	$hejlejo_vars   = array(
		'{name}'  => $hejlejo_freebie->get_name(),
		'{datum}' => $hejlejo_until,
	);
	$hejlejo_title  = strtr( $attributes['activeTitle'], $hejlejo_vars );
	$hejlejo_text   = strtr( $attributes['activeText'], $hejlejo_vars );
	$hejlejo_button = $attributes['activeButton'];
	$hejlejo_link   = $hejlejo_freebie->get_permalink();
	$hejlejo_target = '';
} else {
	$hejlejo_title  = $attributes['emptyTitle'];
	$hejlejo_text   = $attributes['emptyText'];
	$hejlejo_button = $attributes['emptyButton'];
	$hejlejo_link   = hejlejo_instagram_profile_url();
	$hejlejo_target = ' target="_blank" rel="noopener"';
}

// Restlaufzeit: "Noch 9 Tage" als Schild, dahinter das genaue Ende.
$hejlejo_deadline = '';
if ( $hejlejo_countdown ) {
	$hejlejo_deadline = sprintf(
		'<span class="hejlejo-freebie-countdown" data-end="%1$d">%2$s</span> <span class="hejlejo-freebie-deadline__date">%3$s</span>',
		(int) $hejlejo_end,
		esc_html( $hejlejo_countdown ),
		/* translators: %s: Enddatum */
		esc_html( sprintf( __( 'bis %s', 'hejlejo' ), $hejlejo_until ) )
	);
}

$hejlejo_button_html = sprintf(
	'<div class="wp-block-buttons hejlejo-freebie__buttons"><div class="wp-block-button"><a class="wp-block-button__link has-surface-color has-green-background-color has-text-color has-background wp-element-button" href="%1$s"%2$s>%3$s</a></div></div>',
	esc_url( $hejlejo_link ),
	$hejlejo_target, // Fester Text.
	esc_html( $hejlejo_button )
);

if ( $hejlejo_spotlight ) :
	$hejlejo_id      = wp_unique_id( 'hejlejo-freebie-spotlight-' );
	$hejlejo_summary = __( 'Kostenlos zum Herunterladen – nur für kurze Zeit.', 'hejlejo' );
	$hejlejo_image   = $hejlejo_freebie->get_image(
		'woocommerce_single',
		array(
			'class' => 'hejlejo-freebie-spotlight__image',
			'sizes' => '(max-width: 599px) 40vw, 420px',
			'alt'   => '',
		)
	);
	?>
	<section <?php echo get_block_wrapper_attributes( array( 'class' => 'hejlejo-freebie-spotlight alignfull has-global-padding is-layout-constrained' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> aria-labelledby="<?php echo esc_attr( $hejlejo_id ); ?>">
		<div class="hejlejo-freebie-spotlight__inner alignwide">
			<a class="hejlejo-freebie-spotlight__media" href="<?php echo esc_url( $hejlejo_link ); ?>" tabindex="-1" aria-hidden="true">
				<?php echo $hejlejo_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WooCommerce-Bild. ?>
				<span class="hejlejo-badge hejlejo-badge--sale hejlejo-freebie-spotlight__badge"><?php esc_html_e( 'Gratis', 'hejlejo' ); ?></span>
			</a>
			<div class="hejlejo-freebie-spotlight__body">
				<?php if ( $hejlejo_title ) : ?>
					<p class="hejlejo-freebie-spotlight__eyebrow"><?php echo esc_html( $hejlejo_title ); ?></p>
				<?php endif; ?>
				<h2 class="wp-block-heading hejlejo-freebie-spotlight__title" id="<?php echo esc_attr( $hejlejo_id ); ?>"><?php echo esc_html( $hejlejo_freebie->get_name() ); ?></h2>
				<p class="hejlejo-freebie-spotlight__text"><?php echo esc_html( $hejlejo_summary ); ?></p>
				<?php if ( $hejlejo_deadline ) : ?>
					<p class="hejlejo-freebie-deadline"><?php echo $hejlejo_deadline; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- oben escaped. ?></p>
				<?php endif; ?>
			</div>
			<?php echo $hejlejo_button_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- oben escaped. ?>
		</div>
	</section>
	<?php
	return;
endif;

$hejlejo_class = 'hejlejo-freebie ' . ( $hejlejo_freebie ? 'is-active' : 'is-empty' );
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => $hejlejo_class ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $hejlejo_freebie ) : ?>
		<span class="hejlejo-badge hejlejo-badge--sale"><?php esc_html_e( 'Gratis', 'hejlejo' ); ?></span>
	<?php endif; ?>
	<?php if ( $hejlejo_title ) : ?>
		<h2 class="wp-block-heading hejlejo-freebie__title has-x-large-font-size"><?php echo esc_html( $hejlejo_title ); ?></h2>
	<?php endif; ?>
	<?php if ( $hejlejo_text ) : ?>
		<p class="hejlejo-freebie__text has-small-font-size"><?php echo esc_html( $hejlejo_text ); ?></p>
	<?php endif; ?>
	<?php echo $hejlejo_button_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- oben escaped. ?>
	<?php if ( $hejlejo_deadline ) : ?>
		<p class="hejlejo-freebie-deadline has-x-small-font-size"><?php echo $hejlejo_deadline; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- oben escaped. ?></p>
	<?php endif; ?>
</div>
