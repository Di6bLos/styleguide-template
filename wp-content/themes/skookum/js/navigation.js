/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

( function() {
	const siteNavigation = document.getElementById( 'site-navigation' );

	// Return early if the navigation doesn't exist.
	if ( ! siteNavigation ) {
		return;
	}

	const button = siteNavigation.getElementsByTagName( 'button' )[ 0 ];

	// Return early if the button doesn't exist.
	if ( 'undefined' === typeof button ) {
		return;
	}

	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( ! menu.classList.contains( 'nav-menu' ) ) {
		menu.classList.add( 'nav-menu' );
	}

	// Toggle the .mobile-toggled class and the aria-expanded value each time the button is clicked.
	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'mobile-toggled' );

		if ( button.getAttribute( 'aria-expanded' ) === 'true' ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} else {
			button.setAttribute( 'aria-expanded', 'true' );
		}
	} );

	// Remove the .mobile-toggled class and set aria-expanded to false when the user clicks outside the navigation.
	document.addEventListener( 'click', function( event ) {
		const isClickInside = siteNavigation.contains( event.target );

		if ( ! isClickInside ) {
			siteNavigation.classList.remove( 'mobile-toggled' );
			button.setAttribute( 'aria-expanded', 'false' );
		}
	} );

	// Add 'current-menu-item' class to parent menu items
	const currentItems = document.querySelectorAll('.current-menu-item');

	currentItems.forEach(item => {
		let parent = item.closest('.menu-item-has-children');

		if (parent) {
			parent.classList.add('current-menu-item');
		}
	});

	/**
	 * Observer to add sticky class to nav bar when top header is out of view
	 */
	setTimeout(() => {
		const navBar = document.querySelector(".main-navigation");
		const topHeader = document.querySelector(".site-header");
		const alertBar = document.querySelector('.alert-bar-wrapper');
		const closeAlertBar = alertBar ? alertBar.querySelector('.close-btn') : null;
		let alertBarHeight = alertBar ? alertBar.offsetHeight : 0;

		const setStickyTop = () => {
			const offset = alertBarHeight + navBar.offsetHeight;
			document.documentElement.style.setProperty('--facetwp-sticky-top', `${offset}px`);
		};

		setStickyTop();

		const options = {
			root: null,
			rootMargin: `-${alertBarHeight}px 0px 0px 0px`, // Adjust for alert bar height
			threshold: 0
		};

		const navObserver = new IntersectionObserver((entries) => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					if (alertBar) {
						navBar.style.top = `${alertBarHeight}px`;
					}
					navBar.classList.remove('stuck');
				} else {
					navBar.classList.add('stuck');
				}
			});
		}, options);

		navObserver.observe(topHeader);

		// Adjust nav bar position when alert bar is closed
		if (alertBar) {
			closeAlertBar.addEventListener('click', () => {
				navBar.style.top = '0px';
				alertBarHeight = 0; // Reset alert bar height
				setStickyTop();
			});
		}
	}, 500);
}() 
);
