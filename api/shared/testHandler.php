<?php
	require_once('CouchDBConnection.php');
	require_once('CouchDBRequest.php');
	require_once('CouchDBResponse.php');
	require_once('../config/secretConfig.php');


	$newConn = new CouchDB('test_db','localhost',5984,$uname,$pw);

	
	$retVal = $newConn->send('/'.date("d-m-YTh:i:s"), 'PUT', '{
	  " title ":'. $data["title"] .',
	  " body ": '.$data["body"].'
	}');

	$body = $retVal->getBody();

	$decoded = json_decode($body);
	echo $decoded->rev;
?>