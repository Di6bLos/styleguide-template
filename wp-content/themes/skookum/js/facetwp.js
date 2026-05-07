(function($) {
    $(document).on('facetwp-loaded', function() {
        // Put all JS/jQuery for facetWP below
        
        $('.facetwp-facet').each(function() {
            var facet = $(this);
            var facet_name = facet.attr('data-name');
            var facet_type = facet.attr('data-type');
            var facet_label = FWP.settings.labels[facet_name];

            if ( ! ['pager','sort','reset'].includes( facet_type ) ) { // Add or remove excluded facet types to/from the array
                if (facet.closest('.facet-wrap').length < 1 && facet.closest('.facetwp-flyout').length < 1) {
                    facet.wrap('<div class="facet-wrap"></div>');
                    facet.before('<h4 class="facet-label">' + facet_label + '</h4>');
                }
            }
        });

        $.each(FWP.settings.num_choices, function(key, val) {
            // assuming each facet is wrapped within a "facet-wrap" container element
            // this may need to change depending on your setup, for example:
            // change ".facet-wrap" to ".widget" if using WP text widgets
   
            var $facet = $('.facetwp-facet-' + key);
            var $wrap = $facet.closest('.facet-wrap');
            var $flyout = $facet.closest('.flyout-row');
            if ($wrap.length || $flyout.length) {
                var $which = $wrap.length ? $wrap : $flyout;
                (0 === val) ? $which.hide() : $which.show();
            }
        });
    });

    // Disable facetWP auto-refresh when selecting facet values
    $(function() {
        if ('undefined' !== typeof FWP) {
            FWP.auto_refresh = false;
        }
    });
})(jQuery);
