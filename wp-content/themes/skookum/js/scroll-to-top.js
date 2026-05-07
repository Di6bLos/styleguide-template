const scrollBtn = document.querySelector('.scroll-to-top__btn');
const topNav = document.querySelector('.primary-menu');
let scrollAnchor = topNav.getBoundingClientRect().top + 1; // 1px offset to account for border

const options = {
	top: scrollAnchor,
	behavior: 'smooth'
};

if (scrollBtn) {
	scrollBtn.addEventListener('click', () => {
		window.scrollTo(options);
	});
};