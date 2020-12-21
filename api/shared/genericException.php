<?php
namespace REST_API;
use \Exception;
class genericException extends Exception {
  	public function errorMessage() {
		//error message
	    $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
	    .': '.$this->getMessage();
	    return "\n".$errorMsg."\n";
  	}
}

?>