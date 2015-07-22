<?php defined( 'ABSPATH' ) or die;

/* This file is property of Pixel Grade Media. You may NOT copy, or redistribute
 * it. Please see the license that came with your copy for more information.
 */

/**
 * @package    custom_body_class
 * @category   core
 * @author     Pixel Grade Team
 * @copyright  (c) 2013, Pixel Grade Media
 */
interface CustomBodyClassMeta {

	/**
	 * @param string meta key
	 *
	 * @return boolean true if key exists, false otherwise
	 */
	function has( $key );

	/**
	 * @return mixed value or default
	 */
	function get( $key, $default = null );

	/**
	 * @return static $this
	 */
	function set( $key, $value );

	/**
	 * Set the key if it's not already set.
	 *
	 * @param string key
	 * @param string value
	 */
	function ensure( $key, $value );

	/**
	 * If the key is currently a non-array value it will be converted to an
	 * array maintaning the previous value (along with the new one).
	 *
	 * @param  string name
	 * @param  mixed  value
	 *
	 * @return static $this
	 */
	function add( $name, $value );

	/**
	 * @return array all metadata as array
	 */
	function metadata_array();

	/**
	 * Shorthand for a calling set on multiple keys.
	 *
	 * @return static $this
	 */
	function overwritemeta( $overwrites );

} # interface
