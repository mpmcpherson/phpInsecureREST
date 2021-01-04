<?php
	namespace REST_API;
	require 'api/shared/databaseManager.php';

	$var = new databaseManager();

	$file = $var->getMapAndIndexFile('');

	var_dump($file);
?>