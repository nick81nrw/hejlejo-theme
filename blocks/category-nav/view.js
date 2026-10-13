/**
 * Hej Lejo – Kategorie-Navigation.
 *
 * Auf Handy und Tablet ist die Liste eine wischbare Zeile. Dieses Skript zeigt, dass es weitergeht:
 * - Pfeile mit Verlauf an den Rändern, solange in diese Richtung noch Kategorien folgen.
 *   Ein Tipp blättert um gut eine Bildschirmbreite weiter.
 * - Einmal pro Sitzung ruckelt die Zeile kurz an, als Hinweis zum Wischen
 *   (nicht bei "Bewegung reduzieren").
 * - Die Zeile bleibt beim Scrollen unter dem Header hängen.
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

	/*
	 * Mitlaufende Zeile (nur Handy & Tablet, siehe woocommerce.css): hängt direkt unter dem
	 * Header. Die Überschriftenzeile darüber rutscht unter den Header, sichtbar bleiben die Chips.
	 */
	function stick( scroller ) {
		var column = scroller.closest( '.hejlejo-shop-layout__filters' );
		var header = document.querySelector( '.site-header' );
		if ( ! column ) {
			return;
		}

		var top = 0;
		var mobile = window.matchMedia( '(max-width: 781px)' );

		function measure() {
			if ( ! mobile.matches || 'sticky' !== window.getComputedStyle( column ).position ) {
				column.style.removeProperty( '--hejlejo-catnav-sticky-top' );
				column.classList.remove( 'is-stuck' );
				return;
			}
			var headerBottom = 0;
			if ( header && 'sticky' === window.getComputedStyle( header ).position ) {
				headerBottom = ( parseFloat( window.getComputedStyle( header ).top ) || 0 ) + header.offsetHeight;
			}
			var hidden = scroller.getBoundingClientRect().top - column.getBoundingClientRect().top;
			top = Math.round( headerBottom - hidden + 6 ); // etwas Luft unter dem Header
			column.style.setProperty( '--hejlejo-catnav-sticky-top', top + 'px' );
			onScroll();
		}

		function onScroll() {
			column.classList.toggle( 'is-stuck', mobile.matches && window.scrollY > 0 && column.getBoundingClientRect().top <= top + 0.5 );
		}

		window.addEventListener( 'scroll', onScroll, { passive: true } );
		if ( window.ResizeObserver ) {
			var observer = new ResizeObserver( measure );
			observer.observe( column );
			if ( header ) {
				observer.observe( header );
			}
		} else {
			window.addEventListener( 'resize', measure );
		}
		measure();
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

		stick( scroller );

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
