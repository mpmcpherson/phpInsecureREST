<?php
	require_once('CouchDBConnection.php');
	require_once('CouchDBRequest.php');
	require_once('CouchDBResponse.php');
	require_once('../config/secretConfig.php');

	class restBaseClass{
		private $newConn = "";

		function __construct()
		{
			$newConn = new CouchDB('test_db','localhost',5984,$uname,$pw);
			$this->revision = "";
		}
		function CheckRevision()
		{
			//okay, this is almost certainly just me being too clever, but it's fun while it lasts
			//right, so what I need to do here is alert the user to get a new version. The rest (the part where I functionally branch the changes) needs to be handled by certain UI elements and custom code to keep the user in control.
			$dbRevVal = json_decode($newConn->send($this->revision)->getBody())->rev;
			return ($this->revision === $dbRevVal) ? true : $dbRevVal;
		}
		
		function SyncToDb()
		{
			
			$data = "{";

			foreach($this as $key => $value) {
		    	$data = $data .'"'.prepString($key).'":"'. prepString($value).'",';
			}
			//I don't feel like writing a bunch of lookaheads to know if I'm at the last element of an object, sooooo I'll just run until the end and then cut the last character (which will be an erroneous ,) out entirely.
			$data = substr($data,0,-1)."}";
			
			$retVal = $newConn->send('/'.date("d-m-YTh:i:s"), 'PUT', $data);

			$responseBody = $retVal->getBody();

			$decoded = json_decode($responseBody);

			//and we write this back up so that the target knows the new value to override
			$this->revision = $decoded->rev;
		}

		function prepString($string)
		{
			return htmlspecialchars(str_replace(["\r\n", "\r", "\n"], '<br/>', $string), ENT_QUOTES, "UTF-8");
		}
		function recoverString($string)
		{
			return preg_replace('/\<br(\s*)?\/?\>/i', PHP_EOL, html_entity_decode($out, ENT_QUOTES));
		}

		
		
		

	}
?>