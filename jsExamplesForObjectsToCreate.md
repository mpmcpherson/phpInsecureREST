

//JS map function example:
/*
	function (doc) {
	  if (doc.type === 'post' && doc.tags && Array.isArray(doc.tags)) {
	    doc.tags.forEach(function (tag) {
	      emit(tag.toLowerCase(), 1);
	    });
	  }
	}
*/
/*
In this example a key/value pair is emitted for each value in the tags array of a document with a type of “post”. Note that emit() may be called many times for a single document, so the same document may be available by several different keys.

Also keep in mind that each document is sealed to prevent the situation where one map function changes document state and another receives a modified version.

For efficiency reasons, documents are passed to a group of map functions - each document is processed by a group of map functions from all views of the related design document. This means that if you trigger an index update for one view in the design document, all others will get updated too.
*/
