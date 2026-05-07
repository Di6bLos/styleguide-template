<?php

/**
 * Block: Ticker Tape
 */

if ( ! get_field( 'ticker_entries' ) ) : ?>
	<p class="missing-block-error">Add required fields to the Ticker Tape block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'ticker-tape'] ) ); ?>>

	<?php $ticker_scroll_speed = get_field( 'ticker_scroll_speed' ); ?>
	<div 
		class="ticker-tape__inner"
		style="animation-duration: <?php echo esc_attr($ticker_scroll_speed); ?>s;"
	>

	<?php
	if ( have_rows( 'ticker_entries' ) ):
		// Loop through rows.
		while ( have_rows( 'ticker_entries' ) ) : the_row();
			$ticker_entry = get_sub_field( 'ticker_entry' );
			?>

			<?php if ( ! $ticker_entry ) : ?>
				<p class="missing-block-error">Add required fields to the Ticker Tape block.</p>
			<?php return; 
			endif; ?>

			<span><?php echo esc_html( $ticker_entry ); ?></span>
			
		<?php
		endwhile;
	endif; ?>

	</div> <!-- .ticker-tape__inner -->
	
</div> <!-- .ticker-tape -->

<?php
