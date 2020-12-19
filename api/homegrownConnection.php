<?php
	require '../config/configuration.php';

	$data = '{ "name" : "phpInsecureRestTest" }';

	$options = array(
	    'http' => array(
	        'header'  => $header,
	        'method'  => $method,
	        'content' => $data
	    )
	);



	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) { /* Handle error */ }

	var_dump($result);

?>