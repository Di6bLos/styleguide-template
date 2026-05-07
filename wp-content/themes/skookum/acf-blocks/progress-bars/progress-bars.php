<?php
/**
 * Block: Progress Bars
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
    $id = 'id=' . $block['anchor'];
else : $id = '';
endif;

$has_rows = have_rows('progress_bars');
?>

<?php if ( ! $has_rows ): ?>
    <p class="missing-block-error">Add required fields to the Progress Bars block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'progress-bars'] )); echo esc_attr( $id ); ?>>
        
    <?php while( have_rows('progress_bars') ): the_row(); 
        $progress_bar_title = get_sub_field('progress_bar_title');
        $progress_bar_metric = get_sub_field('progress_bar_metric');
        $progress_bar_value = get_sub_field('progress_bar_value');

        // Creates a unique progress bar ID for accessibility
        $progress_bar_id = uniqid( 'progress-bar-' );
    ?>
    
    <div class="progress-bar__wrapper">

        <div class="progress-bar__labels">

            <label for="<?php echo esc_attr($progress_bar_id); ?>">
                <?php echo esc_html($progress_bar_title); ?>
            </label>

            <p><?php echo esc_html($progress_bar_metric); ?></p>

        </div> <!-- .progress-bar__labels -->
        
        <progress
            class="progress-bar__fill"
            value="0"
            data-target-value="<?php echo intval($progress_bar_value); ?>"
            max="100"
            role="progressbar"
            id="<?php echo esc_attr($progress_bar_id); ?>">
        </progress>

    </div> <!-- .progress-bar__wrapper -->

    <?php endwhile; ?>

</div> <!-- .progress-bars -->
