<?php
namespace REST_API;
	class genericView extends restBaseClass
	{

		//attributes to index comes from the config
		//and they'll take the form of doc.ArrayElement
		private $documentAttributesToIndex = array();
		//the elements will have to come from the class, I guess?
		//and here, it will be doc.ArrayElement.forEach(documentElement)
		private $documentElemntsToIndex = array();

		private $baseView = "";
		function __construct($viewElement,$type){

			//this is very raw, and needs to end up taking each of the above into account and make sure to handle the proper element emission for them
			$filter = new filterObject("type","post");
			$this->baseView = 
			"function(doc) {".
			//if (doc.type === "post" && doc.tags && Array.isArray(doc.tags)) {
				"if (".$filter->filterResult().") {
					doc.tags.forEach(function(tag) { 
						emit(tag.toLowerCase(), 1); 
					}); 
				} 
			}";
		}
		//probably several of these. 
		function StringBuilder(){}
		function pack(){}
	}

	//the string this outputs will have to have a boolean evaluation in JS. 
	//How's that for a fucking trip?
	class filterObject{
		//I'm writing an assembler, so I'd best have something to assemble it into.
		private $filterString = "";

		function __construct($docElement = "type",$configuredTarget="post", $inputArray){
			$lops = new logicalOperators();
		
			$this->filterString = "doc." . $docElement . " " . $lops->LAND  . " " . $configuredTarget;
		}

		function filterResult(): string{
			return $this->filterString;
		}
	}
	class emissionLoopObject{
		private $baseLoop="";
		function __construct($inputArray){
			$this->baseLoop =
			 					"doc.".$inputArray.".forEach(function(element) { 
									emit(element, 1); 
								}); ";
		}

	}

	class logicalOperators{
		public $LAND = "&&";
		public $LOR = "||";
		public $STRICT_EQ = "===";
		public $STRICT_NOT_EQ = "!==";
	}
?>