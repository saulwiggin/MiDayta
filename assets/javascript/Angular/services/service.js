app.factory('service', function() {
  var username = '';

  var add = function(username) {
      productList.push(username);
  };

  var get = function(){
      return productList;
  };

  return {
    add: add,
    get: get
  };

});