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
interface CustomBodyClassForm extends CustomBodyClassHTMLElement {

	/**
	 * @return static $this
	 */
	function addtemplatepath( $path );

	/**
	 * @return CustomBodyClassFormField
	 */
	function field( $fieldname );

	/**
	 * @return static $this
	 */
	function errors( $errors );

	/**
	 * @param string field name
	 *
	 * @return array error keys with messages
	 */
	function errors_for( $fieldname );

	/**
	 * Autocomplete meta object passed on by the processor.
	 *
	 * @param CustomBodyClassMeta autocomplete values
	 *
	 * @return static $this
	 */
	function autocomplete( CustomBodyClassMeta $autocomplete );

	/**
	 * Retrieves the value registered for auto-complete. This will not fallback
	 * to the default value set in the configuration since fields are
	 * responsible for managing their internal complexity.
	 *
	 * Typically the autocomplete values are what the processor passes on to
	 * the form.
	 *
	 * @return mixed
	 */
	function autovalue( $key, $default = null );

	/**
	 * @return string
	 */
	function startform();

	/**
	 * @return string
	 */
	function endform();

	/**
	 * @param string template path
	 * @param array  configuration
	 *
	 * @return string
	 */
	function fieldtemplate( $templatepath, $conf = array() );

} # interface
