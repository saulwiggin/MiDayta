app.controller("message_controller", [ '$scope', '$rootScope', '$http', function($scope, $rootScope, $http) {

    var user_id = document.getElementById('user_id_hidden').value;
    var sender_id = document.getElementById('sender_id_hidden').value;

	var url = window.location.href;
	var to = url.lastIndexOf('/') +1;
    x =  url.substring(0,to);
    $scope.baseUrl = x;
    url = x+'get_uri/get/all/'+user_id+'/'+sender_id;
    console.log(url);
    
    $http.get(url)
    .then(function success(response) {
    	console.log(response.data);
        $scope.messages = response.data;
    }, function error(response){
    	console.log(response.statusText);
    });

}]);