<?php
/**
 * Object fieldFunctions
 *
 * Abstract Base Class of all objects like events
 *
 * @author      Heiko Noethen <noethen@uni-paderborn.de>
 * @package     tx_upbeteachingorg
 * @subpackage  lib
 */


class fieldFunction {


	function fieldFunc_textonly($obj,$fieldname){


		//t3lib_div::debug($fieldname,"FOE");
		//$internal = $obj->getInternalFieldname($fieldname);
		//t3lib_div::debug($internal,"INTERNAL");

		//t3lib_div::debug($obj->data,"TEYXTONLY DATA");

		return $obj->getFieldValue($obj->getInternalFieldname($fieldname));

        }

	function XMLfieldFunc_textonly($obj,$fieldname){

		$extConf = $obj->extConf;


		return $obj->getFieldValue($obj->getInternalFieldname($fieldname));


        }


	function XMLfieldFunc_writeUid($obj,$fieldname){


//		$fieldvalue = $obj->getFieldValue($obj->getInternalFieldname($fieldname));

		$value = explode('__', $obj->getFieldValue($obj->getInternalFieldname($fieldname)));

                return $value[1];


        }


        
	function ImportfieldFunc_textonly($obj,$fieldname){


		//t3lib_div::debug($fieldname,"FOE");
		//$internal = $obj->getInternalFieldname($fieldname);
		//t3lib_div::debug($internal,"INTERNAL");

		//t3lib_div::debug($obj->data,"TEYXTONLY DATA");

		$extConf = $obj->extConf;

		if($extConf['encodingFeeds'] != $extConf['encodingTypo3']){

			switch($extConf['encodingFeeds']){

				case 'utf-8': $encodingFeed = 'utf-8';
					break;
				case 'iso-8859-1': $encodingFeed = 'iso-8859-1';
					break;
				default: $encodingFeed = 'utf-8';

			}

			switch($extConf['encodingTypo3']){

        	                case 'utf-8': $encodingTypo3 = 'utf-8';
	                                break;
                        	case 'iso-8859-1': $encodingTypo3 = 'iso-8859-1';
                                	break;
                	        default: $encodingTypo3 = 'iso-8859-1';

        	        }

			return iconv($encodingFeed,$encodingTypo3, $obj->getImportFieldValue($obj->getInternalFieldname($fieldname)) );

		}else{
	
			return $obj->getImportFieldValue($obj->getInternalFieldname($fieldname));

		}

//		return utf8_decode($obj->getImportFieldValue($obj->getInternalFieldname($fieldname)));

        }        
        
	function ImportfieldFunc_setValue($obj,$fieldname){


		$conf = $obj->fields['import'][$fieldname];
		return $conf['fieldFunctionParam'];

		// return $obj->getImportFieldValue($obj->getInternalFieldname($fieldname));

        }

        function ImportfieldFunc_convertETODateToTimestamp($obj,$fieldname){

        	$conf = $obj->fields['import'][$fieldname];
        	$internalFieldname = ($conf['objectFieldname']) ? $conf['objectFieldname'] : $fieldname; 
        	$date = date_parse($obj->getImportFieldValue($internalFieldname));
                $timestamp = mktime($date['hour'],$date['minute'],$date['second'],$date['month'],$date['day'], $date['year']);

                return $timestamp;
        }
        
        function ImportfieldFunc_simpleOption($obj,$fieldname){
        	
        	$conf = $obj->fields['import'][$fieldname];        	
        	$value = $obj->getImportFieldValue($obj->getInternalFieldname($fieldname));
        	
        	return $conf['options'][$value];        	
        	
        }

