<?php
	require_once 'CouchDBConnection.php';
	require_once 'CouchDBRequest.php';
	require_once 'CouchDBResponse.php';
	require_once(__DIR__.'/../config/secretConfig.php');

	class restBaseClass{
		private $newConn = "";
		public $id = '';
		public $revision = '';
		public $clean = '';

		function construct()
		{	//if we get passed an ID, then we need to populate everything with a GET
			echo "constructed\n";
			$newConn = new CouchDB('test_db','localhost',5984,$uname,$pw);
			$this->id = "";
			$this->revision = "";
			$this->clean = false;
		}
		//now POST
		function POST(){
			$this->SubmitToDb();
		}


		private function SubmitToDb(){
				//use the date for this one
				$this->id = date("d-m-YTh:i:s");
				$retVal = $newConn->send('/'. $this->id, 'POST', $this->encodeForDelivery());

				$responseBody = $retVal->getBody();

				$decoded = json_decode($responseBody);

				//we write this back up so that the target knows the value to override
				$this->revision = $decoded->rev;
		}

		//now GET
		//to get something, you just need to know its ID.
		//I don't actually know if this'll bring back good results
		//the $this->$key thing might not actually let me access
		//the $this->key value
		function GET(){
			getObject();
		}
		private function getObject(){
				
				$dbRevVal = json_decode($newConn->send($this->id)->getBody());

				foreach($dbRevVal as $key => $value) {
					$key = recoverString($key);
					$value = recoverString($value);
					$this->$key = $value;
				}
		}


		//now PUT
		function PUT(){
			Save();
		}
		private function Save()
		{
			try{ //these text responses probably aren't going to work out, but they'll do for now.
				$revisionStatus = CheckRevision();
				if(gettype($revisionStatus)==="boolean"){
					//this is *begging* for some horrible race condition to pop up.
					$this->clean = true;
					$this->SyncToDb();
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
								
				$retVal = $newConn->send('/'.$this->id, 'PUT', encodeForDelivery());

				$responseBody = $retVal->getBody();

				$decoded = json_decode($responseBody);

				//and we write this back up so that the target knows the new value to override
				$this->revision = $decoded->rev;
			}

		}

		//now DELETE
		function DELETE(){
			deleteObject();
		}	
		private function deleteObject()
		{
			$retVal = $newConn->send('/'.$this->id, 'DELETE');

			$responseBody = $retVal->getBody();

			$decoded = json_decode($responseBody);

			//and we write this back up so that the target knows the new value to override
			$this->revision = $decoded->rev;
		}

		//really should have pulled this out right away
		private function encodeForDelivery(){
			$data = "{";

				foreach($this as $key => $value) {
					if($key!=="_rev"){
			    		$data = $data .'"'.$this->prepString($key).'":"'. $this->prepString($value).'",';
					}
				}
			//I don't feel like writing a bunch of lookaheads to know if I'm at the last element of an object, sooooo I'll just run until the end and then cut the last character (which will be an erroneous ,) out entirely.
			$data = substr($data,0,-1)."}";
			return $data;
		}

		function abstractPrint()
		{
			foreach($this as $key => $value) {
					echo "key: ".$key." value: ".$value."\n";
			}	
		}

		private function prepString($string)
		{
			return htmlspecialchars(str_replace(["\r\n", "\r", "\n"], '<br/>', $string), ENT_QUOTES, "UTF-8");
		}
		private function recoverString($string)
		{
			return preg_replace('/\<br(\s*)?\/?\>/i', PHP_EOL, html_entity_decode($out, ENT_QUOTES));
		}
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