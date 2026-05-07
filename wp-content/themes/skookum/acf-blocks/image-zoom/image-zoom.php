<?php
/**
 * Block: Image Zoom
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
    $id = 'id=' . $block['anchor'];
else : $id = '';
endif;

// Grab fields, make variables with the field name using underscores.
$image_zoom = get_field( 'image_zoom' );
$image_zoom_thumbnail = get_field( 'image_zoom_thumbnail' );
$image_zoom_caption = get_field( 'image_zoom_caption' );
$image_zoom_alt_text = get_field( 'image_zoom_alt_text' );
$image_zoom_sr_text = strlen( $image_zoom_alt_text ) > 125;
$icon = get_template_directory_uri() . '/icons/expand-icon.svg';

// Click to enlarge text translation
$click_to_enlarge_text = get_field( 'translate_click_to_enlarge_' . get_page_lang(), 'option' );
$click_to_enlarge_text = $click_to_enlarge_text ? $click_to_enlarge_text : 'Click to enlarge';
?>

<?php if( ! $image_zoom || ! $image_zoom_thumbnail ): ?>
    <p class="missing-block-error">Add required fields to the Image Zoom block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'image-zoom-wrapper'] ) ); echo esc_attr( $id ); ?>>

    <figure class="image-zoom">

        <div class="image-zoom__wrapper">

            <img 
                src="<?php echo esc_url( $image_zoom_thumbnail['url'] ); ?>" 
                alt="<?php echo esc_attr( $image_zoom_sr_text ) ? '' : esc_attr( $image_zoom_alt_text ); ?>" 
                data-large-image="<?php echo esc_url( $image_zoom['url'] ); ?>"
                loading="lazy" 
            />

            <!-- Screen reader text for accessibility -->
            <?php if ( $image_zoom_sr_text ): ?>
                <span class="screen-reader-text">
                    <?php echo esc_html( $image_zoom_alt_text ); ?>
                </span>
            <?php endif; ?>

            <button 
                class="zoom-btn" 
                aria-label="<?php echo esc_attr( $click_to_enlarge_text ); ?>"
                inert
            >
                <svg role="presentation" aria-hidden="true">
                    <use href="<?php echo esc_url( get_stylesheet_directory_uri() . '/icons/icons.svg#expand-icon' )?>"></use>
                </svg>
            </button>

        </div> <!-- .image-zoom__wrapper -->

        <?php if( !empty( $image_zoom_caption ) ): ?> 
            <figcaption>
                <span class="image-zoom__caption">
                    <?php echo esc_html( $image_zoom_caption ); ?>
                </span>
            </figcaption>
        <?php endif; ?>

    </figure> <!-- .image-zoom -->
    
</div> <!-- .image-zoom-wrapper -->

<?php
