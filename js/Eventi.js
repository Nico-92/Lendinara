myApp.factory('Eventi', ['$resource', function($resource) {
	function event(){
		return ['evento1','evento2','evento3']
	}
	

	/*return $resource( '/book/:bookId', 
		{ bookId: '@bookId' }, { 
			loan: { 
				method: 'PUT', 
				params: { bookId: '@bookId' }, 
				isArray: false 
			} 
			/* , method2: { ... } 
		} );*/

}]);