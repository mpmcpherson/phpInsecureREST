<?php
	class blogPost extends restBaseClass
	{
		function __construct()
		{
			$this->author = "";
			$this->subject = "";
			$this->body = "";
		}

		function print()
		{
			foreach($this as $key => $value) {
					echo "key: ".$key." value: ".$value."\n";
				}
		}
	}
?>