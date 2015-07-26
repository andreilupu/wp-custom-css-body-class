<?php
//not used yet - moved them to a per gallery option
return array(
	'type'    => 'postbox',
	'label'   => 'General Settings',
	'options' => array(
		'allow_edit_on_post_page' => array(
			'label'          => __( 'Allow Edit Fields', 'custom_body_class_txtd' ),
			'default'        => true,
			'type'           => 'switch',
			'desc' => __( 'Here you can decide if the body class meta box is visible to editors' ),
		),
		'display_on_post_types' => array(
			'label'          => __( 'Post Types', 'custom_body_class_txtd' ),
			'default'        => array('post' => 'on', 'page' => 'on'),
			'type'           => 'post_types_checkbox',
			'description' => __( 'Which post types should have fields' ),
		)
	)
); # config