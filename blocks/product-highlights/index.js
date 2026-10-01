/**
 * Editor-Ansicht für "Produkt-Vorteile".
 * Im Frontend rendert der Block serverseitig (render.php) aus den echten Produktdaten.
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody = wp.components.PanelBody;
	var TextControl = wp.components.TextControl;

	wp.blocks.registerBlockType( 'hejlejo/product-highlights', {
		edit: function ( props ) {
			var items = [
				__( 'Sofort-Download nach Zahlungseingang', 'hejlejo' ),
				__( 'Dateiformat / Lizenz (aus Produkteigenschaften)', 'hejlejo' ),
				props.attributes.promise,
			].filter( Boolean );

			return el(
				'div',
				useBlockProps( { className: 'hejlejo-highlights is-preview' } ),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Einstellungen', 'hejlejo' ) },
						el( TextControl, {
							label: __( 'Markenversprechen (immer sichtbar, leer = aus)', 'hejlejo' ),
							value: props.attributes.promise,
							onChange: function ( value ) {
								props.setAttributes( { promise: value } );
							},
						} )
					)
				),
				el(
					'ul',
					{ className: 'hejlejo-highlights__list' },
					items.map( function ( item, i ) {
						return el( 'li', { key: i, className: 'hejlejo-highlights__item' }, item );
					} )
				),
				el(
					'p',
					{ className: 'hejlejo-highlights__hint' },
					__( 'Vorschau – die Inhalte ergeben sich automatisch aus dem jeweiligen Produkt.', 'hejlejo' )
				)
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
