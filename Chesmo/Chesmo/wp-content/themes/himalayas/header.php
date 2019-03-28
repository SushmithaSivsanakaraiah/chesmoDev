<?php
/**
 * Theme Header Section for our theme.
 *
 * @package    ThemeGrill
 * @subpackage Himalayas
 * @since      Himalayas 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
	/**
	 * This hook is important for wordpress plugins and other many things
	 */
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'himalayas_before' ); ?>
<div id="page" class="hfeed site">
	<?php do_action( 'himalayas_before_header' ); ?>

	<header id="masthead" class="site-header clearfix" role="banner">
		<div class="header-wrapper clearfix">
		<div class="header-pos">
			<div class="head-tg-container header-pos"> 

				<div class="logo">					
					<?php himalayas_the_custom_logo(); ?>
				
				</div> <!-- logo-end -->

						

					<nav id="site-navigation" class="main-navigation" role="navigation">
						<p class="menu-toggle hide"></p>
						<?php wp_nav_menu( array(
							'theme_location'  => 'primary',
							'container_class' => 'menu-primary-container',
						) ); ?>
					</nav> <!-- nav-end -->
				</div> <!-- Menu-search-wrapper end -->
			</div><!-- tg-container -->
						</div>
		</div><!-- header-wrapepr end -->

		<?php if ( function_exists( 'the_custom_header_markup' ) && ( ( get_theme_mod( 'himalayas_slide_on_off', '' ) == 0 ) || ( ( get_theme_mod( 'himalayas_slide_on_off', '' ) == 1 ) && ! is_front_page() ) ) ) :
			do_action( 'himalayas_header_image_markup_render' );
			the_custom_header_markup();
		else :
			if ( get_theme_mod( 'himalayas_slide_on_off' ) == 0 ) {
				$header_image = get_header_image();
				?>
				<div class="header-image-wrap">
					<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</div>
				<?php
			}

		endif; ?>

		<?php if ( get_theme_mod( 'himalayas_slide_on_off' ) == 1 && is_front_page() ) {
			himalayas_featured_image_slider();

		} ?>
	</header>

	<?php do_action( 'himalayas_after_header' ); ?>
	<?php do_action( 'himalayas_before_main' ); ?>
