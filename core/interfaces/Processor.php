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
interface CustomBodyClassProcessor {

	/**
	 * @return static $this
	 */
	function run();

	/**
	 * @return array
	 */
	function status();

	/**
	 * @return CustomBodyClassMeta current data (influenced by user submitted data)
	 */
	function data();

	/**
	 * Shorthand.
	 *
	 * @return array
	 */
	function errors();

	/**
	 * Shorthand.
	 *
	 * @return boolean
	 */
	function performed_update();

	/**
	 * @return boolean true if state is nominal
	 */
	function ok();

} # interface
