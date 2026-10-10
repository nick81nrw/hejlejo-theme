<?php
/**
 * Serverseitige Ausgabe "Freebie-Hinweis".
 *
 * Läuft ein Freebie (Kategorie "Freebie", Laufzeit nicht abgelaufen), verlinkt der Button auf das Produkt.
 * Sonst erscheint ein Hinweis mit Link zum Instagram-Profil.
 * Platzhalter in den Texten: {name} (Produktname), {datum} (Ende der Laufzeit).
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

$hejlejo_freebie = hejlejo_get_active_freebie();
$hejlejo_until   = '';

if ( $hejlejo_freebie ) {
	$hejlejo_end   = hejlejo_freebie_end( $hejlejo_freebie );
	$hejlejo_until = $hejlejo_end ? hejlejo_freebie_date( $hejlejo_end ) : '';
	$hejlejo_vars  = array(
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

$hejlejo_class = 'hejlejo-freebie ' . ( $hejlejo_freebie ? 'is-active' : 'is-empty' );
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => $hejlejo_class ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php if ( $hejlejo_title ) : ?>
		<h2 class="wp-block-heading hejlejo-freebie__title has-x-large-font-size"><?php echo esc_html( $hejlejo_title ); ?></h2>
	<?php endif; ?>
	<?php if ( $hejlejo_text ) : ?>
		<p class="hejlejo-freebie__text has-small-font-size"><?php echo esc_html( $hejlejo_text ); ?></p>
	<?php endif; ?>
	<div class="wp-block-buttons hejlejo-freebie__buttons">
		<div class="wp-block-button"><a class="wp-block-button__link has-surface-color has-green-background-color has-text-color has-background wp-element-button" href="<?php echo esc_url( $hejlejo_link ); ?>"<?php echo $hejlejo_target; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- fester Text. ?>><?php echo esc_html( $hejlejo_button ); ?></a></div>
	</div>
	<?php if ( $hejlejo_until ) : ?>
		<?php /* translators: %s: Enddatum */ ?>
		<p class="hejlejo-freebie__until has-x-small-font-size"><?php echo esc_html( sprintf( __( 'Nur bis %s', 'hejlejo' ), $hejlejo_until ) ); ?></p>
	<?php endif; ?>
</div>
