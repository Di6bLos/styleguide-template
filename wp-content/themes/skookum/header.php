<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package skookum
 */
?>

<?php
    $google_account_toggle = get_field( 'account_type_toggle', 'option' );
    $google_tag_id = sanitize_text_field( get_field( 'tag_id', 'option' ) );
    $google_translate = get_field( 'google_translate_toggle', 'option' );
    $search_bar = get_field( 'search_bar', 'option' );
?>

<!doctype html>

<html <?php language_attributes(); ?>>

<head>
	<?php if ( $google_tag_id ) : ?>
		<?php if ( $google_account_toggle ) : ?>

			<!-- Google Tag Manager -->
			<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','<?php echo esc_html( $google_tag_id )  ?>');</script>
			<!-- End Google Tag Manager -->

			<?php else : ?>

			<!-- Google tag (gtag.js) -->
			<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_html( $google_tag_id ) ?>"></script>
			<script>
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());

				gtag('config', '<?php echo esc_html( $google_tag_id ) ?>');
			</script>

		<?php endif; ?>
	<?php endif; ?>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( $google_tag_id ) : ?>
	<?php if ( $google_account_toggle ) : ?>
		
		<!-- Google Tag Manager (noscript) -->
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_html( $google_tag_id ) ?>"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<!-- End Google Tag Manager (noscript) -->

	<?php endif; ?>
<?php endif; ?>

<?php wp_body_open(); get_alert_bar();?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'skookum' ); ?></a>

	<header id="masthead" class="site-header">
        
		<div class="container">
			<div class="row">
				
				<div class="site-branding">

					<?php
                    the_custom_logo();

					if ( is_front_page() && is_home() ) : ?>
						
						<h1 class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</h1>
				
					<?php else : ?>
					
						<p class="site-title">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						</p>
				
					<?php endif; ?>
					
					<?php
                    $skookum_description = get_bloginfo( 'description', 'display' );

					if ( $skookum_description || is_customize_preview() ) : ?>

						<p class="site-description"><?php echo $skookum_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					
                    <?php endif; ?>

				</div><!-- .site-branding -->

				<?php if ( $google_translate ) : // Display Google Translate widget ?>

					<div id="google_translate_element"></div>

				<?php endif; ?>

			</div> <!-- .row -->

			<div class="row">

				<?php
				if ( has_nav_menu( 'secondary_menu' ) ) :
					wp_nav_menu(
						array(
							'theme_location' => 'secondary_menu',
							'menu_id'        => 'secondary-menu',
							'menu_class'     => 'menu secondary-menu',
							'link_before'  => '<span class="menu-link-text">',
							'link_after'   => '</span>',
							)
						);
				
				endif;
				if ( $search_bar ) :
					get_search_form();
				endif;
				?>

			</div> <!-- .row -->
		</div> <!-- .container -->

		<?php get_featured_image(); ?>
		
    </header><!-- #masthead -->

<?php get_primary_nav(); 