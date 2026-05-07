<?php
/**
 * Timeline Chart
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
	$id = 'id=' . $block['anchor'];
else :
	$id = '';
endif;

$timeline_chart_times = have_rows( 'timeline_chart_times' );
$timeline_chart_rows  = have_rows( 'timeline_chart_rows' );

if ( ! $timeline_chart_times || ! $timeline_chart_rows ) : ?>
	<p class="missing-block-error">Add required fields to the Timeline Chart block.</p>
	<?php return;
endif;

// Gather times to determine column count and bar positions.
$times = [];
while ( have_rows( 'timeline_chart_times' ) ) : the_row();
	$times[] = get_sub_field( 'timeline_chart_time' );
endwhile;

$col_count = count( $times );
$timeline_chart_title = get_field( 'timeline_chart_title' );

?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'timeline-chart'] ) ); echo esc_attr( $id ); ?> style="<?php echo esc_attr( '--tt-col-count: ' . $col_count ); ?>">

	<div class="timeline-chart__scroll">

		<div class="timeline-chart__header">
			<div class="timeline-chart__header-cell timeline-chart__header-cell--title" tabindex="0">
				<?php echo esc_html( $timeline_chart_title ); ?>
			</div>

			<?php foreach ( $times as $time ) : ?>
				<div class="timeline-chart__header-cell" aria-hidden="true">
					<?php echo esc_html( $time ); ?>
				</div>
			<?php endforeach; ?>
		</div>

		<?php while ( have_rows( 'timeline_chart_rows' ) ) : the_row();
			$timeline_chart_activity   = get_sub_field( 'timeline_chart_activity' );
			$timeline_chart_span_begin = get_sub_field( 'timeline_chart_span_begin' );
			$timeline_chart_span_end   = get_sub_field( 'timeline_chart_span_end' );
			$timeline_chart_span_label = get_sub_field( 'timeline_chart_span_label' );
		?>

		<div class="timeline-chart__row">

			<div class="timeline-chart__activity" tabindex="0" >
				<?php echo esc_html( $timeline_chart_activity ); ?>

				<span class="screen-reader-text">
					<?php echo esc_html( $timeline_chart_span_label . ' Active ' . $timeline_chart_span_begin . ' - ' . $timeline_chart_span_end ); ?>
				</span>
			</div>

			<?php foreach ( $times as $index => $time ) :
				// Shade every other time for readability, starting with the second column (index 1).
				$timeline_chart_cell_class = 'timeline-chart__cell' . ( $index % 2 === 0 ? ' timeline-chart__cell--shaded' : '' );
			?>
				<div class="<?php echo esc_attr( $timeline_chart_cell_class ) ?>" style="<?php echo esc_attr( '--col: ' . ( $index + 2 ) ); ?>"></div>
			<?php endforeach; ?>

			<?php
			// Match span begin/end to times to determine bar start/end positions.
			$begin_time = array_search( $timeline_chart_span_begin, $times );
			$end_time   = array_search( $timeline_chart_span_end, $times );

			if ( $begin_time !== false && $end_time !== false ) :
				// Activities occupy col 1; times start at col 2.
				$col_start = intval( $begin_time ) + 2;
				$col_end   = intval( $end_time )   + 3;
			?>
				<div class="timeline-chart__bar" style="<?php echo esc_attr( '--col-start: ' . $col_start . '; --col-end: ' . $col_end . ';' ); ?>">
					<?php if ( $timeline_chart_span_label ) : ?>
						<span class="timeline-chart__bar-label" aria-hidden="true"><?php echo esc_html( $timeline_chart_span_label ); ?></span>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( ( $timeline_chart_span_begin && $begin_time === false ) || ( $timeline_chart_span_end && $end_time === false ) ) : ?>
				<div class="timeline-chart__bar timeline-chart__bar--error">
					<span class="timeline-chart__bar-label">ERROR: time mismatch.</span>
				</div>
			<?php endif; ?>

		</div>

		<?php endwhile; ?>

	</div><!-- .timeline-chart__scroll -->

</div> <!-- .timeline-chart -->
