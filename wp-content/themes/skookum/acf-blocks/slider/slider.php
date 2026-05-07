<?php
/**
 * Block: Slider
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
    $id = 'id=' . $block['anchor'];
else : $id = '';
endif;

if ( ! get_field( 'slider_slides' ) ): ?>
    <p class="missing-block-error">Add required fields to the Slider block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'slider swiper'] ) ); echo esc_attr( $id ); ?>>

    <?php if( have_rows( 'slider_slides' ) ): ?>

    <div class="swiper-wrapper">

        <?php while( have_rows( 'slider_slides' ) ): the_row(); 
            $slide_image = get_sub_field( 'slide_image' );
            $slide_image_alt_text = get_sub_field( 'slide_image_alt_text' );
            $slide_sr_text = strlen( $slide_image_alt_text ) > 125;
            $slide_title = get_sub_field( 'slide_title' );
            $slide_caption = get_sub_field( 'slide_caption' );
            $slide_image_zoom = get_sub_field( 'slide_image_zoom' );

            // Click to enlarge text translation
            $click_to_enlarge_text = get_field( 'translate_click_to_enlarge_' . get_page_lang(), 'option' );
            $click_to_enlarge_text = $click_to_enlarge_text ? $click_to_enlarge_text : 'Click to enlarge';
            $icon = get_template_directory_uri() . '/icons/expand-icon.svg';
            ?>
            
            <div class="slider__slide swiper-slide">
                
                <?php if ( ! $slide_image || ! $slide_image_alt_text ) : // This is only for validation of the fields in the backend. ?>
                    <p class="missing-block-error">Add required fields to the Slider block.</p>
                <?php return; 
                endif; ?>

                <?php if( $slide_title ): ?>
                    <h2><?php echo esc_html( $slide_title ); ?></h2>
                <?php endif; ?>

                <?php if( $slide_image ): ?>
                        <div class="slide-image <?php echo esc_attr( $slide_image_zoom ? 'image-zoom' : '' ); ?>">
                            <img src="<?php echo esc_url( $slide_image['url'] ); ?>" alt="<?php echo $slide_sr_text ? '' : esc_attr( $slide_image_alt_text ); ?>" loading="lazy" />

                            <!-- Screen reader text for accessibility -->
                            <?php if ( $slide_sr_text ): ?>
                                <span class="screen-reader-text">
                                    <?php echo esc_html( $slide_image_alt_text ); ?>
                                </span>
                            <?php endif; ?>

                            <?php if( $slide_image_zoom ): ?>
                                <button 
                                    class="zoom-btn" 
                                    aria-label="<?php echo esc_attr( $click_to_enlarge_text ); ?>"
                                    inert
                                >
                                    <svg role="presentation" aria-hidden="true">
                                        <use href="<?php echo get_stylesheet_directory_uri() . '/icons/icons.svg#expand-icon'?>"></use>
                                    </svg>
                                </button>

                                <!-- Caption displayed in the zoom overlay -->
                                 <span class="hide image-zoom__caption" aria-hidden="true">
                                    <?php echo esc_html( $slide_caption ) ?>
                                </span>
                            <?php endif; ?>
                        </div> <!-- .slide-image -->
                <?php endif; ?>

                <?php if ( $slide_caption ): ?>
                    <p class="slider__slide-caption"><?php echo esc_html( $slide_caption ); ?></p>
                <?php endif; ?>

            </div>
        <?php endwhile; 
    endif ?>
    
    </div> <!-- .swiper-wrapper -->

    <!-- navigation buttons -->
    <button class="swiper-button-prev">
        <svg role="presentation">
            <use href="<?php echo esc_url( get_stylesheet_directory_uri() . '/icons/icons.svg#chevron-left-icon' )?>"></use>
        </svg>
    </button>
    
    <button class="swiper-button-next">
        <svg role="presentation">
            <use href="<?php echo esc_url( get_stylesheet_directory_uri() . '/icons/icons.svg#chevron-right-icon' )?>"></use>
        </svg>
    </button>
        
</div> <!-- .slider.swiper -->

<?php
