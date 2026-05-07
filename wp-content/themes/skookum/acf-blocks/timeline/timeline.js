const timelines = document.querySelectorAll('.timeline');

timelines.forEach(timeline => {    
    const timelineBar = timeline.querySelector('.timeline__bar');
    const timelineBarFill = timelineBar.querySelector('.timeline__bar-fill');
    const timelineRows = timeline.querySelectorAll('.timeline__row');
    const timelineCurrentHeaders = timeline.querySelectorAll('.timeline__header.current');
    const lastCurrentHeader = timelineCurrentHeaders[timelineCurrentHeaders.length - 1];

    // Get total rows and initialize sets
    const totalRows = timelineRows.length;
    const currentRows = new Set();
    const scrolledPastRows = new Set();

    // Store headers that start with current class
    timelineRows.forEach(row => {
        const header = row.querySelector('.timeline__header');

        if (header && header.classList.contains('current')) {
            currentRows.add(header);
        }
    });

    const timelineObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const row = entry.target;
            const header = row.querySelector('.timeline__header');
            
            // Exit early if row is not in view or scrolled past
            if (!entry.isIntersecting && entry.boundingClientRect.top >= 0) {
                return;
            }
            
            // Row is in view or has been scrolled past
            scrolledPastRows.add(row);
            
            if (currentRows.has(header)) {
                header.classList.add('active');
                
                // Add pulse animation to the last current header when it becomes active
                if (header === lastCurrentHeader) {
                    lastCurrentHeader.classList.add('pulse');
                }
                
            } else {
                header.classList.add('grow');
            }

        });

        // Update progress bar
        const progress = (scrolledPastRows.size / totalRows) * 100;
        timelineBarFill.style.height = progress + '%';
    }, 
    {
        rootMargin: '0px 0px -40% 0px',
        threshold: 0
    });

    timelineRows.forEach(row => timelineObserver.observe(row));
});