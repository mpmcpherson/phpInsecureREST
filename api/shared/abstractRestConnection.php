<?php
	require_once 'CouchDBConnection.php';
	require_once 'CouchDBRequest.php';
	require_once 'CouchDBResponse.php';
	//require_once(__DIR__.'/../config/secretConfig.php');

	class restBaseClass{
		
		private $newConn;
		public $_id;
		public $_rev;
		public $clean;

		function construct(){
			//if we get passed an ID, then we need to populate everything with a GET
			$config = include __DIR__.'/../config/secretConfig.php';
			$this->newConn = new CouchDB('test_db','127.0.0.1',5984,$config['uname'],$config['pw']);
			$this->_id = "";
			$this->_rev = "";
			$this->clean = false;
		}
		//now POST
		function POST(){
			$this->SubmitToDb();
		}


		private function SubmitToDb(){
				//use the date for this one
				$this->_id = date("d-m-YTh:i:s");
				
				$retVal = $this->newConn->send('/'. $this->_id, 'PUT', $this->encodeForDeliveryPost());

				$responseBody = $retVal->getBody();

				$decoded = json_decode($responseBody);
				
				//we write this back up so that the target knows the value to override
				$this->_rev = $decoded->_rev;

		}

		//now GET
		//to get something, you just need to know its ID.
		//I don't actually know if this'll bring back good results
		//the $this->$key thing might not actually let me access
		//the $this->key value
		function GET($id){
			try{
				$this->getObject($id);
			}catch(Exception $e){
				echo $e->errorMessage();
			}

		}

		private function getObject($id){

			$retVal = $this->newConn->send($id);
			$responseBody = $retVal->getBody();
			$dbRevVal = json_decode($responseBody);



			foreach($dbRevVal as $key => $value) {
				$this->{$this->recoverString($key)} = $this->recoverString($value);
				
			}
		}


		//now PUT
		function PUT(){
			$this->Save();
		}
		private function Save(){
			try{ //these text responses probably aren't going to work out, but they'll do for now.
				$revisionStatus = $this->CheckRevision();
				if(gettype($revisionStatus)==="boolean"){
					//this is *begging* for some horrible race condition to pop up.
					$this->clean = true;
					$this->SyncToDb();
					echo "Success! Current version number is ".$this->_rev;
					$this->clean = false;
				}else{
					throw new genericException("The version of the object you are editing is out of date; please back up you changes and refresh your data");
				}
			}
			catch(genericException $e){
				echo $e->errorMessage();
			}
		}
		private function CheckRevision(){
			//okay, this is almost certainly just me being too clever, but it's fun while it lasts
			//right, so what I need to do here is alert the user to get a new version. The rest (the part where I functionally branch the changes) needs to be handled by certain UI elements and custom code to keep the user in control.

			//way lighter than sending the whole damn doc over the wire. Might not work as written (probably won't work as written).
			//$dbRevVal = json_decode($this->newConn->send($this->_id, "HEAD")->getHeaders())->ETag;

			$retVal = $this->newConn->send($this->_id, "HEAD");
			$responseBody = $retVal->getHeaders();
			;
			try{
				
				$midVal = explode(PHP_EOL, $responseBody);
				$lokeys = array();
				$hivalue = array();

				foreach($midVal as $key => $value){
					$inter = explode(':', $value);
					array_push($lokeys, str_replace(["\""," "],"",$inter[0]));
					array_push($hivalue, str_replace(["\""," "],"",$inter[1]));
					
				}
				$workingHeaders = array_combine($lokeys, $hivalue);
				$dbRevVal = $workingHeaders['ETag'];
			}catch(genericException $e)
			{
				echo $e->errorMessage();
			}
			
			try{

				return strcmp($this->_rev , $dbRevVal)!==0 ? true : $dbRevVal; 

			}catch(genericException $e){
				echo $e->errorMessage();
			}
			
		}
		
		private function SyncToDb(){		
			if($this->clean){
								
				$retVal = $this->newConn->send('/'.$this->_id, 'PUT', $this->encodeForDeliveryPut());

				$responseBody = $retVal->getBody();
				
				$decoded = json_decode($responseBody);
				
				//and we write this back up so that the target knows the new value to override
				$this->_rev = $decoded->rev; //and it's rev, nto _rev, because consistency is for suckers
			}
		}

		//now DELETE
		function DELETE(){
			deleteObject();
		}	
		private function deleteObject(){
			$retVal = $newConn->send('/'.$this->_id, 'DELETE');

			$responseBody = $retVal->getBody();

			$decoded = json_decode($responseBody);

			//and we write this back up so that the target knows the new value to override
			$this->_rev = $decoded->rev;
		}

		//really should have pulled this out right away
		private function encodeForDeliveryPost(){
			$data = "{";

				foreach($this as $key => $value) {
					if($key!=="_rev"&&$key!=="newConn"&&$key!=="clean"){
			    		$data = $data .'"'.$this->prepString($key).'":"'. $this->prepString($value).'",';
					}
				}
			//I don't feel like writing a bunch of lookaheads to know if I'm at the last element of an object, sooooo I'll just run until the end and then cut the last character (which will be an erroneous ,) out entirely.
			$data = substr($data,0,-1)."}";
			//echo $data;
			return $data;
		}

		//really should have pulled this out right away
		private function encodeForDeliveryPut(){
			$data = "{";

				foreach($this as $key => $value) {
					if($key!=="newConn"&&$key!=="clean"){
			    		$data = $data .'"'.$this->prepString($key).'":"'. $this->prepString($value).'",';
					}
				}
			//I don't feel like writing a bunch of lookaheads to know if I'm at the last element of an object, sooooo I'll just run until the end and then cut the last character (which will be an erroneous ,) out entirely.
			$data = substr($data,0,-1)."}";
			//echo $data;
			return $data;
		}

		function abstractPrint(){
			foreach($this as $key => $value) {
				if($key!=="newConn"){
					echo "key: ".$key." value: ".$value."\n";
				}

			}	
		}

		private function prepString($string){
			return htmlspecialchars(str_replace(["\r\n", "\r", "\n"], '<br/>', $string), ENT_QUOTES, "UTF-8");
		}
		private function recoverString($string){
			return preg_replace('/\<br(\s*)?\/?\>/i', PHP_EOL, html_entity_decode($string, ENT_QUOTES));
		}
	}

class genericException extends Exception {
  	public function errorMessage() {
		//error message
	    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
	    .': '.$this->getMessage();
	    return "\n".$errorMsg."\n";
  	}
}
?>