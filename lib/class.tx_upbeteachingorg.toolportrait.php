<?php

require_once('class.tx_upbeteachingorg.object.php');


/**
 * Object Tool
 *
 * @author      Heiko Noethen <noethen@uni-paderborn.de>
 * @package     tx_upbeteachingorg
 * @subpackage  lib
 */
class toolportrait extends object {


	var $objectTable = 'tx_upbeteachingorg_toolportrait';

	var $displayTemplate = array(


			'list' => 'EXT:upb_eteachingorg/pi1/tmpl/list_toolportrait.tmpl',
			'detail' => 'EXT:upb_eteachingorg/pi1/tmpl/detail_toolportrait.tmpl',
			'xml' => 'EXT:upb_eteachingorg/pi1/tmpl/xml_toolportrait.tmpl',



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
								'objectFieldname' => 'uid',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),


						'tstamp' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => '',
								'objectFunction' => 'XMLfieldFunc_writeDate',
						),
						// Ausnahme: Hier wird nicht das Object geladen sondern der Wert direkt in der Field-Func ausgelesen
						'portrait-id' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'portrait_id',
								'objectFunction' => 'XMLfieldFunc_getToolportraitid',
						),
						'contact' => array(
								'required' => false,
								'validate' => 'text',
								'objectFieldname' => 'contacts',
								'objectFunction' => 'XMLfieldFunc_writeObject',
						),

				),
				'mmData' => array(

						'contact' => array(
								'loadDataFunction' => 'getMMObjects',
								'loadDataParams' => '',
								'mm_option' => true,
								'optionTable' => ' tx_upbeteachingorg_toolportrait_contacts_mm',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_toolportrait_contacts_mm',
								'objectFieldname' => 'contacts',
								'castObject' => 'contact',
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
	 * @param	[type]		$mode: ...
	 * @return	[type]		...
	 */
	public function setData($fields_values,$mode) {
		GLOBAL $BE_USER;

		if($mode == 'insert') {
			//Insert
			$debug = $GLOBALS['TYPO3_DB']->INSERTquery($this->objectTable,$fields_values['fields']);
			echo $debug;
			$GLOBALS['TYPO3_DB']->exec_INSERTquery($this->objectTable,$fields_values['fields']);


			$debug = $GLOBALS['TYPO3_DB']->sql_error();

		}else {
			//Update
			echo "setData-Func";

			$where = " objectid = '".$this->data['objectid']."'";
			$debug = $GLOBALS['TYPO3_DB']->UPDATEquery($this->objectTable,$where,$fields_values['fields']);
			$GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->objectTable,$where,$fields_values['fields']);
		}
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

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.toolportrait.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.toolportrait.php']);
}

?>
