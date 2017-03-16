<?php
//=============================================
// Radio Button for Taxonomies
//=============================================
// Disable the "No term" option on a the "resource_type" taxonomy
add_filter( "radio-buttons-for-taxonomies-no-term-campus", "__return_FALSE" );

//==========================================================
// Admin Columns Pro
// Use the following code so column settings
// apply to multisites
//
// Uncoment the action before pushing to prod
// Use the GUI on dev since if using php GUI is disabled
//==========================================================
function ac_custom_column_settings_be6a174b() {

	if ( function_exists( 'ac_register_columns' ) ) {
		ac_register_columns( 'page', array(
			array(
				'columns' => array(
					'column-order' => array(
						'column-name' => 'column-order',
						'type' => 'column-order',
						'clone' => '',
						'label' => 'Order',
						'width' => '8',
						'width_unit' => '%',
						'edit' => 'on',
						'sort' => 'off'
					),
			'title' => array(
						'column-name' => 'title',
						'type' => 'title',
						'clone' => '',
						'label' => 'Title',
						'width' => '',
						'width_unit' => '%',
						'edit' => 'off',
						'sort' => 'on'
					),
			'column-page_template' => array(
						'column-name' => 'column-page_template',
						'type' => 'column-page_template',
						'clone' => '',
						'label' => 'Template',
						'width' => '',
						'width_unit' => '%',
						'edit' => 'off',
						'filter' => 'off',
						'sort' => 'off'
					),
			'column-acf_field' => array(
						'column-name' => 'column-acf_field',
						'type' => 'column-acf_field',
						'clone' => '',
						'label' => 'Overview',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_576ce022e631e',
						'excerpt_length' => '10',
						'edit' => 'off',
						'sort' => 'off'
					),
			'column-modified' => array(
						'column-name' => 'column-modified',
						'type' => 'column-modified',
						'clone' => '',
						'label' => 'Last modified',
						'width' => '',
						'width_unit' => '%',
						'date_format' => 'd M y',
						'sort' => 'off'
					)
				),
			)
		) );
		ac_register_columns( 'block', array(
			array(
				'columns' => array(
					'title' => array(
						'column-name' => 'title',
						'type' => 'title',
						'clone' => '',
						'label' => 'Title',
						'width' => '',
						'width_unit' => '%',
						'edit' => 'off',
						'sort' => 'on'
					),
			'column-acf_field' => array(
						'column-name' => 'column-acf_field',
						'type' => 'column-acf_field',
						'clone' => '',
						'label' => 'Description',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_589c3344f996c',
						'edit' => 'off',
						'filter' => 'off',
						'sort' => 'off'
					)
				),
			)
		) );
		ac_register_columns( 'voice', array(
			array(
				'columns' => array(
					'title' => array(
						'column-name' => 'title',
						'type' => 'title',
						'clone' => '',
						'label' => 'Title',
						'width' => '',
						'width_unit' => '%',
						'edit' => 'off',
						'sort' => 'on'
					),
			'column-acf_field' => array(
						'column-name' => 'column-acf_field',
						'type' => 'column-acf_field',
						'clone' => '',
						'label' => 'Testimony',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_58b44c2ede82b',
						'excerpt_length' => '10',
						'edit' => 'off',
						'sort' => 'off'
					),
			'column-acf_field-1' => array(
						'column-name' => 'column-acf_field-1',
						'type' => 'column-acf_field',
						'clone' => '1',
						'label' => 'Author Info',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_58b44c6cde82d',
						'edit' => 'off',
						'filter' => 'off',
						'sort' => 'off'
					),
			'date' => array(
						'column-name' => 'date',
						'type' => 'date',
						'clone' => '',
						'label' => 'Date',
						'width' => '10',
						'width_unit' => '%',
						'edit' => 'off',
						'filter' => 'off',
						'sort' => 'on'
					)
				),
			)
		) );
		ac_register_columns( 'event', array(
			array(
				'columns' => array(
					'title' => array(
						'column-name' => 'title',
						'type' => 'title',
						'clone' => '',
						'label' => 'Title',
						'width' => '',
						'width_unit' => '%',
						'edit' => 'off',
						'sort' => 'on'
					),
			'column-taxonomy' => array(
						'column-name' => 'column-taxonomy',
						'type' => 'column-taxonomy',
						'clone' => '',
						'label' => 'Campus',
						'width' => '',
						'width_unit' => '%',
						'taxonomy' => 'campus',
						'edit' => 'off',
						'enable_term_creation' => 'off',
						'filter' => 'off',
						'sort' => 'off'
					),
			'column-date_published' => array(
						'column-name' => 'column-date_published',
						'type' => 'column-date_published',
						'clone' => '',
						'label' => 'Event Start Date',
						'width' => '',
						'width_unit' => '%',
						'date_format' => 'd M Y',
						'edit' => 'off',
						'sort' => 'off'
					)
				),
			)
		) );
		ac_register_columns( 'news', array(
			array(
				'columns' => array(
					'title' => array(
						'column-name' => 'title',
						'type' => 'title',
						'clone' => '',
						'label' => 'Title',
						'width' => '',
						'width_unit' => '%',
						'edit' => 'off',
						'sort' => 'on'
					),
			'column-taxonomy' => array(
						'column-name' => 'column-taxonomy',
						'type' => 'column-taxonomy',
						'clone' => '',
						'label' => 'Campus',
						'width' => '',
						'width_unit' => '%',
						'taxonomy' => 'campus',
						'edit' => 'off',
						'enable_term_creation' => 'off',
						'filter' => 'off',
						'sort' => 'off'
					),
			'column-acf_field' => array(
						'column-name' => 'column-acf_field',
						'type' => 'column-acf_field',
						'clone' => '',
						'label' => 'Overview',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_576ce022e631e',
						'excerpt_length' => '15',
						'edit' => 'off',
						'sort' => 'off'
					),
			'date' => array(
						'column-name' => 'date',
						'type' => 'date',
						'clone' => '',
						'label' => 'Date',
						'width' => '10',
						'width_unit' => '%',
						'edit' => 'off',
						'filter' => 'off',
						'sort' => 'on'
					)
				),
			)
		) );
		ac_register_columns( 'campus', array(
			array(
				'columns' => array(
					'title' => array(
						'column-name' => 'title',
						'type' => 'title',
						'clone' => '',
						'label' => 'Unit',
						'width' => '',
						'width_unit' => '%',
						'edit' => 'off',
						'sort' => 'on'
					),
			'column-acf_field-1' => array(
						'column-name' => 'column-acf_field-1',
						'type' => 'column-acf_field',
						'clone' => '1',
						'label' => 'Leadership',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_58be446b10870',
						'edit' => 'off',
						'filter' => 'off',
						'sort' => 'off'
					),
			'column-acf_field' => array(
						'column-name' => 'column-acf_field',
						'type' => 'column-acf_field',
						'clone' => '',
						'label' => 'Primary Language',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_58abe5ad7bc56',
						'edit' => 'off',
						'filter' => 'off',
						'sort' => 'off'
					),
			'column-acf_field-2' => array(
						'column-name' => 'column-acf_field-2',
						'type' => 'column-acf_field',
						'clone' => '2',
						'label' => 'Address',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_58ac0b1c6cb46',
						'sub_field' => 'field_58bd4405d2e4d',
						'sub_field_display' => '',
						'excerpt_length' => '8',
						'sort' => 'off'
					),
			'column-acf_field-3' => array(
						'column-name' => 'column-acf_field-3',
						'type' => 'column-acf_field',
						'clone' => '3',
						'label' => 'Quicklink Items',
						'width' => '',
						'width_unit' => '%',
						'field' => 'field_58be596abb55c',
						'edit' => 'off',
						'sort' => 'off'
					),
			'column-modified' => array(
						'column-name' => 'column-modified',
						'type' => 'column-modified',
						'clone' => '',
						'label' => 'Last modified',
						'width' => '',
						'width_unit' => '%',
						'date_format' => 'd M Y',
						'sort' => 'off'
					)
				),
			)
		) );
	}
}
add_action( 'init', 'ac_custom_column_settings_be6a174b' );
