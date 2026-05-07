<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package skookum
 */

$scroll_to_top = get_field('scroll_to_top', 'option');
?>

<?php if ($scroll_to_top) : ?>

<div class="container">

	<div class="scroll-to-top">
		<?php
		$back_to_top_text = get_field('translate_back_to_top_' . get_page_lang(), 'option');
		$back_to_top_text = $back_to_top_text ? $back_to_top_text : 'Back to top';
		?>

		<button class="scroll-to-top__btn">
			<svg aria-hidden="true">
				<use href="<?php echo esc_url( get_stylesheet_directory_uri() . '/icons/icons.svg#circle-arrow-up-icon' )?>"></use>
			</svg>
			<span class="scroll-to-top__label">
				<?php echo esc_html( $back_to_top_text ); ?>
			</span>
		</button>

	</div> <!-- .scroll-to-top -->

</div> <!-- .container -->

<?php endif; ?>

<footer id="colophon" class="site-footer">
		
	<div class="container">
		
		<div class="footer-columns">

			<div class="col">
				<?php
				$column_one = get_field('footer_column_one', 'option');
				if ($column_one) {
					echo wp_kses_post($column_one);
				}
				?>
			</div><!-- .col -->

			<div class="col">
				<?php
				$column_two = get_field('footer_column_two', 'option');
				if ($column_two) {
					echo wp_kses_post($column_two);
				}
				?>
			</div><!-- .col -->

			<div class="col">
				<?php
				$column_three = get_field('footer_column_three', 'option');
				if ($column_three) {
					echo wp_kses_post($column_three);
				}
				?>
			</div><!-- .col -->

		</div><!-- .footer-columns -->

	</div> <!-- .container -->

</footer><!-- #colophon -->

<?php wp_footer(); ?>

<nav id="footer-navigation" class="footer-navigation">
    <?php
    wp_nav_menu(
        array(
            'theme_location' => 'footer_menu',
            'menu_id'        => 'footer-menu',
            'menu_class'     => 'menu footer-menu',
        )
    );
    ?>
</nav><!-- #site-navigation -->

<?php // Image Zoom
if ( has_block( 'acf/image-zoom' ) || has_block( 'acf/slider' ) ) : ?>
   
    <!-- This element is not visible on the front-end -->
    <div class="zoom-overlay">
		<?php
		$close_text = get_field('translate_close_' . get_page_lang(), 'option');
		$close_text = $close_text ? $close_text : 'Close';
		?>

        <div class="button-container">
            <button class="zoom-out btn btn-tertiary">–</button>
            <button class="zoom-in btn btn-tertiary">+</button>
            <button class="close-btn btn btn-tertiary"><?php echo esc_html( $close_text ); ?></button>
        </div>

        <div class="zoom-overlay__content">
            <img class="zoom-overlay__image">
        </div>

        <div class="zoom-overlay__caption"></div>
    </div> <!-- .zoom-overlay -->

<?php endif;
// End Image Zoom 
?>

</body>
</html>
