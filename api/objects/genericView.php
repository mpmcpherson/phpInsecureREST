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
		function __construct(){
			//this is very raw, and needs to end up taking each of the above into account and make sure to handle the proper element emission for them
			$this->baseView = "function(doc) {if (doc.type === $sometype && doc.tags && Array.isArray(doc.tags)) { doc.tags.forEach(function(tag) { emit(tag.toLowerCase(), 1); }); } }";
		}
		//probably several of these. 
		function StringBuilder(){}
		
	}
?>