<?php

// *****************************************
// Standard initialization of a CLI module:
// *****************************************

// Defining circumstances for CLI mode:
define('TYPO3_cliMode', TRUE);

// Defining PATH_thisScript here: Must be the ABSOLUTE path of this script in the right context:
// This will work as long as the script is called by it's absolute path!
define("PATH_thisScript", $_ENV['_'] ? $_ENV['_'] : $_SERVER['_']);

require_once(dirname(PATH_thisScript).'/../typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.fieldFunction.php');
require_once(dirname(PATH_thisScript).'/../typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.event.php');
require_once(dirname(PATH_thisScript).'/../typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.project.php');
require_once(dirname(PATH_thisScript).'/../typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.contact.php');
require_once(dirname(PATH_thisScript).'/../typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.training.php');
require_once(dirname(PATH_thisScript).'/../typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.service.php');
require_once(dirname(PATH_thisScript).'/../typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.toolportraiteto.php');
require_once(dirname(PATH_thisScript).'/../typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.tool.php');
require_once(dirname(PATH_thisScript).'/../typo3conf/ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.university.php');


    // Include init file:
    require_once(dirname(PATH_thisScript).'/'.'init.php');

    # HERE you run your application!
    GLOBAL $BE_USER;


/*

	- First all objets will be imported
		- all Options are created/imported
	- after that all relations between objects are created/imported


*/


class importEtoFeed{



        function importEtoFeed($feedUrl,$conf,$syncId){

                $this->feedUrl = $feedUrl;
             	$this->pid = intval($conf['etoPid']);
		$this->ownPid = intval($conf['ownPid']);
		$this->syncId = intval($syncId);
		$this->conf = $conf;
                $this->setFeedData();
                $data = $this->getFeedData();
                $objectlist = array('project','event');
                $this->writeObjects($data->{eteaching-export});
                $this->writeRelations($data->{eteaching-export});

        }

	function getLoglevel(){

		switch($this->conf['cliLoglevel']){

			case 'off' : $level = 0;
				break;
			case 'normal' : $level = 1;
				break;
			case 'medium' : $level = 2;
				break;
			case 'high' : $level = 3;
				break;
			default : $level = 1;
			

		}

		return $level;

	}

	function writeLog($msg,$level){

		$level = intval($level);

		if($this->getLoglevel() >= $level)
		echo $msg."\n";


	}
	

	/**
	*	Writes all objects from XML given by function getObjectData as array into database. Therefore we use the setData function of each object.
	*/        
	function writeObjects($xmlObj,$depth=0) {
		
		$objectList = array(
		
			'project' => 'project',
			'event' => 'event',
			'training' => 'training',
			'service' => 'service',
 			'tool' => 'tool',
			'tool-portrait' => 'toolportraiteto',
			'contact' => 'contact',
			'university-data' => 'university',
			'hs-contacts' => '##SUB##',
		);
		
	
		foreach($xmlObj->children() as $key => $child) {
			$name = $child->getName();
			$castName = $objectList[$name];
			if($castName == '##SUB##'){
				$this->writeObjects($child,$depth+1);
	
			}elseif($castName != ''){
				// echo str_repeat('-',$depth).">".$objectname.": ".$child->title." \n\r";
				
				$object = new $castName();
				$object->setProcessMode('import','');
				$object->setSyncId($this->syncId);
				$objectconf = $object->fields['import'];
				$data = $this->getObjectData($child,$objectconf);

				if($name == 'tool-portrait'){

					echo "XNU8";
					print_r($child);
				}


				if($this->isOwnObject($data['objectid'])){
					$object->setPid($this->conf['ownPid']);
					$objectSourceType = 'own';
				}else{
					$object->setPid($this->conf['etoPid']);
					$objectSourceType = 'eto';
				}
			
				$object->importData = $data;
				$object->processImportFields();
				$objectId = $object->getImportFieldValue('objectid');
				
				$objectUid = $this->getUidByUuid($objectId,$object->objectTable);
				// echo "OBJECT UID $objectUid \n\r";
				
				try{
					$object->loadByUuid($objectId);

					// Check if import object has higher tstamp as current db object one
					// Only write Data if import object has a bigger tstamp for own data or is eto data - cause here i allways update the syncid and eto feed has
					// allways the current data.

					if(!$this->isOwnObject($objectId) || ($object->processedImportData['tstamp'] > $object->getFieldValue('tstamp')) ){
						$msg = 'Updating '.$objectSourceType.' object '.$castName.' with objectid '.$objectId;
						$this->writeLog($msg,1);	
						$object->setData($object->processedImportData,'update');
						$this->writeMMOptions($object);
					}
					
				}catch(Exception $ex){
					
					$msg = 'Inserting '.$objectSourceType.' object '.$castName.' with objectid '.$objectId;
                                        $this->writeLog($msg,1);
					$object->setData($object->processedImportData,'insert');
					$this->writeMMOptions($object);
									
					
				}
		
				if($name != 'contact')
    				$this->writeObjects($child,$depth+1);
			}else{
				
				// echo "$name NOT IN LIST";
				
			}
  		}
	}
	
