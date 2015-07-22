<?php defined( 'ABSPATH' ) or die;

function custom_body_class_validate_is_numeric( $fieldvalue, $validator ) {
	return is_int( $fieldvalue ) || preg_match( '/^[0-9\.]+$/', $fieldvalue );
}
