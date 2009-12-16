<?php

	/**
	*	feed1, feed2 	Url of ETO-Feed - At least one feed must include eto tool portraits and own data if resync is needed
	*	etoPid		ID of TYPO3 sysfolder with Eteaching.org data
	*	ownPid		Id of TYPO3 sysfolder wirth own data
	*	encoding	Encoding of incomming feed and encoding of typo3 database
	*	deleteAfterSyncIdGap	For each sync an counting id is written to each object. If an object has a syncId lower then "actSyncId minus this option value" it will be deleted.
	* 	forceAllowNewOptions	For some options it is possible to create new ones in database. For some is configured that new options are not allowed. 
	*				This option forces this for debugging or star phase to allow all new option values.
	*/


	$etoConf = array(
		'feed1' => 'http://botein-web.uni-paderborn.de/eto/fullfeed.xml',
		'feed2' => '',
		'etoPid' => '21972',
		'ownPid' => '21965',
		'encodingFeeds'	=> 'utf-8',
		'encodingTypo3' => 'iso-8859-1',
		'deleteAfterSyncIdGap' 	=> 10,
		'forceAllowNewOptions' => 1,
		'ownDataETOUid' => 'hochschulinfo.2007-08-07.9503414154',

	); 


?>
