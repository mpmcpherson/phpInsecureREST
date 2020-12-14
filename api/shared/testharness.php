<?php
	require_once 'abstractRestConnection.php';
	require_once 'blogPost.php';

	$post = new blogPost();

	$post->author="Michael";
	$post->subject="Bedtime";
	$post->body="New";
	$post->restBaseClass::__construct();
	
	$post->print();
	$post->abstractPrint();

?>