	/*
	*	Writes all relations between objects. It does not handle MMOptions.
	*/
	function writeRelations($xmlObj,$depth=0,$parent=null,$prevParent=null) {
		
		$objectList = array(
		
			'project' => 'project',
			'event' => 'event',
			'training' => 'training',
			'service' => 'service',
			'tool' => 'tool',
			'tool-portrait' => 'toolportraiteto',
			'contact' => 'contact',
			'university-data' => 'university',
			
					
		);

		if($xmlObj->attributes()->uid !=''){
		echo "Write Relations for ".$xmlObj->getName()." with Id ".$xmlObj->attributes()->uid."\n";


			$curObjName = $xmlObj->getName();
                        $curObjCastName = $objectList[$curObjName];

                        echo "Cu OBJ NAME $curObjName - Cast: $curObjCastName";
                        $curObj = new $curObjCastName('new','',0,1);
                        $curObjId = (string)$xmlObj->attributes()->uid;

                        echo "CU OBJ VAL:: ".$curObjId.' - Castname:: '.$curObjCastName.' -';

                        $curObj->loadByUuid($curObjId);
	
			$curObjUid = $curObj->getFieldValue('uid');

			foreach((array)$curObj->fields['mmData'] as $key => $fieldConf){

				// only clear Relations if mmTable is set and important: dont delete object MMOptions relations - only clear mmObject relations
				if($fieldConf['mmTable'] != '' && $fieldConf['mm_object']){

					echo "CLEAR $key in ".$xmlObj->getName()." Table -> ".$fieldConf['mmTable'];

					$this->clearRelations($curObjUid,$fieldConf['mmTable']);
				}

			}

		}




		
		
		foreach($xmlObj->children() as $key => $child) {
			$name = $xmlObj->getName();
			$childName = $child->getName();

//			$this->writeLog('NAME IN WRITE RELATIONS: '.$name,1);

			if($child->getName() == 'tool-portrait-id'){

				if($xmlObj->getName() == 'hs-tools'){

			
					
                                        // print_r((string)$child);


					/*

					Working but missing import object for toolportrait

                                        $objChild = new toolportraiteto('new','',0,1);
                                        $value = (string)$child;
                                        $objChild->loadByUuid($value);

                                        $objName = $parent->getName();
                                        $objCastName = $objectList[$objName];

                                        echo "2 OBJ NAME $objName - Cast: $objCastName";

                                        $obj = new $objCastName('new','',0,1);
                                        $valueObj = (string)$parent->attributes()->uid;

                                        echo "2 OBJ VAL:: ".$valueObj.' - Castname:: '.$objCastName.' -';

                                        $obj->loadByUuid($valueObj);


                                        echo "2 UIIIDS";
                                        echo $objChild->getFieldValue('uid')."\n";
                                        echo $obj->getFieldValue('uid');
                                        echo "2 KKKSKK";

                                        $mmTable = $obj->fields['mmData'][$childName]['mmTable'];

                                      echo "MM TABLE $mmTable";

                                        $this->writeRelation($obj->getFieldValue('uid'),$objChild->getFieldValue('uid'),$mmTable);

					*/


				}else{

					// print_r((string)$child);

					$objChild = new toolportraiteto('new','',0,1);
					$value = (string)$child;
					$objChild->loadByUuid($value); 

					$objName = $xmlObj->getName();
					$objCastName = $objectList[$objName];
	
					echo "OBJ NAME $objName - Cast: $objCastName";

					$obj = new $objCastName('new','',0,1);
	                                $valueObj = (string)$xmlObj->attributes()->uid;
	
					echo "OBJ VAL:: ".$valueObj.' - Castname:: '.$objCastName.' -';

	                                $obj->loadByUuid($valueObj);


					echo "UIIIDS";
					echo $objChild->getFieldValue('uid')."\n";
					echo $obj->getFieldValue('uid');
					echo "KKKSKK";

					$mmTable = $obj->fields['mmData'][$childName]['mmTable'];

//					echo "MM TABLE $mmTable";

					$this->writeRelation($obj->getFieldValue('uid'),$objChild->getFieldValue('uid'),$mmTable);

						

					// print_r($obj);
	
				}

			}


			if($child->getName() == 'tool-id'){

                                if($xmlObj->getName() == 'hs-tools'){



                                        // print_r((string)$child);


                                        $objChild = new tool('new','',0,1);
                                        $value = (string)$child;
                                        $objChild->loadByUuid($value);

                                        $objName = $parent->getName();
                                        $objCastName = $objectList[$objName];

                                        echo "2ToolId OBJ NAME $objName - Cast: $objCastName";

                                        $obj = new university('new','',0,1);
                                        $valueObj = $parent->attributes()->uid;

                                        echo "2ToolId OBJ VAL:: ".$valueObj.' - Castname:: '.$objCastName.' -';

                                        $obj->loadByUuid($valueObj);


                                        echo "2Tool UIIIDS";
                                        echo $objChild->getFieldValue('uid')."\n";
                                        echo $obj->getFieldValue('uid');
                                        echo "2Tool KKKSKK";

                                        // $mmTable = $obj->fields['mmData'][$childName]['mmTable'];
					 $mmTable = 'tx_upbeteachingorg_university_tools_mm';

                                      echo "MM TABLE $mmTable";

                                        $this->writeRelation($obj->getFieldValue('uid'),$objChild->getFieldValue('uid'),$mmTable);



                                }else{

                                        // print_r((string)$child);

                                        $objChild = new tool('new','',0,1);
                                        $value = (string)$child;
                                        $objChild->loadByUuid($value);

                                        $objName = $xmlObj->getName();
                                        $objCastName = $objectList[$objName];

                                        echo "OBJ NAME $objName - Cast: $objCastName";

                                        $obj = new $objCastName('new','',0,1);
                                        $valueObj = (string)$xmlObj->attributes()->uid;

                                        echo "OBJ VAL:: ".$valueObj.' - Castname:: '.$objCastName.' -';

                                        $obj->loadByUuid($valueObj);


                                        echo "UIIIDS";
                                        echo $objChild->getFieldValue('uid')."\n";
                                        echo $obj->getFieldValue('uid');
                                        echo "KKKSKK";

                                        $mmTable = $obj->fields['mmData'][$childName]['mmTable'];

//                                      echo "MM TABLE $mmTable";

                                        $this->writeRelation($obj->getFieldValue('uid'),$objChild->getFieldValue('uid'),$mmTable);



                                        // print_r($obj);

                                }

                        }


			if($child->getName() == 'contact'){

				echo "CHILD IS CONTACT";

				if($xmlObj->getName() == 'hs-contacts'){

					// Make relation to university

					echo "CONTACT TO UNIVERSITY";

					$objChild = new contact('new','',0,1);
                                        $value = (string)$child->attributes()->uid;
                                        $objChild->loadByUuid($value);

                                        $objName = $xmlObj->getName();

                                        echo "OBJ NAME $objName - Cast UNIVER";

                                        $obj = new university('new','',0,1);

                                        print_r($parent);

                                        $valueObj = $parent->attributes()->uid;

                                        echo "OBJ VAL:: ".$valueObj.' - Castname UniversityD -';

                                        $obj->loadByUuid($valueObj);


                                        echo "UIIIDS";
                                        echo "CHILD CONTACT ".$objChild->getFieldValue('uid')."\n";
                                        echo "UNI ".$obj->getFieldValue('uid');
                                        echo "KKKSKK";

                                        $mmTable = 'tx_upbeteachingorg_university_contacts_mm';

                                        echo "MM TABLE $mmTable";

                                        $this->writeRelation($obj->getFieldValue('uid'),$objChild->getFieldValue('uid'),$mmTable);



				}else{

					// Make relation to parent obj

					echo "CONTACT TO PARENT NORMAL OBJ";

					$objChild = new contact('new','',0,1);
                                        $value = (string)$child->attributes()->uid;
                                        $objChild->loadByUuid($value);

                                        $objName = $xmlObj->getName();
                                        $objCastName = $objectList[$objName];

                                        echo "OBJ NAME $objName - Cast: $objCastName";

                                        $obj = new $objCastName('new','',0,1);

					print_r($xmlObj);

                                        $valueObj = $xmlObj->attributes()->uid;

                                        echo "OBJ VAL:: ".$valueObj.' - Castname:: '.$objCastName.' -';

                                        $obj->loadByUuid($valueObj);


                                        echo "UIIIDS";
                                        echo $objChild->getFieldValue('uid')."\n";
                                        echo $obj->getFieldValue('uid');
                                        echo "KKKSKK";

                                        $mmTable = $obj->fields['mmData'][$childName]['mmTable'];

//                                      echo "MM TABLE $mmTable";

                                        $this->writeRelation($obj->getFieldValue('uid'),$objChild->getFieldValue('uid'),$mmTable);

				}

			}

			if($parent){

				if($prevParent){
					echo "XMLOBJ $name ::  - PARENT: ".$parent->getName().'PREPARENT'.$prevParent->getName().'child: '.$child->getName()."\n\n";
				}else{
					echo "XMLOBJ $name ::  - PARENT: ".$parent->getName().'child: '.$child->getName()."\n\n";
				}


				$this->writeRelations($child,$depth+1,$xmlObj,$parent);

			}else{

				$this->writeRelations($child,$depth+1,$xmlObj);

			}


  		}
	}	
	
	
	function writeMMOptions($object){
		
		$conf = $object->fields['mmData'];
		$importConf = $object->fields['import'];

		echo $object->getFieldValue('objectid');
		
		if(is_array($conf))
		foreach($conf as $key => $fieldconf){
		

			
	
			if($importConf[$key]['multi']){
				
				$object->removeAllObjectMMOptionEntriesFromDB($key);
				$internalName = $object->getInternalFieldname($key);
				$options = $object->getImportFieldValue($object->getInternalFieldname($key));
				foreach((array)$options as $optionKey => $optionname)

	
					echo "KEY $key and OPT $optionname";					

					$object->addMMOption($key,$optionname);
				
			}		
		}
	}
	
