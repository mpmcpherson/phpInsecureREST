<?php
	namespace REST_API;
	//echo dirname(__DIR__).'/shared/abstractRestConnection.php';
	require_once __DIR__.'/shared/abstractRestConnection.php';
	require_once __DIR__.'/objects/blogPost.php';
	require_once __DIR__.'/objects/user.php';
	require_once __DIR__.'/objects/dndPlot.php';


	$_idForward = "";
	//$_idForward = "20-12-2020EST07:43:05";

	$post = array('post' => "",'get'=>"",'put'=>"",'delete'=>"" );
	
	$testPost=true;
	$testGET=true;
	$testPUT=true;
	$testDELETE=false;
	
	/*testing POST*/
	if($testPost){
		echo "\npost \n";
		$post['post'] = new blogPost();
		$post['post']->construct();

		$post['post']->author="Michael";
		$post['post']->subject="we're going to try to get this to go through to the 'put'";
		$post['post']->body="HERE'S A BODY";
		$vals = $post['post']->POST();
		$post['post']->abstractPrint();
		
		$_idForward = $post['post']->_id;
		
		echo "\n";
	}

	/*testing GET*/	
	if($testGET)
	{
		echo "get \n";
		$post['get'] = new blogPost();
		$post['get']->construct();
		$post['get']->GET($_idForward);
		$post['get']->abstractPrint();
		echo "\n";
	}

	/*testing PUT*/	
	if($testPUT)
	{
		echo "put \n";

		$post['put'] = new blogPost();
		$post['put']->construct();

		$post['put']->GET($_idForward);
		$post['put']->body="and now we're something else";
		$post['put']->PUT();

		$post['put']->abstractPrint();

		echo "\n";
	}

	/*testing DELETE*/	
	if($testDELETE){
		echo "delete \n";

		$post['delete'] = new blogPost();
		$post['delete']->construct();

		$post['delete']->GET($_idForward);
		$post['delete']->abstractPrint();
		$post['delete']->DELETE();
		
		echo "\n";
		echo "Now try GETting the DELETEd object...";
		echo "\n";
		echo "\n";

		$post['delete']->GET($_idForward);

		$post['delete']->abstractPrint();

		echo "\n";	
	}

?>