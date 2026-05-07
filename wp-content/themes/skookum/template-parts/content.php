<?php
/**
 * Template part for displaying posts in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package skookum
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content container--constrained">
	
		<?php
		if ( 'post' === get_post_type() ) :
		?>
			<div class="entry-meta">

				<?php skookum_post_categories(); ?>
				<?php skookum_post_tags(); ?>

				<div class="post-date-author">
					<?php
					skookum_posted_on();
					skookum_posted_by();
					?>
				</div>

			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'skookum' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'skookum' ),
				'after'  => '</div>',
			)
		);

		$post_nav = get_field( 'post_navigation_toggle', 'options' );
        if ( $post_nav ) :
            the_post_navigation(
                array(
                    'prev_text' => '<span>' . esc_html__( 'Previous:', 'skookum' ) . '</span> <span class="title">%title</span>',
                    'next_text' => '<span>' . esc_html__( 'Next:', 'skookum' ) . '</span> <span class="title">%title</span>',
                )
            );
        endif;
		?>
	
		<?php if ( get_edit_post_link() ) : ?>
			<footer class="entry-footer">
				<?php skookum_edit_link() ?>
			</footer><!-- .entry-footer -->
		<?php endif; ?>

	</div><!-- .entry-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->
