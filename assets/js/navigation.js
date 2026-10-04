/**
 * Hej Lejo – Navigation.
 *
 * Ergänzt den WordPress-Navigationsblock (Menü "Main"), ohne dessen Markup zu verändern:
 * - Touch-Geräte: erster Tipp auf einen Menüpunkt mit Untermenü öffnet es, zweiter Tipp folgt dem Link.
 * - Großes Menü: merkt sich die zuletzt gewählte Kategorie (rechte Spalte) und passt die Höhe an.
 * - Mobiles Menü: Untermenüs als Akkordeon über den Pfeil; der Text bleibt ein normaler Link.
 */
( function () {
	var nav = document.querySelector( '.hejlejo-header__nav' );
	if ( ! nav ) {
		return;
	}

	var lastPointer = 'mouse';
	var ITEM = '.wp-block-navigation-item.has-child';

	function isOverlay() {
		return !! nav.querySelector( '.wp-block-navigation__responsive-container.is-menu-open' );
	}

	function clearTapped( except ) {
		nav.querySelectorAll( '.hejlejo-tapped' ).forEach( function ( li ) {
			if ( ! except || ( li !== except && ! li.contains( except ) ) ) {
				li.classList.remove( 'hejlejo-tapped' );
			}
		} );
	}

	function setActive( li ) {
		if ( ! li || ! li.parentElement ) {
			return;
		}
		Array.prototype.forEach.call( li.parentElement.children, function ( sibling ) {
			sibling.classList.toggle( 'is-active', sibling === li );
		} );
	}

	nav.addEventListener(
		'pointerdown',
		function ( event ) {
			lastPointer = event.pointerType || 'mouse';
		},
		true
	);

	nav.addEventListener(
		'click',
		function ( event ) {
			// Mobiles Menü: Pfeil klappt das Untermenü auf/zu.
			var toggle = event.target.closest( '.wp-block-navigation-submenu__toggle' );
			if ( toggle && isOverlay() ) {
				event.preventDefault();
				event.stopPropagation();
				var parent = toggle.closest( ITEM );
				var open = ! parent.classList.contains( 'hejlejo-expanded' );
				parent.classList.toggle( 'hejlejo-expanded', open );
				toggle.setAttribute( 'aria-expanded', open ? 'true' : 'false' );
				return;
			}

			// Touch auf großen Bildschirmen: erster Tipp öffnet, zweiter Tipp folgt dem Link.
			var link = event.target.closest( 'a.wp-block-navigation-item__content' );
			if ( ! link || isOverlay() || 'mouse' === lastPointer ) {
				return;
			}

			var li = link.parentElement;
			if ( ! li.classList.contains( 'has-child' ) || li.classList.contains( 'hejlejo-tapped' ) ) {
				return;
			}

			event.preventDefault();
			clearTapped( li );
			li.classList.add( 'hejlejo-tapped' );
			setActive( li );

			var button = li.querySelector( ':scope > .wp-block-navigation-submenu__toggle' );
			if ( button && 'true' !== button.getAttribute( 'aria-expanded' ) && li.parentElement.classList.contains( 'wp-block-navigation__container' ) ) {
				button.click();
			}
		},
		true
	);

	// Maus: zuletzt gewählte Kategorie bleibt in der rechten Spalte stehen.
	nav.addEventListener( 'mouseover', function ( event ) {
		var li = event.target.closest( '.hejlejo-mega > .wp-block-navigation__submenu-container > .wp-block-navigation-item' );
		if ( li ) {
			setActive( li );
		}
	} );

	document.addEventListener( 'click', function ( event ) {
		if ( ! nav.contains( event.target ) ) {
			clearTapped();
		}
	} );

	// Großes Menü erkennen (drei Ebenen) und die Höhe an die längste Unterliste anpassen.
	nav.querySelectorAll( '.wp-block-navigation__container > ' + ITEM ).forEach( function ( top ) {
		var panel = top.querySelector( ':scope > .wp-block-navigation__submenu-container' );
		if ( ! panel || ! panel.querySelector( ':scope > .has-child' ) ) {
			return;
		}
		top.classList.add( 'hejlejo-mega' );
		var longest = 0;
		panel.querySelectorAll( ':scope > .wp-block-navigation-item > .wp-block-navigation__submenu-container' ).forEach( function ( list ) {
			longest = Math.max( longest, list.children.length );
		} );
		panel.style.setProperty( '--hejlejo-mega-rows', String( Math.max( longest, panel.children.length ) ) );
	} );
} )();
