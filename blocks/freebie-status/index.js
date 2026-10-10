/**
 * Editor-Ansicht für "Freebie-Hinweis".
 * Die Vorschau kommt vom Server (render.php) und zeigt den aktuellen Zustand: Freebie aktiv oder Instagram-Hinweis.
 */
( function ( wp ) {
	var el = wp.element.createElement;
	var __ = wp.i18n.__;
	var useBlockProps = wp.blockEditor.useBlockProps;
	var InspectorControls = wp.blockEditor.InspectorControls;
	var PanelBody = wp.components.PanelBody;
	var TextControl = wp.components.TextControl;
	var TextareaControl = wp.components.TextareaControl;
	var ServerSideRender = wp.serverSideRender;

	function field( props, key, label, multiline ) {
		return el( multiline ? TextareaControl : TextControl, {
			label: label,
			value: props.attributes[ key ],
			onChange: function ( v ) {
				var next = {};
				next[ key ] = v;
				props.setAttributes( next );
			},
		} );
	}

	wp.blocks.registerBlockType( 'hejlejo/freebie-status', {
		edit: function ( props ) {
			return el(
				'div',
				useBlockProps(),
				el(
					InspectorControls,
					null,
					el(
						PanelBody,
						{ title: __( 'Wenn ein Freebie läuft', 'hejlejo' ) },
						field( props, 'activeTitle', __( 'Überschrift', 'hejlejo' ) ),
						field( props, 'activeText', __( 'Text', 'hejlejo' ), true ),
						field( props, 'activeButton', __( 'Button', 'hejlejo' ) ),
						el( 'p', { className: 'components-base-control__help' },
							__( 'Platzhalter: {name} = Produktname, {datum} = Ende der Aktion. Der Button führt automatisch zum Freebie.', 'hejlejo' )
						)
					),
					el(
						PanelBody,
						{ title: __( 'Wenn gerade kein Freebie läuft', 'hejlejo' ), initialOpen: false },
						field( props, 'emptyTitle', __( 'Überschrift', 'hejlejo' ) ),
						field( props, 'emptyText', __( 'Text', 'hejlejo' ), true ),
						field( props, 'emptyButton', __( 'Button', 'hejlejo' ) ),
						el( 'p', { className: 'components-base-control__help' },
							__( 'Der Button führt zum Instagram-Profil.', 'hejlejo' )
						)
					),
					el(
						PanelBody,
						{ title: __( 'So funktioniert’s', 'hejlejo' ), initialOpen: false },
						el( 'p', null, __( 'Ein Freebie ist ein Produkt für 0 € in der Kategorie „Freebie“. Laufzeit und Instagram-Beitrag trägst du im Produkt unter „Produktdaten → Allgemein“ ein.', 'hejlejo' ) )
					)
				),
				el( ServerSideRender, { block: 'hejlejo/freebie-status', attributes: props.attributes } )
			);
		},
		save: function () {
			return null;
		},
	} );
} )( window.wp );
