<?php

require_once('class.tx_upbeteachingorg.object.php');

require_once('class.tx_upbeteachingorg.contact.php');


/**
 * Object Project
 *
 *
 *
 * @author      Heiko Noethen <noethen@uni-paderborn.de>
 * @package     tx_upbeteachingorg
 * @subpackage  lib
 */


class university extends object {


	var $objectTable = 'tx_upbeteachingorg_university';

	var $displayTemplate = array(


			'list' => 'EXT:upb_eteachingorg/pi1/tmpl/list_university.tmpl',
			'detail' => 'EXT:upb_eteachingorg/pi1/tmpl/detail_university.tmpl',
			'xml' => 'EXT:upb_eteachingorg/pi1/tmpl/xml_university.tmpl',



	);


	public function config() {
		GLOBAL $BE_USER;

		$this->fields = array(

				'import' => array (

						'pid' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_getETOPid',
								'objectFieldname' => '',

						),
						'syncid' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_getSyncId',
								'objectFieldname' => '',

						),
						'changed' => array(
								'update'        => true,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_convertETODateToTimestamp',
								'objectFieldname' => 'tstamp',
								'isAttribute'   => true,
						),
						'crdate' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_convertETODateToTimestamp',
								'objectFieldname' => 'crdate',
						),
						'cruser_id' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_setValue',
								'fieldFunctionParam' => $BE_USER->user['uid'],
								'objectFieldname' => '',
						),
						'deleted' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_setValue',
								'fieldFunctionParam' => 0,
								'objectFieldname' => '',
						),
						'hidden' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_setValue',
								'fieldFunctionParam' => 0,
						),
						'uid' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'objectid',
								'isAttribute'   => true,
						),
						'university-name' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'name',
						),
						'university-information' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'info',
						),
						'university-news' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'news',
						),
						'url' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => '',
						),
						'e-learning-url' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'elearningurl',
						),
						'news-feed-url' => array(
								'update'        => false,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'newsfeedurl',
						),
				),
				'load' => array (
						'title' => array(
								'required' => true,
								'validate' => 'text',
								'objectFunction' => 'fieldFunc_textonly',
						),
						'summary' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'summary',
								'objectFunction' => 'fieldFunc_textonly',
						),
						'description' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'description',
								'objectFunction' => 'fieldFunc_textonly',
						),
						'url' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => 'url',
								'objectFunction' => 'fieldFunc_writeLink',
						),
						'project-state' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'state',
								'objectFunction' => 'fieldFunc_writeProjectState',
						),
						'dtend' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'dtend',
								'objectFunction' => 'fieldFunc_writeDate',
						),
						'dtstart' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'dtstart',
								'objectFunction' => 'fieldFunc_writeDate',
						),
						'project-responsibility' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'type',
								'objectFunction' => 'fieldFunc_textonly',
						),
						'project-resources' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'resource',
								'objectFunction' => 'fieldFunc_textonly',
						),
						'item-tags' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'tags',
								'objectFunction' => 'fieldFunc_textonly',
						),
						'project-partner' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'partners',
								'objectFunction' => 'pass',
						),
						'contact' => array(
								'required' => false,
								'validate' => 'isValideETOUuid',
								'mm_option' => false,
								'optionTable' => 'tx_upbeteachingorg_projectdepartment',
								'mmTable' => 'tx_upbeteachingorg_project_department_mm',
								'allowNewOptions' => false,
								'objectFieldname' => 'department',
								'objectFieldname' => 'contacts',
								'objectFunction' => 'pass',
								'execMM' => 'setMMOptionContact',
						),
						'category' => array(
								'required' => false,
								'validate' => 'isCategoryToDo',
								'objectFieldname' => 'category',
								'objectFunction' => 'fieldFunc_writeOption',
								'options' => array(
										'0' => 'Lernumgebung',
										'1' => 'Lernmaterial(-sammlung)',
										'2' => 'Software',
										'3' => 'Lehr-/Lernszenario',
								)
						),
						'sub-unit' => array(
								'required' => false,
								'validate' => 'optionValide',
								'mm_option' => true,
								'optionTable' => 'tx_upbeteachingorg_projectdepartment',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_project_department_mm',
								'allowNewOptions' => true,
								'objectFieldname' => 'department',
								'objectFunction' => 'countOptions',
								'execMM' => 'setMMOptionDepartment',
						),

				),
				'loadxml' => array (
						'uid' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'objectid',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),

						'university-key' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'university-key',
								'objectFunction' => 'XMLfieldFunc_printUniversityKey',
						),


						'tstamp' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => '',
								'objectFunction' => 'XMLfieldFunc_writeDate',
						),

						'university-information' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'info',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'university-news' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'news',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'url' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => 'url',
								'objectFunction' => 'XMLfieldFunc_writeLink',
						),
						'e-learning-url' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => 'elearningurl',
								'objectFunction' => 'XMLfieldFunc_writeLink',
						),
						'news-feed-url' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => 'newsfeedurl',
								'objectFunction' => 'XMLfieldFunc_writeLink',
						),
						'projects' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'projects',
								'objectDirectFunction' => 'getObjectCode',
								'castObject' => 'project',
						),
						'events' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'events',
								'objectDirectFunction' => 'getObjectCode',
								'castObject' => 'event',
						),
						'trainings' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'trainings',
								'objectDirectFunction' => 'getObjectCode',
								'castObject' => 'training',
						),
						'services' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'services',
								'objectDirectFunction' => 'getObjectCode',
								'castObject' => 'service',
						),
						'tools' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'tools',
								'objectDirectFunction' => 'getObjectCode',
								'castObject' => 'tool',
						),

						'tool-portraits' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'tool-portraits',
