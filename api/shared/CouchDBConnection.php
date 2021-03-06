<?php
namespace REST_API;
class CouchDB {

    private $username;
    private $password;

    function __construct($db, $host = 'localhost', $port = 5984, $username = null, $password = null) {
        $this->db = $db;
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    static function decode_json($str) {
        return json_decode($str);
    }

    static function encode_json($str) {
        return json_encode($str);
    }

    function send($url, $method = 'get', $data = NULL) {
        $url = '/'.$this->db.(substr($url, 0, 1) == '/' ? $url : '/'.$url);
        $request = new CouchDBRequest($this->host, $this->port, $url, $method, $data, $this->username, $this->password);
        
        return $request->send();
    }

    function get_all_docs() {
        return $this->send('/_all_docs');
    }

    function get_item($id) {
        return $this->send('/'.$id);
    }
}

?>