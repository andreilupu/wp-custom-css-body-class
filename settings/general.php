<?php
//not used yet - moved them to a per gallery option
return array(
	'type'    => 'postbox',
	'label'   => 'General Settings',
	'options' => array(
		'allow_edit_on_post_page' => array(
			'label'          => esc_html__( 'Enable Custom Body Class Editor.(Disabling this will not remove the classes from front-end)', 'wp-custom-body-class' ),
			'default'        => true,
			'type'           => 'switch',
		),
		'admins_only' => array(
			'label'          => esc_html__( 'Restrict for Administrators only', 'wp-custom-body-class' ),
			'default'        => false,
			'type'           => 'switch',
		),
		'enable_autocomplete' => array(
			'label'          => esc_html__( 'Enable Autocomplete', 'wp-custom-body-class' ),
			'default'        => true,
			'type'           => 'switch',
		),
		'global_class' => array(
			'label'          => esc_html__( 'Global Class', 'wp-custom-body-class' ),
			'default'        => '',
			'type'           => 'text',
			'desc'           => esc_html__( 'If you need a temporary CSS class on the entire website here is the place' ),
		),
		'display_on_post_types' => array(
			'label'          => esc_html__( 'Post Types', 'wp-custom-body-class' ),
			'default'        => array('post' => 'on', 'page' => 'on'),
			'type'           => 'post_types_checkbox',
			'description' => esc_html__( 'Which post types should have fields' ),
		),

//		'display_on_taxonomies' => array(
//			'label'          => esc_html__( 'Taxonomies', 'wp-custom-body-class' ),
//			'default'        => array( 'category' => 'on' ),
//			'type'           => 'taxonomies_checkbox',
//			'description' => esc_html__( 'Which taxonomies should have fields' ),
//		)
	)
); # config