	/**
	 * 
	 *  Transforms the XML-Obj data into object data
	 * 
	 */
	function getObjectData($xmlObj,$conf){
		
		$returnArr = array();
		
		foreach($conf as $key => $fieldconf){
			
			$fieldname = ($fieldconf['objectFieldname'] != '') ? $fieldconf['objectFieldname'] : $key; 
			
			if(!$fieldconf['relation']){
				if(!$fieldconf['isAttribute']){
					if(!$fieldconf['multi'])
						$returnArr[$fieldname] = (string)$xmlObj->$key;
					else{
						//$returnArr[$fieldname] = (array)$xmlObj->$key;
						$values = get_object_vars($xmlObj);
						$returnArr[$fieldname] = $values[$key];
					}
				}else{
					$attributes = $xmlObj->attributes();
					$returnArr[$fieldname] = (string)$attributes[$key];
				}
			}else{
				$values = get_object_vars($xmlObj);
				$arr = array();
				$relationData = $values[$key];
				
				if(!is_array($relationData)){
					$tmp = get_object_vars($values[$key]);
					$arr[] = $tmp;
				}else{
				
					foreach($relationData as $sub => $data){
						$arr[] = (array)$data;
					}
				}
				$returnArr[$fieldname] = $arr;
			}
			
			
		}		
		return $returnArr;
	
	}
	
	
	
