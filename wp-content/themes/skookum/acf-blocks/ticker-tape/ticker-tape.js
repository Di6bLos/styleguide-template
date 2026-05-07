const tickerTapes = document.querySelectorAll('.ticker-tape');

// Check if the user has set their OS to reduce motion
if (!window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
	addAnimation();
}

function addAnimation() {
	for (let i = 0; i < 2; i++) {
	tickerTapes.forEach(tickerTape => {
		tickerTape.setAttribute("data-animated", true);

		const tickerTapeInner = tickerTape.querySelector('.ticker-tape__inner');
		const tickerTapeEntries = Array.from(tickerTapeInner.children);

			tickerTapeEntries.forEach(entry => {
				const duplicateEntry = entry.cloneNode(true);
				duplicateEntry.setAttribute("aria-hidden", true);
				tickerTapeInner.appendChild(duplicateEntry);
			});
		});
	};
}