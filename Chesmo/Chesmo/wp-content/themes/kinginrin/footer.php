<?php
/**
 * The template for displaying the footer.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

	</div><!-- #content -->
</div><!-- #page -->

<?php
/**
 * kinginrin_before_footer hook.
 *
 */
do_action( 'kinginrin_before_footer' );
?>

<div <?php kinginrin_footer_class(); ?>>
	<?php
	/**
	 * kinginrin_before_footer_content hook.
	 *
	 */
	do_action( 'kinginrin_before_footer_content' );

	/**
	 * kinginrin_footer hook.
	 *
	 *
	 * @hooked kinginrin_construct_footer_widgets - 5
	 * @hooked kinginrin_construct_footer - 10
	 */
	do_action( 'kinginrin_footer' );

	/**
	 * kinginrin_after_footer_content hook.
	 *
	 */
	do_action( 'kinginrin_after_footer_content' );
	?>
</div><!-- .site-footer -->

<?php
/**
 * kinginrin_after_footer hook.
 *
 */
do_action( 'kinginrin_after_footer' );

wp_footer();
?>

</body>
</html>
