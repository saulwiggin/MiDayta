app.controller('switches', ['$rootScope', '$scope', '$http', function($rootScope, $scope, $http){

  $scope.data = {
    cb1: true,
    cb4: true,
    cb5: false
  };

  $scope.message = 'false';

  $scope.onChange = function(cbState) {
  	$scope.message = cbState;
  };

}]);