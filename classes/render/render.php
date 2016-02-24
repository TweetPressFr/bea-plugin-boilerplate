<?php
namespace BEA\PB\Renders;

/**
 * This class is the base class of Render
 * The aim is to only use render functions in a view (generally in your theme) like the_title, etc
 * By default, it uses a WP_Post object, but this class can be extended
 *
 * Class Render
 *
 * @package BEA\PB\Renders
 * @since   2.2.0
 */
class Render {

	/**
	 * The Model instance
	 * @var $model_instance
	 * @since   2.2.0
	 */
	protected $model_instance;

	/**
	 * The WP Post object
	 * @var \WP_Post $wp_object
	 * @since   2.2.0
	 */
	public $wp_object;

	/**
	 * @param $model : Instance of a given Model
	 */
	function __construct( $model = null ) {
		if ( is_null( $model ) ) {
			return false;
		}
		$this->model_instance = $model;
		$this->wp_object = $model->wp_object; // WP_Post
	}

	/**
	 * Default the_ID function for a WP_Post object
	 * @since   2.2.0
	 *
	 * @return int
	 */
	protected function the_ID() {
		return $this->model_instance->ID;
	}

	/**
	 * Default the_title function for a WP_Post object
	 * @since   2.2.0
	 *
	 * @return string
	 */
	protected function the_title() {
		return get_the_title( $this->wp_object );
	}

}
