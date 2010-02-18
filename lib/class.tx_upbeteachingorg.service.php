<?php

require_once('class.tx_upbeteachingorg.object.php');

require_once('class.tx_upbeteachingorg.contact.php');


/**
 * Object Service
 *
 *
 *
 * @author      Heiko Noethen <noethen@uni-paderborn.de>
 * @package     tx_upbeteachingorg
 * @subpackage  lib
 */


class service extends object {


	var $objectTable = 'tx_upbeteachingorg_service';

	var $displayTemplate = array(


			'list' => 'EXT:upb_eteachingorg/pi1/tmpl/list_service.tmpl',
			'detail' => 'EXT:upb_eteachingorg/pi1/tmpl/detail_service.tmpl',
			'xml' => 'EXT:upb_eteachingorg/pi1/tmpl/xml_service.tmpl',



	);


	public function config() {
		GLOBAL $BE_USER;

		/*

			here we care about what is in the values_array. For ex. the objectid is required for
			new event objects but not allowed to be updated

			required		needed to be set in feed
			validate		feed data musst be valid against this function
			objectFieldname		mapping between feed an object/database
			objectFunction		function to transform feed data into database date
						for ex. date musst be transformed to timestamp
			

			objectfield		field not in feed
						all required: needs to be set
						no validation at the moment


			field types:

			attribute		import value from attribute
			fields			normal field -> data directly to database
			mm_options		option of the object -> write to mm table
			object_fields		to set value only in database, value not given by stream
			mm_relations		relation to other object

		*/


		$this->staticOptions = array(

				'project-state' => array(

						'unbekannt' => '0',
						'aktuell' => '1',
						'im aufbau' => '2',
						'nicht mehr gepflegt' => '3',

				),
				'category' => array(
						'lernumgebung' => '0',
						'lernmaterial' => '1',
						'lernmaterial(-sammlung)' => '1',
						'software' => '2',
						'lehr-/lernszenario' => '3',
				),
		);


		$this->fields = array(

				'import' => array (

						'pid' => array(
								'update'	=> false,
								'insert'	=> true,
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
								'update'	=> true,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_convertETODateToTimestamp',
								'objectFieldname' => 'tstamp',
								'isAttribute'	=> true,
						),
						'crdate' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_convertETODateToTimestamp',
								'objectFieldname' => 'crdate',
						),
						'cruser_id' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_setValue',
								'fieldFunctionParam' => $BE_USER->user['uid'],
								'objectFieldname' => '',
						),
						'deleted' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_setValue',
								'fieldFunctionParam' => 0,
								'objectFieldname' => '',
						),
						'hidden' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_setValue',
								'fieldFunctionParam' => 0,
						),
						'uid' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'objectid',
								'isAttribute'	=> true,
						),
						'summary' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => '',
						),
						'description' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => '',
						),
						'url' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => '',
						),
						'item-tags' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'tags',
						),
						'category' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_countMMOption',
								'objectFieldname' => 'serviceCategories',
								'multi'		=> true,
								'allowNewElements'	=> true,
						),
						'contact' => array(
								'update'	=> true,
								'insert'	=> true,
								'relation'	=> true,

								'fieldFunction' => 'ImportfieldFunc_countMMOption',
								'objectFieldname' => 'contacts',
								'relationFunction' => 'ImportsetMMOptionContact',
								'relationParams' => array(
										'optionTable' => 'tx_upbeteachingorg_projectdepartment',
										'mmTable' => 'tx_upbeteachingorg_project_department_mm',
								)
						),
						'tool-id' => array(
								'update'        => true,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_countMMOption',
								'objectFieldname' => 'tool',
								'multi'         => true,
								'allowNewElements'      => true,
						),
						'tool-portrait-id' => array(
								'update'        => true,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_countMMOption',
								'objectFieldname' => 'toolportrait',
								'multi'         => true,
								'allowNewElements'      => true,
						),

				),

				'load' => array (
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
						'item-tags' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'tags',
								'objectFunction' => 'fieldFunc_textonly',
						),
						'url' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => 'url',
								'objectFunction' => 'fieldFunc_writeLink',
						),
						'category' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'serviceCategories',
								'objectFunction' => 'fieldFunc_writeMMOption',
						),
						'contact' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'contacts',
								'objectFunction' => 'fieldFunc_writeObject',
								'objectParams' => array(
										'light' => true,
										'title' => array(
												'function' => 'concat',
												'fields' => array('honorific_suffic','givenname','familyname')
										),
								),
						),
						'tool-id' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'tool',
								'objectParams' => array(
										'light' => true,
								),
								'objectFunction' => 'fieldFunc_writeObject',
						),
						// TODO
						'tool-portrait-id' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'toolportrait',
								'objectParams' => array(
										'light' => true,
								),
								'objectFunction' => 'fieldFunc_writeToolPortraitLink',
						),

						'morelink'  => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'morelink',
								'objectFunction' => 'fieldFunc_writeMoreLink',
						),


				),
				'loadxml' => array (
						'uid' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'objectid',
								'objectFunction' => 'XMLfieldFunc_writeUid',
						),
						'tstamp' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => '',
								'objectFunction' => 'XMLfieldFunc_writeDate',
						),
						'summary' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'summary',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'description' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'description',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'item-tags' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'tags',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'url' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => 'url',
								'objectFunction' => 'XMLfieldFunc_writeLink',
						),
						'category' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'categories',
								'objectFunction' => 'XMLfieldFunc_writeMMOption',
						),
						'contact' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'contacts',
								'objectFunction' => 'XMLfieldFunc_writeObject',
						),
						'tool-id' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'tool',
								'objectFunction' => 'XMLfieldFunc_writeObjectLight',
						),
						'tool-portrait-id' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'toolportrait',
								'objectFunction' => 'XMLfieldFunc_writeObjectPortraitId',
						),
				),
				'mmData' => array(

						'contact' => array(
								'loadDataFunction' => 'getMMObjects',
								'loadDataParams' => '',
								'mm_object' => true,
								'optionTable' => ' tx_upbeteachingorg_service_contacts_mm',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_service_contacts_mm',
								'objectFieldname' => 'contacts',
								'castObject' => 'contact',
						),
						'category' => array(
								'loadDataFunction' => 'getMMOptionData',
								'loadDataParams' => '',
								'mm_option' => true,
								'optionTable' => 'tx_upbeteachingorg_servicecategory',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_service_categories_mm',
								'objectFieldname' => 'serviceCategories',
						),
						'tool-id' => array(
								'loadDataFunction' => 'getMMObjectsLight',
								'loadDataParams' => '',
								'mm_object' => true,
								'optionTable' => 'tx_upbeteachingorg_tool',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_service_tools_mm',
								'objectFieldname' => 'tool',
								'castObject' => 'tool',
						),
						'tool-portrait-id' => array(
								'loadDataFunction' => 'getMMObjects',
								'loadDataParams' => '',
								'mm_object' => true,
								'optionTable' => 'tx_upbeteachingorg_toolportraiteto',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_service_toolportraits_mm',
								'objectFieldname' => 'toolportrait',
								'castObject' => 'toolportraiteto',
						),
				),

		);


	}

	public function getObjectOptionList() {
		return $this->staticOptions;
	}


	public function getData() {
		return $this->data;
	}

	public function getObjectTable() {
		return $this->objectTable;
	}

	public function updateMMOptionsData($fields_values) {
		$where = " objectid = '".$this->data['objectid']."'";
		$debug = $GLOBALS['TYPO3_DB']->UPDATEquery($this->objectTable,$where,$fields_values);
		$GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->objectTable,$where,$fields_values);

		if($GLOBALS['TYPO3_DB']->sql_error()) {
			throw new Exception('Database Query Error in UpdateMMOptionsData',203);
		}

		foreach($fields_values as $field => $value) {
			$this->data[$field] = $value;
		}
	}

	// TODO Entweder muss hier was richtiges passieren oder weg damit
	public function setRealations() {
		// Alle DB Operationen um die Beziehungen zwischen den Objekten korrekt zu speichern / mm und co
	}



}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.service.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.service.php']);
}

?>
