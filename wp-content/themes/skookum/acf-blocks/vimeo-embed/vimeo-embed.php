<?php
/**
 * Block: Vimeo Embed
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
    $id = 'id=' . $block['anchor'];
else : $id = '';
endif;

// Grab fields, make variables with the field name using underscores.
$vimeo_url = get_field( 'vimeo_url' );

// Replace the vimeo URL with the embed URL.
$vimeo_embed_url = explode( '/', $vimeo_url );
$vimeo_embed_url = 'https://player.vimeo.com/video/' . end( $vimeo_embed_url );
$vimeo_caption = get_field( 'vimeo_caption' );
?>

<?php if ( ! $vimeo_url ) : ?>
	<p class="missing-block-error">Add required fields to the Vimeo Embed block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'vimeo-embed'] ) ); echo esc_attr( $id ); ?>>

	<!-- If the URL is empty or invalid, video player will display error message. -->
	<figure>
		<iframe
			class="vimeo-embed__iframe"
			width="100%"
			height="100%"
			frameborder="0"
			src="<?php echo esc_url( $vimeo_embed_url ) ?>"
			>
		</iframe>

		<?php if ( $vimeo_caption ) : ?>
			<figcaption>
				<?php echo esc_html( $vimeo_caption ) ?>
			</figcaption>
		<?php endif; ?>
	</figure>

</div> <!-- .vimeo-embed -->

<?php
