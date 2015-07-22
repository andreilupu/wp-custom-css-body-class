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
interface CustomBodyClassHTMLElement extends CustomBodyClassHTMLTag {

	/**
	 * @param string meta key
	 *
	 * @return boolean true if key exists, false otherwise
	 */
	function hasmeta( $key );

	/**
	 * @return mixed value or default
	 */
	function getmeta( $key, $default = null );

	/**
	 * @return static $this
	 */
	function setmeta( $key, $value );

	/**
	 * Set the key if it's not already set.
	 *
	 * @param string key
	 * @param string value
	 */
	function ensuremeta( $key, $value );

	/**
	 * If the key is currently a non-array value it will be converted to an
	 * array maintaning the previous value (along with the new one).
	 *
	 * @param  string name
	 * @param  mixed  value
	 *
	 * @return static $this
	 */
	function addmeta( $name, $value );

	/**
	 * @return CustomBodyClassMeta form meta
	 */
	function meta();

} # interface
