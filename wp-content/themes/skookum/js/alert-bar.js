const alertBars = document.querySelectorAll('.alert-bar');

alertBars.forEach((alertBar) => {
	const closeAlertBar = alertBar.querySelector('.close-btn');
	const cookiesName = alertBar.dataset.cookiesName;
    const isCookiesActive = alertBar.dataset.cookiesActive;

    // Delete the cookie if cookies are not active
	if (isCookiesActive === 'no') deleteCookie(cookiesName);

	closeAlertBar.addEventListener('click', () => {
		alertBar.classList.remove('active');

		setTimeout(() => {
			alertBar.classList.add('closed');
		}, 300);

		// Set the cookie only if cookies are active
		if (isCookiesActive === 'yes') {
			setCookie(cookiesName, 'closed', 7); // Cookie expires in 7 days
		}
	});

	// Check if the cookie is not set to 'closed' AND respect cookie settings
	if (isCookiesActive === 'yes') {
		if (getCookie(cookiesName) !== 'closed') {
			alertBar.classList.add('active');
			alertBar.classList.remove('closed');
		}
	} else {
		// Always show if cookies are disabled
		alertBar.classList.add('active');
		alertBar.classList.remove('closed');
	}
});

// Function to delete a cookie by setting its expiration date to the past
function deleteCookie(name) {
	document.cookie = `${name}=; expires=Thu, 04 Apr 1989 00:00:00 UTC; path=/;`;
};

// Function to set a cookie
function setCookie(name, value, daysToLive) {
	const date = new Date();
	date.setTime(date.getTime() + (daysToLive * 24 * 60 * 60 * 1000)); // Convert milliseconds to days
	let expires = 'expires=' + date.toUTCString();
	document.cookie = `${name}=${value}; ${expires}; path=/`;
};

// Function to get a cookie value by name
function getCookie(name) {
    const cookiesName = name + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(';');

    // Iterate through the cookie array
    for(let i = 0; i < cookieArray.length; i++) {
        let cookieValue = cookieArray[i];
		
        // Remove leading spaces from the cookie string
        while (cookieValue.charAt(0) == ' ') {
            cookieValue = cookieValue.substring(1);
        }

        // Check if the current cookie starts with the desired name
        if (cookieValue.indexOf(cookiesName) == 0) {
            // Return the value of the cookie
            return cookieValue.substring(cookiesName.length, cookieValue.length);
        }
    }

    // Return an empty string if the cookie is not found
    return "";
};