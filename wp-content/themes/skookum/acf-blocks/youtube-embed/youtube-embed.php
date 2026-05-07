<?php
/**
 * Block: YouTube Embed
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
    $id = 'id=' . $block['anchor'];
else : $id = '';
endif;

// Grab fields, make variables with the field name using underscores.
$youtube_link = get_field( 'youtube_link' );
// Replace the YouTube URL with the embed URL.
$find = array( 'youtube.com/watch?v=', 'youtu.be/' );
$replace = 'youtube.com/embed/';
$youtube_embed_link = str_replace( $find, $replace, $youtube_link );
// Remove any additional query strings. If there are none (false), return the URL.
$youtube_embed_link = substr( $youtube_embed_link, 0, strpos( $youtube_embed_link, '&' ) )?: $youtube_link;
$youtube_caption = get_field( 'youtube_caption' );
?>

<?php if ( ! $youtube_link ) : ?>
	<p class="missing-block-error">Add required fields to the YouTube Embed block.</p>
<?php return; 
endif; ?>

<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'youtube-embed'] ) ); echo esc_attr( $id ); ?>>

	<figure>
		<iframe
			class="youtube-embed__iframe"
			width="100%"
			height="100%"
			frameborder="0"
			src="<?php echo esc_url( $youtube_embed_link ) ?>"
			>
		</iframe>

		<?php if ( $youtube_caption ) : ?>
			<figcaption>
				<?php echo esc_html( $youtube_caption ) ?>
			</figcaption>
		<?php endif; ?>
	</figure>
	
</div> <!-- .youtube-embed -->

<?php
