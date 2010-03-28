<?php

require_once('class.tx_upbeteachingorg.object.php');


/**
 * Object Event
 *
 * Abstract Base Class of all objects like events
 *
 * @author      Heiko Noethen <noethen@uni-paderborn.de>
 * @package     tx_upbeteachingorg
 * @subpackage  lib
 */
class event extends object {

	var $objectTable = 'tx_upbeteachingorg_event';
	var $staticOptions = array();
	var $displayTemplate = array(
		'list' => 'EXT:upb_eteachingorg/pi1/tmpl/list_event.tmpl',
		'detail' => 'EXT:upb_eteachingorg/pi1/tmpl/detail_event.tmpl',
		'xml' => 'EXT:upb_eteachingorg/pi1/tmpl/xml_event.tmpl',
	);

	public function config() {
		GLOBAL $BE_USER;

		/*
	 	$fields = array();
		$fields['pid'] = $this->getETOPid();
		$fields['tstamp'] = time();
		$fields['crdate'] = time();
		$fields['cruser_id'] = $BE_USER->user['uid'];
		$fields['deleted'] = 0;
		$fields['hidden'] = 0;

		$fields['objectid'] = $valueArray['objectid'];
		$fields['summary'] = $valueArray['summary'];
		$fields['description'] = $valueArray['description'];
		$fields['location'] = $valueArray['location'];
		$fields['url'] = $valueArray['url'];
		$fields['dtstart'] = $valueArray['dtstart'];
		$fields['dtend'] = $valueArray['dtend'];
		*/

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
		*/

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
				'summary' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
					'objectFieldname' => '',
				),
				'description' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
					'objectFieldname' => '',
				),
				'location' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
					'objectFieldname' => '',
				),
				'url' => array(
					'update'	=> false,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_textonly',
					'objectFieldname' => '',
				),
				'dtstart' => array(
					'update'	=> true,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_convertETODateToTimestamp',
					'objectFieldname' => '',
				),
				'dtend' => array(
					'update'	=> true,
					'insert'	=> true,
					'fieldFunction' => 'ImportfieldFunc_convertETODateToTimestamp',
					'objectFieldname' => '',
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
					'required' => true,
					'validate' => 'objectid',
					'objectFieldname' => 'objectid',
					'objectFunction' => 'pass',
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
				'location' => array(
					'required' => true,
					'validate' => 'text',
					'objectFieldname' => 'location',
					'objectFunction' => 'textonly',
				),
				'url' => array(
					'required' => true,
					'validate' => 'url',
					'objectFieldname' => 'url',
					'objectFunction' => 'textonly',
				),
				'dtstart' => array(
					'required' => true,
					'validate' => 'isETODate',
					'objectFieldname' => 'dtstart',
					'objectFunction' => 'convertETODateToTimestamp',
				),
				'dtend' => array(
					'required' => false,
					'validate' => 'isETODate',
					'objectFieldname' => 'dtend',
					'objectFunction' => 'convertETODateToTimestamp',
				),
			),
			'update' => array (
				'summary' => array(
					'required' => false,
					'validate' => 'text',
					'objectFieldname' => 'summary',
					'objectFunction' => 'textonly',
				),
				'description' => array(
					'required' => false,
					'validate' => 'text',
					'objectFieldname' => 'description',
					'objectFunction' => 'textonly',
				),
				'location' => array(
					'required' => false,
					'validate' => 'text',
					'objectFieldname' => 'location',
					'objectFunction' => 'textonly',
				),
				'url' => array(
					'required' => false,
					'validate' => 'url',
					'objectFieldname' => 'url',
					'objectFunction' => 'textonly',
				),
				'dtstart' => array(
					'required' => false,
					'validate' => 'isETODate',
					'objectFieldname' => 'dtstart',
					'objectFunction' => 'convertETODateToTimestamp',
				),
				'dtend' => array(
					'required' => false,
					'validate' => 'isETODate',
					'objectFieldname' => 'dtend',
					'objectFunction' => 'convertETODateToTimestamp',
				),
			),
			'load' => array(
				'summary' => array(
					'required' => false,
					'validate' => 'text',
					'objectFieldname' => 'summary',
					'objectFunction' => 'fieldFunc_textonly',
				),
				'description' => array(
					'required' => false,
					'validate' => 'text',
					'objectFieldname' => 'description',
					'objectFunction' => 'fieldFunc_textonly',
				),
				'location' => array(
					'required' => false,
					'validate' => 'text',
					'objectFieldname' => 'location',
					'objectFunction' => 'fieldFunc_textonly',
				),
				'url' => array(
					'required' => false,
					'validate' => 'url',
					'objectFieldname' => 'url',
					'objectFunction' => 'fieldFunc_writeLink',
				),
				'dtstart' => array(
					'required' => false,
					'validate' => 'isETODate',
					'objectFieldname' => 'dtstart',
					'objectFunction' => 'fieldFunc_writeDate',
				),
				'dtend' => array(
					'required' => false,
					'validate' => 'isETODate',
					'objectFieldname' => 'dtend',
					'objectFunction' => 'fieldFunc_writeDate',
				),
				'date' => array(
					'objectFunction' => 'fieldFunc_writeExtendedDate',
					'objectFunctionParams' => array('dtstart','dtend'),
				),
				'morelink'  => array(
					'required' => true,
					'validate' => 'text',
					'objectFieldname' => 'morelink',
					'objectFunction' => 'fieldFunc_writeMoreLink',
				),
			),
			'loadxml' => array(
				'uid' => array(
					'required' => false,
					'validate' => 'text',
					'objectFieldname' => 'objectid',
					'objectFunction' => 'XMLfieldFunc_writeUid',
				),
				'tstamp' => array(
					'required' => false,
					'validate' => 'text',
					'objectFieldname' => 'tstamp',
					'objectFunction' => 'XMLfieldFunc_writeDate',
				),
				'summary' => array(
					'required' => false,
					'validate' => 'text',
					'objectFieldname' => 'summary',
					'objectFunction' => 'XMLfieldFunc_textonly',
				),
				'description' => array(
					'required' => false,
					'validate' => 'text',
					'objectFieldname' => 'description',
					'objectFunction' => 'XMLfieldFunc_textonly',
				),
				'location' => array(
					'required' => false,
					'validate' => 'text',
					'objectFieldname' => 'location',
					'objectFunction' => 'XMLfieldFunc_textonly',
				),
				'url' => array(
					'required' => false,
					'validate' => 'url',
					'objectFieldname' => 'url',
					'objectFunction' => 'XMLfieldFunc_writeLink',
				),
				'dtstart' => array(
					'required' => false,
					'validate' => 'isETODate',
					'objectFieldname' => 'dtstart',
					'objectFunction' => 'XMLfieldFunc_writeDate',
				),
				'dtend' => array(
					'required' => false,
					'validate' => 'isETODate',
					'objectFieldname' => 'dtend',
					'objectFunction' => 'XMLfieldFunc_writeDate',
				),
			),
		);
	}

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * [Describe function...]
	 *
	 * @param	[type]		$field: ...
	 * @return	[type]		...
	 */
	public function getFieldValue($field) {
		return $this->data[$field];
	}

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	public function getObjectOptionList() {
		return $this->staticOptions;
	}

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	public function getObjectTable() {
		return $this->objectTable;
	}

	/**
	 * [Describe function...]
	 *
	 * @return	[type]		...
	 */
	public function setRealations() {
		// Alle DB Operationen um die Beziehungen zwischen den Objekten korrekt zu speichern / mm und co
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.event.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/upb_eteachingorg/lib/class.tx_upbeteachingorg.event.php']);
}

?>
