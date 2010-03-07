<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

// TODO: add RTE configuration for all RTE fields
t3lib_extMgm::addPageTSconfig('
	# ***************************************************************************************
	# CONFIGURATION of RTE in table "tx_upbeteachingorg", field "description"
	# ***************************************************************************************
#RTE.config.tx_upbeteachingorg.description {
#  hidePStyleItems = H1, H4, H5, H6
#  proc.exitHTMLparser_db=1
#  proc.exitHTMLparser_db {
#    keepNonMatchedTags=1
#    tags.font.allowedAttribs= color
#    tags.font.rmTagIfNoAttrib = 1
#    tags.font.nesting = global
#  }
#}
');

t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_upbeteachingorg_contact = 1
	options.saveDocNew.tx_upbeteachingorg_training = 1
	options.saveDocNew.tx_upbeteachingorg_event = 1
	options.saveDocNew.tx_upbeteachingorg_tool = 1
	options.saveDocNew.tx_upbeteachingorg_servicecategory = 1
	options.saveDocNew.tx_upbeteachingorg_service = 1
	options.saveDocNew.tx_upbeteachingorg_project = 1
	options.saveDocNew.tx_upbeteachingorg_projectdepartment = 1
	options.saveDocNew.tx_upbeteachingorg_projectpartner = 1
');

$GLOBALS ['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = 'EXT:upb_eteachingorg/class.upbeteachingorg_tcemainprocdm.php:tx_upbelearningorg_tceProcessing';

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_upbeteachingorg_pi1.php', '_pi1', 'list_type', 0);

$TYPO3_CONF_VARS['SC_OPTIONS']['GLOBAL']['cliKeys']['upbeteachingorg_import'] = array('EXT:upb_eteachingorg/import_cli.php','_CLI_ETOImport');


?>
