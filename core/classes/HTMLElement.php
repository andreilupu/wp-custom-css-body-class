<?php defined( 'ABSPATH' ) or die;

/* This file is property of Pixel Grade Media. You may NOT copy, or redistribute
 * it. Please see the license that came with your copy for more information.
 */

/**
 * A HTMLElement is a HTMLTag with meta support integrated into it. A normal
 * HTMLTag only cares for it's attributes meta and nothing else, but more
 * specialized tags such as forms or form fields require misc metadata to be
 * attached on the object itself.
 *
 * @package    custom_body_class
 * @category   core
 * @author     Pixel Grade Team
 * @copyright  (c) 2013, Pixel Grade Media
 */
class CustomBodyClassHTMLElementImpl extends CustomBodyClassHTMLTagImpl implements CustomBodyClassHTMLElement {

	/** @var array configuration values */
	protected $meta = null;

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
		// gurantee configuration
		$config !== null or $config = array();

		// invoke htmltag instance configuration
		if ( isset( $config['attrs'] ) ) {
			parent::configure( $config['attrs'] );
			unset( $config['attrs'] );
		} else { // no html attributes set
			parent::configure( array() );
		}

		// setup meta fields
		$this->meta = custom_body_class::instance( 'CustomBodyClassMeta', $config );
	}


	// Meta
	// ------------------------------------------------------------------------

	/**
	 * @param string meta key
	 *
	 * @return boolean true if key exists, false otherwise
	 */
	function hasmeta( $key ) {
		return $this->meta->has( $key );
	}

	/**
	 * @return mixed value or default
	 */
	function getmeta( $key, $default = null ) {
		return $this->meta->get( $key, $default );
	}

	/**
	 * @return static $this
	 */
	function setmeta( $key, $value ) {
		$this->meta->set( $key, $value );

		return $this;
	}

	/**
	 * Set the key if it's not already set.
	 *
	 * @param string key
	 * @param string value
	 */
	function ensuremeta( $key, $value ) {
		$this->meta->ensure( $key, $value );

		return $this;
	}

	/**
	 * If the key is currently a non-array value it will be converted to an
	 * array maintaning the previous value (along with the new one).
	 *
	 * @param  string name
	 * @param  mixed  value
	 *
	 * @return static $this
	 */
	function addmeta( $name, $value ) {
		$this->meta->add( $name, $value );

		return $this;
	}

	/**
	 * @return CustomBodyClassMeta
	 */
	function meta() {
		return $this->meta;
	}

} # class
