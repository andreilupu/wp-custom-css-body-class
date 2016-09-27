<?php
/**
 * CustomBodyClass.
 * @package   CustomBodyClass
 * @author    Andrei Lupu <andrei.lupu@pixelgrade.com>
 * @license   GPL-2.0+
 * @link      http://andrei-lupu.com
 * @copyright 2014 Andrei Lupu
 */

/**
 * Plugin class.
 * @package   CustomBodyClass
 * @author    Andrei Lupu <andrei.lupu@pixelgrade.com>
 */
class CustomBodyClassPlugin {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 * @since   1.0.0
	 * @const   string
	 */
	protected $version = '0.4.0';

	/**
	 * Unique identifier for your plugin.
	 * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
	 * match the Text Domain file header in the main plugin file.
	 * @since    1.0.0
	 * @var      string
	 */
	protected $plugin_slug = 'custom_body_class';

	/**
	 * Instance of this class.
	 * @since    1.0.0
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 * @since    1.0.0
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Path to the plugin.
	 * @since    1.0.0
	 * @var      string
	 */
	protected $plugin_basepath = null;

	public $display_admin_menu = false;

	protected $config;

	public $plugin_settings = null;

	/**
	 * Initialize the plugin by setting localization, filters, and administration functions.
	 * @since     1.0.0
	 */
	protected function __construct() {

		$this->plugin_basepath = plugin_dir_path( __FILE__ );
		$this->config          = self::config();

		$this->get_plugin_settings();


		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __FILE__ ) . 'custom_body_class.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		if ( isset( $this->plugin_settings['allow_edit_on_post_page'] ) && $this->plugin_settings['allow_edit_on_post_page'] ) {

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );

			// add the metabox
			add_action( 'add_meta_boxes', array( $this, 'add_custom_body_class_meta_box' ) );
			add_action( 'save_post', array( $this, 'custom_body_class_save_meta_data' ) );
		}

		add_filter( 'body_class', array( $this, 'add_post_type_custom_body_class_in_front' ) );
	}


	/**
	 * Settings page scripts
	 */
	function enqueue_admin_assets() {

		$screen = get_current_screen();
		if ( is_admin() && $this->is_edit_page() ) {
			wp_enqueue_style( $this->plugin_slug . '-admin-style', plugins_url( 'css/admin-custom-body-class.css', __FILE__ ), array(), $this->version );
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin-custom-body-class.js', __FILE__ ), array(
				'jquery',
				'jquery-ui-autocomplete'
			), $this->version );
			global $post;
			if ( isset( $this->plugin_settings['enable_autocomplete'] ) && $this->plugin_settings['enable_autocomplete'] ) {
				$values = $this->get_unique_post_meta_values();
//				if ( ! empty ( $values ) ) {
				$val = wp_localize_script( $this->plugin_slug . '-admin-script', 'custom_body_class_post_values', $values );
//				}
			}
		}
	}


	/**
	 * Return an instance of this class.
	 * @since     1.0.0
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public static function config() {
		// @TODO maybe check this
		return include 'plugin-config.php';
	}

	/**
	 * Load the plugin text domain for translation.
	 * @since    1.0.0
	 */
	function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, false, basename( dirname( __FILE__ ) ) . '/lang/' );
	}

	function is_edit_page( $new_edit = null ) {
		global $pagenow;
		//make sure we are on the backend
		if ( ! is_admin() ) {
			return false;
		}


		if ( $new_edit == "edit" ) {
			return in_array( $pagenow, array( 'post.php', ) );
		} elseif ( $new_edit == "new" ) //check for new post page
		{
			return in_array( $pagenow, array( 'post-new.php' ) );
		} else //check for either new or edit
		{
			return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
		}
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 */
	function add_plugin_admin_menu() {
		$this->plugin_screen_hook_suffix = add_options_page( __( 'Custom Body Class', $this->plugin_slug ), __( 'Custom Body Class', $this->plugin_slug ), 'manage_options', $this->plugin_slug, array(
			$this,
			'display_plugin_admin_page'
		) );
	}

	/**
	 * Render the settings page for this plugin.
	 */
	function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 */
	function add_action_links( $links ) {
		return array_merge( array( 'settings' => '<a href="' . admin_url( 'options-general.php?page=custom_body_class' ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>' ), $links );
	}

	/**
	 * Adds a box to the main column on any post type checked in settings
	 */
	function add_custom_body_class_meta_box() {

		if ( ! isset( $this->plugin_settings['display_on_post_types'] ) || empty( $this->plugin_settings['display_on_post_types'] ) ) {
			return;
		}

		foreach ( $this->plugin_settings['display_on_post_types'] as $post_type => $val ) {

			// Make a nice metabox title
			$post_type_obj  = get_post_type_object( $post_type );
			$post_type_name = $post_type;
			if ( $post_type_obj !== null ) {
				$post_type_name = $post_type_obj->labels->singular_name;
			}

			add_meta_box(
				'custom_body_class',
				$post_type_name . __( ' classes', 'custom_body_class_txtd' ),
				array( $this, 'custom_body_class_meta_box_callback' ),
				$post_type,
				'side'
			);
		}
	}

	function custom_body_class_meta_box_callback( $post ) {
		// Add a nonce field so we can check for it later.
		wp_nonce_field( 'custom_body_class_meta_box', 'custom_body_class_meta_box_nonce' );

		/*
		 * Use get_post_meta() to retrieve an existing value
		 * from the database and use the value for the form.
		 */
		$value = get_post_meta( $post->ID, '_custom_body_class', true );

		echo '<label for="body_class_new_field">';
		echo '</label> ';

		echo '<input type="text" id="custom_body_class_value" name="custom_body_class_value" value="' . esc_attr( $value ) . '" size="32" />';
	}

	/**
	 * When the post is saved, saves our custom data.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	function custom_body_class_save_meta_data( $post_id ) {
		/*
		 * We need to verify this came from our screen and with proper authorization,
		 * because the save_post action can be triggered at other times.
		 */

		// Check if our nonce is set and if it's valid.
		if ( ! isset( $_POST['custom_body_class_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['custom_body_class_meta_box_nonce'], 'custom_body_class_meta_box' ) ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}

		} else {

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		/* OK, it's safe for us to save the data now. */

		// Make sure that it is set.
		if ( ! isset( $_POST['custom_body_class_value'] ) ) {
			return;
		}

		global $post;

		$old_value = get_post_meta( $post_id, '_custom_body_class', true );

		// if the value is empty just clear the field
		if ( empty( $_POST['custom_body_class_value'] ) ) {
			update_post_meta( $post_id, '_custom_body_class', '', $old_value );

			return;
		}

		$classes_array = explode( ' ', $_POST['custom_body_class_value'] );

		foreach ( $classes_array as $key => $class ) {
			$classes_array[ $key ] = sanitize_html_class( $class );
		}

		$sanitized_value = implode( ' ', $classes_array );

		if ( ! empty( $sanitized_value ) ) {
			update_post_meta( $post_id, '_custom_body_class', $sanitized_value, $old_value );
		}
	}

	function add_post_type_custom_body_class_in_front( $classes ) {

		if ( is_singular() ) {
			global $post;

			if ( isset ( $post->ID ) ) {
				$class_string = get_post_meta( $post->ID, '_custom_body_class', true );

				if ( ! empty( $class_string ) ) {
					$classes_array = explode( ' ', $class_string );

					foreach ( $classes_array as $key => $class ) {
						// check if we are in mobile side
						if ( wp_is_mobile() ) {
							// if on mobile but there's no mobile- class, we simply add it
							if ( false === strpos( $class, 'mobile-' ) ) {
								$classes[] = sanitize_html_class( $class );
							} else {
								// if on mobile and have mobile- class, we remove the mobile- part and just add it
								$class = str_replace('mobile-', '', $class);
								$classes[] = sanitize_html_class( $class );
							}
						} else {
							// we're on the computer and we need to add just the classes without mobile-
							if ( false === strpos( $class, 'mobile-' ) ) {
								$classes[] = sanitize_html_class( $class );
							}
						}
					}
				}
			}
		}

		// return the $classes array
		return $classes;
	}

	function ajax_no_access() {
		echo 'you have no access here';
		die();
	}

	function get_unique_post_meta_values( $key = '_custom_body_class', $type = 'nav', $status = '*' ) {
		global $wpdb;
		if ( empty( $key ) ) {
			return;
		}
		$res = $wpdb->get_col( $wpdb->prepare( "
SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
WHERE pm.meta_key = '%s'
AND p.post_type != '%s'
", $key, $type ) );

		$rezult = array();
		if ( ! empty( $res ) ) {
			foreach ( $res as $k => $val ) {
				$values = explode( ' ', $val );

				if ( ! empty( $values ) ) {
					foreach ( $values as $i => $value ) {
						if ( ! in_array( $value, $rezult ) ) {
							$rezult[] = $value;
						}
					}
				}
			}
		}

		return $rezult;
	}

	function get_the_post_id( $id, $post_type = 'post' ) {
		if ( function_exists( 'icl_object_id' ) ) {
			return icl_object_id( $id, $post_type, true );
		} else {
			return $id;
		}
	}

	public function get_plugin_settings() {

		if ( $this->plugin_settings === null ) {
			$this->plugin_settings = get_option( 'custom_body_class_settings' );
		}

		return $this->plugin_settings;
	}

	static function get_base_path() {
		return plugin_dir_path( __FILE__ );
	}
}
