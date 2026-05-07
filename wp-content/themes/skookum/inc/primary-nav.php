<?php
/**
 * Primary Navigation
 * 
 * Description: This file contains the primary navigation for the theme.
 * The function get_primary_menu() is used to determine the menu based on the current page,
 * by checking the URL and returning the menu name based on the language directory.
 * 
 * ex. /es/ returns primary-menu-es
 * 
 * Menus in the admin should be named primary-menu, primary-menu-es, etc.
 * 
 * @package skookum
 */

function get_primary_menu() {
	
	$dir = get_page_lang();

	if ( $dir == '' ) :
		return 'primary-menu';
	else :
		return 'primary-menu-' . $dir;
	endif;

}

function get_primary_nav() { ?>

    <nav id="site-navigation" class="main-navigation">

        <div class="container">
			<?php
			    // Mobile menu toggle text translation
				$mobile_menu_toggle_text = get_field( 'translate_mobile_menu_toggle_' . get_page_lang(), 'option' );
				$mobile_menu_toggle_text = $mobile_menu_toggle_text ? $mobile_menu_toggle_text : 'Mobile menu toggle';
			?>

			<button 
				class="menu-toggle" 
				aria-controls="primary-menu" 
				aria-expanded="false" 
				aria-label="<?php echo esc_attr( $mobile_menu_toggle_text ); ?>"
			>
				<span class="menu-toggle__icon"></span>
			</button>
			
            <?php
				wp_nav_menu(
					array(
						'menu'           => get_primary_menu(),
						'theme_location' => 'primary_menu',
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'menu primary-menu',
						'link_before'  => '<span class="menu-link-text">',
						'link_after'   => '<span class="sub-menu-icon"></span></span>',
						'walker'         => new Walker_Nav_Primary(),
					)
				);
			?>

		</div> <!-- .container -->

	</nav><!-- #site-navigation -->

<?php
}
