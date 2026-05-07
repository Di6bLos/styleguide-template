const progressBarBlocks = document.querySelectorAll('.progress-bars');

const progressBarObserver = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
        if(entry.isIntersecting) {
            entry.target.querySelectorAll('.progress-bar__fill').forEach(progressBar => {
                // Get the target value from data attribute
                const targetValue = progressBar.dataset.targetValue;
                
                // Animate the progress bar fill
                const animation = function(){
                    progressBar.value = progressBar.value + 1;
                    
                    // Check if the progress bar has reached or exceeded the target value
                    if(progressBar.value >= targetValue){
                        // Stop the interval when target is reached
                        clearInterval(animationInterval);

                        progressBar.value = targetValue; // Ensure exact final value
                    }
                };

                // Set an interval to animate the progress bar
                const animationInterval = setInterval(animation, 10);

            });
            obs.unobserve(entry.target);
        }
    });
}, { threshold: 0.5 });

progressBarBlocks.forEach(block => progressBarObserver.observe(block));
