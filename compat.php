<?php
namespace BEA\PB;
class Compatibility {

	/**
	 * admin_init hook callback
	 *
	 * @since 0.1
	 * @since 3.0 Add support for autoloader dependency issue
	 */
	public static function admin_init() {

		// Not on ajax
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		// Check activation
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		// Check PHP min version
		if ( version_compare( PHP_VERSION, BEA_PB_MIN_PHP_VERSION, '<' ) ) {
			\deactivate_plugins( BEA_PB_DIR . 'bea-plugin-boilerplate.php' );
			unset( $_GET['activate'] );
			trigger_error( sprintf( __( 'Plugin Boilerplate requires PHP version %s or greater to be activated.', 'bea-plugin-boilerplate' ), BEA_PB_MIN_PHP_VERSION ) );
			add_action( 'admin_notices', array( __CLASS__, 'admin_notices_php_compat' ) );
		}

	}

	/**
	 * Notify the user about the incompatibility issue.
	 *
	 * @since 0.1
	 */
	public static function admin_notices_php_compat() {
		echo '<div class="notice error is-dismissible">';
		echo '<p>' . esc_html( sprintf( __( 'Plugin Boilerplate requires PHP version %s or greater to be activated. Your server is currently running PHP version %s.', 'bea-plugin-boilerplate' ), BEA_PB_MIN_PHP_VERSION, PHP_VERSION ) ) . '</p>';
		echo '</div>';
	}
}