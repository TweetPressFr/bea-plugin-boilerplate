<?php
namespace BEA\PB\Shortcodes;

use BEA\PB\Singleton;


/**
 * This class is the base class of Shortcode
 * It have to be used as base for all Shortcodes
 *
 * Class Shortcode
 *
 * @package BEA\PB\Shortcodes
 * @since   2.1.0
 */
abstract class Shortcode {

	use Singleton;

	/**
	 * The shortcode [tag]
	 *
	 * @var string
	 * @since   2.1.0
	 */
	protected $tag = '';

	/**
	 * List of supported attributes and their defaults
	 *
	 * @var array
	 * @since   2.1.0
	 */
	protected $defaults = array();

	/**
	 * Flag to enable shortcake support
	 *
	 * @var bool
	 * @since   2.2.0
	 */
	protected $shortcake_support = false;

	/**
	 * Create a shortcode
	 *
	 * @since   2.1.0
	 */
	public function add() {
		add_shortcode( $this->tag, array( $this, 'render' ) );

		if ( $this->shortcake_support ) {
			$this->add_shortcake_support( );
		}
	}

	/**
	 * Combine the attributes gives us whit defaults attributes
	 *
	 * @since   2.1.0
	 *
	 * @param array $attributes
	 *
	 * @return mixed
	 */
	public function attributes( $attributes = array() ) {
		return shortcode_atts( $this->defaults, $attributes, $this->tag );
	}

	/**
	 * Display shortcode content
	 *
	 * @since   2.1.0
	 *
	 * @param array  $attributes
	 * @param string $content
	 *
	 * @return string
	 */
	public abstract function render( $attributes = array(), $content = '' );


	/**
	 * Allow shortcake support
	 * Just extend this method and call register_shortcode_ui function
	 *
	 * @since   2.2.0
	 */
	protected function add_shortcake_support( ) {}

	/**
	 * Register a UI for the Shortcode.
	 * Pass an array or args.
	 *
	 * @since   2.2.0
	 *
	 * @param $tag
	 * @param $args
	 */
	public function register_shortcode_ui( $args = array() ) {

		if ( ! function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
			return false;
		}

		shortcode_ui_register_for_shortcode(
			$this->tag,
			$args
		);

		return true;
	}
}
