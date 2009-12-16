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


class toolportraiteto extends object{


	var $objectTable = 'tx_upbeteachingorg_toolportraiteto';

	var $displayTemplate = array(


			'list' => 'EXT:upb_eteachingorg/pi1/tmpl/list_toolportraiteto.tmpl',
			'detail' => 'EXT:upb_eteachingorg/pi1/tmpl/detail_toolportraiteto.tmpl',
			'xml' => 'EXT:upb_eteachingorg/pi1/tmpl/xml_toolportraiteto.tmpl',



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
				'operating-field' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => 'operating_field',
				),
				'description' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => '',
                                ),
				'category' => array(
                                        'update'        => true,
                                        'insert'        => true,
                                        'fieldFunction' => 'ImportfieldFunc_simpleOptionMulti',
                                        'objectFieldname' => '',
					'multi'         => true,
                                        'options' => array(
                                                        'HTML' => 1,
							'PDF' => 2,
							'Bild' => 3,
							'Audio' => 4,
							'Video' => 5,
							'Animation' => 6,
							'Simulation' => 7,                                                        
							'CBT/WBT' => 8,
                                                        'CMS' => 9,
                                                        'Synchrone Kommunikation' => 10,
                                                        'Asynchrone Kommunikation' => 11,
                                                        'Kooperation' => 12,
                                                        'Präsentation' => 13,
                                                        'LMS' => 14,
							'Aufzeichnung' => 15,
                                                        'Literaturverwaltung' => 16,
                                                        'Macintosh' => 1,
                                                        'Unix / Linux' => 2,
                                                        'Sonstige' => 3,
                                        )

                                ),
				'pros' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => '',
                                ),
                                'cons' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => '',
                                ),
                                'examples' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => '',
                                ),
                                'format' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => '',
                                ),
                                'producer' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => '',
                                ),
                                'price' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => '',
                                ),
				'operating-system' => array(
                                        'update'        => true,
                                        'insert'        => true,
                                        'fieldFunction' => 'ImportfieldFunc_simpleOptionMulti',
                                        'objectFieldname' => 'operating_system',
					'multi'         => true,
                                        'options' => array(
                                                        'Windows' => 0,
                                                        'Macintosh' => 1,
                                                        'Unix / Linux' => 2,
                                                        'Sonstige' => 3,
                                        )

                                ),
                                'level' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => '',
                                ),
                                'tutorials' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => '',
                                ),
                                'references' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => 'reference',
                                ),
                                'option' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
                                	'objectFieldname' => 'options',
                                ),


			),
			
			'load' => array (

				'title' => array(
                                        'required' => true,
                                        'validate' => 'text',
                                        'objectFunction' => 'fieldFunc_textonly',
                                ),

                                'operating-field' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => 'operating_field',
                                ),
                                'description' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => '',
                                ),
                                'category' => array(
                                        'update'        => true,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_writeOption',
                                        'objectFieldname' => '',
                                        'multi'         => true,
                                        'options' => array(
                                                        1 => 'HTML',
                                                        2 => 'PDF',
                                                        3 => 'Bild',
                                                        4 => 'Audio',
                                                        5 => 'Video',
                                                        6 => 'Animation',
                                                        7 => 'Simulation',
                                                        8 => 'CBT/WBT',
                                                        9 => 'CMS',
                                                        10 => 'Synchrone Kommunikation',
                                                        11 => 'Asynchrone Kommunikation',
                                                        12 => 'Kooperation',
                                                        13 => 'Präsentation',
                                                        14 => 'LMS',
                                                        15 => 'Aufzeichnung',
                                                        16 => 'Literaturverwaltung',
                                        )

                                ),
                                'pros' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => '',
                                ),
                                'cons' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => '',
                                ),
                                'examples' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => '',
                                ),
                                'format' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => '',
                                ),
                                'producer' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => '',
                                ),
                                'price' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => '',
                                ),
				'operating-system' => array(
                                        'update'        => true,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_writeOption',
                                        'objectFieldname' => 'operating_system',
                                        'multi'         => true,
                                        'options' => array(
                                                        0 => 'Windows',
                                                        1 => 'Macintosh',
                                                        2 => 'Unix / Linux',
                                                        3 => 'Sonstige',
                                        )

                                ),
                                'level' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => '',
                                ),
                                'tutorials' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => '',
                                ),
                                'references' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => 'reference',
                                ),
                                'option' => array(
                                        'update'        => false,
                                        'insert'        => true,
                                        'objectFunction' => 'fieldFunc_textonly',
                                        'objectFieldname' => 'options',
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
