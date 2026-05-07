<?php

/**
 * Block: Prev/Next Pagination
 */

global $post;
$prev_post = get_previous_post();
$next_post = get_next_post();
?>

<?php if ( ! $post->post_parent ) : ?>
    <?php if ( is_admin() ) : ?>
        <p class="missing-block-error">This page does not have any previous or next pages.</p>
    <?php endif; ?>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'prev-next-pagination'] ) ); ?>>

    <?php // Get the previous post
        if ( $prev_post->post_parent ) :
            $prev_title = get_the_title( $prev_post->ID );
            $prev_url = get_permalink( $prev_post->ID );

            // Previous page text translation
            $previous_page_text = get_field( 'translate_previous_' . get_page_lang(), 'option' );
            $previous_page_text = $previous_page_text ? $previous_page_text : 'Navigate to previous page';
    ?>
        <a aria-label="<?php echo esc_attr( $previous_page_text ) ?>, <?php echo esc_attr( $prev_title ) ?>" href="<?php echo esc_url( $prev_url ); ?>" class="prev-next-pagination__link prev">
            <svg role="presentation">
                <use href="<?php echo esc_url( get_stylesheet_directory_uri() . '/icons/icons.svg#arrow-left-icon' )?>"></use>
            </svg>
            <span><?php echo esc_html( $prev_title ); ?></span>
        </a>
    <?php endif; ?>

    <?php // Get the next post
        if ( $next_post->post_parent ) :
            $next_title = get_the_title( $next_post->ID );
            $next_url = get_permalink( $next_post->ID );

            // Next page text translation
            $next_page_text = get_field( 'translate_next_' . get_page_lang(), 'option' );
            $next_page_text = $next_page_text ? $next_page_text : 'Navigate to next page';
    ?>  

        <a aria-label="<?php echo esc_attr( $next_page_text ) ?>, <?php echo esc_attr( $next_title ) ?>" href="<?php echo esc_url( $next_url ); ?>" class="prev-next-pagination__link next">
            <span><?php echo esc_html( $next_title ); ?></span>
            <svg role="presentation">
                <use href="<?php echo esc_url( get_stylesheet_directory_uri() . '/icons/icons.svg#arrow-right-icon' )?>"></use>
            </svg>
        </a>
    <?php endif; ?>
    
</div> <!-- .prev-next-pagination -->

<?php
