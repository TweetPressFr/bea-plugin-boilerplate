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

		// Self Deactivatation, there is an issue
		if ( version_compare( PHP_VERSION, BEA_PB_MIN_PHP_VERSION, '<' ) || ! class_exists('\BEA\Autoloader') ) {
			deactivate_plugins( BEA_PB_DIR . 'bea-plugin-boilerplate.php' );
			unset( $_GET['activate'] );
			load_plugin_textdomain( 'bea-plugin-boilerplate', false, BEA_PB_DIR . 'languages' );
		}

		if ( ! class_exists('\BEA\Autoloader') ) {
			trigger_error( __( 'Plugin Boilerplate requires BEA Autoloader mu-plugins in order to autoload your files', 'bea-plugin-boilerplate' ) );
			add_action( 'admin_notices', array( __CLASS__, 'admin_notices_autoloader' ) );
		}

		// Check PHP min version
		if ( version_compare( PHP_VERSION, BEA_PB_MIN_PHP_VERSION, '<' ) ) {
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

	/**
	 * Notify the user about the autoloader mu-plugins not found.
	 *
	 * @since 3.0
	 */
	public static function admin_notices_autoloader() {
		echo '<div class="notice error is-dismissible">';
		echo '<p>' . esc_html( __( 'Plugin Boilerplate requires BEA Autoloader mu-plugins in order to autoload your files', 'bea-plugin-boilerplate' ) ) . '</p>';
		echo '</div>';
	}
}