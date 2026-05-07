document.addEventListener("DOMContentLoaded", function() {
    
    // Get the zoomOverlay and necessary elements
    const expandBtnList = document.querySelectorAll(".zoom-btn");
    const zoomOverlay = document.querySelector(".zoom-overlay");
    const body = document.querySelector("body");
    const zoomImage = zoomOverlay.querySelector(".zoom-overlay__image");
    const captionText = zoomOverlay.querySelector(".zoom-overlay__caption");
    const closeBtn = zoomOverlay.querySelector(".close-btn");
    const zoomInBtn = zoomOverlay.querySelector(".zoom-in");
    const zoomOutBtn = zoomOverlay.querySelector(".zoom-out");
    let imgScaleFactor = 1;
    let isDragging = false;
    let startX, startY;
    let initialX = 0, initialY = 0;

    /* Cycle through all buttons with the class "zoom-btn"
     and dynamically populate the zoomOverlay with the image and caption of the parent figure element. */
    expandBtnList.forEach(btn => {
        btn.addEventListener("click", () => {
            const figure = btn.closest(".image-zoom"); // Get the parent figure element
            openZoomOverlay(figure);
        });
    });

    function openZoomOverlay(figure) {
        const img = figure.querySelector("img");
        const caption = figure.querySelector(".image-zoom__caption");
        
        body.classList.add("no-scroll");
        zoomOverlay.classList.add("open");
        zoomImage.src = img.dataset.largeImage ? img.dataset.largeImage : img.src; // Use data-large-image if available
        caption ? captionText.innerHTML = caption.textContent : captionText.innerHTML = ""; // Prevent null error
    }

    zoomInBtn.addEventListener("click", zoomIn);
    zoomOutBtn.addEventListener("click", zoomOut);
    closeBtn.addEventListener("click", resetZoomAndPosition);

    function resetZoomAndPosition() {
        zoomOverlay.classList.remove("open");
        body.classList.remove("no-scroll");
        captionText.innerHTML = "";

        imgScaleFactor = 1;
        initialX = 0;
        initialY = 0;
        applyZoom();
    }

    function zoomIn() {
        imgScaleFactor *= 1.2; // Increase the scale factor by 20%
        applyZoom();
    }

    function zoomOut() {
        imgScaleFactor /= 1.2; // Decrease the scale factor by 20%
        applyZoom();
    }

    function applyZoom() {
        zoomImage.style.transform = `scale(${imgScaleFactor}) translate(${initialX}px, ${initialY}px)`;
    }

    // Dragging the image around
    zoomImage.addEventListener("mousedown", function(e) {
        e.preventDefault();
        isDragging = true;
        startX = e.clientX;
        startY = e.clientY;
        zoomImage.style.cursor = "grabbing";
    });

    zoomOverlay.addEventListener("mousemove", function(e) {
        if (isDragging) {
            let dx = e.clientX - startX;
            let dy = e.clientY - startY;
            initialX += dx / imgScaleFactor;
            initialY += dy / imgScaleFactor;
            startX = e.clientX;
            startY = e.clientY;
            applyZoom();
        }
    });

    zoomOverlay.addEventListener("mouseup", function() {
        isDragging = false;
        zoomImage.style.cursor = "grab";
    });

    zoomOverlay.addEventListener("mouseleave", function() {
        isDragging = false;
        zoomImage.style.cursor = "grab";
    });

    // Support for touch devices
    zoomImage.addEventListener("touchstart", function(e) {
        if (e.touches.length === 1) {
            e.preventDefault();
            isDragging = true;
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            zoomImage.style.cursor = "grabbing";
        }
    });

    zoomOverlay.addEventListener("touchmove", function(e) {
        if (isDragging && e.touches.length === 1) {
            let dx = e.touches[0].clientX - startX;
            let dy = e.touches[0].clientY - startY;
            initialX += dx / imgScaleFactor;
            initialY += dy / imgScaleFactor;
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            applyZoom();
        }
    });

    zoomOverlay.addEventListener("touchend", function() {
        isDragging = false;
        zoomImage.style.cursor = "grab";
    });
});