	/**
        *       getFeedData: Fetch file and return simpleXML-Object
        */
        function setFeedData(){

                $this->xml = simplexml_load_file($this->feedUrl,null, LIBXML_NOCDATA);
                

        }
        
	/**
        *       getFeedData: Fetch file and return simpleXML-Object
        */
        function getFeedData(){


		return $this->xml;


        }

        function writeRelation($localUid,$foreignUid,$mmTable){
        	
        	$fieldArray = array();
		$fieldArray['uid_local'] = $localUid; 
		$fieldArray['uid_foreign'] = $foreignUid;
		$GLOBALS['TYPO3_DB']->exec_INSERTquery($mmTable,$fieldArray);
        	
        }
        
        function clearRelations($localUid,$mmTable){
        	
        	if(intval($localUid) != 0){
			$where = " uid_local = $localUid ";
			$GLOBALS['TYPO3_DB']->exec_DELETEquery($mmTable,$where);
			//$debug = $GLOBALS['TYPO3_DB']->DELETEquery($table,$where);
			//t3lib_div::debug($debug,"DEBUG REMOVE ALL BY RELATION");
		}
        	
        	
        }

	function writeConfOption($optionName,$type,$value){

		if($type = 'int'){
			$fieldname = 'confvalueInt';
			$value = intval($value);
		}else{
			$fieldname = 'confvalueString';
		}

                $fieldArray = array();
		$fieldArray['confname'] = $optionName;
                $fieldArray[$fieldname] = $value;

		$from_table = 'tx_upbeteachingorg_conf';

		if(importEtoFeed::getConfOption($optionName)){

			
			$optionNameQuoted = $GLOBALS['TYPO3_DB']->fullQuoteStr($optionName,$from_table);
		
			$where = ' confname = '.$optionNameQuoted;
                        // $debug = $GLOBALS['TYPO3_DB']->UPDATEquery($from_table,$where,$fieldArray);
                        $GLOBALS['TYPO3_DB']->exec_UPDATEquery($from_table,$where,$fieldArray);

		}else{

                	$GLOBALS['TYPO3_DB']->exec_INSERTquery($from_table,$fieldArray);
			// $debug = $GLOBALS['TYPO3_DB']->INSERTquery($from_table,$fieldArray);

		}

        }


