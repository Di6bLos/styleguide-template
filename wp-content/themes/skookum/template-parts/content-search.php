<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package skookum
 */

$thumbnail     = get_the_post_thumbnail_url( null, 'medium_large' );
$categories    = get_the_category();
$category_list = $categories ? join( ', ', wp_list_pluck( $categories, 'name' ) ) : '';
$excerpt       = $thumbnail
	? wp_trim_words( get_the_excerpt(), 15 )
	: wp_trim_words( get_the_excerpt(), 35 );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry' ); ?>>

	<div class="entry__content">

		<?php if ( $category_list ) : ?>
			<div class="entry__categories">
				<?php echo wp_kses_post( $category_list ); ?>
			</div>
		<?php endif; ?>

		<a href="<?php echo esc_url( get_permalink() ); ?>">
			<h3><?php echo esc_html( get_the_title() ); ?></h3>
		</a>

		<div class="entry__date">
			<?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
		</div>

		<?php if ( $excerpt ) : ?>
			<div class="entry__summary">
				<p><?php echo wp_kses_post( $excerpt ); ?></p>
			</div>
		<?php endif; ?>

	</div> <!-- .entry__content -->

	<?php if ( $thumbnail ) : ?>
		<div class="entry__thumbnail">
			<img src="<?php echo esc_url( $thumbnail ); ?>" alt="" loading="lazy" />
		</div> <!-- .entry__thumbnail -->
	<?php endif; ?>

</article> <!-- .entry -->
