<?php
namespace REST_API;
	class blogPost extends restBaseClass
	{
		//this won't work now. Or it'll break abstractRestBaseClass
		//I'll put this in a bug fix issue
		function __construct()
		{
			$this->author = "";
			$this->subject = "";
			$this->body = "";
		}

		
	}
?>