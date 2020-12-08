<?php
	require_once('CouchDBConnection.php');
	require_once('CouchDBRequest.php');
	require_once('CouchDBResponse.php');
	require_once('../config/secretConfig.php');


	$newConn = new CouchDB('test_db','localhost',5984,$uname,$pw);

	
	$retVal = $newConn->send('/'.date("d-m-YTh:i:s"), 'PUT', '{
  " title ": " a third attempt to learn about collisions ",
  " body ": "learning about conflict and collision the hard way"
}');

	$body = $retVal->getBody();


//	echo "typeof body " . gettype($body);
//	echo "\n";
//	echo "val of body " . $body;//['rev'];
//	echo "\n";
	$decoded = json_decode($body);
//	echo "typeof decoded body " . gettype($decoded);
//	echo "\nVar dump of decoded body: ";
	//var_dump($decoded);
	echo $decoded->rev;
//	echo "\n";
	echo "\n";
	echo "\n";
	//echo $decoded['rev'];
	
	//echo $retVal->getRawResponse();
/*

	$testVals = '{"ok":true,"id":"07-12-2020EST07:01:53","rev":"1-11bcfe09336aed44fdfabf5627209fa4"}';
	echo "testVals " . $testVals;

	echo "typeof testVals " . gettype($testVals);
	
	$tryVals = json_decode($testVals);
	var_dump($tryVals);
*/
	//echo $body;

//curl -X PUT 'http://couchAdmin:Adein1Dva2!@localhost:5984/test_db/"001"' -d '{ " title " : " a modesta proposal " , " body " : " everyone sleeps under their desks, it is crunch time " }'	
?>