	function ImportfieldFunc_simpleOptionMulti($obj,$fieldname){

                $conf = $obj->fields['import'][$fieldname];
                $selectedOptions = $obj->getImportFieldValue($obj->getInternalFieldname($fieldname));

		$options = $conf['options'];

		$return = '';

		foreach((array)$selectedOptions as $key => $option){

			$return .= $options[$option].',';
			
		}
		$return = substr($return, 0, -1); // remove last char


                return $return;

        }

        
	function ImportfieldFunc_countMMOption($obj,$fieldname){
        	
        	$conf = $obj->fields['import'][$fieldname];        	
        	$value = $obj->getImportFieldValue($obj->getInternalFieldname($fieldname));
        	
        	if(is_array($value)){
        		return count($value);        		
        	}else
        		return 0;
        	
        }
        
	public function ImportfieldFunc_getETOPid($obj,$fieldname){

		//own/eto-pid Is set by importCli in $obj
		
                return $obj->pid;


        }

	public function ImportfieldFunc_getSyncId($obj,$fieldname){

                // syncId is set by importCli in $obj

                return $obj->getSyncId();


        }

	function fieldFunc_writeDate($obj,$fieldname){

                $timestamp = $obj->getFieldValue($obj->getInternalFieldname($fieldname));

                if (intval($timestamp) != 0)
                return date('d.m.Y',$timestamp);
                else
                return "Keine Angabe";


        }

	function XMLfieldFunc_writeDate($obj,$fieldname){

                $timestamp = $obj->getFieldValue($obj->getInternalFieldname($fieldname));

                if (intval($timestamp) != 0)
                return date('Y-m-d H:i:s',$timestamp);
                else
                return "";


        }

	function fieldFunc_writeExtendedDate($obj,$fieldname){

		$conf = $obj->fields['load'][$fieldname];

                $timestamp1 = $obj->getFieldValue($conf['objectFunctionParams'][0]);
                $timestamp2 = $obj->getFieldValue($conf['objectFunctionParams'][1]);

                if (intval($timestamp1) != 0 && intval($timestamp2) == 0)
                return date('d.m.Y',$timestamp1);

                if (intval($timestamp1) != 0 && intval($timestamp2) != 0 ){
                        $date1 = date('d.m.Y',$timestamp1);
                        $date2 = date('d.m.Y',$timestamp2);

                        if($date1 != $date2)
                        $dateString = 'vom '.$date1.' bis zum '.$date2;
                        else
                        $dateString = $date1;

                }

                return $dateString;

        }


	function fieldFunc_writeLink($obj,$fieldname){

		$url = $obj->getFieldValue($obj->getInternalFieldname($fieldname));

		if ((substr($url,0,7) === 'http://') || (substr($url,0,8) === 'https://'))
			return '<a href="'.$url.'">'.$obj->getFieldValue($fieldname).'</a>';
		elseif($url != '') 
	                return '<a href="http://'.$url.'">http://'.$url.'</a>';
		else
			return '';


        }
     
	function fieldFunc_writeImage($obj,$fieldname){

		$url = $obj->getFieldValue($obj->getInternalFieldname($fieldname));

		if ((substr($url,0,7) === 'http://') || (substr($url,0,8) === 'https://'))
			return '<img src="'.$url.'" style="height: 100px;" />';
		elseif($url != '') 
	                return '<img src="http://'.$url.'" style="height: 100px;" />';
		else
			return '';


	}

        function XMLfieldFunc_writeLink($obj,$fieldname){

		$url = $obj->getFieldValue($obj->getInternalFieldname($fieldname));

                if ((substr($url,0,7) === 'http://') || (substr($url,0,8) === 'https://'))
                        return $url;
                else
                        return 'http://'.$url;

        }


	function XMLfieldFunc_writeMail($obj,$fieldname){

                return $obj->getFieldValue($obj->getInternalFieldname($fieldname));


        }



	function fieldFunc_writeProjectState($obj,$fieldname){

                switch ($obj->getFieldValue($obj->getInternalFieldname($fieldname))){

                        case 0: $content = 'Unbekannt';
                                break;
                        case 1: $content = 'Aktuell';
                                break;
                        case 2: $content = 'Im Aufbau';
                                break;
                        case 3: $content = 'Nicht mehr gepflegt';
                                break;
                        default: $content = 'Unbekannt';


                }

//		t3lib_div::debug($content,"CONTENT IN PROJ STATE");

                return $content;


        }


