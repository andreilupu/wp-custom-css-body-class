<?php defined( 'ABSPATH' ) or die;

function custom_body_class_cleanup_switch_not_available( $fieldvalue, $meta, $processor ) {
	return $fieldvalue !== null ? $fieldvalue : false;
}
