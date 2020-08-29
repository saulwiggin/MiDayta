app.controller("emails", [ '$scope', '$rootScope', '$http', function($scope, $rootScope, $http) {

	//if no message show alternative message
    userid = document.getElementById('hiddenuserid').value;
    senderid = document.getElementById('hiddensenderid').value;
    console.log(senderid);
    console.log(userid);

    var url = window.location.href;
    var to = url.lastIndexOf('/') +1;
    x =  url.substring(0,to);
    $scope.baseUrl = x;

    // table for email log
    url = x+'get_uri/get/email_log/'+userid;
    console.log(url);

	$http.get(url)
    .then(function success(response) {
        console.log(response.data);
        $scope.emails = response.data;
    }, function error(response){
        console.log(response.statusText);
    });

	$('#delete_emails').on('click',function(){
		console.log('click delete');
	     $.ajax({
		  type: 'POST',
		  url: '<?php echo base_url(); ?>get_uri/delete/all_emails',
		  data: data,
		  dataType:'json',
		  success: function(res) {
				console.log(res);
				location.reload();
			},
		  error: function(err){
		  	console.log(err);
		  }
		});
	});

}]);