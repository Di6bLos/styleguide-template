<?php
/**
 * Block: Image Stack
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
    $id = 'id=' . $block['anchor'];
else : $id = '';
endif;

// Grab fields from the ACF field group
$image_stack_base = get_field( 'image_stack_base' );
$image_stack_base_alt_text = get_field( 'image_stack_base_alt_text' );
$image_stack_base_sr_text = strlen( $image_stack_base_alt_text ) > 125;
$image_stack_layers = get_field( 'image_stack_layers' );
?>

<?php if( ! $image_stack_base ): ?>
    <p class="missing-block-error">Add required fields to the Image Layers block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'image-stack-wrapper'] ) ); echo esc_attr( $id ); ?>>

    <div class="image-stack">

        <!-- Base Layer -->
        <div class="image-stack__layer image-stack__base">
            <img
                src="<?php echo esc_url( $image_stack_base['url'] ); ?>"
                alt="<?php echo $image_stack_base_sr_text ? '' : esc_attr( $image_stack_base_alt_text ); ?>"
                loading="lazy"
            />

            <!-- Screen reader text for accessibility -->
            <?php if ( $image_stack_base_sr_text ): ?>
                <span class="screen-reader-text">
                    <?php echo esc_html( $image_stack_base_alt_text ); ?>
                </span>
            <?php endif; ?>
        </div>

        <!-- Stacked Layers -->
        <?php if( $image_stack_layers ): ?>
            <?php foreach( $image_stack_layers as $layer ):
                $layer_image = $layer['image_stack_layers_layer_image'];
                $layer_alt_text = $layer['image_stack_layers_layer_alt_text'];
                $layer_sr_text = strlen( $layer_alt_text ) > 125;
                $layer_name = $layer['image_stack_layers_layer_name'];
                // Convert layer name to lowercase and replace spaces with hyphens for data attribute
                $layer_id = strtolower( str_replace( ' ', '-', $layer_name ) );

                if( $layer_image ): ?>
                    <div
                        class="image-stack__layer image-stack__additional-layer"
                        id="<?php echo esc_attr( $layer_id ); ?>"
                    >
                        <img
                            src="<?php echo esc_url( $layer_image['url'] ); ?>"
                            alt="<?php echo $layer_sr_text ? '' : esc_attr( $layer_alt_text ); ?>"
                            loading="lazy"
                        />

                        <!-- Screen reader text for accessibility -->
                        <?php if ( $layer_sr_text ): ?>
                            <span class="screen-reader-text">
                                <?php echo esc_html( $layer_alt_text ); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        <?php endif; ?>

    </div> <!-- .image-stack -->

    <div class="layers-checkbox-group">
        
        <h3 class="layers-checkbox-group__header">Layers</h3>

        <?php if( $image_stack_layers ): ?>
            <?php foreach( $image_stack_layers as $layer ): 
                $layer_name = $layer['image_stack_layers_layer_name'];
                // Convert layer name to lowercase and replace spaces with hyphens for data attribute
                $layer_id = strtolower( str_replace( ' ', '-', $layer_name ) );
                ?>

                <div class="layers-checkbox-group__item">
                    <input 
                        type="checkbox" 
                        id="checkbox-<?php echo esc_attr( $layer_id ); ?>" 
                        name="checkbox-<?php echo esc_attr( $layer_id ); ?>" 
                        value="<?php echo esc_attr( $layer_id ); ?>" 
                        checked
                    >
                    <label for="checkbox-<?php echo esc_attr( $layer_id ); ?>">
                        <?php echo esc_html( $layer_name ); ?>
                    </label>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>
                
        <button class="btn layers-checkbox-group__toggle-btn">Show/Hide All</button>

    </div> <!-- .layers-checkbox -->
    
</div> <!-- .image-stack-wrapper -->

<?php
