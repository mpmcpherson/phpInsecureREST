<?php
namespace REST_API;
require_once 'CouchDBConnection.php';
require_once 'CouchDBRequest.php';
require_once 'CouchDBResponse.php';
require_once 'genericException.php';
require_once 'abstractRestConnection.php';

	class databaseManager extends restBaseClass{
		
		private $dbName;

		function __construct(){
			$this->dbName="";
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
		private function handleReturns($obj) : void{
			foreach($obj as $key => $value) {
				if(gettype($value) == 'array'){
					$this->{$this->recoverString($key)} = "Array";
					$this->handleReturns($obj);
				}else{
					if($this->recoverString($key)=="id"){$this->_id=$this->recoverString($value);}else
					if($this->recoverString($key)=="rev"){$this->_rev=$this->recoverString($value);}else{
					$this->{$this->recoverString($key)} = $this->recoverString($value);}
				}
			}
		}
	}
?>

