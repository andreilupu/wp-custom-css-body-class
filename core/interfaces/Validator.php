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
interface CustomBodyClassValidator {

	/**
	 * @return array errors
	 */
	function validate( $input );

	/**
	 * @param string rule
	 *
	 * @return string error message
	 */
	function error_message( $rule );

} # interface
