<?php

require_once('class.tx_upbeteachingorg.object.php');

require_once('class.tx_upbeteachingorg.contact.php');


/**
 * Object Project
 *
 * @author      Heiko Noethen <noethen@uni-paderborn.de>
 * @package     tx_upbeteachingorg
 * @subpackage  lib
 */
class project extends object {


	var $objectTable = 'tx_upbeteachingorg_project';

	var $displayTemplate = array(


			'list' => 'EXT:upb_eteachingorg/pi1/tmpl/list_project.tmpl',
			'detail' => 'EXT:upb_eteachingorg/pi1/tmpl/detail_project.tmpl',
			'xml' => 'EXT:upb_eteachingorg/pi1/tmpl/xml_project.tmpl',



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
						'title' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => '',
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
						'project-state' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_simpleOption',
								'objectFieldname' => 'state',
								'options' => array(
										'Unbekannt' => 0,
										'Aktuell' => 1,
										'Im Aufbau' => 2,
										'Nicht mehr gepflegt' => 3,
								)
						),
						'dtend' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_convertETODateToTimestamp',
								'objectFieldname' => '',
						),
						'project-responsibility' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'type',
						),
						'project-resources' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'resource',
						),
						'item-tags' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'tags',
						),
						'project-partner' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_countMMOption',
								'objectFieldname' => 'partners',
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
						'category' => array(
								'update'	=> true,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_simpleOption',
								'objectFieldname' => '',
								'options' => array(
										'Unbekannt' => 0,
										'Aktuell' => 1,
										'Im Aufbau' => 2,
										'Nicht mehr gepflegt' => 3,
										'Lernumgebung' => 0,
										'Lernmaterial(-sammlung)' => 1,
										'Software' => 2,
										'Lehr-/Lernszenario' => 3,
								)

						),
						'sub-unit' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_countMMOption',
								'objectFieldname' => 'department',
								'multi'		=> true,
								'allowNewElements'	=> true,
						),
				/*
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
				*/

				),

				'insert' => array (

						'pid' => array(
								'objectfield' => true,
								'objectFunction' => 'getETOPid',
						),
						'tstamp' => array(
								'objectfield' => true,
								'objectFunction' => 'getCurrentTimestamp',
						),
						'crdate' => array(
								'objectfield' => true,
								'objectFunction' => 'getCurrentTimestamp',
						),
						'cruser_id' => array(
								'objectfield' => true,
								'objectFunction' => 'setValue',
								'objectFunctionParam' => $BE_USER->user['uid'],
						),
						'deleted' => array(
								'objectfield' => true,
								'objectFunction' => 'setValue',
								'objectFunctionParam' => 0,
						),
						'hidden' => array(
								'objectfield' => true,
								'objectFunction' => 'setValue',
								'objectFunctionParam' => 0,
						),
						'uid' => array(
								'isAttribute' => true,
								'required' => true,
								'validate' => 'objectid',
								'objectFieldname' => 'objectid',
								'objectFunction' => 'passAttribute',
						),
						'title' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'title',
								'objectFunction' => 'textonly',
						),
						'summary' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'summary',
								'objectFunction' => 'textonly',
						),
						'description' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'description',
								'objectFunction' => 'textonly',
						),
						'url' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => 'url',
								'objectFunction' => 'textonly',
						),
						'project-state' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'state',
								'objectFunction' => 'textonly',
						),
						'dtend' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'dtend',
								'objectFunction' => 'convertETODateToTimestamp',
						),
						'project-responsibility' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'type',
								'objectFunction' => 'textonly',
						),
						'project-resources' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'resource',
								'objectFunction' => 'textonly',
						),
						'item-tags' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'tags',
								'objectFunction' => 'textonly',
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
								'validate' => 'isETODate',
								'objectFieldname' => 'dtend',
								'objectFunction' => 'convertETODateToTimestamp',
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
				'update' => array (
						'title' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'title',
								'objectFunction' => 'textonly',
						),
						'summary' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'summary',
								'objectFunction' => 'textonly',
						),
						'description' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'description',
								'objectFunction' => 'textonly',
						),
						'url' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => 'url',
								'objectFunction' => 'textonly',
						),
						'project-state' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'state',
								'objectFunction' => 'getOptionSingle',
						),
						'dtend' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'dtend',
								'objectFunction' => 'convertETODateToTimestamp',
						),
						'project-responsibility' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'type',
								'objectFunction' => 'textonly',
						),
						'project-resources' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'resource',
								'objectFunction' => 'textonly',
						),
						'item-tags' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'tags',
								'objectFunction' => 'textonly',
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
								'objectFunction' => 'getOptionList',
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
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'department',
								'objectFunction' => 'fieldFunc_writeMMOption',
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

						'title' => array(
								'required' => true,
								'validate' => 'text',
								'objectFunction' => 'XMLfieldFunc_textonly',
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
						'url' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => 'url',
								'objectFunction' => 'XMLfieldFunc_writeLink',
						),
						'project-state' => array(
								'required' => false,
								'validate' => 'isCategoryToDo',
								'objectFieldname' => 'state',
								'objectFunction' => 'XMLfieldFunc_writeSimpleOption',
								'options' => array(
										'0' => 'Unbekannt',
										'1' => 'Aktuell',
										'2' => 'Im Aufbau',
										'3' => 'Nicht mehr gepflegt',
								)
						),
						'dtend' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'dtend',
								'objectFunction' => 'XMLfieldFunc_writeDate',
						),
						'dtstart' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'dtstart',
								'objectFunction' => 'XMLfieldFunc_writeDate',
						),
						'project-responsibility' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'type',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'project-resources' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'resource',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'item-tags' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'tags',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'project-partner' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'partners',
								'objectFunction' => 'XMLfieldFunc_writeMMOption',
						),
						'contact' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'contacts',
								'objectFunction' => 'XMLfieldFunc_writeObject',
						),
						'category' => array(
								'required' => false,
								'validate' => 'isCategoryToDo',
								'objectFieldname' => 'category',
								'objectFunction' => 'XMLfieldFunc_writeOption',
								'options' => array(
										'0' => 'Lernumgebung',
										'1' => 'Lernmaterial(-sammlung)',
										'2' => 'Software',
										'3' => 'Lehr-/Lernszenario',
								)
						),
						'sub-unit' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'department',
								'objectFunction' => 'XMLfieldFunc_writeMMOption',
						),
				),
				'mmData' => array(

						'sub-unit' => array(
								'loadDataFunction' => 'getMMOptionData',
								'loadDataParams' => '',
								'mm_option' => true,
								'optionTable' => 'tx_upbeteachingorg_projectdepartment',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_project_department_mm',
								'objectFieldname' => 'department',
						),

						'contact' => array(
								'loadDataFunction' => 'getMMObjects',
								'loadDataParams' => '',
								'mm_object' => true,
								'optionTable' => ' tx_upbeteachingorg_project_contacts_mm',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_project_contacts_mm',
								'objectFieldname' => 'contacts',
								'castObject' => 'contact',
						),
						'project-partner' => array(
								'loadDataFunction' => 'getMMOptionData',
								'loadDataParams' => '',
								'mm_option' => true,
								'optionTable' => 'tx_upbeteachingorg_projectpartner',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_project_partners_mm',
								'objectFieldname' => 'partners',
						),
				),

		);


	}

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	public function getObjectOptionList() {
		return $this->staticOptions;
	}

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	public function getObjectTable() {
		return $this->objectTable;
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$fields_values: ...
	 * @return	[type]		...
	 */
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

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	public function setRealations() {

		// Alle DB Operationen um die Beziehungen zwischen den Objekten korrekt zu speichern / mm und co

	}





}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.project.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.project.php']);
}

?>
