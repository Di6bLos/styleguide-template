// Image Hotspot functionality
document.addEventListener('DOMContentLoaded', function() {
    const imageHotspot = document.querySelectorAll('.image-hotspot');
    
    if (!imageHotspot.length) return;
    
    imageHotspot.forEach(function(map) {
        const hotspots = map.querySelectorAll('.hotspot');
        
        hotspots.forEach(function(hotspot) {
            const marker = hotspot.querySelector('.hotspot__marker');
            
            if (marker) {
                // Add click functionality to toggle tooltip
                marker.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const isActive = hotspot.classList.contains('active');
                    
                    // Close all other tooltips in this map
                    hideAllTooltips(map);
                    
                    // Toggle this tooltip
                    if (!isActive) {
                        showTooltip(hotspot);
                    }
                });
                
                // Add keyboard support for Enter and Space keys
                marker.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        const isActive = hotspot.classList.contains('active');
                        
                        // Close all other tooltips in this map
                        hideAllTooltips(map);
                        
                        // Toggle this tooltip
                        if (!isActive) {
                            showTooltip(hotspot);
                        }
                    }
                });
            }
            
            // Handle focus leaving the entire hotspot container
            hotspot.addEventListener('focusout', function(e) {
                // Use a small delay to check if focus is still within the hotspot
                // This handles cases where e.relatedTarget might be null or unreliable
                const self = this;
                setTimeout(function() {
                    // Check if the currently focused element is within this hotspot
                    const activeElement = document.activeElement;
                    const isWithinHotspot = self.contains(activeElement);
                    
                    if (!isWithinHotspot) {
                        // Focus has left the hotspot entirely, close the tooltip
                        hideTooltip(self);
                    }
                }, 10); // Slightly longer delay to ensure focus has fully settled
            });
            
            // Prevent click events on tooltip content from closing the tooltip
            const tooltip = hotspot.querySelector('.hotspot__tooltip');
            if (tooltip) {
                tooltip.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
                
                // Make tooltip content focusable for better keyboard navigation
                const tooltipLinks = tooltip.querySelectorAll('a, button, [tabindex]');
                tooltipLinks.forEach(function(element) {
                    element.addEventListener('click', function(e) {
                        e.stopPropagation();
                    });
                });
            }
        });
        
        // Close tooltips when clicking outside the map
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.image-hotspot')) {
                hideAllTooltips(map);
            }
        });
        
        // Handle escape key to close all tooltips
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideAllTooltips(map);
            }
        });
    });
    
    // Helper functions
    function showTooltip(hotspot) {
        hotspot.classList.add('active');
    }
    
    function hideTooltip(hotspot) {
        hotspot.classList.remove('active');
    }
    
    function hideAllTooltips(map) {
        const activeHotspots = map.querySelectorAll('.hotspot.active');
        activeHotspots.forEach(function(hotspot) {
            hotspot.classList.remove('active');
        });
    }
});