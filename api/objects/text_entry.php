<?php
class text_entry{
  
    // database connection and table name
    private $conn;
    private $table_name = "text_entries";
  
    // object properties
    public $id;
    public $title;
    public $tags;
    public $text;
    public $created;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}


//TODO: write the couchDB access methods for this, then import them
//based on the configuration file values
function create(){
  
 

}
function read(){
  
 

}
function update(){
  
 

}
function delete(){
  
 

}
?>