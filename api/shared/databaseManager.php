<?php
namespace REST_API;
require_once 'CouchDBConnection.php';
require_once 'CouchDBRequest.php';
require_once 'CouchDBResponse.php';
require_once 'genericException.php';
require_once 'abstractRestConnection.php';
require_once 'genericView.php';

	class databaseManager extends restBaseClass{
		
		private $dbName;
		private $conf;
		private $baseView="";
		private $configPath = "../";
		private $configValues = "";
		

		function __construct(){
			$this->dbName="";
			//the database is going to have to have a flag for "under the management of..." this program.
		}
		public function print(){
			parent::betterAbstractPrint($this);
		}

		function createDatabase(string $name)
		{
			$this->dbName = $name;
			$this->SubmitDbToDb($this->dbName);
		}
		function createView(string $name, string $view){
			$viewTargetingString = $this->dbName."/_design/".$this->configValues["designDoc"]."/_view/".$name;

			#http://127.0.0.1:5984/_utils/#/database/test_db/_design/test_document/_view/tagger
			$this->SubmitDbToDb($viewTargetingString.$view);
		}
		function deleteDatabse(string $name){
			$this->dbName = $name;
			$this->deleteObject();
		}
		private function SubmitDbToDb($submissionTarget) : void{
			$retVal = parent::$newConn->send('/'. $submissionTarget, 'PUT');
			$responseBody = $retVal->getBody(); 
			$decoded = json_decode($responseBody);
			parent::handleReturns($decoded);
		}

		function getAllDbs(){
			parent::GET('_all_dbs');
		}
		private function deleteObject() : void{
			if(parent::CheckRevision()){
				$retVal = parent::$newConn->send('/'.$this->dbName, 'DELETE');
				$responseBody = $retVal->getBody();
				$decoded = json_decode($responseBody);

				foreach($this as $key => $value) {
					if($key !== "newConn"){
						$this->{$key} = "null";
					}
				}
				parent::handleReturns($decoded);
			}else{
				$this->clean=false;
			}
		}
		function buildDatabaseIndices(){
			$this->configValues = $this->getMapAndIndexFile($this->configPath);
			//var_dump($this->configValues);

			$mappingColumns = $this->configValues['mapColumnList'];
			
			$packagedView = array();

			foreach($mappingColumns as $key => $value){
				//now to start initializing all these things
				$view = new genericView($key,$value);
				$packageView = $view->pack();
				

				array_push($packagedView, $packageView);
			}


			foreach ($packagedView as $key => $value) {
				# code...
			}

			var_dump($packageView);
			
		}
		function loadDatabaseIndex($viewAsJson){
			//_design/test_document/_view/tagger
			//database/_design/name_of_design_doc/_view/nameOfElement
		}
		function getMapAndIndexFile($path) {
			if(file_exists($path.'.couchConfig')){
				$file = json_decode(file_get_contents($path.'.couchConfig'), true);
				return $file;
			}else{
				throw new \Exception("file doesn't exist. Path given: ".$path.".couchConfig");
			}
		}

	}
?>

