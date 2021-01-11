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

		private $viewElement = "";
		private $elementType = "";

		function __construct($viewElement,$type){
			$this->viewElement = $viewElement;
			$this->elementType = $type;
			//this is very raw, and needs to end up taking each of the above into account and make sure to handle the proper element emission for them

			//going to have to write some code for handling JS objects, which suuuucks
			$filter = new filterObject($this->viewElement,$this->elementType);
			$emitter = new emissionLoopObject($viewElement);
			
			$this->baseView = "function(doc) {if (".$filter->filterResult()."){".$emitter->emissionLoopResult()."}}";
		}
		//probably several of these. 
		function StringBuilder(){}
		function pack(){
			return json_encode(array($this->viewElement=>$this->baseView));
		}
	}

	//the string this outputs will have to have a boolean evaluation in JS. 
	//How's that for a fucking trip?
	class filterObject{
		//I'm writing an assembler, so I'd best have something to assemble it into.
		private $filterString = "";

		function __construct($viewElement,$elementType){
			$lops = new logicalOperators();
		
			$this->filterString = "(typeof doc." . $viewElement. $lops->NOT_EQ . "'undefined') ".$lops->LAND." typeof doc." . $viewElement . $lops->STRICT_EQ . "'" . $elementType . "'";
		}

		function filterResult(): string{
			return $this->filterString;
		}
	}
	class emissionLoopObject{
		private $baseLoop="";
		function __construct($viewElement){
			$this->baseLoop ="doc.".$viewElement.".forEach(function(element) { emit(element, 1); });";
		}
		function emissionLoopResult(){
			return $this->baseLoop;
		}

	}

	class logicalOperators{
		public $LAND = "&&";
		public $LOR = "||";
		public $STRICT_EQ = "===";
		public $STRICT_NOT_EQ = "!==";
		public $NOT_EQ = "!=";
	}
?>