/**
 * Hej Lejo – Editor-Anpassungen.
 *
 * Entfernt Block-Stile, die nicht zum Designsystem passen, damit die Auswahl im Editor übersichtlich bleibt.
 */
( function ( wp ) {
	wp.domReady( function () {
		var remove = {
			'core/button': [ 'outline', 'fill' ],
			'core/image': [ 'rounded' ],
			'core/separator': [ 'dots' ],
			'core/quote': [ 'plain' ],
			'core/social-links': [ 'pill-shape' ],
		};

		Object.keys( remove ).forEach( function ( block ) {
			remove[ block ].forEach( function ( style ) {
				wp.blocks.unregisterBlockStyle( block, style );
			} );
		} );
	} );
} )( window.wp );
