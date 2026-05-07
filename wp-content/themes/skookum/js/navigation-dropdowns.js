/**
 * File navigation-dropdowns.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */

( function () {
	const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');

	/**
	 * Update tab indexes for dropdown links based on their visibility
	 */
	function updateTabIndexes() {
		menuItemsWithChildren.forEach(menuItem => {
			const dropdown = menuItem.querySelector('.dropdown');
			if (!dropdown) return;

			const isOpen = dropdown.classList.contains('toggled');
			const dropdownLinks = dropdown.querySelectorAll('a');

			dropdownLinks.forEach(link => {
				// Set tabindex based on dropdown visibility
				link.setAttribute('tabindex', isOpen ? '0' : '-1');
			});
		});
	}

	/**
	 * Add sub-menu toggles for primary navigation.
	 */
	menuItemsWithChildren.forEach(parentItem => {
		const subMenu = parentItem.querySelector('.dropdown');

		parentItem.addEventListener('click', (e) => {
			e.stopPropagation();

			// Check if we're clicking a link inside the dropdown toggle
			const isLinkClick = e.target.closest('a') && e.target.closest('a') !== parentItem;

			// Close all other submenus first
			menuItemsWithChildren.forEach(otherParentItem => {
				if (
					otherParentItem !== parentItem && // Check if it's not the same parent item
					!otherParentItem.contains(parentItem) // Check if it's not a child of the current parent item
				) {
					const otherSubMenu = otherParentItem.querySelector('.dropdown');

					// If other submenu is open, close it
					if (otherSubMenu) {
						otherParentItem.classList.remove('toggled');
						otherSubMenu.classList.remove('toggled');
					}
				}
			});

			// Toggle this submenu only if not clicking a link
			 setTimeout(() => {
				if (subMenu && !isLinkClick ) {
					subMenu.classList.toggle('toggled');
					parentItem.classList.toggle('toggled');
					
					updateTabIndexes();
				}
			}, 150);
		});

		// Add event listener for 'Enter' key to toggle dropdown
		parentItem.addEventListener('keydown', (e) => {
			if (e.key === 'Enter') {
				// Prevent following the link if it's a parent item
				if (e.target === parentItem.querySelector('a')) {
					e.preventDefault();
				}
				
				e.stopPropagation();

				// Close all other submenus first
				menuItemsWithChildren.forEach(otherParentItem => {
					if (otherParentItem !== parentItem &&
						!otherParentItem.contains(parentItem)
					) {
						const otherSubMenu = otherParentItem.querySelector('.dropdown');

						if (otherSubMenu) {
							otherSubMenu.classList.remove('toggled');
							otherParentItem.classList.remove('toggled');
						}
					}
				});

				// Toggle this submenu only if not clicking a link
				setTimeout(() => {
					if (subMenu) {
						subMenu.classList.toggle('toggled');
						parentItem.classList.toggle('toggled');
						
						updateTabIndexes();
					}
				}, 150);
			}

			// Close the submenu if 'Escape' is pressed
			if (e.key === 'Escape') {
				if (subMenu) {
					subMenu.classList.remove('toggled');
					parentItem.classList.remove('toggled');
					
					updateTabIndexes();
				}
			}
		});
	});

	// Close dropdowns menu
	function closedropdowns(event) {
		menuItemsWithChildren.forEach(dropdown => {
			const subMenu = dropdown.querySelector('.dropdown');

			if (subMenu && !dropdown.contains(event.target)) {
				subMenu.classList.remove('toggled');
				dropdown.classList.remove('toggled');
			}
		});
		
		updateTabIndexes();
	}

	// Close dropdowns when clicking outside
	document.addEventListener('click', closedropdowns);

	updateTabIndexes();
}()
);
