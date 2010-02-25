<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}
$TCA['tx_upbeteachingorg_university'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_university',
		'label'     => 'name',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_university.gif',
	),
);

$TCA['tx_upbeteachingorg_contact'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_contact',
		'label'     => 'familyname',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_contact.gif',
	),
);

$TCA['tx_upbeteachingorg_training'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_training',
		'label'     => 'summary',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_training.gif',
	),
);

$TCA['tx_upbeteachingorg_event'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_event',
		'label'     => 'summary',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_event.gif',
	),
);

$TCA['tx_upbeteachingorg_tool'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_tool',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_tool.gif',
	),
);

$TCA['tx_upbeteachingorg_toolcategories'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolcategories',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_toolcategories.gif',
	),
);

$TCA['tx_upbeteachingorg_servicecategory'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_servicecategory',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_servicecategory.gif',
	),
);

$TCA['tx_upbeteachingorg_service'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_service',
		'label'     => 'summary',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_service.gif',
	),
);

$TCA['tx_upbeteachingorg_project'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_project',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_project.gif',
	),
);

$TCA['tx_upbeteachingorg_projectdepartment'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_projectdepartment',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_projectdepartment.gif',
	),
);

$TCA['tx_upbeteachingorg_projectpartner'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_projectpartner',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_projectpartner.gif',
	),
);

$TCA['tx_upbeteachingorg_role'] = array (
	'ctrl' => array (
		'title'     => 'Rolle fuer Kontakt',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_role.gif',
	),
);

$TCA['tx_upbeteachingorg_toolportraiteto'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportraiteto',
		'label'     => 'title',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_toolportraiteto.gif',
	),
);

$TCA['tx_upbeteachingorg_toolportrait'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:upb_eteachingorg/locallang_db.xml:tx_upbeteachingorg_toolportrait',
		'label'     => 'portrait_id',
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY crdate',
		'delete' => 'deleted',
		'enablecolumns' => array (
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'res/icon_tx_upbeteachingorg_toolportrait.gif',
	),
);




t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key';


t3lib_extMgm::addPlugin(array(
'LLL:EXT:upb_eteachingorg/locallang_db.xml:tt_content.list_type_pi1',
$_EXTKEY . '_pi1',
t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY.'_pi1'] ='pi_flexform';

t3lib_extMgm::addPiFlexFormValue($_EXTKEY.'_pi1', 'FILE:EXT:'.$_EXTKEY . '/flexform_ds_pi1.xml');


?>
