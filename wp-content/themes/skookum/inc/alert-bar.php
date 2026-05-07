<?php
/**
 * Alert Bar
 * 
 * This function displays an alert bar at the top of the page.
 * 
 * @package skookum
 */

function get_alert_bar() {
	$alert_bar = get_field('alert_bar_toggle', 'option');
	$alert_bar_message = get_field('alert_bar_message', 'option');
	$alert_bar_background_color = get_field('alert_bar_background_color', 'option');
	$alert_bar_text_color = get_field('alert_bar_text_color', 'option');
	$close_button_text = get_field('translate_close_message_' . get_page_lang(), 'option');
	$close_button_text = $close_button_text ? $close_button_text : 'Close message';
	$alert_bar_cookies = get_field('alert_bar_cookies', 'option') ? 'yes' : 'no';
	
	if ($alert_bar) : ?>

		<div 
			class="alert-bar closed"
			data-cookies-name="alert-bar"
			data-cookies-active="<?php echo esc_attr( $alert_bar_cookies ); ?>"
		>

			<div
				class="alert-bar-wrapper"
				style="background-color: <?php echo esc_attr( $alert_bar_background_color ); ?>; color: <?php echo esc_attr( $alert_bar_text_color ); ?>;"
			>
			
				<div class="container">
					
					<button 
						class="close-btn" 
						style="color: <?php echo esc_attr( $alert_bar_text_color ) ?>;" 
						aria-label="<?php echo esc_attr( $close_button_text ); ?>"
					>
						<span class="close-btn__icon"></span>
					</button>

					<span class="alert-bar__message"><?php echo wp_kses_post( $alert_bar_message );  ?></span>

				</div> <!-- .container -->

			</div> <!-- .alert-bar-wrapper -->

		</div> <!-- .alert-bar -->
		
	<?php endif;
}