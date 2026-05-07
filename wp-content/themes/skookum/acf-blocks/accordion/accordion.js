const accordions = document.querySelectorAll('.accordion__container');

accordions.forEach((accordion) => {
    const accBtn = accordion.querySelector('.accordion__button');

    accBtn.addEventListener('click', function () {
        accordion.classList.toggle('active');
    });
});