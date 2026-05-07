document.addEventListener('DOMContentLoaded', () => {
	const scrollButton = document.querySelector('.scroll-down__btn');
	const scrollDownIcon = document.querySelector('.scroll-down__icon');

	if (scrollButton) {
		// Trigger animation on page load
		scrollDownIcon.classList.add('bounce-animation');

		setTimeout(() => {
			scrollDownIcon.classList.remove('bounce-animation');
		}, 1500);

		// Trigger animation on mouseenter
		scrollDownIcon.addEventListener('mouseenter', () => {
			scrollDownIcon.classList.add('bounce-animation');

			setTimeout(() => {
				scrollDownIcon.classList.remove('bounce-animation');
			}, 1500);
		});
	
		scrollButton.addEventListener('click', () => {
			window.scrollTo({
				top: window.innerHeight,
				behavior: 'smooth',
			});
		});
	};
});
