/**
 * Hej Lejo – Kategorie-Navigation.
 *
 * Auf Handy und Tablet ist die Liste eine wischbare Zeile. Dieses Skript zeigt, dass es weitergeht:
 * - Pfeile mit Verlauf an den Rändern, solange in diese Richtung noch Kategorien folgen.
 *   Ein Tipp blättert um gut eine Bildschirmbreite weiter.
 * - Einmal pro Sitzung ruckelt die Zeile kurz an, als Hinweis zum Wischen
 *   (nicht bei "Bewegung reduzieren").
 */
( function () {
	var CHEVRON = '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
	var HINT_KEY = 'hejlejo-catnav-hint';
	var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	function hintShown() {
		try {
			return !! window.sessionStorage.getItem( HINT_KEY );
		} catch ( e ) {
			return false;
		}
	}

	function rememberHint() {
		try {
			window.sessionStorage.setItem( HINT_KEY, '1' );
		} catch ( e ) {}
	}

	function arrow( direction, label ) {
		var button = document.createElement( 'button' );
		button.type = 'button';
		button.className = 'hejlejo-catnav__arrow hejlejo-catnav__arrow--' + direction;
		button.tabIndex = -1; // Die Links selbst sind per Tastatur erreichbar.
		button.setAttribute( 'aria-hidden', 'true' );
		button.title = label;
		button.innerHTML = '<span class="hejlejo-catnav__arrow-icon"' + ( 'prev' === direction ? ' style="transform:scaleX(-1)"' : '' ) + '>' + CHEVRON + '</span>';
		return button;
	}

	document.querySelectorAll( '.hejlejo-catnav__scroller' ).forEach( function ( scroller ) {
		var list = scroller.querySelector( '.hejlejo-catnav__list' );
		if ( ! list ) {
			return;
		}

		var prev = arrow( 'prev', 'Vorherige Kategorien' );
		var next = arrow( 'next', 'Weitere Kategorien' );
		scroller.appendChild( prev );
		scroller.appendChild( next );
		scroller.classList.add( 'is-enhanced' );

		function update() {
			var max = list.scrollWidth - list.clientWidth;
			scroller.classList.toggle( 'has-more-start', max > 1 && list.scrollLeft > 1 );
			scroller.classList.toggle( 'has-more-end', max > 1 && list.scrollLeft < max - 1 );
		}

		function page( sign ) {
			list.scrollBy( { left: sign * list.clientWidth * 0.75, behavior: reduceMotion ? 'auto' : 'smooth' } );
		}

		prev.addEventListener( 'click', function () {
			page( -1 );
		} );
		next.addEventListener( 'click', function () {
			page( 1 );
		} );

		list.addEventListener( 'scroll', update, { passive: true } );
		if ( window.ResizeObserver ) {
			new ResizeObserver( update ).observe( list );
		} else {
			window.addEventListener( 'resize', update );
		}
		update();

		if ( ! reduceMotion && ! hintShown() && scroller.classList.contains( 'has-more-end' ) ) {
			rememberHint();
			window.setTimeout( function () {
				if ( list.scrollLeft > 1 ) {
					return; // Schon selbst gewischt.
				}
				list.scrollTo( { left: 56, behavior: 'smooth' } );
				window.setTimeout( function () {
					list.scrollTo( { left: 0, behavior: 'smooth' } );
				}, 550 );
			}, 900 );
		}
	} );
} )();
