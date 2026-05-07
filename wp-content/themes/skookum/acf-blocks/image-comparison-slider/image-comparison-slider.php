<?php
/**
 * Image Comparison Slider
 */

// Grab fields, make variables with the field name using underscores.
$image_comparison_image_one = get_field('image_comparison_image_one');
$image_comparison_image_one_caption = get_field('image_comparison_image_one_caption');
$image_comparison_image_one_alt_text = get_field('image_comparison_image_one_alt_text');
$image_one_sr_text = strlen( $image_comparison_image_one_alt_text ) > 125;

$image_comparison_image_two = get_field('image_comparison_image_two');
$image_comparison_image_two_caption = get_field('image_comparison_image_two_caption');
$image_comparison_image_two_alt_text = get_field('image_comparison_image_two_alt_text');
$image_two_sr_text = strlen( $image_comparison_image_two_alt_text ) > 125;

?>

<?php if( ! $image_comparison_image_one || ! $image_comparison_image_two ) : ?>
    <p class="missing-block-error">Add required fields to the Image Comparison Slider block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'image-comparison-slider'] ) ); ?>>

    <div class="compare-images">

        <figure class="before-image">

            <img src="<?php echo esc_url( $image_comparison_image_one['url'] ) ?>" alt="<?php echo $image_one_sr_text ? '' : esc_attr( $image_comparison_image_one_alt_text ); ?>"/>

            <!-- Screen reader text for accessibility -->
            <?php if ( $image_one_sr_text ): ?>
                <span class="screen-reader-text">
                    <?php echo esc_html( $image_comparison_image_one_alt_text ); ?>
                </span>
            <?php endif; ?>

            <?php if ( $image_comparison_image_one_caption ) : ?>
                <figcaption>
                    <?php echo esc_html( $image_comparison_image_one_caption ) ?>
                </figcaption>
            <?php endif; ?>

        </figure> <!-- .before-image -->

        <div class="resizer" aria-label="Drag to compare images">

            <div class="resizer__icon">
                <svg role="presentation">
                    <use href="<?php echo esc_url( get_stylesheet_directory_uri() . '/icons/icons.svg#slider-arrow-icon' )?>"></use>
                </svg>
            </div>
            
        </div>

        <figure class="after-image">
            
            <img src="<?php echo esc_url( $image_comparison_image_two['url'] ) ?>" alt="<?php echo $image_two_sr_text ? '' : esc_attr( $image_comparison_image_two_alt_text ); ?>"/>

            <!-- Screen reader text for accessibility -->
            <?php if ( $image_two_sr_text ): ?>
                <span class="screen-reader-text">
                    <?php echo esc_html( $image_comparison_image_two_alt_text ); ?>
                </span>
            <?php endif; ?>

            <?php if ( $image_comparison_image_two_caption ) : ?>
                <figcaption>
                    <?php echo esc_html( $image_comparison_image_two_caption ) ?>
                </figcaption>
            <?php endif; ?>

        </figure> <!-- .after-image -->

    </div> <!-- .compare-images -->

</div> <!-- .image-comparison-slider -->

<?php