//                                        'objectFunction' => 'XMLfieldFunc_writeObject',
								'objectDirectFunction' => 'getObjectCode',
								'castObject' => 'toolportrait',
						),

						'hs-contact' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'hs-contact',
								'objectFunction' => 'XMLfieldFunc_writeObject',
						),
						'tool-id' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'toolids',
								'objectFunction' => 'XMLfieldFunc_writeObjectLight',
						),
						'tool-portrait-id' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'toolportraitids',
								'objectFunction' => 'XMLfieldFunc_writeObjectPortraitId',
						),
				),
				'mmData' => array(
						'hs-contacts' => array(
								'loadDataFunction' => 'getMMObjects',
								'loadDataParams' => '',
								'mm_option' => true,
								'optionTable' => ' tx_upbeteachingorg_university_contacts_mm',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_university_contacts_mm',
								'objectFieldname' => 'hs-contact',
								'castObject' => 'contact',
								'mm_object' => true,
						),

						'hs-tools' => array(
								'loadDataFunction' => 'getMMObjectsLight',
								'loadDataParams' => '',
								'mm_option' => true,
								'optionTable' => ' tx_upbeteachingorg_tool',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_university_tools_mm',
								'objectFieldname' => 'toolids',
								'castObject' => 'tool',
								'mm_object' => true,
						),
						'tool-portrait-id' => array(
								'loadDataFunction' => 'getMMObjects',
								'loadDataParams' => '',
								'mm_option' => true,
								'optionTable' => ' tx_upbeteachingorg_university_toolportraits_mm',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_university_toolportraits_mm',
								'objectFieldname' => 'toolportraitids',
								'castObject' => 'toolportraiteto',
								'mm_object' => true,
						),
				),


		);


	}

	public function writeCode() {
		//	return $this->getXMLCode();
	}


	/**
	 *	Creates the XML code for one object type for all existing entries
	 *
	 *	@param object $obj
	 *	@param string $fieldname
	 *	@return string
	 *
	 */
	function getObjectCode($obj,$fieldname) {

		// get object config
		$conf = fieldFunction::getFieldConf($obj,$fieldname);

		// what kind of object
		$objectname = $conf['castObject'];
		$select_fields = "uid";
		$tmpObj = new $objectname();

		$from_table =  $tmpObj->objectTable;
		$pid = intval($this->extConf['ownPid']);
		$where_clause = ' pid = '.$pid.' AND deleted=0';
		$resultArray = array();
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
		$deb = $GLOBALS['TYPO3_DB']->SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
		$numRows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);
		$returnData = array();
		$objectTemplate = $tmpObj->getObjectTemplate('xml');
		unset($tmpObj);


		// if there are rows create objects for each, parse data and parse them into template

		if ($GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1) {
			while($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {

				$oId = $data['uid'];

				$object = new $objectname('uid',$oId);
				$object->setProcessMode('loadxml',$objectTemplate);
				$object->processFields();

				$markerArray = $object->getMarkerArray();
				$objXMLCode = t3lib_parsehtml::getSubpart($objectTemplate, "###TEMPLATE_LIST###");
				$code = t3lib_parsehtml::substituteMarkerArray($objXMLCode,$markerArray,'',0);

				$content .= $code;
				unset($object);

			}

			return $content;

		}else {

			return "";
		}

	}

	public function getData() {
		return $this->data;
	}


	public function getObjectOptionList() {

	}


	public function setRealations() {
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.university.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.university.php']);
}

?>
