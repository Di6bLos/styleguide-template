<?php
/**
 * Block: PDF Embed
 */

// Create id attribute allowing for custom "anchor" value or none.
if ( ! empty( $block['anchor'] ) ) :
    $id = 'id=' . $block['anchor'];
else : $id = '';
endif;

// Grab fields, make variables with the field name using underscores.
$pdf_link_toggle = get_field( 'pdf_src_toggle' );
$pdf_media_upload_file = get_field( 'pdf_media_upload_file' );
$pdf_external_link_url = get_field( 'pdf_external_link_url' );
?>

<?php if ( ! $pdf_media_upload_file && ! $pdf_external_link_url ) : ?>
	<p class="missing-block-error">Add required fields to the PDF Embed block.</p>
<?php return; 
endif; ?>
	
<div <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'pdf-embed'] ) ); echo esc_attr( $id ); ?>>

	<iframe 
		class="pdf-embed__iframe" 
		width="100%" 
		height="100%"
		type="application/pdf"

		<?php if ( $pdf_link_toggle ) : ?>
			src="<?php echo esc_url( $pdf_external_link_url ) ?>"
		<?php else : ?>
			src="<?php echo esc_url( $pdf_media_upload_file['url'] ) ?>" 
		<?php endif; ?>
		>
	</iframe>
	
</div> <!-- .pdf-embed -->

<?php
