<?php
/** 
 * Blocks allow list.
 * The functions here are used to tweak the core gutenberg blocks and add in ACF blocks to the block inserter.
 * 
 * References:
 * Take out core Gutenberg Blocks by not allowing them thanks to https://rudrastyh.com/gutenberg/remove-default-blocks.html
 * Full block list: https://wordpress.org/documentation/article/blocks-list/
 *
 * @package Skookum
 */


add_filter( 'allowed_block_types_all', 'skookum_allowed_block_types' );
// Now add in only what you need
function skookum_allowed_block_types( $allowed_blocks ) {
	return array(
		'core/block', // <-- Include to show reusable blocks in the block inserter.
        
        // Text Blocks
        'core/paragraph',
		'core/heading',
        'core/list',
		'core/list-item',
        'core/table',

        // Media
        'core/image',
        'core/audio',
        'core/cover',
        'core/file',
        'core/video',
		'core/embed',

        // Design
		'core/buttons',
		'core/button',
        'core/columns',
        'core/spacer',
        'core/separator',

        // Widgets
        'core/html',
               
        // ACF
		'acf/accordion',
		'acf/slider',
		'acf/slider-video',
		'acf/image-zoom',
		'acf/image-comparison-slider',
		'acf/image-hotspot',
		'acf/image-stack',
		'acf/timeline',
		'acf/timeline-chart',
		'acf/hero',
		'acf/ticker-tape',
		'acf/pdf-embed',
		'acf/vimeo-embed',
		'acf/youtube-embed',
		'acf/breadcrumbs',
		'acf/prev-next-pagination',
		'acf/progress-bars',
	);
}

function skookum_allow_embed_blocks() {
	wp_enqueue_script(
		'allow-embed-blocks',
		get_template_directory_uri() . '/js/allow-embed-blocks.js',
		array('wp-blocks', 'wp-dom-ready', 'wp-edit-post')
	);
}

add_action('enqueue_block_editor_assets', 'skookum_allow_embed_blocks');
