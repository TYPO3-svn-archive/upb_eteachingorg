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


class university extends object{


	var $objectTable = 'tx_upbeteachingorg_university';

	var $displayTemplate = array(


                        'list' => 'EXT:upb_eteachingorg/pi1/tmpl/list_university.tmpl',
                        'detail' => 'EXT:upb_eteachingorg/pi1/tmpl/detail_university.tmpl',
                        'xml' => 'EXT:upb_eteachingorg/pi1/tmpl/xml_university.tmpl',



        );


	public function config(){
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
					'objectParams' => array(
                                                'light' => true,
                                        ),
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
                                        'optionTable' => ' tx_upbeteachingorg_university_tools_mm',
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


//		$this->objects = array('event','training','contact','service','project','tool','toolportrait');

	
	public function writeCode(){
		
	//	return $this->getXMLCode();


	}

	function getObjectCode($obj,$fieldname){

		$conf = fieldFunction::getFieldConf($obj,$fieldname);
		
		$objectname = $conf['castObject'];

		$select_fields = "uid";
		$tmpObj = new $objectname();

                $from_table =  $tmpObj->objectTable;
		//TODO PID!
                $where_clause = ' pid = 21965 AND deleted=0';
                $resultArray = array();
                $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
                $deb = $GLOBALS['TYPO3_DB']->SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
//		t3lib_div::debug($deb,"QUERY IN UNI");

                $numRows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

//		t3lib_div::debug($numRows,"NUM ROWS IN UNI");

                $returnData = array();

//		$tmpObj = new $objectname();
//		$tmpObj->getObjectTemplate('xml');
		$objectTemplate = $tmpObj->getObjectTemplate('xml');
//		t3lib_div::debug($objectTemplate,"OBJ TEMPLATE IN GET OBJ CODE");
		unset($tmpObj);

                if ($GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1){
                        while($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
				if(isset($object))
				print_r("IST NOCH GESETZT");


//				 t3lib_div::debug($data,"DATA IN UNI");

				$oId = $data['uid'];

				$object = new $objectname('uid',$oId);

//				t3lib_div::debug($object,"OBJ IN GETOBJ CODE");

				
        			$object->setProcessMode('loadxml',$objectTemplate);
        			$object->processFields();

//				if($objectname == 'contact')
//				t3lib_div::debug($object,"OBJ contact");

				

        			$markerArray = $object->getMarkerArray();

//				if($objectname == 'contact')
  //                              t3lib_div::debug($markerArray,"MARKERARRAY Ctact");

			        $objXMLCode = t3lib_parsehtml::getSubpart($objectTemplate, "###TEMPLATE_LIST###");
				$code = t3lib_parsehtml::substituteMarkerArray($objXMLCode,$markerArray,'',0);
			        $content .= $code;
				unset($object);	

			}

//			t3lib_div::debug($content,"CONTENT");

			return $content;

		}

	}

	function getXMLCode(){

//		t3lib_div::debug($this->data,"THIS DASTE");


		$content = '<?xml version="1.0" encoding="UTF-8"?>'."\n\r";
                $content .= '<!DOCTYPE eteaching-import SYSTEM "eteaching-import.dtd" >'."\n\r";
                $content .= '<eteaching-import>'."\n\r";
                $content .= '<university id="'.$universityData['objectid'].'" key="6576565465465606">'."\n\r";

                $content .= '   <university-info><![CDATA['.$this->data['info'].']]></university-info>'."\n\r";
                $content .= '   <university-news><![CDATA['.$this->data['news'].']]></university-news>'."\n\r";


//		foreach($this->objects as $key => $objectname){
//			$content .= $this->getObjectCode($objectname);

			 $content .= $this->getObjectCode('project');

//		}
//		$content = '123';	

//		t3lib_div::debug($content,"CONTENT in GET XML CODE");

		return $content;


	}

	public function getData(){

                return $this->data;


        }


	public function getObjectOptionList(){

	}


	 public function setRealations(){

                // Alle DB Operationen um die Beziehungen zwischen den Objekten korrekt zu speichern / mm und co

        }

}
?>
