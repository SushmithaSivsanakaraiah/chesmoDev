<?php
/**
 * Builds our admin page.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'kinginrin_create_menu' ) ) {
	add_action( 'admin_menu', 'kinginrin_create_menu' );
	/**
	 * Adds our "Kinginrin" dashboard menu item
	 *
	 */
	function kinginrin_create_menu() {
		$kinginrin_page = add_theme_page( 'Kinginrin', 'Kinginrin', apply_filters( 'kinginrin_dashboard_page_capability', 'edit_theme_options' ), 'kinginrin-options', 'kinginrin_settings_page' );
		add_action( "admin_print_styles-$kinginrin_page", 'kinginrin_options_styles' );
	}
}

if ( ! function_exists( 'kinginrin_options_styles' ) ) {
	/**
	 * Adds any necessary scripts to the Kinginrin dashboard page
	 *
	 */
	function kinginrin_options_styles() {
		wp_enqueue_style( 'kinginrin-options', get_template_directory_uri() . '/css/admin/admin-style.css', array(), KINGINRIN_VERSION );
	}
}

if ( ! function_exists( 'kinginrin_settings_page' ) ) {
	/**
	 * Builds the content of our Kinginrin dashboard page
	 *
	 */
	function kinginrin_settings_page() {
		?>
		<div class="wrap">
			<div class="metabox-holder">
				<div class="kinginrin-masthead clearfix">
					<div class="kinginrin-container">
						<div class="kinginrin-title">
							<a href="<?php echo esc_url(KINGINRIN_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Kinginrin', 'kinginrin' ); ?></a> <span class="kinginrin-version"><?php echo KINGINRIN_VERSION; ?></span>
						</div>
						<div class="kinginrin-masthead-links">
							<?php if ( ! defined( 'KINGINRIN_PREMIUM_VERSION' ) ) : ?>
								<a class="kinginrin-masthead-links-bold" href="<?php echo esc_url(KINGINRIN_THEME_URL); ?>" target="_blank"><?php esc_html_e( 'Premium', 'kinginrin' );?></a>
							<?php endif; ?>
							<a href="<?php echo esc_url(KINGINRIN_WPKOI_AUTHOR_URL); ?>" target="_blank"><?php esc_html_e( 'WPKoi', 'kinginrin' ); ?></a>
                            <a href="<?php echo esc_url(KINGINRIN_DOCUMENTATION); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'kinginrin' ); ?></a>
						</div>
					</div>
				</div>

				<?php
				/**
				 * kinginrin_dashboard_after_header hook.
				 *
				 */
				 do_action( 'kinginrin_dashboard_after_header' );
				 ?>

				<div class="kinginrin-container">
					<div class="postbox-container clearfix" style="float: none;">
						<div class="grid-container grid-parent">

							<?php
							/**
							 * kinginrin_dashboard_inside_container hook.
							 *
							 */
							 do_action( 'kinginrin_dashboard_inside_container' );
							 ?>

							<div class="form-metabox grid-70" style="padding-left: 0;">
								<h2 style="height:0;margin:0;"><!-- admin notices below this element --></h2>
								<form method="post" action="options.php">
									<?php settings_fields( 'kinginrin-settings-group' ); ?>
									<?php do_settings_sections( 'kinginrin-settings-group' ); ?>
									<div class="customize-button hide-on-desktop">
										<?php
										printf( '<a id="kinginrin_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
											esc_url( admin_url( 'customize.php' ) ),
											esc_html__( 'Customize', 'kinginrin' )
										);
										?>
									</div>

									<?php
									/**
									 * kinginrin_inside_options_form hook.
									 *
									 */
									 do_action( 'kinginrin_inside_options_form' );
									 ?>
								</form>

								<?php
								$modules = array(
									'Backgrounds' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Blog' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Colors' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Disable Elements' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Demo Import' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Hooks' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Import / Export' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Menu Plus' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Page Header' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Secondary Nav' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Spacing' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Typography' => array(
											'url' => KINGINRIN_THEME_URL,
									),
									'Elementor Addon' => array(
											'url' => KINGINRIN_THEME_URL,
									)
								);

								if ( ! defined( 'KINGINRIN_PREMIUM_VERSION' ) ) : ?>
									<div class="postbox kinginrin-metabox">
										<h3 class="hndle"><?php esc_html_e( 'Premium Modules', 'kinginrin' ); ?></h3>
										<div class="inside" style="margin:0;padding:0;">
											<div class="premium-addons">
												<?php foreach( $modules as $module => $info ) { ?>
												<div class="add-on activated kinginrin-clear addon-container grid-parent">
													<div class="addon-name column-addon-name" style="">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php echo esc_html( $module ); ?></a>
													</div>
													<div class="addon-action addon-addon-action" style="text-align:right;">
														<a href="<?php echo esc_url( $info[ 'url' ] ); ?>" target="_blank"><?php esc_html_e( 'Learn more', 'kinginrin' ); ?></a>
													</div>
												</div>
												<div class="kinginrin-clear"></div>
												<?php } ?>
											</div>
										</div>
									</div>
								<?php
								endif;

								/**
								 * kinginrin_options_items hook.
								 *
								 */
								do_action( 'kinginrin_options_items' );
								?>
							</div>

							<div class="kinginrin-right-sidebar grid-30" style="padding-right: 0;">
								<div class="customize-button hide-on-mobile">
									<?php
									printf( '<a id="kinginrin_customize_button" class="button button-primary" href="%1$s">%2$s</a>',
										esc_url( admin_url( 'customize.php' ) ),
										esc_html__( 'Customize', 'kinginrin' )
									);
									?>
								</div>

								<?php
								/**
								 * kinginrin_admin_right_panel hook.
								 *
								 */
								 do_action( 'kinginrin_admin_right_panel' );

								  ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'kinginrin_admin_errors' ) ) {
	add_action( 'admin_notices', 'kinginrin_admin_errors' );
	/**
	 * Add our admin notices
	 *
	 */
	function kinginrin_admin_errors() {
		$screen = get_current_screen();

		if ( 'appearance_page_kinginrin-options' !== $screen->base ) {
			return;
		}

		if ( isset( $_GET['settings-updated'] ) && 'true' == $_GET['settings-updated'] ) {
			 add_settings_error( 'kinginrin-notices', 'true', esc_html__( 'Settings saved.', 'kinginrin' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'imported' == $_GET['status'] ) {
			 add_settings_error( 'kinginrin-notices', 'imported', esc_html__( 'Import successful.', 'kinginrin' ), 'updated' );
		}

		if ( isset( $_GET['status'] ) && 'reset' == $_GET['status'] ) {
			 add_settings_error( 'kinginrin-notices', 'reset', esc_html__( 'Settings removed.', 'kinginrin' ), 'updated' );
		}

		settings_errors( 'kinginrin-notices' );
	}
}