	function fieldFunc_writeOption($obj,$fieldname){

                $selectedArr = explode(',',$obj->getFieldValue($obj->getInternalFieldname($fieldname)));

//		t3lib_div::debug($conf,"SELECT ARR IN WRITE OPT");


		$conf = fieldFunction::getFieldConf($obj,$fieldname);
		
//		t3lib_div::debug($conf,"CONF IN FIELD WRITE OPT");

                $categories = $conf['options']; 
                $count = count($selectedArr);

                for($i=0; $i < $count; $i++){

                        $content .= $categories[$selectedArr[$i]];
                        if($i+1 < $count)
                        $content .= ', ';

                }

                return $content;

        }

	function XMLfieldFunc_writeSimpleOption($obj,$fieldname){

                $conf = fieldFunction::getFieldConf($obj,$fieldname);
                $content = '';

                $selected = intval($obj->getFieldValue($obj->getInternalFieldname($fieldname)));

//                t3lib_div::debug($selectedArr,"SELECT ARR IN WRITE OPT");

                $options = $conf['options'];

                return $options[$selected];

        }

	function XMLfieldFunc_writeOption($obj,$fieldname){

		$conf = fieldFunction::getFieldConf($obj,$fieldname);
                $template =  $obj->getTemplate();
		$fieldnameUpper = strtoupper($fieldname);
		

//              t3lib_div::debug($template," WRITE MM OPT N XML FUNC PRO CAT - FIRST");

			$code = t3lib_parsehtml::getSubpart($template, '###TEMPLATE_'.$fieldnameUpper.'###');


//		t3lib_div::debug($code,"COOCOCOO2222 334 43");

                $code = ereg_replace("[\n]", "", $code);
//                $code = $code."\n";


//              t3lib_div::debug($code,"CODE IN XML FUNC PRO CAT");

                $content = '';
		

                $selectedArr = explode(',',$obj->getFieldValue($obj->getInternalFieldname($fieldname)));

//		t3lib_div::debug($selectedArr,"SELECT ARR IN WRITE OPT 22334");

                $categories = $conf['options'];

                $count = count($selectedArr);

		$markerName = '###'.strtoupper($fieldname).'###';

                for($i=0; $i < $count; $i++){
                        $mArray = array( $markerName => $categories[$selectedArr[$i]] );
			$content .= t3lib_parsehtml::substituteMarkerArray($code, $mArray, '', 0);

                        if($i != ($count-1)){
                                $content .= "\n";

                        }


                }

                return $content;

        }

	function XMLfieldFunc_writeMMOption($obj,$fieldname){

		$conf = fieldFunction::getFieldConf($obj,$fieldname);
		$dataName = 'loaded_'.$conf['objectFieldname'];
		$template =  $obj->getTemplate();


	//	t3lib_div::debug($dataName,"DATA NAME");
	//	 t3lib_div::debug($template," WRITE MM OPT TEMPLATE777");

		$code = t3lib_parsehtml::getSubpart($template, '###TEMPLATE_'.strToUpper($fieldname).'###');
	//	t3lib_div::debug($code,"COOCOCOO");

                $code = ereg_replace("[\n]", "", $code);
//                $code = $code."\n";


//              t3lib_div::debug($code,"CODE IN XML WRITE MM OPTION");

                $content = '';

                $options = $obj->data[$dataName];

	//	t3lib_div::debug($options,"OPTIONS555");
	//	t3lib_div::debug($dataName,"DATANAME");


		$content = '';

                if(!is_array($options))
                return "";


                $count = count($options);
		$markerName = '###'.strToUpper($fieldname).'###';

		$valueField = ($conf['valueField']) ? $conf['valueField'] : 'title';
		

                 for($i=0; $i < $count; $i++){
                         $mArray = array( $markerName => $options[$i][$valueField] );
                       $content .= t3lib_parsehtml::substituteMarkerArray($code,$mArray,'',0);
                        if($i != ($count-1)){
                                $content .= "\n";

                        }

                }

//		t3lib_div::debug($content,"CONTENTWRITEMMOPTION");


                return $content;



        }


