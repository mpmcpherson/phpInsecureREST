<?php
	require_once('CouchDBConnection.php');
	require_once('CouchDBRequest.php');
	require_once('CouchDBResponse.php');


	$newConn = new CouchDB('test_db','localhost',5984,NULL,NULL);

	
	$retVal = $newConn->send('/'.date("d-m-YTh:m:s"), 'PUT', '{
  " title ": " a third attempt to learn about collisions ",
  " body ": "learning about conflict and collision the hard way"
}');

	var_dump($retVal);

//curl -X PUT 'http://couchAdmin:Adein1Dva2!@localhost:5984/test_db/"001"' -d '{ " title " : " a modesta proposal " , " body " : " everyone sleeps under their desks, it is crunch time " }'	
?>