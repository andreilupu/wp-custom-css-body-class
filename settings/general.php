<?php
//not used yet - moved them to a per gallery option
return array(
	'type'    => 'postbox',
	'label'   => 'General Settings',
	'options' => array(
		'allow_edit_on_post_page' => array(
			'label'          => __( 'Enable Custom Body Class Editor.(Disabling this will not remove the classes from front-end)', 'custom_body_class_txtd' ),
			'default'        => true,
			'type'           => 'switch',
		),
		'admins_only' => array(
			'label'          => __( 'Restrict for Administrators only', 'custom_body_class_txtd' ),
			'default'        => false,
			'type'           => 'switch',
		),
		'enable_autocomplete' => array(
			'label'          => __( 'Enable Autocomplete', 'custom_body_class_txtd' ),
			'default'        => true,
			'type'           => 'switch',
		),
		'global_class' => array(
			'label'          => __( 'Global Class', 'custom_body_class_txtd' ),
			'default'        => '',
			'type'           => 'text',
			'desc' => __( 'If you need a temporary CSS class on the entire website here is the place' ),
		),
		'display_on_post_types' => array(
			'label'          => __( 'Post Types', 'custom_body_class_txtd' ),
			'default'        => array('post' => 'on', 'page' => 'on'),
			'type'           => 'post_types_checkbox',
			'description' => __( 'Which post types should have fields' ),
		),

//		'display_on_taxonomies' => array(
//			'label'          => __( 'Taxonomies', 'custom_body_class_txtd' ),
//			'default'        => array( 'category' => 'on' ),
//			'type'           => 'taxonomies_checkbox',
//			'description' => __( 'Which taxonomies should have fields' ),
//		)
	)
); # config