<?php
/**
 * Skookum Navigation Registration.
 *
 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
 *
 * @package skookum
 */

if ( ! function_exists( 'skookum_register_nav_menu' ) ) {

    function skookum_register_nav_menu() {
        register_nav_menus( array(
            'primary_menu' => esc_html__( 'Primary', 'skookum' ),
            'secondary_menu'  => esc_html__( 'Secondary', 'skookum' ),
            'footer_menu'  => esc_html__( 'Footer', 'skookum' ),
        ) );
    }

    add_action( 'after_setup_theme', 'skookum_register_nav_menu', 0 );
}
