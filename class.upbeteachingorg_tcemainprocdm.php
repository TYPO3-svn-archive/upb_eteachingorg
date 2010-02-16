<?php


class tx_upbelearningorg_tceProcessing{

	function processDatamap_postProcessFieldArray($status, $table, $id, &$fieldArray, &$pObj){

		$etoConf = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['upb_eteachingorg']);

		if(intval($fieldArray['pid']) != 0){

			if ($etoConf['ownPid'] == $fieldArray['pid'])
				$ownData = 1;
			else
				$ownData = 0;

		}

		if ($status == 'new' && $ownData && ($table == 'tx_upbeteachingorg_project' || $table == "tx_upbeteachingorg_contact" || $table == "tx_upbeteachingorg_event" || $table == "tx_upbeteachingorg_service" || $table == "tx_upbeteachingorg_tool" || $table == "tx_upbeteachingorg_training" || $table == "tx_upbeteachingorg_university" || $table == "tx_upbeteachingorg_toolportraiteto" ) ) {

			$prefix = $etoConf['ownDataETOUid'];

			$fieldArray['objectid'] = $prefix.'__'.$this->guid();


		}


	}


	function guid(){
    		if (function_exists('com_create_guid')){
        		return com_create_guid();
    		}else{
		        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
		        $charid = strtoupper(md5(uniqid(rand(), true)));
		        $hyphen = chr(45);// "-"
		        $uuid =  substr($charid, 0, 8).$hyphen
		                .substr($charid, 8, 4).$hyphen
		                .substr($charid,12, 4).$hyphen
		                .substr($charid,16, 4).$hyphen
		                .substr($charid,20,12);
		                
		        return $uuid;
    		}
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/class.upbeteachingorg_tcemainprocdm.php'])    {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/class.upbeteachingorg_tcemainprocdm.php']);
}

?>
