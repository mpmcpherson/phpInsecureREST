<?php
	require_once 'abstractRestConnection.php';
	require_once 'blogPost.php';

	$post = new blogPost();

	$post->author="Michael";
	$post->subject="Bedtime";
	$post->body="New";


	//var_dump($post);	
	$post->print();
?>