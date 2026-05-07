<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package skookum
 */
	$four_o_four_header = get_field('four_o_four_header', 'option');
	$four_o_four_content = get_field('four_o_four_content', 'option');
	
	get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found wp-block-group is-layout-constrained wp-block-group-is-layout-constrained">
			<header>

				<h1 class="<?php echo esc_attr( $four_o_four_header['title_alignment'] ); ?>">
					<?php echo esc_html( $four_o_four_header['four_o_four_title'] ); ?>
				</h1>

			</header>

			<div class="page-content">

				<?php echo wp_kses_post( $four_o_four_content ); ?>

			</div><!-- .page-content -->
			
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
