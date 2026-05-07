<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package skookum
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content container--constrained">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'skookum' ),
				'after'  => '</div>',
			)
		);
		?>

		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<?php skookum_edit_link() ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>

	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
