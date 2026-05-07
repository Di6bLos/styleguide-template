<?php
/**
 * Block: Image Hotspot
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
    $id = 'id=' . $block['anchor'];
else : $id = '';
endif;

// Grab fields from the ACF field group
$image_hotspot_base = get_field( 'image_hotspot_base' );
$image_hotspot_base_alt_text = get_field( 'image_hotspot_base_alt_text' );
$hotspot_sr_text = strlen( $image_hotspot_base_alt_text ) > 125;
$image_hotspot_markers = get_field( 'image_hotspot_markers' );
?>

<?php if( ! $image_hotspot_base ): ?>
    <p class="missing-block-error">Add required fields to the Image Hotspot block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'image-hotspot-wrapper'] ) ); echo esc_attr( $id ); ?>>

    <div class="image-hotspot">
            <img
                src="<?php echo esc_url( $image_hotspot_base['url'] ); ?>"
                alt="<?php echo $hotspot_sr_text ? '' : esc_attr( $image_hotspot_base_alt_text ); ?>"
                width="100%"
                height="auto"
                class="image-hotspot__image"
            />

            <!-- Screen reader text for accessibility -->
            <?php if ( $hotspot_sr_text ): ?>
                <span class="screen-reader-text">
                    <?php echo esc_html( $image_hotspot_base_alt_text ); ?>
                </span>
            <?php endif; ?>
            
            <?php if( $image_hotspot_markers ): ?>
                <?php foreach( $image_hotspot_markers as $index => $marker ): 
                    $title = $marker['image_hotspot_marker_title'];
                    $position_x = $marker['image_hotspot_marker_position_x'];
                    $position_y = $marker['image_hotspot_marker_position_y'];
                    $description = $marker['image_hotspot_marker_description'];
                    $icon_class = $marker['image_hotspot_marker_icon'] ?? '';
                ?>
                    <div 
                        class="hotspot" 
                        tabindex="0"
                        style="left: <?php echo esc_attr( $position_x ); ?>%; top: <?php echo esc_attr( $position_y ); ?>%;"
                    >
                        <button 
                            class="hotspot__marker"
                            tabindex="-1"
                        >
                            <span class="hotspot__icon">
                                <?php if( $icon_class ): ?>
                                    <svg role="presentation">
                                        <use href="<?php echo esc_url( get_stylesheet_directory_uri() . '/icons/icons.svg#' . $icon_class ); ?>"></use>
                                    </svg>
                                <?php else: ?>
                                    <svg role="presentation">
                                        <use href="<?php echo esc_url( get_stylesheet_directory_uri() . '/icons/icons.svg#map-pin-icon' ); ?>"></use>
                                    </svg>                                
                                <?php endif; ?>
                            </span>

                        </button>
                        
                        <div class="hotspot__tooltip" role="tooltip">

                            <div class="hotspot__tooltip-content">

                                <h4 class="hotspot__title"><?php echo esc_html( $title ); ?></h4>

                                <?php if( $description ): ?>
                                    <span class="hotspot__description"><?php echo wp_kses_post( $description ); ?></span>
                                <?php endif; ?>
                                
                            </div>

                            <div class="hotspot__tooltip-arrow"></div>

                        </div>
                    </div> <!-- .hotspot -->
                <?php endforeach; ?>
            <?php endif; ?>
    </div>

</div> <!-- .image-hotspot-wrapper -->

<?php
