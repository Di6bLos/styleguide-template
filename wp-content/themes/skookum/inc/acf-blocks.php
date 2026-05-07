<?php
/**
 * Register ACF blocks.
 *
 * @link https://www.advancedcustomfields.com/resources/blocks/
 */
function skookum_register_acf_blocks() {
	/**
     * @link https://developer.wordpress.org/reference/functions/register_block_type/
     */
    register_block_type( get_template_directory() . '/acf-blocks/accordion' );
    register_block_type( get_template_directory() . '/acf-blocks/breadcrumbs' );
    register_block_type( get_template_directory() . '/acf-blocks/hero' );
    register_block_type( get_template_directory() . '/acf-blocks/image-comparison-slider' );
    register_block_type( get_template_directory() . '/acf-blocks/image-hotspot' );
    register_block_type( get_template_directory() . '/acf-blocks/image-stack' );
    register_block_type( get_template_directory() . '/acf-blocks/image-zoom' );
    register_block_type( get_template_directory() . '/acf-blocks/pdf-embed' );
    register_block_type( get_template_directory() . '/acf-blocks/prev-next-pagination' );
    register_block_type( get_template_directory() . '/acf-blocks/progress-bars' );
    register_block_type( get_template_directory() . '/acf-blocks/slider' );
    register_block_type( get_template_directory() . '/acf-blocks/slider-video' );
    register_block_type( get_template_directory() . '/acf-blocks/ticker-tape' );
    register_block_type( get_template_directory() . '/acf-blocks/timeline' );
    register_block_type( get_template_directory() . '/acf-blocks/timeline-chart' );
    register_block_type( get_template_directory() . '/acf-blocks/vimeo-embed' );
    register_block_type( get_template_directory() . '/acf-blocks/youtube-embed' );
}
add_action( 'init', 'skookum_register_acf_blocks' );