	function getFieldConf($obj,$fieldname){

		$conf = $obj->fields[$obj->getProcessMode()][$fieldname];

		return $conf;

	}

	function XMLfieldFunc_writeObject($obj,$fieldname){

		

		$conf = $obj->fields[$obj->getProcessMode()][$fieldname];
                $objectFieldname = 'loaded_'.$conf['objectFieldname']; 

		

                $objects = $obj->data[$objectFieldname];

		$content = '';

/*		print_r("FIELD22");
		print_r($objectFieldname);
		print_r("OBJECT");
		print_r($objects);
		print_r("OBJE1");
		print_r($obj); */


		if(is_array($objects))
		foreach($objects as $key => $object){

//		        t3lib_div::debug($object,"NEEED");
		        $tmpl = $object->getTemplate();

//			t3lib_div::debug($tmpl,"TEMPL");

		        $object->setProcessMode('loadxml',$tmpl);
		        $object->processFields();
//		        t3lib_div::debug($object,"OBJECT AFTER PROCESSING");
		        $markerArray = $object->getMarkerArray();
			$markerArray['###INDENT###'] = "\t";
//		        print_r($markerArray);
		        $objXMLCode = t3lib_parsehtml::getSubpart($tmpl, "###TEMPLATE_LIST###");
		        $content .=  t3lib_parsehtml::substituteMarkerArray($objXMLCode, $markerArray,'',0);

		}

		unset($obj);

		return $content;

	}

	function XMLfieldFunc_writeObjectLight($obj,$fieldname){

		$conf = $obj->fields[$obj->getProcessMode()][$fieldname];
		$objectFieldname = 'loadedLight_'.$conf['objectFieldname']; 
                $objects = $obj->data[$objectFieldname];

//		t3lib_div::debug($objectFieldname,"WRITE OBJECT LIGHT");

//		 t3lib_div::debug($obj->data,"WRITE OBJECT LIGHT OBJ");

//		 t3lib_div::debug($objects,"WRITE OBJECT LIGHT OBJs");

                $content = '';

		if(is_array($objects)){
	                foreach($objects as $key => $object){


				// Only export uid without eto prefix

				$tmp = explode('__',$object->data['objectid']);

				$content .= '	<'.$fieldname.'>'.$tmp[1].'</'.$fieldname.'>'."\n";


                	}

			$content = substr($content, 0, -1); // remove last line break
		}

                return $content;

        }

	function XMLfieldFunc_writeObjectPortraitId($obj,$fieldname){


		

                $conf = $obj->fields[$obj->getProcessMode()][$fieldname];
                // $objectFieldname = 'loaded_'.$conf['objectFieldname'];

		if($conf['objectParams']['light']){
                        $objectFieldname = 'loadedLight_'.$conf['objectFieldname'];
                }else{
                        $objectFieldname = 'loaded_'.$conf['objectFieldname'];
                }



                $objects = $obj->data[$objectFieldname];

                $content = '';

/*              print_r("FIELD22");
                print_r($objectFieldname);
                print_r("OBJECT");
                print_r($objects);
                print_r("OBJE1");
                print_r($obj); */

//		print_r($objects);


                if(is_array($objects))
                foreach($objects as $key => $object){

//                      t3lib_div::debug($object,"NEEED");
                        $tmpl = $object->getTemplate();

//                      t3lib_div::debug($tmpl,"TEMPL");

                        $object->setProcessMode('loadxml',$tmpl);
                        $object->processFields();
//                      t3lib_div::debug($object,"OBJECT AFTER PROCESSING");
                        $markerArray = $object->getMarkerArray();
                        $markerArray['###INDENT###'] = "\t";
//                     t3lib_div::debug($markerArray,"MAKRER");

			$content .= '		<'.$fieldname.'>'.$markerArray['###PORTRAIT_ID###'].'</'.$fieldname.'>'."\n";

                }

		$content = substr($content, 0, -1); // remove last line break

                return $content;

        }


