const tooltipList = document.querySelectorAll(".tooltip");

tooltipList.forEach(tooltip => {
    const tip = tooltip.querySelector(".tooltip__btn");

    tooltip.addEventListener("click", (event) => {
        // Close all other tooltips
        tooltipList.forEach(otherTooltip => {
            if (otherTooltip !== tooltip && otherTooltip.querySelector(".tooltip__btn").classList.contains("active")) {
                otherTooltip.querySelector(".tooltip__btn").classList.remove("active");
            }
        });

        // Toggle the current tooltip
        tip.classList.toggle("active");

        event.preventDefault();
    });
});

// Close tooltips when clicking outside
document.addEventListener("click", (event) => {
    if (!event.target.closest(".tooltip")) {
        tooltipList.forEach(tooltip => {
            const tip = tooltip.querySelector(".tooltip__btn");
            if (tip.classList.contains("active")) {
                tip.classList.remove("active");
            }
        });
    }
});