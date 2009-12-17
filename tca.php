<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$conf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['upb_eteachingorg']);

$TCA['tx_upbeteachingorg_university'] = array (
	'ctrl' => $TCA['tx_upbeteachingorg_university']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,objectid,name,news,info,url,elearningurl,newsfeedurl,contacts,tools,toolportraits'
	),
	'feInterface' => $TCA['tx_upbeteachingorg_university']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'objectid' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_university.objectid',		
			'config' => array (
				'type' => 'input',	
				'size' => '80',
				 'readOnly' => '1',
			)
		),
		'name' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_university.name',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'news' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_university.news',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
				'wizards' => array(
					'_PADDING' => 2,
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly'       => 1,
						'type'          => 'script',
						'title'         => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
						'icon'          => 'wizard_rte2.gif',
						'script'        => 'wizard_rte.php',
					),
				),
			)
		),
		'info' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_university.info',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',
				'rows' => '5',
				'wizards' => array(
					'_PADDING' => 2,
					'RTE' => array(
						'notNewRecords' => 1,
						'RTEonly'       => 1,
						'type'          => 'script',
						'title'         => 'Full screen Rich Text Editing|Formatteret redigering i hele vinduet',
						'icon'          => 'wizard_rte2.gif',
						'script'        => 'wizard_rte.php',
					),
				),
			)
		),
		'url' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_university.url',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'required,trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'elearningurl' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_university.elearningurl',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'required,trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'newsfeedurl' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_university.newsfeedurl',
                        'config' => array (
                                'type'     => 'input',
                                'size'     => '15',
                                'max'      => '255',
                                'checkbox' => '',
                                'eval'     => 'trim',
                                'wizards'  => array(
                                        '_PADDING' => 2,
                                        'link'     => array(
                                                'type'         => 'popup',
                                                'title'        => 'Link',
                                                'icon'         => 'link_popup.gif',
                                                'script'       => 'browse_links.php?mode=wizard',
                                                'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
                                        )
                                )
                        )
                ),
		'contacts' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_university.contacts',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_upbeteachingorg_contact',	
				'foreign_table_where' => 'AND tx_upbeteachingorg_contact.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_contact.familyname',	
				'size' => 15,	
				'minitems' => 0,
				'maxitems' => 50,	
				"MM" => "tx_upbeteachingorg_university_contacts_mm",	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_upbeteachingorg_contact',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),
			)
		),
		
		'tools' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_university.tools',
                        'config' => array (
                                'type' => 'select',
                                'foreign_table' => 'tx_upbeteachingorg_tool',
                                'foreign_table_where' => 'AND tx_upbeteachingorg_tool.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_tool.title',
                                'size' => 15,
                                'minitems' => 0,
                                'maxitems' => 50,
                                "MM" => "tx_upbeteachingorg_university_tools_mm",
                                'wizards' => array(
                                        '_PADDING'  => 2,
                                        '_VERTICAL' => 1,
                                        'add' => array(
                                                'type'   => 'script',
                                                'title'  => 'Create new record',
                                                'icon'   => 'add.gif',
                                                'params' => array(
                                                        'table'    => 'tx_upbeteachingorg_tool',
                                                        'pid'      => '###CURRENT_PID###',
                                                        'setValue' => 'prepend'
                                                ),
                                                'script' => 'wizard_add.php',
                                        ),
                                ),
                        )
                ),

		 'toolportraits' => array (
                        'exclude' => 0,
                        'label' => 'Werkzeugportrait von E-Teaching.org',
                        'config' => array (
                                'type' => 'select',
                                'foreign_table' => 'tx_upbeteachingorg_toolportraiteto',
                                'foreign_table_where' => 'AND tx_upbeteachingorg_toolportraiteto.pid='.$conf['etoPid'].' ORDER BY tx_upbeteachingorg_toolportraiteto.title',
                                'size' => 15,
                                'minitems' => 0,
                                'maxitems' => 50,
                                "MM" => "tx_upbeteachingorg_university_toolportraits_mm",
                        )
                ),

	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, objectid, name, news;;;richtext[]:rte_transform[mode=ts], info;;;richtext[]:rte_transform[mode=ts], url, elearningurl, newsfeedurl, contacts, tools, toolportraits')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_upbeteachingorg_contact'] = array (
	'ctrl' => $TCA['tx_upbeteachingorg_contact']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,objectid,honorific_suffix,givenname,familyname,email,phone,url,photourl,generalcontact,role,tools,portraits'
	),
	'feInterface' => $TCA['tx_upbeteachingorg_contact']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'objectid' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_contact.objectid',		
			'config' => array (
				'type' => 'input',	
				'size' => '80',
				'readOnly' => '1',
			)
		),
		'honorific_suffix' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_contact.honorific_suffix',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'givenname' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_contact.givenname',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
		'familyname' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_contact.familyname',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
		'email' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_contact.email',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
		'phone' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_contact.phone',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'url' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_contact.url',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'photourl' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_contact.photourl',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'role' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_contact.role',
                        'config' => array (
                                'type' => 'select',
                                'foreign_table' => 'tx_upbeteachingorg_role',
                                'foreign_table_where' => 'AND tx_upbeteachingorg_role.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_role.uid',
                                'size' => 15,
                                'minitems' => 0,
                                'maxitems' => 50,
                                "MM" => "tx_upbeteachingorg_contact_roles_mm",
                                'wizards' => array(
                                        '_PADDING'  => 2,
                                        '_VERTICAL' => 1,
                                        'add' => array(
                                                'type'   => 'script',
                                                'title'  => 'Create new record',
                                                'icon'   => 'add.gif',
                                                'params' => array(
                                                        'table'    => 'tx_upbeteachingorg_role',
                                                        'pid'      => '###CURRENT_PID###',
                                                        'setValue' => 'prepend'
                                                ),
                                                'script' => 'wizard_add.php',
                                        ),
                                ),
                        )
                ),

		'tools' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_contact.tools',
                        'config' => array (
                                'type' => 'select',
                                'foreign_table' => 'tx_upbeteachingorg_tool',
                                'foreign_table_where' => 'AND tx_upbeteachingorg_tool.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_tool.title',
                                'size' => 15,
                                'minitems' => 0,
                                'maxitems' => 50,
                                "MM" => "tx_upbeteachingorg_contact_tools_mm",
                                'wizards' => array(
                                        '_PADDING'  => 2,
                                        '_VERTICAL' => 1,
                                        'add' => array(
                                                'type'   => 'script',
                                                'title'  => 'Create new record',
                                                'icon'   => 'add.gif',
                                                'params' => array(
                                                        'table'    => 'tx_upbeteachingorg_tool',
                                                        'pid'      => '###CURRENT_PID###',
                                                        'setValue' => 'prepend'
                                                ),
                                                'script' => 'wizard_add.php',
                                        ),
                                ),
                        )
                ),


		'portraits' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportrait.protrait_id',
                        'config' => array (
                                'type' => 'group',
                                'internal_type' => 'db',
                                'allowed' => 'tx_upbeteachingorg_toolportraiteto',
                                'size' => 15,
                                'minitems' => 0,
                                'maxitems' => 50,
                                "MM" => "tx_upbeteachingorg_contact_portraits_mm",
                                'wizards' => array(
                                        '_PADDING'  => 2,
                                        '_VERTICAL' => 1,
                                        'add' => array(
                                                'type'   => 'script',
                                                'title'  => 'Create new record',
                                                'icon'   => 'add.gif',
                                                'params' => array(
                                                        'table'    => 'tx_upbeteachingorg_toolportraiteto',
                                                        'pid'      => '###CURRENT_PID###',
                                                        'setValue' => 'prepend'
                                                ),
                                                'script' => 'wizard_add.php',
                                        ),
                                ),
                        )
                ),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, objectid, honorific_suffix, givenname, familyname, email, phone, url, photourl, generalcontact, role,tools,portraits')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_upbeteachingorg_training'] = array (
	'ctrl' => $TCA['tx_upbeteachingorg_training']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,objectid,summary,description,location,url,dtstart,dtend,due,category,targetgroup,price,certificate,content,contacts'
	),
	'feInterface' => $TCA['tx_upbeteachingorg_training']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'objectid' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.objectid',		
			'config' => array (
				'type' => 'input',	
				'size' => '80',	
				 'readOnly' => '1',
			)
		),
		'summary' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.summary',		
			'config' => array (
				'type' => 'input',	
				'size' => '48',	
				'max' => '100',	
				'eval' => 'required',
			)
		),
		'description' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.description',		
			'config' => array (
				'type' => 'text',
				'cols' => '48',	
				'rows' => '10',
				'eval' => 'required',
			)
		),
		'location' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.location',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
		'url' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.url',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'required,trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'dtstart' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.dtstart',		
			'config' => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0'
			)
		),
		'dtend' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.dtend',		
			'config' => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0'
			)
		),
		'due' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.due',		
			'config' => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0'
			)
		),
		'category' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.category',		
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.category.I.0', '1'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.category.I.1', '2'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.category.I.2', '3'),
				),
				'size' => 3,	
				'maxitems' => 1,
				'minitems' => 1,
			)
		),
		'targetgroup' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.targetgroup',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
				'eval' => 'required',
			)
		),
		'price' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.price',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'certificate' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.certificate',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'content' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.content',		
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.content.I.0', '0'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.content.I.1', '1'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.content.I.2', '2'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.content.I.3', '3'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.content.I.4', '4'),
				),
				'size' => 5,	
				'maxitems' => 1,
				'minitems' => 1,
			)
		),
		'contacts' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training.contacts',
                        'config' => array (
                                'type' => 'select',
                                'foreign_table' => 'tx_upbeteachingorg_contact',
                                'foreign_table_where' => 'AND tx_upbeteachingorg_contact.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_contact.familyname',
                                'size' => 15,
                                'minitems' => 0,
                                'maxitems' => 50,
                                "MM" => "tx_upbeteachingorg_training_contacts_mm",
                                'wizards' => array(
                                        '_PADDING'  => 2,
                                        '_VERTICAL' => 1,
                                        'add' => array(
                                                'type'   => 'script',
                                                'title'  => 'Create new record',
                                                'icon'   => 'add.gif',
                                                'params' => array(
                                                        'table'    => 'tx_upbeteachingorg_contact',
                                                        'pid'      => '###CURRENT_PID###',
                                                        'setValue' => 'prepend'
                                                ),
                                                'script' => 'wizard_add.php',
                                        ),
                                ),
                        )
                ),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, objectid, summary, description, location, url, dtstart, dtend, due, category, targetgroup, price, certificate, content, contacts')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_upbeteachingorg_event'] = array (
	'ctrl' => $TCA['tx_upbeteachingorg_event']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,objectid,summary,description,location,url,dtstart,dtend'
	),
	'feInterface' => $TCA['tx_upbeteachingorg_event']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'objectid' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_event.objectid',		
			'config' => array (
				'type' => 'input',	
				'size' => '80',	
				'readOnly' => '1',
			)
		),
		'summary' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_event.summary',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
		'description' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_event.description',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
				'eval' => 'required',
			)
		),
		'location' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_event.location',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
				'eval' => 'required',
			)
		),
		'url' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_event.url',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'dtstart' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_event.dtstart',		
			'config' => array (
				'type'     => 'input',
				'size'     => '16',
				'max'      => '20',
				'eval'     => 'required,datetime',
				'default'  => mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"))
			)
		),

		'dtend' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_event.dtend',		
			'config' => array (
				'type'     => 'input',
				'size'     => '16',
				'max'      => '20',
				'eval'     => 'required,datetime',
				'default'  =>  mktime(date("H"),date("i"),0,date("m"),date("d"),date("Y"))
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, objectid, summary, description, location, url, dtstart, dtend')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_upbeteachingorg_tool'] = array (
	'ctrl' => $TCA['tx_upbeteachingorg_tool']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,objectid,title,description,url,categories,contacts'
	),
	'feInterface' => $TCA['tx_upbeteachingorg_tool']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'objectid' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_tool.objectid',		
			'config' => array (
				'type' => 'input',	
				'size' => '80',	
				'readOnly' => '1',
			)
		),
		'title' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_tool.title',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
				'eval' => 'required',
			)
		),
		'description' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_tool.description',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
				'eval' => 'required',
			)
		),
		'url' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_tool.url',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'required,trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'categories' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_tool.categories',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_upbeteachingorg_toolcategories',	
				'foreign_table_where' => 'AND tx_upbeteachingorg_toolcategories.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_toolcategories.uid',	
				'size' => 10,	
				'minitems' => 0,
				'maxitems' => 100,	
				"MM" => "tx_upbeteachingorg_tool_categories_mm",	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_upbeteachingorg_toolcategories',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),
			)
		),
		 'contacts' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_tool.contacts',
                        'config' => array (
                                'type' => 'select',
                                'foreign_table' => 'tx_upbeteachingorg_contact',
                                'foreign_table_where' => 'AND tx_upbeteachingorg_contact.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_contact.familyname',
                                'size' => 15,
                                'minitems' => 0,
                                'maxitems' => 50,
                                "MM" => "tx_upbeteachingorg_tool_contacts_mm",
                                'wizards' => array(
                                        '_PADDING'  => 2,
                                        '_VERTICAL' => 1,
                                        'add' => array(
                                                'type'   => 'script',
                                                'title'  => 'Create new record',
                                                'icon'   => 'add.gif',
                                                'params' => array(
                                                        'table'    => 'tx_upbeteachingorg_contact',
                                                        'pid'      => '###CURRENT_PID###',
                                                        'setValue' => 'prepend'
                                                ),
                                                'script' => 'wizard_add.php',
                                        ),
                                ),
                        )
                ),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, objectid, title;;;;2-2-2, description;;;;3-3-3, url, categories, contacts')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_upbeteachingorg_toolcategories'] = array (
	'ctrl' => $TCA['tx_upbeteachingorg_toolcategories']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title'
	),
	'feInterface' => $TCA['tx_upbeteachingorg_toolcategories']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'title' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolcategories.title',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_upbeteachingorg_servicecategory'] = array (
	'ctrl' => $TCA['tx_upbeteachingorg_servicecategory']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title'
	),
	'feInterface' => $TCA['tx_upbeteachingorg_servicecategory']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'title' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_servicecategory.title',		
			'config' => array (
				'type' => 'input',	
				'size' => '48',	
				'max' => '100',	
				'eval' => 'required',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_upbeteachingorg_service'] = array (
	'ctrl' => $TCA['tx_upbeteachingorg_service']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,objectid,summary,description,url,tags,serviceCategories,contacts,tool,toolportrait'
	),
	'feInterface' => $TCA['tx_upbeteachingorg_service']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'objectid' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_service.objectid',		
			'config' => array (
				'type' => 'input',	
				'size' => '80',
				 'readOnly' => '1',
			)
		),
		'summary' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_service.summary',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
				'eval' => 'required',
			)
		),
		'description' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_service.description',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
				'eval' => 'required',
			)
		),
		'url' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_service.url',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'required,trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'tags' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_service.tags',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
				'eval' => 'required',
			)
		),
		'serviceCategories' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_service.categories',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_upbeteachingorg_servicecategory',	
				'foreign_table_where' => 'AND tx_upbeteachingorg_servicecategory.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_servicecategory.uid',	
				'size' => 3,	
				'minitems' => 0,
				'maxitems' => 10,	
				"MM" => "tx_upbeteachingorg_service_categories_mm",	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_upbeteachingorg_servicecategory',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),
			)
		),
		'contacts' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_service.contacts',		
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('',0),
				 ),
				'foreign_table' => 'tx_upbeteachingorg_contact',	
				'foreign_table_where' => 'AND tx_upbeteachingorg_contact.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_contact.uid',	
				'size' => 1,	
				'minitems' => 0,
				'maxitems' => 1,	
				"MM" => "tx_upbeteachingorg_service_contacts_mm",
				'wizards' => array(
                                        '_PADDING'  => 2,
                                        '_VERTICAL' => 1,
                                        'add' => array(
                                                'type'   => 'script',
                                                'title'  => 'Create new record',
                                                'icon'   => 'add.gif',
                                                'params' => array(
                                                        'table'    => 'tx_upbeteachingorg_contact',
                                                        'pid'      => '###CURRENT_PID###',
                                                        'setValue' => 'prepend'
                                                ),
                                                'script' => 'wizard_add.php',
                                        ),
                                ),
			)
		),
		
                'tool' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_service.tools',
                        'config' => array (
                                'type' => 'select',
                                'foreign_table' => 'tx_upbeteachingorg_tool',
                                'foreign_table_where' => 'AND tx_upbeteachingorg_tool.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_tool.title',
                                'size' => 15,
                                'minitems' => 0,
                                'maxitems' => 50,
                                "MM" => "tx_upbeteachingorg_service_tools_mm",
                                'wizards' => array(
                                        '_PADDING'  => 2,
                                        '_VERTICAL' => 1,
                                        'add' => array(
                                                'type'   => 'script',
                                                'title'  => 'Create new record',
                                                'icon'   => 'add.gif',
                                                'params' => array(
                                                        'table'    => 'tx_upbeteachingorg_tool',
                                                        'pid'      => '###CURRENT_PID###',
                                                        'setValue' => 'prepend'
                                                ),
                                                'script' => 'wizard_add.php',
                                        ),
                                ),
                        )
                ),
		'toolportrait' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_service.toolportrait',
                        'config' => array (
                                'type' => 'group',
                                'internal_type' => 'db',
                                'allowed' => 'tx_upbeteachingorg_toolportraiteto',
                                'size' => 4,
                                'minitems' => 0,
                                'maxitems' => 10,
                                "MM" => "tx_upbeteachingorg_service_toolportraits_mm",
                        )
                ),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, objectid, summary, description, url, tags, serviceCategories, contacts, tool, toolportrait')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_upbeteachingorg_project'] = array (
	'ctrl' => $TCA['tx_upbeteachingorg_project']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,objectid,title,summary,description,url,state,dtstart,dtend,type,resource,tags,department,partners,partneruniversities,contacts,category'
	),
	'feInterface' => $TCA['tx_upbeteachingorg_project']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'objectid' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.objectid',		
			'config' => array (
				'type' => 'input',	
				'size' => '80',
				'readOnly' => '1',
			)
		),
		'title' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.title',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
				'eval' => 'required',
			)
		),
		'summary' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.summary',		
			'config' => array (
				'type' => 'text',
				'cols' => '30',	
				'rows' => '5',
				'eval' => 'required',
			)
		),
		'description' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.description',
                        'config' => array (
                                'type' => 'text',
                                'cols' => '40',
                                'rows' => '15',
				'eval' => 'required',
                        )
                ),
		'url' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.url',		
			'config' => array (
				'type'     => 'input',
				'size'     => '15',
				'max'      => '255',
				'checkbox' => '',
				'eval'     => 'trim',
				'wizards'  => array(
					'_PADDING' => 2,
					'link'     => array(
						'type'         => 'popup',
						'title'        => 'Link',
						'icon'         => 'link_popup.gif',
						'script'       => 'browse_links.php?mode=wizard',
						'JSopenParams' => 'height=300,width=500,status=0,menubar=0,scrollbars=1'
					)
				)
			)
		),
		'state' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.state',		
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.state.I.0', '0'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.state.I.1', '1'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.state.I.2', '2'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.state.I.3', '3'),
				),
				'size' => 1,	
				'maxitems' => 1,
				'eval' => 'required',
			)
		),
		'dtstart' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.dtstart',
                        'config' => array (
                                'type'     => 'input',
                                'size'     => '8',
                                'max'      => '20',
                                'eval'     => 'date',
                                'checkbox' => '0',
                                'default'  => '0'
                        )
                ),
		'dtend' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.dtend',		
			'config' => array (
				'type'     => 'input',
				'size'     => '8',
				'max'      => '20',
				'eval'     => 'date',
				'checkbox' => '0',
				'default'  => '0'
			)
		),
		'type' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.type',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'resource' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.resource',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'tags' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.tags',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
				'eval' => 'required',
			)
		),
		'department' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.department',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_upbeteachingorg_projectdepartment',	
				'foreign_table_where' => 'AND tx_upbeteachingorg_projectdepartment.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_projectdepartment.uid',	
				'size' => 5,	
				'minitems' => 0,
				'maxitems' => 10,	
				"MM" => "tx_upbeteachingorg_project_department_mm",	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_upbeteachingorg_projectdepartment',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),
			)
		),
		'partners' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.partners',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_upbeteachingorg_projectpartner',	
				'foreign_table_where' => 'AND tx_upbeteachingorg_projectpartner.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_projectpartner.uid',	
				'size' => 3,	
				'minitems' => 0,
				'maxitems' => 15,	
				"MM" => "tx_upbeteachingorg_project_partners_mm",	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_upbeteachingorg_projectpartner',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
				),
			)
		),
