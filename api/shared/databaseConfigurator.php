<?php
namespace REST_API;
require_once 'CouchDBConnection.php';
require_once 'CouchDBRequest.php';
require_once 'CouchDBResponse.php';
require_once 'genericException.php';
require_once 'abstractRestConnection.php';

	class databaseConfigurator{

		function __construct(){}
		function getUserId(){}//not actually sure I need this, but let's note down the thought process
		function createUserDbDimension(){}//we're going to be pulling this in when the user is searching on the META objects
		function determine(){
			$conf = file_get_contents('../config/databaseClassification.json');//manual is bullshit, but it's a start
		}
	}

?>