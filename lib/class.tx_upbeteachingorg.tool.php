<?php

require_once('class.tx_upbeteachingorg.object.php');


/**
 * Object Tool
 *
 * 
 *
 * @author      Heiko Noethen <noethen@uni-paderborn.de>
 * @package     tx_upbeteachingorg
 * @subpackage  lib
 */


class tool extends object{


	var $objectTable = 'tx_upbeteachingorg_tool';

	var $displayTemplate = array(


			'list' => 'EXT:upb_eteachingorg/pi1/tmpl/list_tool.tmpl',
			'detail' => 'EXT:upb_eteachingorg/pi1/tmpl/detail_tool.tmpl',
			'xml' => 'EXT:upb_eteachingorg/pi1/tmpl/xml_tool.tmpl',



		);


	public function config(){
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
				'url' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => 'url',
				),
				'description' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => '',
                                ),
				'category' => array(
                                	'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_countMMOption',
                                	'objectFieldname' => 'categories',
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
                                        'objectFieldname' => 'title',
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
                                        'objectFieldname' => '',
                                        'objectFunction' => 'fieldFunc_writeLink',
                                ),
                                'category' => array(
                                        'required' => true,
                                        'validate' => 'text',
                                        'objectFieldname' => 'categories',
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
                                        'objectFieldname' => 'title',
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
                                        'objectFieldname' => '',
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
                        ),
			'mmData' => array(

				'category' => array(
                                        'loadDataFunction' => 'getMMOptionData',
                                        'loadDataParams' => '',
                                        'mm_option' => true,
                                        'optionTable' => 'tx_upbeteachingorg_toolcategories',
                                        'optionTableWhereField' => 'title',
                                        'mmTable' => 'tx_upbeteachingorg_tool_categories_mm',
					'objectFieldname' => 'categories',
                                ),
				'contact' => array(
                                        'loadDataFunction' => 'getMMObjects',
                                        'loadDataParams' => '',
                                        'mm_object' => true,
                                        'optionTable' => ' tx_upbeteachingorg_tool_contacts_mm',
                                        'optionTableWhereField' => 'title',
                                        'mmTable' => 'tx_upbeteachingorg_tool_contacts_mm',
                                        'objectFieldname' => 'contacts',
                                        'castObject' => 'contact',
                                ),
			),

		);	


	}

	public function getObjectOptionList(){

		return $this->staticOptions;

	}


        public function getData(){

                return $this->data;


        }

	public function getObjectTable(){
		return $this->objectTable;
	}

        
	public function updateMMOptionsData($fields_values){

			$where = " objectid = '".$this->data['objectid']."'";

                        $debug = $GLOBALS['TYPO3_DB']->UPDATEquery($this->objectTable,$where,$fields_values);
                         $GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->objectTable,$where,$fields_values);

			if($GLOBALS['TYPO3_DB']->sql_error()){

				throw new Exception('Database Query Error in UpdateMMOptionsData',203);

			}

			foreach($fields_values as $field => $value){
				$this->data[$field] = $value;
			}
	
	}


        public function setRealations(){

                // Alle DB Operationen um die Beziehungen zwischen den Objekten korrekt zu speichern / mm und co

        }



}
?>
