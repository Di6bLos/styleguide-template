<?php

/**
 * Block: Breadcrumbs
 */

$breadcrumbs_current_post_id = get_the_ID();
$breadcrumbs_ancestors = get_post_ancestors( $breadcrumbs_current_post_id );
$breadcrumbs_reverse_ancestors = array_reverse( $breadcrumbs_ancestors );
?>

<?php if ( ! $breadcrumbs_current_post_id || ! $breadcrumbs_ancestors ) : ?>
    <?php if ( is_admin() ) : ?>
        <p class="missing-block-error">This page does not have a parent page.</p>
    <?php endif; ?>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'breadcrumbs'] ) ); ?>>

    <?php
        foreach ( $breadcrumbs_reverse_ancestors as $ancestor_id ) {
            $ancestor_url = esc_url( get_permalink( $ancestor_id ) );
            $ancestor_title = esc_html( get_the_title( $ancestor_id ) );

            echo wp_kses_post( '<a href="' . $ancestor_url . '">' . $ancestor_title . '</a> <span class="divider">></span> ' );
        }

        echo esc_html( get_the_title( $breadcrumbs_current_post_id ) );
    ?> 
    
</div> <!-- .breadcrumbs -->

<?php
