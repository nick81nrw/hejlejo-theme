<?php
/**
 * Serverseitige Ausgabe "Kategorie-Navigation".
 *
 * - Shop, Suche, Schlagwörter: Hauptkategorien.
 * - Kategorie mit Unterkategorien: deren Unterkategorien.
 * - Kategorie ohne Unterkategorien: die Geschwister (aktuelle hervorgehoben) und ein Link zur übergeordneten Kategorie.
 *
 * Es werden nur vorhandene Kategorien gelesen, nichts wird verändert.
 *
 * @package HejLejo
 *
 * @var array    $attributes Block-Attribute.
 * @var WP_Block $block      Block-Instanz.
 */

defined( 'ABSPATH' ) || exit;

if ( ! taxonomy_exists( 'product_cat' ) ) {
	return;
}

$hejlejo_current = is_tax( 'product_cat' ) ? get_queried_object() : null;
$hejlejo_default = (int) get_option( 'default_product_cat', 0 );
$hejlejo_parent  = null;
$hejlejo_title   = __( 'Kategorien', 'hejlejo' );
$hejlejo_back    = null;

$hejlejo_get_terms = function ( $parent ) use ( $hejlejo_default ) {
	$terms = get_terms(
		array(
			'taxonomy'   => 'product_cat',
			'parent'     => (int) $parent,
			'hide_empty' => true,
			'orderby'    => 'menu_order',
			'order'      => 'ASC',
			'exclude'    => $hejlejo_default ? array( $hejlejo_default ) : array(),
		)
	);
	return is_wp_error( $terms ) ? array() : $terms;
};

if ( $hejlejo_current instanceof WP_Term ) {
	$hejlejo_terms = $hejlejo_get_terms( $hejlejo_current->term_id );

	if ( $hejlejo_terms ) {
		$hejlejo_title = $hejlejo_current->name;
		if ( $hejlejo_current->parent ) {
			$hejlejo_parent = get_term( $hejlejo_current->parent, 'product_cat' );
		}
	} else {
		$hejlejo_parent = $hejlejo_current->parent ? get_term( $hejlejo_current->parent, 'product_cat' ) : null;
		$hejlejo_terms  = $hejlejo_get_terms( $hejlejo_current->parent );
		$hejlejo_title  = $hejlejo_parent instanceof WP_Term ? $hejlejo_parent->name : $hejlejo_title;
	}

	if ( $hejlejo_parent instanceof WP_Term ) {
		$hejlejo_back = array(
			'url'  => get_term_link( $hejlejo_parent ),
			/* translators: %s: Name der übergeordneten Kategorie. */
			'text' => sprintf( __( 'Alle %s', 'hejlejo' ), $hejlejo_parent->name ),
		);
	} else {
		$hejlejo_back = array(
			'url'  => function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ),
			'text' => __( 'Alle Produkte', 'hejlejo' ),
		);
	}
} else {
	$hejlejo_terms = $hejlejo_get_terms( 0 );
}

if ( empty( $hejlejo_terms ) ) {
	return;
}

$hejlejo_show_images = ! empty( $attributes['showImages'] );
$hejlejo_show_counts = ! empty( $attributes['showCounts'] );
?>
<nav <?php echo get_block_wrapper_attributes( array( 'class' => 'hejlejo-catnav' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> aria-label="<?php esc_attr_e( 'Kategorien', 'hejlejo' ); ?>">
	<p class="hejlejo-catnav__title"><?php echo esc_html( $hejlejo_title ); ?></p>
	<ul class="hejlejo-catnav__list">
		<?php foreach ( $hejlejo_terms as $hejlejo_term ) : ?>
			<?php
			$hejlejo_link = get_term_link( $hejlejo_term );
			if ( is_wp_error( $hejlejo_link ) ) {
				continue;
			}
			$hejlejo_is_active = $hejlejo_current instanceof WP_Term && (int) $hejlejo_current->term_id === (int) $hejlejo_term->term_id;
			$hejlejo_count     = function_exists( 'get_term_meta' ) ? (int) get_term_meta( $hejlejo_term->term_id, 'product_count_product_cat', true ) : 0;
			$hejlejo_count     = $hejlejo_count ? $hejlejo_count : (int) $hejlejo_term->count;
			$hejlejo_thumb     = $hejlejo_show_images ? (int) get_term_meta( $hejlejo_term->term_id, 'thumbnail_id', true ) : 0;
			?>
			<li>
				<a class="hejlejo-catnav__link<?php echo $hejlejo_is_active ? ' is-active' : ''; ?>" href="<?php echo esc_url( $hejlejo_link ); ?>"<?php echo $hejlejo_is_active ? ' aria-current="page"' : ''; ?>>
					<?php if ( $hejlejo_thumb ) : ?>
						<?php echo wp_get_attachment_image( $hejlejo_thumb, 'thumbnail', false, array( 'class' => 'hejlejo-catnav__image', 'alt' => '', 'loading' => 'lazy' ) ); ?>
					<?php endif; ?>
					<span class="hejlejo-catnav__name"><?php echo esc_html( $hejlejo_term->name ); ?></span>
					<?php if ( $hejlejo_show_counts && $hejlejo_count ) : ?>
						<span class="hejlejo-catnav__count"><?php echo esc_html( number_format_i18n( $hejlejo_count ) ); ?></span>
					<?php endif; ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php if ( $hejlejo_back && ! is_wp_error( $hejlejo_back['url'] ) ) : ?>
		<a class="hejlejo-catnav__back" href="<?php echo esc_url( $hejlejo_back['url'] ); ?>"><?php echo esc_html( $hejlejo_back['text'] ); ?></a>
	<?php endif; ?>
</nav>