	public function getConfOption($optionName){

                $select_fields = '*';
                $from_table = 'tx_upbeteachingorg_conf';
                $optionNameQuoted = $GLOBALS['TYPO3_DB']->fullQuoteStr($optionName,$from_table);
                $where_clause = " confname = $optionNameQuoted";
                $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
	   	// $debug = $GLOBALS['TYPO3_DB']->SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
                $count = $GLOBALS['TYPO3_DB']->sql_num_rows($res);


                if($count == 1){

                        $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);

			if(intval($row['confvalueInt']) == 0){
                        	$value = $row['confvalueString'];
	                }else{
        	                $value = $row['confvalueInt'];
                	}

                        return $value;
                }else{
			return false;
		}

        }


	
        

	function isOwnObject($objectId){

		$tmp = explode('__',$objectId);
		if($tmp[0] == $this->conf['ownDataETOUid']){
			return true;
		}else{	
			return false;
		}

	}


	function deleteObjects($conf){

		$etoPid = intval($conf['etoPid']);
		$currentSyncId = importEtoFeed::getConfOption('syncId');
		$sync = $currentSyncId - intval($conf['deleteAfterSyncIdGap']);

		$objectList = array(

                        'project' => 'project',
                        'event' => 'event',
                        'training' => 'training',
                        'service' => 'service',
                        'tool' => 'tool',
                        'tool-portrait' => 'toolportraiteto',
                        'contact' => 'contact',



                );


		foreach($objectList as $key => $objname){

			$obj = new $objname();
			$table = $obj->objectTable;


			$fieldArray = array();
        	        $fieldArray['deleted'] = 1;

                        $where = ' syncid < '.$sync.' AND pid = '.$etoPid;
                        //$debug = $GLOBALS['TYPO3_DB']->UPDATEquery($table,$where,$fieldArray);

                       $GLOBALS['TYPO3_DB']->exec_UPDATEquery($table,$where,$fieldArray);

		}





	}


	function getListOfDeletedObjectUids($conf){

		$objectList = array(

                        'project' => 'project',
                        'event' => 'event',
                        'training' => 'training',
                        'service' => 'service',
                        'tool' => 'tool',
                        'tool-portrait' => 'toolportraiteto',
                        'contact' => 'contact',



                );

		$etoPid = intval($conf['etoPid']);
	
		$returnArray = array();

		foreach($objectList as $key => $objectName){

			$obj = new $objectName();
			$table = $obj->objectTable;

			$select_fields = 'uid';
	                $where_clause = " deleted = 1 AND pid = ".$etoPid;;
        	        $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields,$table,$where_clause,$groupBy='',$orderBy='',$limit='');
                	//$debug = $GLOBALS['TYPO3_DB']->SELECTquery($select_fields,$table,$where_clause,$groupBy='',$orderBy='',$limit='');
			$returnArray[$objectName] = array();

	                while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)){

				importEtoFeed::deleteRelationsOfObject($row['uid'],$obj);

			}

		}

		importEtoFeed::realyDeleteObjects($conf);

	}

	

	function deleteRelationsOfObject($uid,$obj){


		$uid = intval($uid);
		$mmData = $obj->fields['mmData'];

		if(is_array($mmData)){

			foreach($mmData as $fieldname => $fieldconf){

				$table = $fieldconf['mmTable'];

				$where_clause = " uid_local = ".$uid;;
                        	// $debug = $GLOBALS['TYPO3_DB']->DELETEquery($table,$where_clause);

				$GLOBALS['TYPO3_DB']->exec_DELETEquery($table,$where_clause);

			}

		}


	}

	function realyDeleteObjects($conf){

                $etoPid = intval($conf['etoPid']);

                $objectList = array(

                        'project' => 'project',
                        'event' => 'event',
                        'training' => 'training',
                        'service' => 'service',
                        'tool' => 'tool',
                        'tool-portrait' => 'toolportraiteto',
                        'contact' => 'contact',



                );


                foreach($objectList as $key => $objname){

                        $obj = new $objname();
                        $table = $obj->objectTable;

                        $where = ' deleted = 1 AND pid = '.$etoPid;
                        // $debug = $GLOBALS['TYPO3_DB']->DELETEquery($table,$where);

			$GLOBALS['TYPO3_DB']->exec_DELETEquery($table,$where);


                }





        }
                
        
        
        
        

        public function getUidByUuid($uuid,$from_table){

                $select_fields = '*';

                $objectId = $GLOBALS['TYPO3_DB']->fullQuoteStr($uuid,$from_table);
                $where_clause = " objectid = $objectId AND deleted != 1 AND hidden != 1";
                $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
                //$debug = $GLOBALS['TYPO3_DB']->SELECTquery($select_fields,$from_table,$where_clause,$groupBy='',$orderBy='',$limit='');
                $count = $GLOBALS['TYPO3_DB']->sql_num_rows($res);

                if($count == 1){
                        $row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res);
                        return $row['uid'];
                }elseif($count > 1){
                        throw new Exception('Duplicate Option',201);
                }elseif($count == 0){
                        return 0;
                }

        }




}


	$etoConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['upb_eteachingorg']);

	echo "Using config: \n";

	print_r($etoConf);

	echo "Starting import";
	
	$syncId = importEtoFeed::getConfOption('syncId') + 1;

	echo "SyncId: $syncId \n";

	if($etoConf['feed1'] != '')
		$feed = new importEtoFeed($etoConf['feed1'],$etoConf,$syncId);


	importEtoFeed::writeConfOption('syncId','int',$syncId);

	echo "Deleting no longer used objects ...\n";

	importEtoFeed::deleteObjects($etoConf);

	importEtoFeed::getListOfDeletedObjectUids($etoConf);

	echo "\n";
        echo "\n Speicherverbrauch: : \n";
        print_r(memory_get_usage())." Bytes";


	echo "\n Import script finished! \n";

?>
