<?php
/***************************************************************
*  Copyright notice
*
*  (c) YYYY Your name here (your@email.here)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * [CLASS/FUNCTION INDEX of Script
 *
 */
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

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
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
