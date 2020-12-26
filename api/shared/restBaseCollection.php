<?php
namespace REST_API;
require_once 'CouchDBConnection.php';
require_once 'CouchDBRequest.php';
require_once 'CouchDBResponse.php';
require_once 'genericException.php';
require_once 'abstractRestConnection.php';

	class restBaseCollection{
		
		private $baseClassArray;

		function __construct(){
			$baseClassArray = array();
		} 

		function getAllDocs()
		{
			$this->baseClassArray = restBaseClass::GET("_all_docs");
		}

		private function handleReturns($obj) : void{
			foreach($obj as $key => $value) {
				if(gettype($value) == 'array'){
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

