<?php
/**
 * Timeline
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
    $id = 'id=' . $block['anchor'];
else : $id = '';
endif;

$has_rows = have_rows('timeline_row');
?>

<?php if ( ! $has_rows ): ?>
    <p class="missing-block-error">Add required fields to the Timeline block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'timeline'] ) ); echo esc_attr( $id ); ?>>

    <div class="timeline__bar">
        <div class="timeline__bar-fill"></div>
    </div>

    <div class="timeline-wrapper">

        <?php while( have_rows('timeline_row') ): the_row(); 
            // Grab sub fields
            $timeline_active_beacon = get_sub_field('timeline_active_beacon');
            $timeline_primary_header = get_sub_field('timeline_primary_header');
            $timeline_subheading = get_sub_field('timeline_subheading');
            $timeline_content = get_sub_field('timeline_content');

            if( $timeline_active_beacon ):
                $header_class = 'timeline__header current';
            else:
                $header_class = 'timeline__header';
            endif;
        ?>
        
        <div class="timeline__row">
            
            <?php if( $timeline_primary_header ): ?>
                <h3 class="<?php echo esc_attr( $header_class ); ?>">
                    <span class="timeline__beacon"></span><?php echo esc_html( $timeline_primary_header ); ?>
                </h3>
            <?php else: ?>
                <p class="missing-block-error">Add required fields to the Timeline block.</p>
            <?php endif; ?>

            <?php if( $timeline_subheading ): ?>
                <strong class="timeline__subheading"><?php echo esc_html( $timeline_subheading ); ?></strong>
            <?php endif; ?>

            <?php if ( $timeline_content ): ?>
                <div class="timeline__content">
                    <?php echo wp_kses_post( $timeline_content ); ?>
                </div>
            <?php endif; ?>

            </div>

        <?php endwhile; ?>

    </div> <!-- .timeline-wrapper -->
    
</div> <!-- .timeline -->

<?php
