<?php
/**
 * Theme setup: creates boilerplate pages on first activation.
 *
 * @package skookum
 */

function skookum_create_style_guide_page() {
	if ( get_page_by_path( 'style-guide' ) ) {
		return;
	}

	$content_file = get_template_directory() . '/style-guide.xml';

	if ( ! file_exists( $content_file ) ) {
		return;
	}

	wp_insert_post(
		array(
			'post_title'   => 'Style Guide',
			'post_name'    => 'style-guide',
			'post_content' => file_get_contents( $content_file ), // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			'post_status'  => 'draft',
			'post_type'    => 'page',
		)
	);
}
add_action( 'after_switch_theme', 'skookum_create_style_guide_page' );
