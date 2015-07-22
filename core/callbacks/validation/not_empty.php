<?php defined( 'ABSPATH' ) or die;

function custom_body_class_validate_not_empty( $fieldvalue, $processor ) {
	return ! empty( $fieldvalue );
}
