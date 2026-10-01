/**
 * Editor-Ansicht für "Produkt-Badges".
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody = wp.components.PanelBody;
	var ToggleControl = wp.components.ToggleControl;
	var RangeControl = wp.components.RangeControl;

	wp.blocks.registerBlockType( 'hejlejo/product-badges', {
		edit: function ( props ) {
			var a = props.attributes;
			var set = props.setAttributes;

			return el(
				'div',
				useBlockProps( { className: 'hejlejo-badges is-preview' } ),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Badges', 'hejlejo' ) },
						el( ToggleControl, {
							label: __( '„Sale“ bei reduzierten Produkten', 'hejlejo' ),
							checked: a.showSale,
							onChange: function ( v ) { set( { showSale: v } ); },
						} ),
						el( ToggleControl, {
							label: __( '„Sofort-Download“ bei herunterladbaren Produkten', 'hejlejo' ),
							checked: a.showDownload,
							onChange: function ( v ) { set( { showDownload: v } ); },
						} ),
						el( RangeControl, {
							label: __( '„Neu“ automatisch für Produkte der letzten X Tage (0 = aus)', 'hejlejo' ),
							value: a.newDays,
							min: 0,
							max: 90,
							onChange: function ( v ) { set( { newDays: v || 0 } ); },
						} ),
						el( 'p', { className: 'components-base-control__help' },
							__( 'Zusätzlich werden die Schlagwörter „Neu“, „Bestseller“, „Handmade“ und „Sofortdownload“ als Badge angezeigt.', 'hejlejo' )
						)
					)
				),
				el( 'span', { className: 'hejlejo-badge' }, __( 'Neu', 'hejlejo' ) ),
				el( 'span', { className: 'hejlejo-badge hejlejo-badge--download' }, __( 'Sofort-Download', 'hejlejo' ) )
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
