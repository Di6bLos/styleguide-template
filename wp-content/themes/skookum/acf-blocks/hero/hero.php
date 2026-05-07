<?php
/**
 * Block: Hero
 *
 * More info: https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package skookum;
 */

// Create variables from ACF fields.
$hero_heading = get_field( 'hero_heading' );
$hero_small_heading = get_field( 'hero_small_heading' );
$hero_small_heading_toggle = get_field( 'hero_small_heading_toggle' );
$hero_description = get_field( 'hero_description' );
$hero_background_image = get_field( 'hero_background_image' );
?>

<?php if ( ! $hero_heading ) : ?>
    <p class="missing-block-error">Add required fields to the Hero block.</p>
<?php return; 
endif; ?>

<div 
    <?php if ( $hero_background_image ) : ?>
        <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'hero background-image']) ); ?>
        style="background-image: url('<?php echo esc_url( $hero_background_image ); ?>'), linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5))"
    <?php else : ?>
        <?php echo wp_kses_data( get_block_wrapper_attributes( ['class' => 'hero']) ); ?>
    <?php endif; ?>
>

    <div class="container">
        <?php if ( $hero_small_heading && $hero_small_heading_toggle ) : ?>
            <span class="small_heading">
                <?php echo wp_kses_post( $hero_small_heading ); ?>
            </span>
        <?php endif; ?>

        <h2 class="h1">
            <?php echo wp_kses_post( $hero_heading ); ?>
        </h2>

        <?php if ( $hero_small_heading && ! $hero_small_heading_toggle ) : ?>
            <span class="small_heading">
                <?php echo wp_kses_post( $hero_small_heading ); ?>
            </span>
        <?php endif; ?>

        <?php if ( $hero_description ) : ?>
            <p class="description">
                <?php echo wp_kses_post( $hero_description ); ?>
            </p>
        <?php endif; ?>

    </div> <!-- .wrapper -->

</div> <!-- .hero -->

<?php
