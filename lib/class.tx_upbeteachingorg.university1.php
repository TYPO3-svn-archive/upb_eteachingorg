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


class university{


	var $objectTable = 'tx_upbeteachingorg_university';


	public function config(){
		GLOBAL $BE_USER;

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
					'objectFieldname' => 'objectid',
                                        'objectFunction' => 'XMLfieldFunc_textonly',
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
                                        'required' => true,
                                        'validate' => 'text',
                                        'objectFieldname' => 'state',
                                        'objectFunction' => 'XMLfieldFunc_writeProjectState',
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
                                        'mm_option' => true,
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


	public function university(){


		$this->getData();
		

//		$this->objects = array('event','training','contact','service','project','tool','toolportrait');
		$this->objects = array('event','project');

	}

	
	public function writeCode(){
		
		return $this->getXMLCode();


	}

	function getObjectCode($objectname){
		$select_fields = "objectid";
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
		$tmpObj->getObjectTemplate('xml');
		$objectTemplate = $tmpObj->getObjectTemplate('xml');

//		t3lib_div::debug($objectTemplate,"OBJ TEMPLATE IN GET OBJ CODE");

		unset($tmpObj);

                if ($GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1){
                        while($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){

//				 t3lib_div::debug($data,"DATA IN UNI");

				$oId = $data['objectid'];

				$object = new $objectname('uuid',$oId);

//				t3lib_div::debug($object,"OBJ IN GETOBJ CODE");

				
        			$object->setProcessMode('loadxml',$objectTemplate);
        			$object->processFields();

//				t3lib_div::debug($object,"OBJ IN GETOBJ CODE 2");

				

        			$markerArray = $object->getMarkerArray();
//        print_r($markerArray);
				
			        $objXMLCode = t3lib_parsehtml::getSubpart($objectTemplate, "###TEMPLATE_LIST###");
				$code = t3lib_parsehtml::substituteMarkerArray($objXMLCode,$markerArray,'',0);

			        $content .= $code;
				
	
				

			}

//			t3lib_div::debug($content,"CONTENT");

			return $content;

		}

	}

	function getXMLCode(){

		t3lib_div::debug($this->data,"THIS DASTE");


		$content = '<?xml version="1.0" encoding="ISO-8859-1"?>'."\n\r";
                $content .= '<!DOCTYPE eteaching-content-syndication SYSTEM "eteaching-org.dtd">'."\n\r";
                $content .= '<eteaching-content-syndication>'."\n\r";
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

	
	protected function getData(){

		//TODO

		$uid = 1;

                $select_fields = '*';
                $from_table = $this->objectTable;
                $objectUid = $GLOBALS['TYPO3_DB']->fullQuoteStr($uid,$from_table);
                $where_clause = " uid = $objectUid AND deleted != 1 AND hidden != 1";
                $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
                $debug = $GLOBALS['TYPO3_DB']->SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');

              t3lib_div::debug($debug,"DEBUG QUERY LOAD BY UID");

                $count = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

                $row2 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);


                if($count == 1){
                        $this->data = $row2;
                }elseif($count > 1){
                        throw new Exception('Object with dublicated Uid in Database',200);
                }elseif($count == 0){
                        throw new Exception('No object with this uid in database',100);
                }



        }


}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.university1.php'])    {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.university1.php']);
}

?>
