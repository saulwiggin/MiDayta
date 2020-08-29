app.controller("login", ["$scope", "$rootScope", "$http", function($scope, $rootScope, $http){

	$scope.update_username = function(username){

		console.log(username);
		document.cookie = "username="+username;
		var x = document.cookie;
		console.log(x);

		//service.add(username);

		$rootScope.$broadcast('username', username);

	}

}]);