/*		'partneruniversities' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.partneruniversities',		
			'config' => array (
				'type' => 'group',	
				'internal_type' => 'db',	
				'allowed' => 'tx_upbeteachingorg_university',	
				'size' => 4,	
				'minitems' => 0,
				'maxitems' => 15,	
				"MM" => "tx_upbeteachingorg_project_partneruniversities_mm",
			)
		),
*/
		'contacts' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.contacts',
                        'config' => array (
                                'type' => 'select',
                                'foreign_table' => 'tx_upbeteachingorg_contact',
                                'foreign_table_where' => 'AND tx_upbeteachingorg_contact.pid=###CURRENT_PID### ORDER BY tx_upbeteachingorg_contact.uid',
                                'size' => 10,
                                'minitems' => 0,
                                'maxitems' => 10,
                                "MM" => "tx_upbeteachingorg_project_contacts_mm",
                                'wizards' => array(
                                        '_PADDING'  => 2,
                                        '_VERTICAL' => 1,
                                        'add' => array(
                                                'type'   => 'script',
                                                'title'  => 'Create new record',
                                                'icon'   => 'add.gif',
                                                'params' => array(
                                                        'table'    => 'tx_upbeteachingorg_contact',
                                                        'pid'      => '###CURRENT_PID###',
                                                        'setValue' => 'prepend'
                                                ),
                                                'script' => 'wizard_add.php',
                                        ),
                                ),
                        )
                ),


		'category' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.category',		
			'config' => array (
				'type' => 'select',
				'items' => array (
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.category.I.0', '0'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.category.I.1', '1'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.category.I.2', '2'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project.category.I.3', '3'),
				),
				'size' => 4,	
				'maxitems' => 1,
				'minitems' => 1,
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, objectid, title;;;;2-2-2, summary, description;;;;3-3-3, url, state, dtstart, dtend, type, resource, tags, department, partners, contacts, category')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_upbeteachingorg_projectdepartment'] = array (
	'ctrl' => $TCA['tx_upbeteachingorg_projectdepartment']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title'
	),
	'feInterface' => $TCA['tx_upbeteachingorg_projectdepartment']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'title' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_projectdepartment.title',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_upbeteachingorg_projectpartner'] = array (
	'ctrl' => $TCA['tx_upbeteachingorg_projectpartner']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'hidden,title'
	),
	'feInterface' => $TCA['tx_upbeteachingorg_projectpartner']['feInterface'],
	'columns' => array (
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'title' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_projectpartner.title',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);

$TCA['tx_upbeteachingorg_role'] = array (
        'ctrl' => $TCA['tx_upbeteachingorg_role']['ctrl'],
        'interface' => array (
                'showRecordFieldList' => 'hidden,title'
        ),
        'feInterface' => $TCA['tx_upbeteachingorg_role']['feInterface'],
        'columns' => array (
                'hidden' => array (
                        'exclude' => 1,
                        'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
                        'config'  => array (
                                'type'    => 'check',
                                'default' => '0'
                        )
                ),
                'title' => array (
                        'exclude' => 0,
                        'label' => 'Rolle',
                        'config' => array (
                                'type' => 'input',
                                'size' => '30',
                        )
                ),
        ),
        'types' => array (
                '0' => array('showitem' => 'hidden;;1;;1-1-1, title;;;;2-2-2')
        ),
        'palettes' => array (
                '1' => array('showitem' => '')
        )
);


$TCA['tx_upbeteachingorg_toolportraiteto'] = array (
        'ctrl' => $TCA['tx_upbeteachingorg_toolportraiteto']['ctrl'],
        'interface' => array (
                'showRecordFieldList' => 'hidden,objectid,title,description,operating_field,category,pros,cons,examples,format,producer,price,operating_system,level,tutorials,reference,options'
        ),
        'feInterface' => $TCA['tx_upbeteachingorg_toolportraiteto']['feInterface'],
        'columns' => array (
                'hidden' => array (
                        'exclude' => 1,
                        'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
                        'config'  => array (
                                'type'    => 'check',
                                'default' => '0'
                        )
                ),
                'objectid' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_tool.objectid',
                        'config' => array (
                                'type' => 'input',
                                'size' => '80',
                                'readOnly' => '0',
				'eval' => 'required',
                        )
                ),
                'title' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_tool.title',
                        'config' => array (
                                'type' => 'input',
                                'size' => '30',
				'eval' => 'required',
                        )
                ),
		'operating_field' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.operating_field',
                        'config' => array (
                                'type' => 'input',
                                'size' => '30',
				'eval' => 'required',
                        )
                ),
                'description' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_tool.description',
                        'config' => array (
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
				'eval' => 'required',
                        )
                ),
		'category' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category',
                        'config' => array (
                                'type' => 'select',
                                'items' => array (
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.1', '1'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.2', '2'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.3', '3'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.4', '4'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.5', '5'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.6', '6'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.7', '7'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.8', '8'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.9', '9'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.10', '10'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.11', '11'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.12', '12'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.13', '13'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.14', '14'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.15', '15'),
					array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.category.I.16', '16'),
                                ),
                                'size' => 10,
                                'maxitems' => 100,
                                'eval' => 'required',
                        )
                ),
		'pros' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.pros',
                        'config' => array (
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
				'eval' => 'required',
                        )
                ),
		'cons' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.cons',
                        'config' => array (
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
				'eval' => 'required',
                        )
                ),
		'examples' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.examples',
                        'config' => array (
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
                        )
                ),
		'format' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.format',
                        'config' => array (
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
                        )
                ),
		'producer' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.producer',
                        'config' => array (
                                'type' => 'input',
                                'size' => '30',
                        )
                ),
		'price' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.price',
                        'config' => array (
                                'type' => 'input',
                                'size' => '30',
                        )
                ),
		 'operating_system' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.operating_system',
                        'config' => array (
                                'type' => 'select',
                                'items' => array (
                                        array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.operating_system.I.0', '0'),
                                        array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.operating_system.I.1', '1'),
                                        array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.operating_system.I.2', '2'),
                                        array('LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.operating_system.I.3', '3'),
                                ),
                                'size' => 4,
                                'maxitems' => 4,
                        )
                ),
		'level' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.level',
                        'config' => array (
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
                        )
                ),
		'tutorials' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.tutorials',
                        'config' => array (
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
                        )
                ),
		'reference' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.references',
                        'config' => array (
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
                        )
                ),
		'options' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto.option',
                        'config' => array (
                                'type' => 'text',
                                'cols' => '30',
                                'rows' => '5',
                        )
                ),
        ),
        'types' => array (
                '0' => array('showitem' => 'hidden;;1;;1-1-1, objectid, title;;;;2-2-2, description;;;;3-3-3, operating_field, category, pros, cons, examples, format, producer, price, operating_system, level, tutorials, reference, options')
        ),
        'palettes' => array (
                '1' => array('showitem' => '')
        )
);

