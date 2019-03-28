<?php
/**
 * Theme Footer Section for our theme.
 *
 * Displays all of the footer section and closing of the #page div.
 *
 * @package    ThemeGrill
 * @subpackage Himalayas
 * @since      Himalayas 1.0
 */
?>
<?php $himalayas_footer_layout = get_theme_mod( 'himalayas_footer_layout', 'footer-layout-one' ); ?>
<footer id="colophon" class="site-footer" role="contentinfo">
		<?php get_sidebar( 'footer' ); ?>
		<div class="site-info">
			<div class="ps-section-container">
				<?php echo wp_kses_post( get_theme_mod( 'ps_copyright_text', __('&copy; 2019 Chesmo', 'parallaxsome')));?>
				
	</footer><!-- #colophon -->
<a href="#" class="scrollup"><i class="fa fa-angle-up"> </i> </a>

</div> <!-- #Page -->
<?php wp_footer(); ?>
</body>
</html>
