<?php
/**
 * Featured image function
 * 
 * This function displays the featured image as the header background image
 * 
 * @package skookum
 */

function get_featured_image() {
	
	// Hide header on search pages
	if ( is_search() || is_archive() ) {
		return;
	}

    if ( has_post_thumbnail() ) : // Display featured image as header background image 

        $featured_image = get_the_post_thumbnail_url( get_the_ID() ); ?>

        <div 
            class="entry-header featured-image" 
            style="background-image: url(<?php echo esc_url( $featured_image ); ?>);" 
        >

            <?php 
            $title_class = has_block( 'acf/hero' ) ? 'hide' : '';

            the_title( '<h1 class="entry-title ' . esc_attr( $title_class ) . '">', '</h1>' ); 
            ?>

            <?php
            $scroll_down = get_field( 'scroll_down_toggle', 'options' );

            if ( $scroll_down ) : ?>
                <div class="scroll-down">
                    <button class="scroll-down__btn" aria-label="Scroll down">
                        <svg class="scroll-down__icon" role="presentation">
                            <use href="<?php echo esc_url( get_stylesheet_directory_uri() . '/icons/icons.svg#scroll-down-icon' )?>"></use>
                        </svg>
                    </button>
                </div>
            <?php endif; ?>

        </div><!-- .entry-header.featured-image -->


    <?php else : ?>

        <div class="entry-header">
            <div class="container">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </div>
        </div><!-- .entry-header -->

    <?php endif; // End featured image header 
}
