/**
 * Hej Lejo – Kategorie-Navigation.
 *
 * Auf dem Handy ist die Liste eine wischbare Zeile: die aktive Kategorie wird beim Laden
 * in den sichtbaren Bereich geholt, ohne die Seite selbst zu scrollen.
 */
( function () {
	document.querySelectorAll( '.hejlejo-catnav__list' ).forEach( function ( list ) {
		var active = list.querySelector( '.hejlejo-catnav__link.is-active' );
		if ( ! active || list.scrollWidth <= list.clientWidth ) {
			return;
		}
		var item = active.parentElement;
		list.scrollLeft = item.offsetLeft - ( list.clientWidth - item.offsetWidth ) / 2;
	} );
} )();
