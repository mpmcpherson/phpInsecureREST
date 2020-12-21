<?php
namespace REST_API;
class CouchDBResponse {

    private $raw_response = '';
    private $headers = '';
    private $body = '';

    function __construct($response = '') {
        
        $this->raw_response = $response;
        list($this->headers, $this->body) = explode("\r\n\r\n", $response);
        //$this->body = preg_replace('/\s+/', '', $this->body); //OH FOR FUCKS SAKE
        //THIS WAS THE CULPRIT THE WHOLE TIME
        //WHY WAS IT TRYING TO DO STRING HANDLING?
    }

    function getRawResponse() {
        return $this->raw_response;
    }

    function getHeaders() {
        return $this->headers;
    }

    function getBody($decode_json = false) {
        return $decode_json ? CouchDB::decode_json($this->body) : $this->body;
    }
}
?>