app.controller("reporting", [ '$scope', '$rootScope', '$http', function($scope, $rootScope, $http) {


	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15, // Creates a dropdown of 15 years to control year,
	    today: 'Today',
	    clear: 'Clear',
	    close: 'Ok',
	    closeOnSelect: false // Close upon selecting a date,
	  });	       

	 $('.timepicker').pickatime({
	    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
	    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
	    twelvehour: false, // Use AM/PM or 24-hour format
	    donetext: 'OK', // text for done-button
	    cleartext: 'Clear', // text for clear-button
	    canceltext: 'Cancel', // Text for cancel-button
	    autoclose: false, // automatic close timepicker
	    ampmclickable: true, // make AM PM clickable
	    aftershow: function(){} //Function for after opening timepicker
	  });

	//function print_report(){
	 //console.log('heelo');

		var user_id = document.getElementById('user_id_hidden').value;
	    var sender_id = document.getElementById('sender_id_hidden').value;

		var url = window.location.href;
		var to = url.lastIndexOf('/') +1;
	    x =  url.substring(0,to);
	    $scope.baseUrl = x;
	    url = x+'get_uri/get/email_log/'+user_id+'/'+sender_id;
	    console.log(url);

	 	 $http.get(url)
		    .then(function success(response) {
		    	console.log(response.data[0]);
		        $scope.email_log = response.data;

		     	 var pdf = new jsPDF();

		        pdf.text(30, 20, 'List of last twenty Alarms');

				for (i=0;i<21;i++){
					var date = new Date(response.data[0].datetime*1000);
					var usermessage = response.data[0].usermessage + ' at time ' + date;
					pdf.text(30, 30+10*i, usermessage);
				}

		        pdf.fromHTML(document.body);

		        pdf.save('report.pdf');

		    }, function error(response){
		    	console.log(response.statusText);
		    });
//	 }
	
}]);