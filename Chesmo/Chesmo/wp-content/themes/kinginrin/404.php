<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php kinginrin_content_class(); ?>>
		<main id="main" <?php kinginrin_main_class(); ?>>
			<?php
			/**
			 * kinginrin_before_main_content hook.
			 *
			 */
			do_action( 'kinginrin_before_main_content' );
			?>

			<div class="inside-article">

				<?php
				/**
				 * kinginrin_before_content hook.
				 *
				 *
				 * @hooked kinginrin_featured_page_header_inside_single - 10
				 */
				do_action( 'kinginrin_before_content' );
				?>

				<header class="entry-header">
					<h1 class="entry-title" itemprop="headline"><?php echo apply_filters( 'kinginrin_404_title', __( 'Oops! That page can&rsquo;t be found.', 'kinginrin' ) ); // WPCS: XSS OK. ?></h1>
				</header><!-- .entry-header -->

				<?php
				/**
				 * kinginrin_after_entry_header hook.
				 *
				 *
				 * @hooked kinginrin_post_image - 10
				 */
				do_action( 'kinginrin_after_entry_header' );
				?>

				<div class="entry-content" itemprop="text">
					<?php
					echo '<p>' . apply_filters( 'kinginrin_404_text', __( 'It looks like nothing was found at this location. Maybe try searching?', 'kinginrin' ) ) . '</p>'; // WPCS: XSS OK.

					get_search_form();
					?>
				</div><!-- .entry-content -->

				<?php
				/**
				 * kinginrin_after_content hook.
				 *
				 */
				do_action( 'kinginrin_after_content' );
				?>

			</div><!-- .inside-article -->

			<?php
			/**
			 * kinginrin_after_main_content hook.
			 *
			 */
			do_action( 'kinginrin_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * kinginrin_after_primary_content_area hook.
	 *
	 */
	 do_action( 'kinginrin_after_primary_content_area' );

	 kinginrin_construct_sidebars();

get_footer();
