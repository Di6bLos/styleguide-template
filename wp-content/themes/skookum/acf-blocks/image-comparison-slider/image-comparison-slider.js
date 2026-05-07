const sliders = document.querySelectorAll('.compare-images');

sliders.forEach(slider => {

	const before = slider.querySelector('.before-image');
	const beforeImage = before.querySelector('img');
	const resizer = slider.querySelector('.resizer');
	let active = false;

	// Function to set the width of the before image
	function setImageWidth() {
		let width = slider.offsetWidth;
		beforeImage.style.width = width + 'px';
	}

	// Set the width of the before image
	setImageWidth();
	window.addEventListener('resize', setImageWidth);

	resizer.addEventListener('mousedown', () => {
		active = true;
		resizer.classList.add('resize');
	});

	document.body.addEventListener('mouseup', () => {
		active = false;
		resizer.classList.remove('resize');
	});

	document.body.addEventListener('mouseleave', () => {
		active = false;
		resizer.classList.remove('resize');
	});

	document.body.addEventListener('mousemove', (e) => {
		if (!active) return;
		let x = e.pageX - slider.getBoundingClientRect().left;
		slideIt(x);
		pauseEvent(e);
	});

	resizer.addEventListener('touchstart', () => {
		active = true;
		resizer.classList.add('resize');
	});

	document.body.addEventListener('touchend', () => {
		active = false;
		resizer.classList.remove('resize');
	});

	document.body.addEventListener('touchcancel', () => {
		active = false;
		resizer.classList.remove('resize');
	});

	// Add a touchmove event listener to the body element
	document.body.addEventListener('touchmove', (e) => {
		if (!active) return;
		let x = e.changedTouches[0].pageX - slider.getBoundingClientRect().left;
		slideIt(x);
		pauseEvent(e);
	});

	// Function to slide the before image based on the position of the resizer
	function slideIt(x) {
		let transform = Math.max(0, Math.min(x, slider.offsetWidth));
		before.style.width = transform + "px";
		resizer.style.left = transform + "px";
	}

	// Function to pause the event propagation and prevent default behavior
	function pauseEvent(e) {
		if (e.stopPropagation) e.stopPropagation();
		if (e.preventDefault) e.preventDefault();
		e.cancelBubble = true;
		e.returnValue = false;
		return false;
	}
});