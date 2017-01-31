<?php
// //=============================================
// // Radio Button for Taxonomies
// //=============================================
// // Disable the "No term" option on a the "resource_type" taxonomy
// add_filter( "radio-buttons-for-taxonomies-no-term-event_category", "__return_FALSE" );
// add_filter( "radio-buttons-for-taxonomies-no-term-news_topic", "__return_FALSE" );
// add_filter( "radio-buttons-for-taxonomies-no-term-media_type", "__return_FALSE" );
// add_filter( "radio-buttons-for-taxonomies-no-term-media_category", "__return_FALSE" );
// add_filter( "radio-buttons-for-taxonomies-no-term-role", "__return_FALSE" );
//
// //==========================================================
// // Admin Columns Pro
// // Use the following code so column settings
// // apply to multisites
// //
// // Uncoment the action before pushing to prod
// // Use the GUI on dev since if using php GUI is disabled
// //==========================================================
// add_action( 'init', 'ac_custom_column_settings_c9cc5d77' );
// function ac_custom_column_settings_c9cc5d77() {
// 	if ( function_exists( 'ac_register_columns' ) ) {
// 		ac_register_columns( 'page', array(
// 			array(
// 				'columns' => array(
// 					'column-order' => array(
// 						'column-name' => 'column-order',
// 						'type' => 'column-order',
// 						'clone' => '',
// 						'label' => 'Order',
// 						'width' => '4',
// 						'width_unit' => '%',
// 						'edit' => 'on',
// 						'sort' => 'on'
// 					),
// 			'title' => array(
// 						'column-name' => 'title',
// 						'type' => 'title',
// 						'clone' => '',
// 						'label' => 'Title',
// 						'width' => '20',
// 						'width_unit' => '%',
// 						'edit' => 'off',
// 						'sort' => 'on'
// 					),
// 			'column-page_template' => array(
// 						'column-name' => 'column-page_template',
// 						'type' => 'column-page_template',
// 						'clone' => '',
// 						'label' => 'Template',
// 						'width' => '12',
// 						'width_unit' => '%',
// 						'edit' => 'off',
// 						'filter' => 'off',
// 						'sort' => 'on'
// 					),
// 			'column-acf_field' => array(
// 						'column-name' => 'column-acf_field',
// 						'type' => 'column-acf_field',
// 						'clone' => '',
// 						'label' => 'Overview',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'field' => 'field_576ce022e631e',
// 						'excerpt_length' => '15',
// 						'edit' => 'off',
// 						'sort' => 'on'
// 					)
// 				),
// 			)
// 		) );
// 		ac_register_columns( 'block', array(
// 			array(
// 				'columns' => array(
// 					'title' => array(
// 						'column-name' => 'title',
// 						'type' => 'title',
// 						'clone' => '',
// 						'label' => 'Title',
// 						'width' => '25',
// 						'width_unit' => '%',
// 						'edit' => 'off',
// 						'sort' => 'on'
// 					),
// 			'column-acf_field-1' => array(
// 						'column-name' => 'column-acf_field-1',
// 						'type' => 'column-acf_field',
// 						'clone' => '1',
// 						'label' => 'Description',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'field' => 'field_57715bb61788a',
// 						'excerpt_length' => '15',
// 						'edit' => 'off',
// 						'sort' => 'off'
// 					)
// 				),
// 			)
// 		) );
// 		ac_register_columns( 'event', array(
// 			array(
// 				'columns' => array(
// 					'title' => array(
// 						'column-name' => 'title',
// 						'type' => 'title',
// 						'clone' => '',
// 						'label' => 'Title',
// 						'width' => '20',
// 						'width_unit' => '%',
// 						'edit' => 'off',
// 						'sort' => 'on'
// 					),
// 			'taxonomy-event_category' => array(
// 						'column-name' => 'taxonomy-event_category',
// 						'type' => 'taxonomy-event_category',
// 						'clone' => '',
// 						'label' => 'Categories',
// 						'width' => '10',
// 						'width_unit' => '%'
// 					),
// 			'date' => array(
// 						'column-name' => 'date',
// 						'type' => 'date',
// 						'clone' => '',
// 						'label' => 'Start Date',
// 						'width' => '10',
// 						'width_unit' => '%',
// 						'edit' => 'off',
// 						'filter' => 'off',
// 						'sort' => 'on'
// 					),
// 			'column-acf_field' => array(
// 						'column-name' => 'column-acf_field',
// 						'type' => 'column-acf_field',
// 						'clone' => '',
// 						'label' => 'Advanced Custom Fields',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'field' => 'field_57ceadbc0b1c6_57bd72f5f6804',
// 						'sort' => 'on'
// 					)
// 				),
// 			)
// 		) );
// 		ac_register_columns( 'news', array(
// 			array(
// 				'columns' => array(
// 					'title' => array(
// 						'column-name' => 'title',
// 						'type' => 'title',
// 						'clone' => '',
// 						'label' => 'Title',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'edit' => 'off',
// 						'sort' => 'on'
// 					),
// 			'taxonomy-news_topic' => array(
// 						'column-name' => 'taxonomy-news_topic',
// 						'type' => 'taxonomy-news_topic',
// 						'clone' => '',
// 						'label' => 'News Topics',
// 						'width' => '',
// 						'width_unit' => '%'
// 					),
// 			'column-acf_field' => array(
// 						'column-name' => 'column-acf_field',
// 						'type' => 'column-acf_field',
// 						'clone' => '',
// 						'label' => 'Overview',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'field' => 'field_57e383efb2d6e',
// 						'excerpt_length' => '15',
// 						'edit' => 'off',
// 						'sort' => 'on'
// 					),
// 			'date' => array(
// 						'column-name' => 'date',
// 						'type' => 'date',
// 						'clone' => '',
// 						'label' => 'Published On',
// 						'width' => '10',
// 						'width_unit' => '%',
// 						'edit' => 'off',
// 						'filter' => 'off',
// 						'sort' => 'on'
// 					)
// 				),
// 			)
// 		) );
// 		ac_register_columns( 'person', array(
// 			array(
// 				'columns' => array(
// 					'title' => array(
// 						'column-name' => 'title',
// 						'type' => 'title',
// 						'clone' => '',
// 						'label' => 'Title',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'edit' => 'off',
// 						'sort' => 'on'
// 					),
// 			'taxonomy-role' => array(
// 						'column-name' => 'taxonomy-role',
// 						'type' => 'taxonomy-role',
// 						'clone' => '',
// 						'label' => 'Roles',
// 						'width' => '',
// 						'width_unit' => '%'
// 					),
// 			'column-acf_field' => array(
// 						'column-name' => 'column-acf_field',
// 						'type' => 'column-acf_field',
// 						'clone' => '',
// 						'label' => 'Title',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'field' => 'field_575faacb00736',
// 						'excerpt_length' => '15',
// 						'edit' => 'off',
// 						'sort' => 'on'
// 					),
// 			'column-acf_field-1' => array(
// 						'column-name' => 'column-acf_field-1',
// 						'type' => 'column-acf_field',
// 						'clone' => '1',
// 						'label' => 'Email',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'field' => 'field_575faa4800735',
// 						'edit' => 'off',
// 						'filter' => 'off',
// 						'sort' => 'on'
// 					)
// 				),
// 			)
// 		) );
// 		ac_register_columns( 'resource', array(
// 			array(
// 				'columns' => array(
// 					'title' => array(
// 						'column-name' => 'title',
// 						'type' => 'title',
// 						'clone' => '',
// 						'label' => 'Title',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'edit' => 'off',
// 						'sort' => 'on'
// 					),
// 			'taxonomy-media_type' => array(
// 						'column-name' => 'taxonomy-media_type',
// 						'type' => 'taxonomy-media_type',
// 						'clone' => '',
// 						'label' => 'Media Type',
// 						'width' => '',
// 						'width_unit' => '%'
// 					),
// 			'taxonomy-media_category' => array(
// 						'column-name' => 'taxonomy-media_category',
// 						'type' => 'taxonomy-media_category',
// 						'clone' => '',
// 						'label' => 'Media Categories',
// 						'width' => '',
// 						'width_unit' => '%'
// 					),
// 			'date' => array(
// 						'column-name' => 'date',
// 						'type' => 'date',
// 						'clone' => '',
// 						'label' => 'Published On',
// 						'width' => '10',
// 						'width_unit' => '%',
// 						'edit' => 'off',
// 						'filter' => 'off',
// 						'sort' => 'on'
// 					)
// 				),
// 			)
// 		) );
// 		ac_register_columns( 'wp-taxonomy_event_category', array(
// 			array(
// 				'columns' => array(
// 					'name' => array(
// 						'column-name' => 'name',
// 						'type' => 'name',
// 						'clone' => '',
// 						'label' => 'Name',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'edit' => 'off'
// 					),
// 			'description' => array(
// 						'column-name' => 'description',
// 						'type' => 'description',
// 						'clone' => '',
// 						'label' => 'Description',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'edit' => 'off'
// 					),
// 			'column-acf_field' => array(
// 						'column-name' => 'column-acf_field',
// 						'type' => 'column-acf_field',
// 						'clone' => '',
// 						'label' => 'Color',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'field' => 'field_57d64fab2d7a8',
// 						'edit' => 'off'
// 					),
// 			'posts' => array(
// 						'column-name' => 'posts',
// 						'type' => 'posts',
// 						'clone' => '',
// 						'label' => 'Count',
// 						'width' => '',
// 						'width_unit' => '%'
// 					)
// 				),
// 			)
// 		) );
// 		ac_register_columns( 'wp-taxonomy_media_type', array(
// 			array(
// 				'columns' => array(
// 					'name' => array(
// 						'column-name' => 'name',
// 						'type' => 'name',
// 						'clone' => '',
// 						'label' => 'Name',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'edit' => 'off'
// 					),
// 			'description' => array(
// 						'column-name' => 'description',
// 						'type' => 'description',
// 						'clone' => '',
// 						'label' => 'Description',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'edit' => 'off'
// 					),
// 			'column-acf_field' => array(
// 						'column-name' => 'column-acf_field',
// 						'type' => 'column-acf_field',
// 						'clone' => '',
// 						'label' => 'Color',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'field' => 'field_57fb61974f758',
// 						'edit' => 'off'
// 					),
// 			'posts' => array(
// 						'column-name' => 'posts',
// 						'type' => 'posts',
// 						'clone' => '',
// 						'label' => 'Count',
// 						'width' => '',
// 						'width_unit' => '%'
// 					)
// 				),
// 			)
// 		) );
// 		ac_register_columns( 'wp-taxonomy_media_category', array(
// 			array(
// 				'columns' => array(
// 					'name' => array(
// 						'column-name' => 'name',
// 						'type' => 'name',
// 						'clone' => '',
// 						'label' => 'Name',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'edit' => 'off'
// 					),
// 			'description' => array(
// 						'column-name' => 'description',
// 						'type' => 'description',
// 						'clone' => '',
// 						'label' => 'Description',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'edit' => 'off'
// 					),
// 			'posts' => array(
// 						'column-name' => 'posts',
// 						'type' => 'posts',
// 						'clone' => '',
// 						'label' => 'Count',
// 						'width' => '',
// 						'width_unit' => '%'
// 					)
// 				),
// 			)
// 		) );
// 		ac_register_columns( 'wp-taxonomy_role', array(
// 			array(
// 				'columns' => array(
// 					'name' => array(
// 						'column-name' => 'name',
// 						'type' => 'name',
// 						'clone' => '',
// 						'label' => 'Name',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'edit' => 'off'
// 					),
// 			'description' => array(
// 						'column-name' => 'description',
// 						'type' => 'description',
// 						'clone' => '',
// 						'label' => 'Description',
// 						'width' => '',
// 						'width_unit' => '%',
// 						'edit' => 'off'
// 					),
// 			'posts' => array(
// 						'column-name' => 'posts',
// 						'type' => 'posts',
// 						'clone' => '',
// 						'label' => 'Count',
// 						'width' => '',
// 						'width_unit' => '%'
// 					)
// 				),
// 			)
// 		) );
// 	}
// }