	function XMLfieldFunc_getToolportraitid($obj,$fieldname){

	// function gets toolportrait id from eto portrait or portrait used in university


		if(get_class($obj) == 'toolportraiteto'){

			return $obj->getFieldValue('objectid');
		}else{

			$id = $obj->getFieldValue('portrait_id');

			try{

				$tmp = new toolportraiteto('uid',$id);

				return $tmp->getFieldValue('objectid');
			}catch(Exception $ex){

				// ERROR - NOT FOUND


			}
		}

	}

	function XMLfieldFunc_printUniversityKey($obj,$fieldname){



		return "MEINEUNIPADERBORNKEY";


	}



	function fieldFunc_writeMMOption($obj,$fieldname){

                $conf = fieldFunction::getFieldConf($obj,$fieldname);
                $dataName = 'loaded_'.$conf['objectFieldname'];
                $content = '';

                $options = $obj->data[$dataName];

        //      t3lib_div::debug($options,"OPTIONS555");
        //      t3lib_div::debug($dataName,"DATANAME");


                $content = '';

                if(!is_array($options))
                return "";


                $count = count($options);
                $valueField = ($conf['valueField']) ? $conf['valueField'] : 'title';


                 for($i=0; $i < $count; $i++){
                         $content .= $options[$i][$valueField];
                        if($i != ($count-1)){
                                $content .= ", ";

                        }

                }

//              t3lib_div::debug($content,"CONTENTWRITEMMOPTION");


                return $content;



        }


        function fieldFunc_writeObject($obj,$fieldname){



                $conf = $obj->fields[$obj->getProcessMode()][$fieldname];

		// t3lib_div::debug($GLOBALS['EXT_CONF'],"GLOBAL CONF IN WRITEOBJ");

		// t3lib_div::debug($conf,"CONF IN WRITEOBJ");


		if($conf['objectParams']['light']){
			$objectFieldname = 'loadedLight_'.$conf['objectFieldname'];
		}else{
	                $objectFieldname = 'loaded_'.$conf['objectFieldname'];
		}

		// t3lib_div::debug($obj->data,"DATA IN WRITEOBJ");


                $objects = $obj->data[$objectFieldname];

		// t3lib_div::debug($objects,"OBJECT IN WRITEOBJ");

                $content = '';

/*              print_r("FIELD22");
                print_r($objectFieldname);
                print_r("OBJECT");
                print_r($objects);
                print_r("OBJE1");
                print_r($obj); */


                if(is_array($objects))
                foreach($objects as $key => $object){

			$objName = get_class($object);
			$detailPageId = intval($GLOBALS['EXT_CONF']['detailPages.'][$objName]);

//                      t3lib_div::debug($object,"NEEED 555333");

			$title = '';

			if($conf['objectParams']['title']['function'] == 'concat' && is_array($conf['objectParams']['title']['fields'])){

				
				foreach($conf['objectParams']['title']['fields'] as $key => $value){

					$title .=  $object->data[$value].' ';
				}

			}else{


				$title = $object->data['title'];
	
			}

//			$title = $contact['honorific_suffix'].' '.$contact['givenname'].' '.$contact['familyname'];
//                      t3lib_div::debug($title,"TITLE IN WRITE CONTACTS");
                        $urlParameters = array("tx_upbeteachingorg_pi1[uid]" => $object->data['objectid']);
                        if ($detailPageId)
                        $link = $GLOBALS['COBJ']->getTypoLink($title,$detailPageId,$urlParameters);

                        $content .= $link." <br/> \n\r";

//			$content .= $object->data['honorific_suffix'].' '.$object->data['givenname'].' '.$object->data['familyname'];			


                }

                unset($obj);

	//		t3lib_div::debug($content,"CONTENT CONTACT");

                return $content;

        }


