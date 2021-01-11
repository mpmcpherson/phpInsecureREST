<?php
namespace REST_API;
require_once 'CouchDBConnection.php';
require_once 'CouchDBRequest.php';
require_once 'CouchDBResponse.php';
require_once 'genericException.php';

	class restBaseClass {
		
		public $author;
		public $subject;
		public $body;
		private $newConn;
		public $_id;
		public $timestamp;
		public $_rev;
		public $clean;
		public $type;
		public $tags;

		function __construct(){

			$this->_id = "";
			$this->timestamp="";
			$this->_rev = "";
			$this->clean = false;
			$this->type = "abstract";
			$this->tags = array();
		}
		function connect(string $db, string $host,string $uname,string $passwd) : void{
			$this->newConn = $this->buildDbConnection($db,$host,5984,$uname,$passwd);
		}
		//now POST
		function POST() : void{
			$this->SubmitToDb();
		}


		private function SubmitToDb() : void{
				
				//use the date for this one
				$this->_id = uniqid("",true);
				 
				$this->timestamp = date("d-m-YTh:i:s");

				$retVal = $this->newConn->send('/'. $this->_id, 'PUT', $this->encodeForDelivery("POST"));
				
				$responseBody = $retVal->getBody();

				$decoded = json_decode($responseBody);
				 
				//testing
				$this->handleReturns($decoded);
				//we write this back up so that the target knows the value to override
				//$this->_rev = $decoded->rev;

		}

		private function buildDbConnection(string $db,string $host,int $port, string $uname,string $passwd) : CouchDB {

			return new CouchDB($db,$host,$port,$uname,$passwd);
		}

		//now GET
		//to get something, you just need to know its ID.
		function GET(string $id) : void{
			try{
				$this->getObject($id);
			}catch(genericException $e){
				echo $e->errorMessage();
			}

		}

		private function getObject(string $id) : void{

			$retVal = $this->newConn->send($id);
			//var_dump($retVal);
			$responseBody = $retVal->getBody();
			//echo $responseBody;
			$dbRevVal = json_decode($responseBody);


			//ahhh ahahaha, this is beautiful: the means that any new classes (say, errors) will get dynamically added to the class without vomiting any errors out. 
			//there could be issues, but as it is, this also makes this very useful.
			//I might write this into each of the functions...
			/*foreach($dbRevVal as $key => $value) {
				$this->{$this->recoverString($key)} = $this->recoverString($value);
				
			}*/
			//testing
			$this->handleReturns($dbRevVal);
		}


		//now PUT
		function PUT() : void{
			$this->Save();
		}
		private function Save() : void{
			try{ //these text responses probably aren't going to work out, but they'll do for now.
				$revisionStatus = $this->CheckRevision();
				if(gettype($revisionStatus)==="boolean"){
					//this is *begging* for some horrible race condition to pop up.
					$this->clean = $revisionStatus;
					if($this->clean){
						$this->SyncToDb();
						echo "Success! Current version number is ".$this->_rev."\n";
						$this->clean = false;
					}
				}else{
					throw new genericException("The version of the object you are editing is out of date. Current local version is: " . 
						$this->_rev . " and current server version is : " . 
						$revisionStatus . ". Please back up your changes and refresh your data\n");
				}
			}
			catch(genericException $e){
				echo $e->errorMessage();
			}
		}
		function CheckRevision() {
			//okay, this is almost certainly just me being too clever, but it's fun while it lasts
			//right, so what I need to do here is alert the user to get a new version. The rest (the part where I functionally branch the changes) needs to be handled by certain UI elements and custom code to keep the user in control.

			//way lighter than sending the whole damn doc over the wire. Might not work as written (probably won't work as written).
			//$dbRevVal = json_decode($this->newConn->send($this->_id, "HEAD")->getHeaders())->ETag;

			$retVal = $this->newConn->send($this->_id, "HEAD");
			$responseBody = $retVal->getHeaders();
			
			//var_dump($responseBody);

			$parsedHeaders = $this->parseHeaders($responseBody);			

			$dbRevVal = $parsedHeaders['ETag'];		

			return strcmp($this->_rev , $dbRevVal)!==0 ? true : $dbRevVal; 
		}
		
		private function SyncToDb() : void{		
			if($this->clean){
								
				$retVal = $this->newConn->send('/'.$this->_id, 'PUT', $this->encodeForDelivery("PUT"));

				$responseBody = $retVal->getBody();
				
				$decoded = json_decode($responseBody);
				
				//and we write this back up so that the target knows the new value to override

				//let's try this little thing:
				$this->handleReturns($decoded);
				

				//$this->_rev = $decoded->rev; //and it's rev, not _rev, because consistency is for suckers
			}
		}

		
		//now DELETE
		function DELETE() : void{
			$this->deleteObject();
		}	
		private function deleteObject() : void{
			if($this->CheckRevision()){
				$retVal = $this->newConn->send('/'.$this->_id."?rev=".$this->_rev, 'DELETE');

				$responseBody = $retVal->getBody();

				$decoded = json_decode($responseBody);

				//Wipe the object itself from local memory
				foreach($this as $key => $value) {
					if($key !== "newConn"){
						$this->{$key} = "null";
					}
				}
				$this->handleReturns($decoded);
			}else{
				$this->clean=false;
			}
		}


		private function encodeForDelivery(string $encodingMethod) : string{

			if($encodingMethod==="POST"){
				$encAry = array("newConn","clean","_rev","","position","ary");
			}elseif($encodingMethod==="PUT"){
				$encAry = array("newConn","clean","","position","ary");
			}
			
			$startAry = get_object_vars($this);

			$workingAry = array();

			foreach($startAry as $key => $value){
					if(in_array($key, $encAry, true)===false){
						$workingAry[$key]=$value;
					}
			}
			return json_encode($workingAry);			
		}

		private function parseHeaders(string $headerString) : array{

			$midVal = explode(PHP_EOL, $headerString);
			$lokeys = array();
			$hivalue = array();

			$httpResponse = $midVal[0];
			
			array_shift($midVal);


			foreach($midVal as $key => $value){
				$inter = explode(':', $value);
				array_push($lokeys, str_replace(["\""," "],"",$inter[0]));
				array_push($hivalue, str_replace(["\""," "],"",$inter[1]));
				
			}
			$workingHeaders = array_combine($lokeys, $hivalue);
			return $workingHeaders;

		}

		
		function betterAbstractPrint($obj){
			
			$print = "";
			foreach($obj as $key => $value) {
				if($key!=="newConn"){
					$print .= $key.":";
					if(gettype($value) == 'array'){
						$print .= "array()\n\t" . $this->betterAbstractPrint($value)."\n";
					}
					else{
						if($key === "clean"){
							$print .= strval($value)."\n";
						}else{
							$print .= $value."\n";
						}
					}
				}	
			}
			return $print;
		}			

		function handleReturns($obj) : void{

			$startAry = get_object_vars($obj);

			$workingAry = array();

			foreach($startAry as $key => $value){
				if($key=="id")
					{$this->_id=$value;}
				elseif($key=="rev")
					{$this->_rev=$value;}
				else
					{$this->{$key} = $value;}	
			}


			
		}

		private function prepString(string $string) : string{
			return htmlspecialchars(str_replace(["\r\n", "\r", "\n"], '<br/>', $string), ENT_QUOTES, "UTF-8");
			
		}
		private function recoverString(string $string) : string{
			return htmlspecialchars_decode($string, ENT_QUOTES);
		}

	}


?>

