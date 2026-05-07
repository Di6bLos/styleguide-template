<?php
/**
 * Block: Video Slider
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
    $id = 'id=' . $block['anchor'];
    else : $id = '';
endif;

// Function to convert video URLs to embed URLs
if ( ! function_exists( 'get_video_source' ) ) {
    function get_video_source( $url ) {
        if (strpos( $url, 'youtu' )) { // YouTube
            $find = array( 'youtube.com/watch?v=', 'youtu.be/' );
            $replace = 'youtube.com/embed/';
            $youtube_embed_link = str_replace( $find, $replace, $url );

            return $youtube_embed_link;

        } else { // Vimeo
            $vimeo_embed_url = explode( '/', $url );
            $vimeo_embed_url = 'https://player.vimeo.com/video/' . end( $vimeo_embed_url );

            return $vimeo_embed_url;
        }
    }
}

if ( ! get_field( 'slider_video_slides' ) ): ?>
    <p class="missing-block-error">Add required fields to the Video Slider block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'slider slider-video swiper'] ) ); echo esc_attr( $id ); ?>>

    <?php if( have_rows( 'slider_video_slides' ) ): ?>

    <div class="swiper-wrapper">

        <?php while( have_rows( 'slider_video_slides' ) ): the_row(); 
            $video_slide_title = get_sub_field( 'video_slide_title' );
            $video_slide_url = get_sub_field( 'video_slide_url' );
        ?>
            
        <div class="slider__slide swiper-slide">
            
            <?php if ( ! $video_slide_url ) : ?>
                <p class="missing-block-error">Add a video URL to the Video Slider slide.</p>
            <?php return; 
            endif; ?>

            <?php if( $video_slide_title ): ?>
                <h3><?php echo esc_html( $video_slide_title ); ?></h3>
            <?php endif; ?>

            <?php if( $video_slide_url ): ?>
                <div class="slide-video">

                    <iframe 
                        src="<?php echo esc_url( get_video_source( $video_slide_url ) ); ?>" 
                        title="<?php echo esc_attr( $video_slide_title ? $video_slide_title : "Embeded video" ); ?>"
                        width="100%"
                        height="100%"
                        frameborder="0">
                    </iframe>

                </div> <!-- .slide-video -->
            <?php endif; ?>

        </div> <!-- .slider__slide -->

        <?php endwhile; ?>
    
    <?php endif; ?>
    
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
