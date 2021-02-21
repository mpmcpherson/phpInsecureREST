<?php
namespace REST_API;
	class blogPost extends restBaseClass
	{
		//this won't work now. Or it'll break abstractRestBaseClass
		//I'll put this in a bug fix issue
		public $author;
		public $subject;
		public $body;

		public $_id;
		public $timestamp;
		public $_rev;
		public $type;
		public $tags;
		
		function __construct(){
			$this->author="";
			$this->subject="";
			$this->body="";

			$this->ary = get_object_vars($this);

			$this->_id = "";
			$this->timestamp="";
			$this->_rev = "";
			$this->clean = false;
			$this->type = "post";
			$this->tags = array("testing","blogPost","mcpherson","dyer");
		}

		
	}
?>