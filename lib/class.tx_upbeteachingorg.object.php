<?php

/**
 * Object Lib
 *
 * Abstract Base Class of all objects like events
 *
 * @author      Heiko Noethen <noethen@uni-paderborn.de>
 * @package 	tx_upbeteachingorg
 * @subpackage	lib
 */

/*


	Die Objecte definieren eine Konfiguration, welche die verschiedenen Sichtena auf das Objekt definieren
	
	Field
		Options

			objectFieldname		Überschreibt den bei Field angegebenen Namen und verweist auf den Objektnamen/Internen Namen(DB)



*/


abstract class object{

        var $data = array();
        var $importData = array();
        var $id;

	var $processedFieldData = array();
        var $processedXMLData = array();
        var $processedImportData = array();

	var $processMode = 'load';

	var $template = '';

	var $level;

	var $pid;


        abstract public function getData();
        abstract public function setRealations();
	abstract public function getObjectOptionList();


        function __construct($mode='new',$value='',$level=0,$forceLight=0){

		$this->extConf =  unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['upb_eteachingorg']);


                switch($mode){

                        case 'new': $this->initNewObject();
				$this->level = $level;
				$this->config();
                        break;
                        case 'uid': 
				$this->loadByUid($value);
				$this->level = $level;
				$this->config();
				$this->processLoadingData($forceLight);
                        break;
                        case 'uuid': $this->loadByUuid($value);
				$this->level = $level;
				$this->config();
				$this->processLoadingData();
                        break;

                }


        }

	public function getFieldValue($field){


                return $this->data[$field];

        }
        
	public function getImportFieldValue($field){


                return $this->importData[$field];

        }


        public function getConf(){

                return $this->fields;

        }

        protected function initNewObject(){


        }

	public function setPid($pid){

		$this->pid = intval($pid);

	}

	public function getPid(){

		return $this->pid;

	}

	public function setSyncId($syncId){

		$this->syncId = intval($syncId);

	}

	public function getSyncId(){

		return $this->syncId;

	}

	public function loadByUuid($uuid){

                $select_fields = '*';
                $from_table = $this->objectTable;
                $objectId = $GLOBALS['TYPO3_DB']->fullQuoteStr($uuid,$from_table);
                $where_clause = " objectid = $objectId AND deleted != 1 AND hidden != 1";
                $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
                $debug = $GLOBALS['TYPO3_DB']->SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');

//		print_r($debug);
                
                $count = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

		$row2 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
		

                if($count == 1){
                        $this->data = $row2;
                }elseif($count > 1){
                        throw new Exception('Object with dublicated UUid in Database',200);
                }elseif($count == 0){
                        throw new Exception('No object with '.$uuid.' uuid in database',100);
                }



        }

	 protected function loadByUid($uid){

                $select_fields = '*';
                $from_table = $this->objectTable;
                $objectUid = $GLOBALS['TYPO3_DB']->fullQuoteStr($uid,$from_table);
                $where_clause = " uid = $objectUid AND deleted != 1 AND hidden != 1";
                $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
                //$debug = $GLOBALS['TYPO3_DB']->SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
                
                $count = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

                $row2 = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);


                if($count == 1){
                        $this->data = $row2;
                }elseif($count > 1){
                        throw new Exception('Object '.$from_table.' with dublicated Uid in Database',200);
                }elseif($count == 0){
                        throw new Exception('No object '.$from_table.' with uid '.$uid.'in database',100);
                }



        }


	/*

		foreach conf field with loadData processLoadingData

	*/

	public function processLoadingData($forceLight=0){

                $conf = $this->fields['mmData'];
		if(is_array($conf))	
		foreach($conf as $key => $field){

			if($field['loadDataFunction'] != ''){	
	                        if (method_exists  ($this,$field['loadDataFunction'] )){

        	                        $params = array();
                        	        $params['obj'] = $this;
                	                $params['fieldname'] = $key;


				//	$debug =  "DEBHN LEVEL:: ". $this->level ." FIELDNAME:: ".$params['fieldname'] . " FUNCTION " . $field['loadDataFunction'];
				//	t3lib_div::debug($debug,"DEBUG HN");


					if( ($this->level == 0 || $field['loadDataFunction'] == 'getMMOptionData' ) && ($field['loadDataFunction'] != 'getMMObjectsLight') && ($forceLight==0 ||$field['loadDataFunction'] == 'getMMOptionData' )) {
	                                	$returnValue = call_user_func_array(array($this,$field['loadDataFunction']),$params);
						 $fieldName = 'loaded_'.$field['objectFieldname'];

                                                $this->data[$fieldName] = $returnValue;
					}else{
						
						if($field['loadDataFunction'] == 'getMMObjects' || $field['loadDataFunction'] == 'getMMObjectsLight')
						$returnValue = call_user_func_array(array($this,'getMMObjectsLight'),$params);

        	                        	$fieldName = 'loadedLight_'.$field['objectFieldname'];

                	                        $this->data[$fieldName] = $returnValue;

					}


                        	}
			}elseif($field['loadObjectFunction'] != ''){

				$object = 1;


			}


                }
	

	}


	public function processFields(){

		$confType = $this->getProcessMode();

                $conf = $this->fields[$confType];
	

                foreach($conf as $key => $field){

                        if (method_exists  ('fieldFunction',$field['objectFunction'] ) || method_exists  ($this,$field['objectDirectFunction'] )){

                                $params = array();
                                $params['obj'] = $this;
                                $params['fieldname'] = $key;

				if($field['objectFunction'] !=''){
        	                        $returnValue = call_user_func_array(array('fieldFunction',$field['objectFunction']),$params);
				}elseif($field['objectDirectFunction']){
					$returnValue = call_user_func_array(array($this,$field['objectDirectFunction']),$params);
				}

				$internalFieldName = $this->getInternalFieldname($key);

                                if($confType == 'load'){
                                        $this->processedFieldData[$internalFieldName] = $returnValue;
                                }elseif($confType == 'loadxml'){
                                        $this->processedXMLData[$internalFieldName] = $returnValue;
                                }

                        }


                }


        }

	public function getMarkerArray(){

		$type = $this->getProcessMode();

                switch($type){

                        case 'loadxml': $dataArray = $this->processedXMLData;
                                        break;
                        default: $dataArray = $this->processedFieldData;


                }

                $markerArray = array();

                foreach($dataArray as $field => $value){
			
			$internalFieldname = $this->getInternalFieldname($field);
                        $markerName = '###'.strtoupper($internalFieldname).'###';
                        $markerArray[$markerName] = $value;
                }

		
                return $markerArray;

        }

	public function getProcessMode(){

		return $this->processMode;

	}

	public function setProcessMode($mode,$template){

		 switch($mode){

                        case 'loadxml': $objMode = 'loadxml';
                                        break;
                        case 'import': $objMode = 'import';
                                        break;                                        
                        default: $objMode = 'load';

                }	

		$this->processMode = $objMode;
		$this->template = $template;


	}

	public function getTemplate(){


		return $this->template;

	}

	public function getInternalFieldname($fieldname){

                $mode = $this->getProcessMode();
                $mappedName = $this->fields[$mode][$fieldname]['objectFieldname'];

		if($mappedName != '')
			return $mappedName;
		else
			return $fieldname;

        }


	function getMMOptionData($obj,$fieldname){

		$objectname = get_class($obj);
		$conf = fieldFunction::getFieldConf($obj,$fieldname);

		$conf = $obj->fields['mmData'][$fieldname];

		$objectUid = $obj->getFieldValue('uid');

                if (intval($objectUid) != 0){

                        $select = $conf['optionTable'].'.*';
                        $local_table = $obj->objectTable;
                        $mm_table = $conf['mmTable'];
                        $foreign_table = $conf['optionTable'];
                        $where = ' AND '.$local_table.'.uid = '.$objectUid;
                        $groupBy = ' uid';
                        $orderBy = ' uid';
                        $limit = 1000;


                        $res = $GLOBALS['TYPO3_DB']->exec_SELECT_mm_query($select,$local_table,$mm_table,$foreign_table, $where);

                        $numRows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

                        $returnData = array();


                        if ($GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1){
                                while($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){

                                        $returnData[] = $data;


                                }

                                return $returnData;
                        }else{
                                return 0;
                        }
                }else{
                return 0;
                }


       	}


	function getMMObjects($obj,$fieldname){

		$objectname = get_class($obj);
                $conf = $obj->fields['mmData'][$fieldname];
                $objectUid = $obj->getFieldValue('uid');

                if (intval($objectUid) != 0){

                        $select = 'uid_foreign,tablenames';
			$table = $conf['mmTable'];
                        $where = ' uid_local = '.$objectUid;
                        $groupBy = ' ';
                        $orderBy = ' ';
                        $limit = 1000;


                        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select,$table, $where);
	
//			$debug = $GLOBALS['TYPO3_DB']->SELECTquery($select,$table, $where);

//			t3lib_div::debug($debug,"TABLE QUERY");

                        $numRows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

                        $returnData = array();

			$tmpCode = array();

			if($conf['multicast'] == false){
                                  $tmp = new $conf['castObject'];
				  $tmpCode[$conf['castObject']] = $tmp->getObjectTemplate('xml');
                        }else{

				foreach($conf['templatePreload'] as $key => $objectPre){

					$tmp = new $objectPre;
                                        $tmpCode[$objectPre] = $tmp->getObjectTemplate('xml');

                               }

			}

                        if ($GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1){
                                while($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){

					if($conf['multicast'] == false){
			                        $newObjectName = $conf['castObject'];
        			        }else{
	
        	                		$newObjectName = $conf[$data['tablenames']];

                			}


					$level = $obj->level +1;
                                        $tmpObject = new $newObjectName('uid',$data['uid_foreign'],$level);
					$templateCode = $tmpCode[$newObjectName];
					$tmpObject->setProcessMode('loadxml',$tmpCode[$newObjectName]);
					$tmpObject->processFields();

					$returnData[] = $tmpObject;



                                }


                                return $returnData;
                        }else{
                                return 0;
                        }
                }else
                return 0;


        }



	function getMMObjectsLight($obj,$fieldname){

                $objectname = get_class($obj);

                $conf = $obj->fields['mmData'][$fieldname];
                $objectUid = $obj->getFieldValue('uid');

                if (intval($objectUid) != 0){

                        $select = 'uid_foreign,tablenames';
                        $table = $conf['mmTable'];
                        $where = ' uid_local = '.$objectUid;
                        $groupBy = ' ';
                        $orderBy = ' ';
                        $limit = 1000;


                        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select,$table, $where);

                        // $debug = $GLOBALS['TYPO3_DB']->SELECTquery($select,$table, $where);

                        $numRows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

                        $returnData = array();

			if($conf['multicast'] == false){
                                  $tmp = new $conf['castObject'];
                                  $tmpCode[$conf['castObject']] = $tmp->getObjectTemplate('xml');
                        }else{

                                foreach($conf['templatePreload'] as $key => $objectPre){

                                        $tmp = new $objectPre;
                                        $tmpCode[$objectPre] = $tmp->getObjectTemplate('xml');

                               }

                        }


                        if ($GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1){
                                while($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){

					if($conf['multicast'] == false){
                                                $newObjectName = $conf['castObject'];
                                        }else{

                                                $newObjectName = $conf[$data['tablenames']];

                                        }



                                        $level = $obj->level +1;

					if($level < 3){
        	                                $tmpObject = new $newObjectName('uid',$data['uid_foreign'],$level);
	                                        $tmpObject->level = $obj->level +1;
                                        	$returnData[] = $tmpObject;
					}

                                }

//                                t3lib_div::debug($returnData[0],"RETUNR DATA99928 LIGHT");

                                return $returnData;
                        }else{
                                return 0;
                        }
                }else
                return 0;


        }

	function getObjectTemplate($type){


		$filePath = '';


		switch($type){


			case 'list' : $filePath = $this->displayTemplate['list'];
				break;

			case 'detail' : $filePath = $this->displayTemplate['detail'];
				break;
	
			case 'xml' : $filePath = $this->displayTemplate['xml'];


		}


		$cObj = t3lib_div::makeInstance('tslib_cObj');
 		return $cObj->fileResource($filePath);

	}


	 function getThisObjectCode($piConf){


	//		t3lib_div::debug($this->extConf,"EXT CONF 765");
//		t3lib_div::debug($piConf,"PLUGIN CONF");

                $objectname = get_class($this);

                $select_fields = "uid";

                $from_table =  $this->objectTable;

		switch($piConf['sourceMode']){

			case 1: $where_clause = ' pid = '.$this->extConf['ownPid'];
				break;

			case 2: $where_clause = ' pid = '.$this->extConf['etoPid'];
				break;

			case 3:	$where_clause = ' (pid = '.$this->extConf['etoPid'].' OR pid = '.$this->extConf['ownPid'].' )';
				break;

		}

                $where_clause .= ' AND deleted=0 AND hidden = 0';
                $resultArray = array();
                $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
                $deb = $GLOBALS['TYPO3_DB']->SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
//              t3lib_div::debug($deb,"QUERY IN UNI");

                $numRows = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

//              t3lib_div::debug($numRows,"NUM ROWS IN UNI");

                $returnData = array();

//              $tmpObj = new $objectname();
                $objectTemplate = $this->getObjectTemplate('list');
//                t3lib_div::debug($objectTemplate,"OBJ TEMPLATE IN GET OBJ CODE PROJET LIST");

                if ($GLOBALS['TYPO3_DB']->sql_num_rows($res) >= 1){
                        while($data = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){
//                                if(isset($object))
//                                print_r("IST NOCH GESETZT");


  //                             t3lib_div::debug($data,"DATA IN UNI");

                                $oId = $data['uid'];
//      die(print_r($data));

                                $object = new $objectname('uid',$oId,1,1);

//       die(print_r($object));

//                              t3lib_div::debug($object,"OBJ IN GETOBJ CODE");


                                $object->setProcessMode('load',$objectTemplate);
                                $object->processFields();

//                              if($objectname == 'contact')
//                              t3lib_div::debug($object,"OBJ IN PROJCET 83453");



                                $markerArray = $object->getMarkerArray();

//                              if($objectname == 'contact')
//                              t3lib_div::debug($markerArray,"MARKERARRAY $objectname");

                                $objXMLCode = t3lib_parsehtml::getSubpart($objectTemplate, "###TEMPLATE_LIST###");
                                $code = t3lib_parsehtml::substituteMarkerArray($objXMLCode,$markerArray,'',0);
                                $content .= $code;
                                unset($object);

                        }

//                      t3lib_div::debug($content,"CONTENT");

                        return $content;

                }

        }
	
	function processImportFields(){
		
		$conf = $this->fields['import'];
		
		$returnData = array();
		
		foreach($conf as $key => $field){
				
                        if (method_exists  ('fieldFunction',$field['fieldFunction'] )){
                        	
                                $params = array();
                                $params['obj'] = $this;
                                $params['fieldname'] = $key;

				if($field['fieldFunction'] !=''){
        	                        $returnValue = call_user_func_array(array('fieldFunction',$field['fieldFunction']),$params);
				}

				$internalFieldName = ($field['objectFieldname']) ? $field['objectFieldname'] : $key  ;

                                
                                $this->processedImportData[$internalFieldName] = $returnValue;
                                

                        }else{
                        	
                        	// "EXT NICHT!";
                        	
                        }


                }
				
	}
	
	function addMMOption($field,$value){
		GLOBAL $BE_USER;
		
		$conf = $this->fields['mmData'][$field];
		$objConf = $this->fields['import'][$field];
		
		// GET OPTION UID IN DB
		$select_fields = "uid";

                $from_table =  $conf['optionTable'];
                $valueEscaped = $GLOBALS['TYPO3_DB']->fullQuoteStr($value, $from_table); 
                $where_clause = ' pid = '.$this->getFieldValue('pid').' AND deleted=0 AND '.$conf['optionTableWhereField'].' = '.$valueEscaped;
                $resultArray = array();
                $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
                //$deb = $GLOBALS['TYPO3_DB']->SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
                //t3lib_div::debug($deb,"QUERY IN ADD MM OPTION");

                $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);

                if(!is_array($row)){
                	
                	if($objConf['allowNewElements'] || $this->extConf['forceAllowNewOptions']){
                		

                		$field_array = array();
				$field_array['pid'] = $this->getFieldValue('pid');
				$field_array['tstamp'] = time();
				$field_array['crdate'] = time();
				$field_array['cruser_id'] = $BE_USER->user['uid'];
				$field_array['deleted'] = 0;
				$field_array['hidden'] = 0;
				$field_array['title'] = $value;
				$GLOBALS['TYPO3_DB']->exec_INSERTquery($conf['optionTable'],$field_array);
				// $debug = $GLOBALS['TYPO3_DB']->INSERTquery($conf['optionTable'],$field_array);
				// print_r($debug);
				$uid = $GLOBALS['TYPO3_DB']->sql_insert_id();
							
                		
                	}
                	
                }else{
                	$uid = $row['uid'];
                }
                
                if(intval($uid) != 0){
                	
                	// Create Relation entry
                	$fieldArray = array();
			$fieldArray['uid_local'] = $this->getFieldValue('uid');
			$fieldArray['uid_foreign'] = $uid;
			$GLOBALS['TYPO3_DB']->exec_INSERTquery($conf['mmTable'],$fieldArray);

			// $deb = $GLOBALS['TYPO3_DB']->INSERTquery($conf['mmTable'],$fieldArray);

                	
                }
		
	}
	
	function removeAllObjectMMOptionEntriesFromDB($field){
		
		$conf = $this->fields['mmData'][$field];
		$objConf = $this->fields['import'][$field];

		
		$objectDBUid = $this->getFieldValue('uid');
		$table = $conf['mmTable'];

		if($objectDBUid != 0){
			$where = " uid_local = $objectDBUid ";
			$GLOBALS['TYPO3_DB']->exec_DELETEquery($table,$where);
			//$debug = $GLOBALS['TYPO3_DB']->DELETEquery($table,$where);
			//t3lib_div::debug($debug,"DEBUG REMOVE ALL");
		}

	}
	
	
	public function setData($fields_values,$mode){
		GLOBAL $BE_USER;

		

		$objName = get_class($this);

		if($mode == 'insert'){
	
		        $GLOBALS['TYPO3_DB']->exec_INSERTquery($this->objectTable,$fields_values);
			$debug = $GLOBALS['TYPO3_DB']->INSERTquery($this->objectTable,$fields_values);
			$error = $GLOBALS['TYPO3_DB']->sql_error();
			if($error=='')
				$this->loadByUuid($fields_values['objectid']);
			else
				print_r($debug);

		}else{
			//Update

			$where = " objectid = '".$this->data['objectid']."' AND deleted=0";
			//$debug = $GLOBALS['TYPO3_DB']->UPDATEquery($this->objectTable,$where,$fields_values);
			 $GLOBALS['TYPO3_DB']->exec_UPDATEquery($this->objectTable,$where,$fields_values);

			$error = $GLOBALS['TYPO3_DB']->sql_error();
			if($error=='')
				$this->loadByUuid($this->data['objectid']);
			 

		}



        }


}

?>
