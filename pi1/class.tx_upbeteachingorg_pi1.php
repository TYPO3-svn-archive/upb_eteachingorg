<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Heiko Noethen <noethen@uni-paderborn.de>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');
require_once(dirname(PATH_thisScript).'/typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.fieldFunction.php');
require_once(dirname(PATH_thisScript).'/typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.event.php');
require_once(dirname(PATH_thisScript).'/typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.project.php');
require_once(dirname(PATH_thisScript).'/typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.tool.php');
require_once(dirname(PATH_thisScript).'/typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.training.php');
require_once(dirname(PATH_thisScript).'/typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.service.php');
require_once(dirname(PATH_thisScript).'/typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.toolportrait.php');
require_once(dirname(PATH_thisScript).'/typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.university.php');
require_once(dirname(PATH_thisScript).'/typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.toolportraiteto.php');

/**
 * Plugin 'E-Teaching.org' for the 'upb_eteachingorg' extension.
 *
 * @author    Heiko Noethen <noethen@uni-paderborn.de>
 * @package    TYPO3
 * @subpackage    tx_upbeteachingorg
 */
class tx_upbeteachingorg_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_upbeteachingorg_pi1';
	var $scriptRelPath = 'pi1/class.tx_upbeteachingorg_pi1.php';
	var $extKey        = 'upb_eteachingorg';

	/**
	 * The main method of the PlugIn
	 *
	 * @param    string       $content: The PlugIn content
	 * @param    array        $conf: The PlugIn configuration
	 * @return   The content  that is displayed on the website
	 */
	function main($content, $conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_initPIflexForm();
		$this->pi_loadLL();
		$this->pi_USER_INT_obj = 1;    // Configuring so caching is not expected. This value means that no cHash params are ever set. We do this, because it's a USER_INT object!

		$GLOBALS['EXT_CONF'] = $conf;
		$GLOBALS['COBJ'] = t3lib_div::makeInstance('tslib_cObj');

		$extConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['upb_eteachingorg']);

		$this->debug = 0;

		$this->piConf = array();
		$this->piConf['maxListElements'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'maxListElements');
		$this->piConf['what_to_display'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'what_to_display');
		$this->piConf['mode'] = ($this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'mode') != '') ? $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'mode') : ($this->conf['displayXML'] ? 'xml' : '');
		$this->piConf['displayPageBrowser'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'displayPageBrowser');
		$this->piConf['PIDitemDisplay'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'PIDitemDisplay');
		$this->piConf['listSortBy'] = $this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'listSortBy');
		$this->piConf['tablePrefix'] = 'tx_upbeteachingorg_';

		$sourcePagesArray = explode(',',$this->cObj->data['pages']);
		$this->piConf['sourceMode'] = intval($this->pi_getFFvalue($this->cObj->data['pi_flexform'], 'source'));
		$this->piConf['debug'] = (1==2) ? 5 : (3==4)? 8 : 9; // nicht immer 9 ??
		$this->piConf['ownUniversityShortKey'] = 'upb';

		$this->detailPageConf['contact']    = intval($this->conf['detailPages.']['contact']);
		$this->detailPageConf['service']    = intval($this->conf['detailPages.']['service']);
		$this->detailPageConf['event']      = intval($this->conf['detailPages.']['event']);
		$this->detailPageConf['tool']       = intval($this->conf['detailPages.']['tool']);
		$this->detailPageConf['training']   = intval($this->conf['detailPages.']['training']);
		$this->detailPageConf['project']    = intval($this->conf['detailPages.']['project']);
		$this->detailPageConf['university'] = intval($this->conf['detailPages.']['university']);

		if (intval($extConf['ownPid']) == 0 || intval($extConf['etoPid']) == 0) {
			return $this->pi_wrapInBaseClass('Fehler: Konfiguration im Extension Manager &uuml;berpr&uuml;fen!');
		}
		var_dump($this->piConf['mode']);
		$this->currentVars = array();
		switch($this->piConf['mode']) {
			case 'Liste': $this->currentVars['mode'] = 'list';
				break;
			case 'Detail': $this->currentVars['mode'] = 'detail';
				break;
			case 'xml': $this->currentVars['mode'] = 'xml';
				break;
			//return '<h1>Fehler</h1><p>Keine g&uuml;ltige Display-Variable in Flexform (T3BE) &uuml;bergeben!</p>';
		}

		switch($this->piConf['what_to_display']) {
			case 'contact': $this->currentVars['object'] = 'contact';
				break;
			case 'event': $this->currentVars['object'] = 'event';
				break;
			case 'project': $this->currentVars['object'] = 'project';
				break;
			case 'tool':  $this->currentVars['object'] = 'tool';
				break;
			case 'training':  $this->currentVars['object'] = 'training';
				break;
			case 'service':  $this->currentVars['object'] = 'service';
				break;
			case 'university': $this->currentVars['object'] = 'university';
				break;
			case 'toolportrait': $this->currentVars['object'] = 'toolportraiteto';
				break;
			default:
			//return '<h1>Fehler</h1><p>Keine g&uuml;ltige Display-Variable in Flexform (T3BE) &uuml;bergeben!</p>';
		}

		switch($this->currentVars['mode']) {


			case 'list':
				var_dump($this->piConf['what_to_display']);
				$objectname = $this->currentVars['object'];
				$object = new $objectname();
				$content = $object->getThisObjectCode($this->piConf);
				unset($object);
				return $content;


				break;
			case 'detail':
				$objectname = $this->currentVars['object'];
				$uid = $this->piVars['uid'];
				var_dump($uid);
				var_dump($this->piConf['what_to_display']);
				try {
					$object = new $objectname('uuid',$uid,1,1);
				}catch (Exception $ex) {
					return '<h1>Fehler</h1><p>Keine g&uuml;ltige ID &uuml;bergeben!</p>';
				}

				$objectTemplate = $object->getObjectTemplate('detail');
				$object->setProcessMode('load',$objectTemplate);
				$object->processFields();
				$markerArray = $object->getMarkerArray();
				$objXMLCode = t3lib_parsehtml::getSubpart($objectTemplate, "###TEMPLATE_LIST###");
				$code = t3lib_parsehtml::substituteMarkerArray($objXMLCode,$markerArray,'',0);
				$content .= $code;
				unset($object);
				return $content;
				break;

			case 'xml':
				$uid = intval($extConf['ownUniversityId']);

				if($uid != 0 ) {

					$uni = new university('uid',$uid);
					$tmpl = $uni->getObjectTemplate('xml');
					$uni->setProcessMode('loadxml',$tmpl);
					$uni->processFields();
					$markerArray = $uni->getMarkerArray();
					$objXMLCode = $this->cObj->getSubpart($tmpl, "###TEMPLATE_LIST###");
					$content = $this->cObj->substituteMarkerArray($objXMLCode,$markerArray,'',0);
				}else {

					$content = "Fehler in der Konfiguration: ID der eigenen Uni angeben";

				}
				break;

		}


		return $content;


	}

	function debug($var,$text) {

		if($this->debug) {
			t3lib_div::debug($var,$text);
		}

	}


}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/pi1/class.tx_upbeteachingorg_pi1.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/pi1/class.tx_upbeteachingorg_pi1.php']);
}

?>
