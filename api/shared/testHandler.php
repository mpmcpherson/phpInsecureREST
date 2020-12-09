<?php
	require_once('CouchDBConnection.php');
	require_once('CouchDBRequest.php');
	require_once('CouchDBResponse.php');
	require_once('../config/secretConfig.php');
	require_once('helper.php');

	//get the posted values...
	$gets = json_decode(file_get_contents('php://input'), true);

	$newConn = new CouchDB('test_db','localhost',5984,$uname,$pw);

	$data = "{";

	foreach($gets as $key => $value) {
    	$data = $data .'"'.fullConvertDown($key).'":"'. fullConvertDown($value).'",';
	}
	//I don't feel like writing a bunch of lookaheads to know if I'm at the last element of an object, sooooo I'll just run until the end and then cut the last character (which will be an erroneous ,) out entirely.
	$data = substr($data,0,-1)."}";
	
	$retVal = $newConn->send('/'.date("d-m-YTh:i:s"), 'PUT', $data);

	$body = $retVal->getBody();

	$decoded = json_decode($body);

	//and we echo this back up so that the target knows the new value to override
	echo $decoded->rev;
?>