<?php

/* 
Tooltip syntax: [tooltip data="Tooltip content here"] Content [/tooltip]
*/
add_shortcode('tooltip', function( $atts, $content = null ) {
    $attributes = shortcode_atts( array(
        'data' => 'Tooltip content here',
    ), $atts );

    $data =  $attributes['data'];

    return (
        '<span class="tooltip" role="tooltip">
            <a href="#" class="tooltip__btn" data-tooltip="' . esc_attr( $data ) . '">' . wp_kses_post( $content ) . '</a>
        </span>'
    );
});