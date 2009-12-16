<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_upbeteachingorg_contact=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_upbeteachingorg_training=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_upbeteachingorg_event=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_upbeteachingorg_tool=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_upbeteachingorg_servicecategory=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_upbeteachingorg_service=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_upbeteachingorg_project=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_upbeteachingorg_projectdepartment=1
');
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_upbeteachingorg_projectpartner=1
');

$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:upb_eteachingorg/class.upbeteachingorg_tcemainprocdm.php:tx_upbelearningorg_tceProcessing';

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_upbeteachingorg_pi1.php', '_pi1', 'list_type', 0);

$TYPO3_CONF_VARS['SC_OPTIONS']['GLOBAL']['cliKeys']['upbeteachingorg_import'] = array('EXT:upb_eteachingorg/import_cli.php','_CLI_ETOImport');


?>
