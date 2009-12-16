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


class toolportrait extends object{


	var $objectTable = 'tx_upbeteachingorg_toolportrait';

	var $displayTemplate = array(


			'list' => 'EXT:upb_eteachingorg/pi1/tmpl/list_toolportrait.tmpl',
			'detail' => 'EXT:upb_eteachingorg/pi1/tmpl/detail_toolportrait.tmpl',
			'xml' => 'EXT:upb_eteachingorg/pi1/tmpl/xml_toolportrait.tmpl',



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

	public function getObjectOptionList(){

		return $this->staticOptions;

	}


        public function getData(){

                return $this->data;


        }

	public function getObjectTable(){
		return $this->objectTable;
	}


        public function setData($fields_values,$mode){
		GLOBAL $BE_USER;


//		print_r("SET DATA ALL");

//		print_r($this);

		if($mode == 'insert'){
			//Insert
			$debug = $GLOBALS['TYPO3_DB']->INSERTquery($this->objectTable,$fields_values['fields']); 
			echo $debug;
		        $GLOBALS['TYPO3_DB']->exec_INSERTquery($this->objectTable,$fields_values['fields']);


			$debug = $GLOBALS['TYPO3_DB']->sql_error();
	
//			echo "DEBUG ERROR MYSQL";
//			print_r($debug);
//			echo "END ERROR MYSQL INSERT";


//			$this->writeMMOptions('insert');

			//$this->loadByUuid($fields_values['objectid']);

			

		}else{
			//Update
			echo "setData-Func";

			$where = " objectid = '".$this->data['objectid']."'";
			$debug = $GLOBALS['TYPO3_DB']->UPDATEquery($this->objectTable,$where,$fields_values['fields']);
			 $GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->objectTable,$where,$fields_values['fields']);

//			print_r($debug);

//			$debug = $GLOBALS['TYPO3_DB']->sql_error();

 //                       echo "DEBUG ERROR UPDATE MYSQL";
   //                     print_r($debug);
     //                   echo "END ERROR MYSQL UPDATE";

	

//			echo $debug;

//			$this->writeMMOptions('update');


		}



        }

/*
	private function writeMMOptions($mode){

		echo "writeMMOptions";

		if($mode == 'insert')
			$mode = 'insert';
		elseif($mode == 'update')
			$mode = 'update';
		else
			$mode = '';

		if ($mode == '')
			return false;

		$tmpConf = $this->getCalculatedConf("mm_option",true,$mode);
		$data = $this->getData();


		foreach($tmpConf as $key => $conf){

			echo "DATA IN PROJECT MM OPTIONS";
			print_r($data);




		}



	}


	private function getCalculatedConf($option,$optionValue,$modus){


		if($modus == 'insert')
			$conf = $this->fields['insert'];
		elseif($modus == 'update')
			$conf = $this->fields['update'];

		$array = array();

		if($option == 'mm_option')
			$optionSetting = 'mm_option';

		foreach($conf as $key => $field){

			if($field[$optionSetting] == $optionValue)
			$array[$key] = $field;

		}

		echo "CALCULATED CONF";
		print_r($array);

		return $array;

	}

*/


	/*

		Input jedes Feld einzeln und damit wiederholend aufgerufen? Nein.

		WO DIE INTELIGENZ HINLEGEN? IN DIE OBJECTE ODER DEN IMPORTER? IMPORTER MUSS IMMER FÜR ALLE IMPLEMENTIEREN.

		$project->allMMOptionsAvailable();

			für alle mmOptions
				für alle Daten der mmOption

		function allMMOptionsAvailable($mmOptionsDataArray){

			$tmpConf = $this->getCalculatedConf("mmOptions");
			$returnValue = true;

			foreach(tmpConf as $xmlField => $fieldconf){

				if($fieldconf['required'] == true){
					//Query if option is aivailable

						

					//if is multioption accept one as ok

					//all options available
				}else{
					if($extConf['ignoreFailureImportingNotNeededOptions'] == 1){
						//true
					}else{
						//
					}
				}

			}

		}

		function setData(){

			if(allMMOptionsAvailable()){

				$objectDBUid = $this->writeObjectToDB();
				writeOptions($objectDBUid);
				updateObjectForCounts($objectDBUid);


			}


		}
		

	*/

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
