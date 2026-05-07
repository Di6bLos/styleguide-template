<?php
/**
 * Template Name: Posts Feed
 *
 * More info: https://www.advancedcustomfields.com/resources/blocks/
 *
 * @package skookum;
 */

get_header();
?>

<main id="primary" class="site-main">

    <div class="post-feed-page-content container--constrained">

        <?php the_content(); ?> 

    </div> <!-- .container -->


    <div class="fwp">

        <?php if ( function_exists( 'FWP' ) ) : ?>

            <aside class="facetwp-filters">
                <!-- Facets below are default placeholders. -->
                <?php echo facetwp_display( 'facet', 'categories' ); ?>

                <div class="facetwp-category-controls">
                    <button class="btn" onclick="FWP.refresh()">Submit</button>
                    <?php echo do_shortcode( '[facetwp facet="reset"]' ); ?>
                </div>
            </aside>

        <?php else : ?>
            <p>The plugin, <a href="https://facetwp.com/" target="_blank">FacetWP</a> does not exist or is not activated. Please install and activate the plugin to use this template.</p>
        <?php endif; ?>

        <div class="posts">

            <?php
            $args = [
                'post_type'      => 'post',
                'posts_per_page' => 6,
                'facetwp'        => true,
            ];
            $query = new WP_Query( $args );
                
            if ( $query->have_posts() ) :
                while ( $query->have_posts() ) :
                    $query->the_post();
                    get_template_part( 'template-parts/content', 'search' );
                endwhile;
            endif;
            ?>	

        </div><!-- .posts --> 

        <?php if ( $query->found_posts > 6 ) : ?>
            
            <div class="pagination">
                <?php echo facetwp_display( 'facet', 'pagination' ); ?>
            </div>

        <?php endif; ?>
                
    </div><!-- .fwp -->

</main><!-- #main -->

<?php

get_footer();