$TCA['tx_upbeteachingorg_toolportrait'] = array (
        'ctrl' => $TCA['tx_upbeteachingorg_toolportrait']['ctrl'],
        'interface' => array (
                'showRecordFieldList' => 'hidden,portrait_id,contacts'
        ),
        'feInterface' => $TCA['tx_upbeteachingorg_toolportrait']['feInterface'],
        'columns' => array (
                'hidden' => array (
                        'exclude' => 1,
                        'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
                        'config'  => array (
                                'type'    => 'check',
                                'default' => '0'
                        )
                ),
		'portrait_id' => array ( 
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportrait.protrait_id',
			'config' => array (
	                	'type' => 'select',    
	        	        'internal_type' => 'db',
				'foreign_table_where' => 'AND tx_upbeteachingorg_toolportraiteto.pid='.$conf['etoPid'].' ORDER BY tx_upbeteachingorg_toolportraiteto.uid',
				'foreign_table' => 'tx_upbeteachingorg_toolportraiteto',  
                		'allowed' => 'tx_upbeteachingorg_toolportraiteto',    
	                	'size' => 1,    
        	        	'minitems' => 1,
                		'maxitems' => 1,
				'eval' => 'required,uniqueInPid,unique',
			)

                ),
		'contacts' => array (
                        'exclude' => 0,
                        'label' => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_university.contacts',
                        'config' => array (
                                'type' => 'select',
                                'foreign_table' => 'tx_upbeteachingorg_contact',
                                'foreign_table_where' => 'AND tx_upbeteachingorg_contact.pid=###STORAGE_PID### ORDER BY tx_upbeteachingorg_contact.uid',
                                'size' => 15,
                                'minitems' => 0,
                                'maxitems' => 50,
                                "MM" => "tx_upbeteachingorg_toolportrait_contacts_mm",
                                'wizards' => array(
                                        '_PADDING'  => 2,
                                        '_VERTICAL' => 1,
                                        'add' => array(
                                                'type'   => 'script',
                                                'title'  => 'Create new record',
                                                'icon'   => 'add.gif',
                                                'params' => array(
                                                        'table'    => 'tx_upbeteachingorg_contact',
                                                        'pid'      => '###CURRENT_PID###',
                                                        'setValue' => 'prepend'
                                                ),
                                                'script' => 'wizard_add.php',
                                        ),
                                ),
                        )
                ),
        ),
        'types' => array (
                '0' => array('showitem' => 'hidden;;1;;1-1-1, portrait_id, contacts')
        ),
        'palettes' => array (
                '1' => array('showitem' => '')
        )
);

?>
