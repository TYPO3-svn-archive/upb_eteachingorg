<?php

require_once('class.tx_upbeteachingorg.object.php');


/**
 * Object Contact
 *
 *
 *
 * @author      Heiko Noethen <noethen@uni-paderborn.de>
 * @package     tx_upbeteachingorg
 * @subpackage  lib
 */


class contact extends object {

	var $objectTable = 'tx_upbeteachingorg_contact';

	var $displayTemplate = array(
			'list' => 'EXT:upb_eteachingorg/pi1/tmpl/list_contact.tmpl',
			'detail' => 'EXT:upb_eteachingorg/pi1/tmpl/detail_contact.tmpl',
			'xml' => 'EXT:upb_eteachingorg/pi1/tmpl/xml_contact.tmpl',
	);

	public function config() {
		GLOBAL $BE_USER;

		/*
			here we care about what is in the values_array. For example the objectid
		 	is required for a new event-object but not allowed to be updated

			required			needed to be set in feed
			validate			feed data musst be valid against this function
			objectFieldname		mapping between feed and object/database
			objectFunction		function to transform feed data into database date
								for example date musst be transformed to timestamp

			objectfield			field not in feed
								all required: needs to be set
								no validation at the moment

			field types:

			attribute			import value from attribute
			fields				normal field -> data directly to database
			mm_options			option of the object -> write to mm table
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


						'academic-degree' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'honorific_suffix',
						),
						'given-name' => array(

								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'givenname',
						),
						'family-name' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'familyname',
						),
						'email' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'email',
						),
						'fon' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'phone',
						),
						'url' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'url',
						),
						'photo' => array(
								'update'	=> false,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_textonly',
								'objectFieldname' => 'photourl',
						),
						'role' => array(
								'update'	=> true,
								'insert'	=> true,
								'fieldFunction' => 'ImportfieldFunc_countMMOption',
								'objectFieldname' => 'role',
								'multi'		=> true,
								'allowNewElements'	=> true,
						),
						'tool-id' => array(
								'update'        => true,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_countMMOption',
								'objectFieldname' => 'tools',
								'multi'         => true,
								'allowNewElements'      => true,
						),
						'tool-portrait-id' => array(
								'update'        => true,
								'insert'        => true,
								'fieldFunction' => 'ImportfieldFunc_countMMOption',
								'objectFieldname' => 'portraits',
								'multi'         => true,
								'allowNewElements'      => true,
						),
				/*                                'tool-id' => array(
                                        'required' => false,
                                        'validate' => 'isETODate',
                                        'objectFieldname' => 'tools',
                                        'objectFunction' => 'XMLfieldFunc_writeObjectLight',
                                ),
                                'tool-portrait-id' => array(
                                        'required' => false,
                                        'validate' => 'isETODate',
                                        'objectFieldname' => 'portrait',
					'valueField' => 'objectid',
                                        'objectFunction' => 'XMLfieldFunc_writeMMOption',
                                ), */






				),

				'load' => array (
						'academic-degree' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'honorific_suffix',
								'objectFunction' => 'fieldFunc_textonly',
						),
						'given-name' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'givenname',
								'objectFunction' => 'fieldFunc_textonly',
						),
						'family-name' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'familyname',
								'objectFunction' => 'fieldFunc_textonly',
						),
						'email' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'email',
								'objectFunction' => 'fieldFunc_writeMail',
						),
						'fon' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'phone',
								'objectFunction' => 'fieldFunc_textonly',
						),
						'url' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => '',
								'objectFunction' => 'fieldFunc_writeLink',
						),
						'photo' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => 'photourl',
								'objectFunction' => 'fieldFunc_writeImage',
						),
						'role' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'role',
								'objectFunction' => 'fieldFunc_writeMMOption',
						),
						'tool-id' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'tools',
								'objectFunction' => 'fieldFunc_writeObjectLight',
						),
						'tool-portrait-id' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'portraits',
								'objectParams' => array(
										'light' => true,
								),
								'valueField' => 'objectid',
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

						'academic-degree' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'honorific_suffix',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'given-name' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'givenname',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'family-name' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'familyname',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'email' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'email',
								'objectFunction' => 'XMLfieldFunc_writeMail',
						),
						'fon' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'phone',
								'objectFunction' => 'XMLfieldFunc_textonly',
						),
						'url' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => '',
								'objectFunction' => 'XMLfieldFunc_writeLink',
						),
						'photo' => array(
								'required' => true,
								'validate' => 'url',
								'objectFieldname' => 'photourl',
								'objectFunction' => 'XMLfieldFunc_writeLink',
						),
						'role' => array(
								'required' => true,
								'validate' => 'text',
								'objectFieldname' => 'role',
								'objectFunction' => 'XMLfieldFunc_writeMMOption',
						),
						'tool-id' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'tools',
								'objectFunction' => 'XMLfieldFunc_writeObjectLight',
						),
						'tool-portrait-id' => array(
								'required' => false,
								'validate' => 'isETODate',
								'objectFieldname' => 'portraits',
								'objectParams' => array(
										'light' => true,
								),
								'objectFunction' => 'XMLfieldFunc_writeObjectPortraitId',
						),
				),
				'mmData' => array(

						'role' => array(
								'loadDataFunction' => 'getMMOptionData',
								'loadDataParams' => '',
								'mm_option' => true,
								'optionTable' => 'tx_upbeteachingorg_role',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_contact_roles_mm',
								'objectFieldname' => 'role',
						),
						'tool-id' => array(
								'loadDataFunction' => 'getMMObjectsLight',
								'loadDataParams' => '',
								'mm_option' => true,
								'optionTable' => 'tx_upbeteachingorg_tool',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_contact_tools_mm',
								'objectFieldname' => 'tools',
								'castObject' => 'tool',
								'mm_object' => true,
						),
						'tool-portrait-id' => array(
								'loadDataFunction' => 'getMMObjects',
								'loadDataParams' => '',
								'mm_object' => true,
								'optionTable' => 'tx_upbeteachingorg_toolportraiteto',
								'optionTableWhereField' => 'title',
								'mmTable' => 'tx_upbeteachingorg_contact_portraits_mm',
								'objectFieldname' => 'portraits',
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


	public function setRealations() {
		// Alle DB Operationen um die Beziehungen zwischen den Objekten korrekt zu speichern / mm und co
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.contact.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.contact.php']);
}

?>
