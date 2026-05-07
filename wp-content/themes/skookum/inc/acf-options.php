<?php
/**
 * Add ACF-powered options page for theme settings. 
 */

// Wrap the acf options page function in an action hook to ensure it does not initialize too early. This may get fixed post ACF Pro 6.4.2.
 add_action('acf/init', function() { 

     // Check if the ACF function exists then runs function
    if( function_exists('acf_add_options_page') ) {

        // Add a general options page for the theme
        acf_add_options_page(array(
            'page_title'    => 'Theme General Settings',
            'menu_title'    => 'Theme Settings',
            'menu_slug'     => 'theme-options',
            'capability'    => 'edit_posts',
            'redirect'      => false,
        ));

		// Subpage for translations
		acf_add_options_sub_page(array(
			'page_title'    => 'Translations',
			'menu_title'    => 'Translations',
			'menu_slug'     => 'theme-options-translations',
			'capability'    => 'edit_posts',
			'parent_slug'   => 'theme-options'
		));
        
        // Subpage for footer settings
        acf_add_options_sub_page(array(
            'page_title'	=> 'Footer',
            'menu_title'	=> 'Footer',
            'menu_slug'		=> 'theme-options-footer',
            'capability'	=> 'edit_posts',
            'parent_slug'	=> 'theme-options'
        ));
        
    }

});

/**
* Alert bar
*/
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group-alert_bar',
	'title' => 'Alert bar',
	'fields' => array(
		array(
			'key' => 'field-alert_bar_toggle',
			'label' => 'Enable',
			'name' => 'alert_bar_toggle',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
			'ui' => 1,
		),
		array(
			'key' => 'field-alert_bar_cookies',
			'label' => 'Store cookies',
			'name' => 'alert_bar_cookies',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => 'Hide alert bar after user closes it for 7 days.',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field-alert_bar_toggle',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array(
			'key' => 'field-alert_bar_message',
			'label' => 'Alert message',
			'name' => 'alert_bar_message',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field-alert_bar_toggle',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 0,
			'delay' => 0,
		),
		array(
			'key' => 'field-alert_bar_background_color',
			'label' => 'Background Color',
			'name' => 'alert_bar_background_color',
			'aria-label' => '',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field-alert_bar_toggle',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '#1F2C3E',
			'enable_opacity' => 0,
			'return_format' => 'string',
			'allow_in_bindings' => 0,
		),
		array(
			'key' => 'field-alert_bar_text_color',
			'label' => 'Font Color',
			'name' => 'alert_bar_text_color',
			'aria-label' => '',
			'type' => 'color_picker',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field-alert_bar_toggle',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '#ffffff',
			'enable_opacity' => 0,
			'return_format' => 'string',
			'allow_in_bindings' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

/**
 * Search Bar
 */
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_search-bar',
	'title' => 'Search Bar',
	'fields' => array(
		array(
			'key' => 'field_search-bar',
			'label' => 'Enable',
			'name' => 'search_bar',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui_on_text' => 'ON',
			'ui_off_text' => 'OFF',
			'ui' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

/**
 * Google Settings
 */
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_google-settings',
	'title' => 'Google Settings',
	'fields' => array(
		array(
			'key' => 'field_google-analytics',
			'label' => 'Analytics',
			'name' => '',
			'aria-label' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_account-type-toggle',
			'label' => 'Account Type',
			'name' => 'account_type_toggle',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui_on_text' => 'Tag Manager',
			'ui_off_text' => 'Analytics',
			'ui' => 1,
		),
		array(
			'key' => 'field_tag-id',
			'label' => 'Tag ID',
			'name' => 'tag_id',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'maxlength' => '',
			'rows' => '',
			'placeholder' => '',
			'new_lines' => '',
		),
		array(
			'key' => 'field_google-translations',
			'label' => 'Translations',
			'name' => '',
			'aria-label' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array(
			'key' => 'field_translate-widget',
			'label' => 'Translate Widget',
			'name' => 'google_translate_toggle',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui_on_text' => 'ON',
			'ui_off_text' => 'OFF',
			'ui' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

/**
 * Scroll Down
 */
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_scroll-down',
	'title' => 'Scroll Down',
	'fields' => array(
		array(
			'key' => 'field_scroll-down-toggle',
			'label' => 'Display Icon',
			'name' => 'scroll_down_toggle',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui_on_text' => 'ON',
			'ui_off_text' => 'OFF',
			'ui' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

/**
 * Post Navigation
 */
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_post-navigation',
	'title' => 'Post Navigation',
	'fields' => array(
		array(
			'key' => 'field_post-navigation-toggle',
			'label' => 'Enable',
			'name' => 'post_navigation_toggle',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => 'Display next and previous post titles on single post pages.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui_on_text' => 'ON',
			'ui_off_text' => 'OFF',
			'ui' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

/**
 * 404 Page Settings
 */
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_404-page',
	'title' => '404 Page',
	'fields' => array(
		array(
			'key' => 'field_four-o-four-header',
			'label' => 'Header',
			'name' => 'four_o_four_header',
			'aria-label' => '',
			'type' => 'group',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'layout' => 'block',
			'sub_fields' => array(
				array(
					'key' => 'field_title-alignment',
					'label' => 'Align',
					'name' => 'title_alignment',
					'aria-label' => '',
					'type' => 'button_group',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'' => '<i class="dashicons dashicons-editor-alignleft"></i>',
						'center' => ' <i class="dashicons dashicons-editor-aligncenter"></i>',
						'right' => ' <i class="dashicons dashicons-editor-alignright"></i>',
					),
					'default_value' => 'left',
					'return_format' => 'value',
					'allow_null' => 1,
					'layout' => 'horizontal',
				),
				array(
					'key' => 'field_four-o-four-title',
					'label' => 'Title',
					'name' => 'four_o_four_title',
					'aria-label' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => 404,
					'maxlength' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
				),
			),
		),
		array(
			'key' => 'field_four-o-four-content',
			'label' => 'Content',
			'name' => 'four_o_four_content',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Sorry, this page was not found.',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 0,
			'delay' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

/**
 * Scroll to top
 */
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_scroll-to-top',
	'title' => 'Scroll to top',
	'fields' => array(
		array(
			'key' => 'field_scroll-to-top',
			'label' => 'Enable',
			'name' => 'scroll_to_top',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui_on_text' => 'ON',
			'ui_off_text' => 'OFF',
			'ui' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );

/**
 * Footer columns
 */
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_footer-columns',
	'title' => 'Footer',
	'fields' => array(
		array(
			'key' => 'field_footer-column-one',
			'label' => 'Column One',
			'name' => 'footer_column_one',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 0,
			'delay' => 0,
		),
		array(
			'key' => 'field_footer-column-two',
			'label' => 'Column Two',
			'name' => 'footer_column_two',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 0,
			'delay' => 0,
		),
		array(
			'key' => 'field_footer-column-three',
			'label' => 'Column Three',
			'name' => 'footer_column_three',
			'aria-label' => '',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'basic',
			'media_upload' => 0,
			'delay' => 0,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'theme-options-footer',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
) );
} );
