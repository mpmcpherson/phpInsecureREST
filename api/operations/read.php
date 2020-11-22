<?php
//headers for requests...
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//database and objects...
include_once '../config/configuration.php';
include_once '../objects/text_entry.php';

//let's get our connection...
$database = new Database();
$db = $database->getConnection();

$stmt = $text_entry->read();
$num = $stmt->rowCount(); //not sure this'll work when I'm not going after a standard db interface
  
// verify that we got results back....
if($num>0){
  
    // products array
    $entries=array();
    $entries["text"]=array();

    while (/*however the hell you do this when pulling from couch*/){

        extract($row);
  
        $text_entry=array(
    	    "id" => $id,
			"title" => $title,
			"tags" => $tags,
			"text" => $text,
			"created" => $created
		  
        );
  
        array_push($entries["text"], $text_entry);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($entries);
}else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no entries found
    echo json_encode(
        array("message" => "No entries.")
    );
}
  


?>