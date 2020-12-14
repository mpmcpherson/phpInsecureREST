<?php
	require_once('CouchDBConnection.php');
	require_once('CouchDBRequest.php');
	require_once('CouchDBResponse.php');
	require_once('../config/secretConfig.php');

	class restBaseClass{
		private $newConn = "";

		function __construct()
		{	//if we get passed an ID, then we need to populate everything with a GET
			$newConn = new CouchDB('test_db','localhost',5984,$uname,$pw);
			$this->id = "";
			$this->revision = "";
			$this->clean = false;
		}
		//now POST
		private function SubmitToDb(){
							
				$retVal = $newConn->send('/'.date("d-m-YTh:i:s"), 'PUT', encodeForDelivery());

				$responseBody = $retVal->getBody();

				$decoded = json_decode($responseBody);

				//and we write this back up so that the target knows the new value to override
				$this->revision = $decoded->rev;
		}

		//now GET
		//to get something, you just need to know its ID.
		//I don't actually know if this'll bring back good results
		//the $this->$key thing might not actually let me access
		//the $this->key value
		private function getObject(){
				
				$dbRevVal = json_decode($newConn->send($this->id)->getBody());

				foreach($dbRevVal as $key => $value) {
					$key = recoverString($key);
					$value = recoverString($value);
					$this->$key = $value;
				}
		}


		//now PUT
		private function CheckRevision()
		{
			//okay, this is almost certainly just me being too clever, but it's fun while it lasts
			//right, so what I need to do here is alert the user to get a new version. The rest (the part where I functionally branch the changes) needs to be handled by certain UI elements and custom code to keep the user in control.
			$dbRevVal = json_decode($newConn->send($this->id, "HEAD")->getHeaders())->ETag;//way lighter than sending the whole damn doc over the wire. Might not work as written (probably won't work as written).
			return ($this->revision === $dbRevVal) ? true : $dbRevVal;
		}
		
		private function SyncToDb()
		{
			
			if($this->clean){
								
				$retVal = $newConn->send('/'.date("d-m-YTh:i:s"), 'PUT', encodeForDelivery());

				$responseBody = $retVal->getBody();

				$decoded = json_decode($responseBody);

				//and we write this back up so that the target knows the new value to override
				$this->revision = $decoded->rev;
			}

		}

		function Save()
		{
			try{ //these text responses probably aren't going to work out, but they'll do for now.
				$revisionStatus = CheckRevision();
				if(gettype($revisionStatus)==="boolean"){
					//this is *begging* for some horrible race condition to pop up.
					$this->clean = true;
					SyncToDb();
					echo "Success! Current version number is ".$this->revision;
					$this->clean = false;
				}else{
					throw new genericException("The version of the object you are editing is out of date; please back up you changes and refresh your data");
				}
			}
			catch(Exception $e){
				echo $e->errorMessage();
			}
		}

		//really should have pulled this out right away
		private function encodeForDelivery(){
			$data = "{";

				foreach($this as $key => $value) {
					if($key!=="_rev"){
			    		$data = $data .'"'.prepString($key).'":"'. prepString($value).'",';
					}
				}
			//I don't feel like writing a bunch of lookaheads to know if I'm at the last element of an object, sooooo I'll just run until the end and then cut the last character (which will be an erroneous ,) out entirely.
			$data = substr($data,0,-1)."}";
			return $data;		

		}

		function prepString($string)
		{
			return htmlspecialchars(str_replace(["\r\n", "\r", "\n"], '<br/>', $string), ENT_QUOTES, "UTF-8");
		}
		function recoverString($string)
		{
			return preg_replace('/\<br(\s*)?\/?\>/i', PHP_EOL, html_entity_decode($out, ENT_QUOTES));
		}


	//now DELETE		
		
		

	}

	class genericException extends Exception {
	  	public function errorMessage() {
	    //error message
	    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
	    .': '.$this->getMessage();
	    return $errorMsg;
  	}
}
?>