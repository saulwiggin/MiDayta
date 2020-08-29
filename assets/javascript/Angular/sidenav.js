app.controller('sidenav', ['$http', function($rootScope, $scope, $http){

  // company specific info: name, applicaitons, logo, etc. 
  user_id = 17;

  $http.get($rootScope.baseUrl+'get_uri/get/user/'+user_id).
    success(function(data, status, headers, config) {
      console.log(data);
      $scope.messages = data;
    }).
    error(function(data, status, headers, config) {
      console.log(data);
    });

  $rootScope.company_name = $scope.company_name;
  console.log($rootScope.username); 


}]);