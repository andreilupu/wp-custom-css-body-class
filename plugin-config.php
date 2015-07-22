<?php defined( 'ABSPATH' ) or die;

$basepath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

$debug = false;
if ( isset( $_GET['debug'] ) && $_GET['debug'] == 'true' ) {
	$debug = true;
}
$debug   = true;
$options = get_option( 'custom_body_class_settings' );

$display_settings = false;

if ( isset( $options['display_settings'] ) ) {
	$display_settings = $options['display_settings'];
}

return array
(
	'plugin-name'    => 'custom_body_class',
	'settings-key'   => 'custom_body_class_settings',
	'textdomain'     => 'custom_body_class_txtd',
	'template-paths' => array
	(
		$basepath . 'core/views/form-partials/',
		$basepath . 'views/form-partials/',
	),
	'fields'         => array
	(
		'hiddens'
		=> include 'settings/hiddens' . EXT,
		'general'
		=> include 'settings/general' . EXT,
	),
	'processor'      => array
	(
		// callback signature: (array $input, PixtypesProcessor $processor)

		'preupdate'  => array
		(
			// callbacks to run before update process
			// cleanup and validation has been performed on data
			'save_settings'
		),
		'postupdate' => array
		(

		),
	),
	'cleanup'        => array
	(
		'switch' => array( 'switch_not_available' ),
	),
	'checks'         => array
	(
		'counter' => array( 'is_numeric', 'not_empty' ),
	),
	'errors'         => array
	(
		'not_empty' => __( 'Invalid Value.', custom_body_class::textdomain() ),
	),
	'callbacks'      => array
	(
		'save_settings' => 'save_custom_body_class_settings'
	),
	// shows exception traces on error
	'debug'          => $debug,

); # config
