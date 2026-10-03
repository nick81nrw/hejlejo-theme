/**
 * Editor-Ansicht für "Kategorie-Navigation".
 * Im Frontend rendert der Block serverseitig (render.php) passend zur aufgerufenen Kategorie.
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody = wp.components.PanelBody;
	var ToggleControl = wp.components.ToggleControl;

	wp.blocks.registerBlockType( 'hejlejo/category-nav', {
		edit: function ( props ) {
			var a = props.attributes;
			var set = props.setAttributes;
			var items = [ __( 'Unterkategorie A', 'hejlejo' ), __( 'Unterkategorie B', 'hejlejo' ), __( 'Unterkategorie C', 'hejlejo' ) ];

			return el(
				'nav',
				useBlockProps( { className: 'hejlejo-catnav is-preview' } ),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Einstellungen', 'hejlejo' ) },
						el( ToggleControl, {
							label: __( 'Kategoriebilder anzeigen', 'hejlejo' ),
							checked: a.showImages,
							onChange: function ( v ) { set( { showImages: v } ); },
						} ),
						el( ToggleControl, {
							label: __( 'Anzahl der Produkte anzeigen', 'hejlejo' ),
							checked: a.showCounts,
							onChange: function ( v ) { set( { showCounts: v } ); },
						} )
					)
				),
				el( 'p', { className: 'hejlejo-catnav__title' }, __( 'Kategorien', 'hejlejo' ) ),
				el(
					'ul',
					{ className: 'hejlejo-catnav__list' },
					items.map( function ( item, i ) {
						return el(
							'li',
							{ key: i },
							el( 'span', { className: 'hejlejo-catnav__link' + ( 0 === i ? ' is-active' : '' ) },
								el( 'span', { className: 'hejlejo-catnav__name' }, item )
							)
						);
					} )
				),
				el( 'p', { className: 'hejlejo-highlights__hint' }, __( 'Vorschau – im Shop erscheinen automatisch die passenden Kategorien.', 'hejlejo' ) )
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