	function fieldFunc_writeObjectLight($obj,$fieldname){

                $conf = $obj->fields[$obj->getProcessMode()][$fieldname];
                $objectFieldname = 'loadedLight_'.$conf['objectFieldname'];
                $objects = $obj->data[$objectFieldname];

//              t3lib_div::debug($objectFieldname,"WRITE OBJECT LIGHT");

//               t3lib_div::debug($obj->data,"WRITE OBJECT LIGHT OBJ");

//               t3lib_div::debug($objects,"WRITE OBJECT LIGHT OBJs");

                $content = '';

                if(is_array($objects)){
                        foreach($objects as $key => $object){

				$objName = get_class($object);
	                        $detailPageId = intval($GLOBALS['EXT_CONF']['detailPages.'][$objName]);

                                $title = $object->data['title'];
				$urlParameters = array("tx_upbeteachingorg_pi1[uid]" => $object->data['objectid']);
        	                if ($detailPageId)
	                        $link = $GLOBALS['COBJ']->getTypoLink($title,$detailPageId,$urlParameters);
				$content .= $link." <br/> \n\r";

                        }

                        $content = substr($content, 0, -1); // remove last line break
                }

                return $content;

        }



	function fieldFunc_writeMail($obj,$fieldname){

		$data = $obj->getFieldValue($obj->getInternalFieldname($fieldname));

		return '<a href="mailto:'.$data.'">'.$data.'</a>';

	}


	function fieldFunc_writeSimpleOption($obj,$fieldname){

                $conf = fieldFunction::getFieldConf($obj,$fieldname);
                $content = '';

                $selected = intval($obj->getFieldValue($obj->getInternalFieldname($fieldname)));

//                t3lib_div::debug($selectedArr,"SELECT ARR IN WRITE OPT");

                $options = $conf['options'];

                return $options[$selected];

        }
	

	function fieldFunc_writeToolPortraitLink($obj,$fieldname){

                $conf = fieldFunction::getFieldConf($obj,$fieldname);

		if($conf['objectParams']['light']){
                        $dataName = 'loadedLight_'.$conf['objectFieldname'];
                }else{
                        $dataName = 'loaded_'.$conf['objectFieldname'];
                }

	

//                $dataName = 'loaded_'.$conf['objectFieldname'];
                $content = '';

                $options = $obj->data[$dataName];

//		      t3lib_div::debug($dataName,"OPTIONS555");
//              t3lib_div::debug($options,"OOO444 DATANAME");


                $content = '';

                if(!is_array($options))
                return "";


                $count = count($options);
                $valueField = ($conf['valueField']) ? $conf['valueField'] : 'title';


                 for($i=0; $i < $count; $i++){
			if(is_object($options[$i]))
				$content .= '<a href="http://www.e-teaching.org/toolportrait1/'.$options[$i]->data['objectid'].'">'.$options[$i]->data['title'].'</a>';
			else
	                        $content .= '<a href="http://www.e-teaching.org/toolportrait2/'.$options[$i]['objectid'].'">'.$options[$i]['title'].'</a>';

                        if($i != ($count-1)){
                                $content .= ", ";

                        }

                }

//              t3lib_div::debug($content,"CONTENTWRITEMMOPTION");


                return $content;



        }


	function fieldFunc_writeMoreLink($obj,$fieldname){

		$objName = get_class($obj);
                $content = '';

                $detailPageId = intval($GLOBALS['EXT_CONF']['detailPages.'][$objName]);

                $title = $obj->data['title'];
                $urlParameters = array("tx_upbeteachingorg_pi1[uid]" => $obj->data['objectid']);
                if ($detailPageId)
                     $link = $GLOBALS['COBJ']->getTypoLink('mehr',$detailPageId,$urlParameters);
                     $content .= $link." <br/> \n\r";

//                        $content = substr($content, 0, -1); // remove last line break
                return $content;

        }



}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.fieldFunction.php'])    {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.fieldFunction.php']);
}

?>
