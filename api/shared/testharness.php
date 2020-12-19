<?php
	require_once 'shared/abstractRestConnection.php';
	require_once 'objects/blogPost.php';
	require_once 'objects/user.php';
	require_once 'objects/dndPlot.php';

	$post = new blogPost();
	$post->construct();
	$post->author="Michael";
	$post->subject="Bedtime? > < & @ # : ;";
	$post->body="New";


	//var_dump($post);	
	//$post->print();
	//$post->abstractPrint();
	//I should write something to print the methods, in the abstract class
	//var_dump(get_class_methods($post));
	/*
	$user = new user();
	$user ->abstractPrint();

	$plot = new dndPlot();
	$plot -> abstractPrint();
	*/
	$vals = $post->POST();
	echo $vals;
	$post->abstractPrint();
?>