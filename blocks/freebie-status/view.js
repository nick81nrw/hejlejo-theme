/**
 * Hej Lejo – Freebie-Hinweis.
 *
 * Rechnet die Restlaufzeit ("Noch 9 Tage") im Browser nach, damit sie auch stimmt,
 * wenn die Seite aus dem Cache kommt. Gleiche Regeln wie hejlejo_freebie_countdown().
 */
( function () {
	function label( end ) {
		var today = new Date();
		today.setHours( 0, 0, 0, 0 );
		var last = new Date( end * 1000 );
		last.setHours( 0, 0, 0, 0 );
		var days = Math.round( ( last - today ) / 86400000 );

		if ( days <= 0 ) {
			return 'Nur noch heute';
		}
		if ( 1 === days ) {
			return 'Nur noch bis morgen';
		}
		return 'Noch ' + days + ' Tage';
	}

	document.querySelectorAll( '.hejlejo-freebie-countdown[data-end]' ).forEach( function ( el ) {
		var end = parseInt( el.getAttribute( 'data-end' ), 10 );
		if ( end ) {
			el.textContent = label( end );
		}
	} );
} )();
