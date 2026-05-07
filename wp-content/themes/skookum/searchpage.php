<?php
/**
 * Template Name: Search Page
 *
 * The template for displaying the search page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package skookum
 */

get_header();
?>

	<main id="search-page" class="site-main">

		<div class="container">

			<?php get_search_form(); ?>

		</div>

	</main><!-- #main -->

<?php
get_footer();
