<?php
/**
 * Block: Accordion
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
    $id = 'id=' . $block['anchor'];
else : $id = '';
endif;

// Grab fields, make variables with the field name using underscores.
$accordion_heading = get_field( 'accordion_heading' );
$accordion_content  = get_field( 'accordion_content' );
$expand_button_text = get_field( 'translate_expand_section_' . get_page_lang(), 'option' );
$expand_button_text = $expand_button_text ? $expand_button_text : 'Expand section';

// Create unique accordion ID for accessibility
$accordion_id = uniqid( 'accordion-' );
?>

<?php if ( ! $accordion_heading ) : ?>
    <p class="missing-block-error">Add required fields to the Accordion block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'accordion'] )); echo esc_attr( $id ); ?>>

    <div class="accordion__container">

        <div class="accordion__title">
            <?php echo esc_html( $accordion_heading ); ?>

            <button 
                class="accordion__button" 
                aria-expanded="false" 
                aria-controls="<?php echo esc_attr( $accordion_id ); ?>" 
                aria-label="<?php echo esc_attr( $expand_button_text ); ?>"
                data-accordion-heading="<?php echo esc_attr( $accordion_heading ); ?>"
            > 
            </button>
        </div> <!-- .accordion__title -->
        
        <div class="accordion__content" id="<?php echo esc_attr( $accordion_id ); ?>">
                
            <InnerBlocks />

        </div> <!-- .accordion__content -->

    </div> <!-- .accordion__container -->
    
</div> <!-- .accordion -->

<?php
