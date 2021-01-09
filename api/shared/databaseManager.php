<?php
namespace REST_API;
require_once 'CouchDBConnection.php';
require_once 'CouchDBRequest.php';
require_once 'CouchDBResponse.php';
require_once 'genericException.php';
require_once 'abstractRestConnection.php';
require_once '../genericView.php';

	class databaseManager extends restBaseClass{
		
		private $dbName;
		private $conf;
		private $baseView="";

		function __construct(){
			$this->dbName="";
			$this->conf = loadConfigFile();
			
		}
		public function print(){
			parent::betterAbstractPrint();
		}

		function createDatabase(string $name)
		{
			$this->dbName = $name;
			SubmitToDb();
		}
		function deleteDatabse(string $name){
			$this->dbName = $name;
			deleteObject();
		}
		private function SubmitToDb() : void{
			$retVal = $this->newConn->send('/'. $this->dbName, 'PUT');
			$responseBody = $retVal->getBody(); 
			$decoded = json_decode($responseBody);
			$this->handleReturns($decoded);
		}

		function getAllDbs(){
			return GET('_all_dbs');
		}
		private function deleteObject() : void{
			if($this->CheckRevision()){
				$retVal = $this->newConn->send('/'.$this->dbName, 'DELETE');
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
		
		function loadConfigFile(){
			return file_get_contents(file_exists('../../.couchConfig'));//this is so brittle and ugly. There's probably a real convention regarding this, but my brain is literally not working.
		}

		function getMapAndIndexFile($path) {
			$this->file = json_decode(file_get_contents($path.'.couchConfig'), true);

			return $this->file['mapColumnList'];
		}

	}
?>

