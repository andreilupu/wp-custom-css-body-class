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
class CustomBodyClassFormImpl extends CustomBodyClassHTMLElementImpl implements CustomBodyClassForm {

	/** @var array templates */
	protected $fields = null;

	/**
	 * @param array config
	 */
	static function instance( $config = null ) {
		$i = new self;
		$i->configure( $config );

		return $i;
	}

	/**
	 * Apply configuration.
	 */
	protected function configure( $config = null ) {
		if ( $config === null ) {
			$config = array( 'template-paths' => array(), 'fields' => array() );
		}

		// setup errors
		$this->errors = array();

		// setup default autocomplete
		$this->autocomplete = custom_body_class::instance( 'CustomBodyClassMeta', array() );

		// setup fields
		$this->fields = custom_body_class::instance( 'CustomBodyClassMeta', $config['fields'] );
		unset( $config['fields'] );

		// invoke htmltag instance configuration
		parent::configure( $config );

		// setup paths
		$this->setmeta( 'template-paths', $config['template-paths'] );

		// @todo CLEANUP the empty action should redirect to the same page but
		// it's probably wiser to explicitly provide the right page url
		$this->set( 'action', '' );
		$this->set( 'method', 'POST' );
	}

	/**
	 * Shorthand.
	 *
	 * @return static $this
	 */
	function addtemplatepath( $path ) {
		return $this->addmeta( 'template-paths', $path );
	}

	/**
	 * Note: the field configuration parameter is indented for use when
	 * invoking fields as part of creating other fields (ie. embeded field
	 * configuration inside custom fields). It is not meant for overwriting
	 * configuration and will not accept partial configuration; albeit the
	 * minimal field configuration is fairly minimal.
	 *
	 * @param string field name
	 * @param array  complete field configuration
	 *
	 * @return string
	 */
	function field( $fieldname, $fieldconfig = null ) {
		if ( $fieldconfig === null ) {
			$fieldconfig = $this->fields->get( $fieldname );
		}

		return custom_body_class::instance( 'CustomBodyClassFormField', $fieldconfig )
		                ->setmeta( 'form', $this )
		                ->setmeta( 'name', $fieldname );
	}

	// Errors
	// ------------------------------------------------------------------------

	/** @var array field errors */
	protected $errors = null;

	/**
	 * @return static $this
	 */
	function errors( $errors ) {
		$this->errors = $errors;

		return $this;
	}

	/**
	 * @param string field name
	 *
	 * @return array error keys with messages
	 */
	function errors_for( $fieldname ) {
		if ( isset( $this->errors[ $fieldname ] ) ) {
			return $this->errors[ $fieldname ];
		} else { // no errors set
			return array();
		}
	}


	// Autocomplete
	// ------------------------------------------------------------------------

	/** @var CustomBodyClassMeta autocomplete */
	protected $autocomplete = null;

	/**
	 * Autocomplete meta object passed on by the processor.
	 *
	 * @param CustomBodyClassMeta autocomplete values
	 *
	 * @return static $this
	 */
	function autocomplete( CustomBodyClassMeta $autocomplete ) {
		$this->autocomplete = $autocomplete;

		return $this;
	}

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
	function autovalue( $key, $default = null ) {
		return $this->autocomplete->get( $key, $default );
	}

	// Rendering
	// ------------------------------------------------------------------------

	/**
	 * @return string
	 */
	function __toString() {
		return $this->startform();;
	}

	/**
	 * @return string
	 */
	function startform() {
		return "<form {$this->htmlattributes()}>";
	}

	/**
	 * @return string
	 */
	function endform() {
		return '</form>';
	}

	/**
	 * @param string template path
	 * @param array  configuration
	 *
	 * @return string
	 */
	function fieldtemplate( $templatepath, $conf = array() ) {
		$config = custom_body_class::instance( 'CustomBodyClassMeta', $conf );

		return $this->fieldtemplate_render( $templatepath, $config );
	}

	/**
	 * @param string template path
	 * @param CustomBodyClassMeta configuration
	 *
	 * @return string
	 */
	protected function fieldtemplate_render( $_template_path, CustomBodyClassMeta $conf ) {
		// variables which we wish to expose to template
		$form = $this; # $this will also work

		ob_start();
		include $_template_path;

		return ob_get_clean();
	}

} # class
