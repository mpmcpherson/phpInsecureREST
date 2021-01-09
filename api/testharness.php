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
	$testDELETE=true;
	
	$db = "test_db";
	$host = "localhost";
	$uname = "couchAdmin";
	$passwd = "Adein1Dva2!";

	/*testing POST*/
	if($testPost){
		echo "\npost \n";
		$post['post'] = new restBaseClass();
		$post['post']->connect($db,$host,$uname,$passwd);
		$post['post']->author="Michael";
		$post['post']->subject="<p><br />we're going to try to get this to go through to the 'put'";
		$post['post']->body="HERE'S A BODY";
		$post['post']->type="post";
		$post['post']->tags = array("testing","blogPost","mcpherson","dyer");
		//var_dump($post['post']);
		echo "\n";
		echo $post['post']->betterAbstractPrint($post['post']);

		//var_dump($post['post']);
		$post['post']->POST();
		
		echo $post['post']->betterAbstractPrint($post['post']);		
		
		$_idForward = $post['post']->_id;
		
		echo "\n";
	}

	/*testing GET*/	
	if($testGET)
	{
		echo "get \n";
		$post['get'] = new restBaseClass();
		$post['get']->connect($db,$host,$uname,$passwd);
		
		$post['get']->GET($_idForward);
		$post['get']->betterAbstractPrint($post['get']);
		var_dump($post['get']);
		echo "\n";
	}

	/*testing PUT*/	
	if($testPUT)
	{
		echo "put \n";

		$post['put'] = new restBaseClass();
		$post['put']->connect($db,$host,$uname,$passwd);
		

		$post['put']->GET($_idForward);
		$post['put']->body="and now we're something else";
		$post['put']->PUT();

		$post['put']->betterAbstractPrint($post['put']);
		var_dump($post['put']);

		echo "\n";
	}

	/*testing DELETE*/	
	if($testDELETE){
		echo "delete \n";

		$post['delete'] = new restBaseClass();
		$post['delete']->connect($db,$host,$uname,$passwd);
		

		$post['delete']->GET($_idForward);
		$post['delete']->betterAbstractPrint($post['delete']);
		$post['delete']->DELETE();
		
		echo "\n";
		echo "Now try GETting the DELETEd object...";
		echo "\n";
		echo "\n";

		$post['delete']->GET($_idForward);

		$post['delete']->betterAbstractPrint($post['delete']);
		var_dump($post['delete']);

		echo "\n";	
	}

?>