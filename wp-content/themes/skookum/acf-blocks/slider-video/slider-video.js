/*
	Checkout Swiper API: https://swiperjs.com/swiper-api
*/

// Function to stop videos when changing slides
function resetVideo(slide) {
	const iframe = slide.querySelector('iframe');
	const src = iframe.src;
	// Reload the iframe to stop the video
	iframe.src = '';
	iframe.src = src;
}

const swiperVideo = new Swiper('.slider-video', {
  // Optional parameters
	direction: 'horizontal',
	loop: true,

	// If we need pagination
	pagination: {
		el: '.swiper-pagination',
	},

	// Navigation arrows
	navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
	},

	// And if we need scrollbar
	scrollbar: {
		el: '.swiper-scrollbar',
	},

	// Event callbacks https://swiperjs.com/swiper-api#event-slideChange
	on: {		
		slideChange: function() {
			const allSlides = this.slides;
			
			allSlides.forEach(slide => {
				resetVideo(slide);
			});
		}
	}
});