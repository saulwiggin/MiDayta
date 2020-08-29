app.controller("digital_outputs", [ '$scope', '$rootScope', '$http', function($scope, $rootScope, $http) {

$scope.post_outputs = function(){
	$scope.user_id = document.getElementById('user_id_hidden').value;
    $scope.sender_id = document.getElementById('sender_id_hidden').value;
	D0OUT = $('#round-button-output-1').html();
	D1OUT = $('#round-button-output-2').html();
	D2OUT = $('#round-button-output-3').html();
	D3OUT = $('#round-button-output-4').html();
	D4OUT = $('#round-button-output-5').html();
	D5OUT = $('#round-button-output-6').html();
	D6OUT = $('#round-button-output-7').html();
	D7OUT = $('#round-button-output-8').html();
	$('#D0OUT').val(D0OUT); 
	$('#D1OUT').val(D1OUT);
	$('#D2OUT').val(D2OUT); 
	$('#D3OUT').val(D3OUT);
	$('#D4OUT').val(D4OUT);
	$('#D5OUT').val(D5OUT);
	$('#D6OUT').val(D6OUT);
	$('#D7OUT').val(D7OUT);
	$('#sender_id').val($scope.sender_id);
	data_dash = [$scope.user_id, $scope.sender_id, D0OUT, D1OUT, D2OUT, D3OUT, D4OUT, D5OUT, D6OUT, D7OUT];
	console.log(data_dash);
	url = x+'rawdata/configure_digital_inputs';
	console.log(url);
	$.ajax({
	  type: "POST",
	  url: url,
	  data: {user_id: data_dash[0], sender_id: data_dash[1], D0OUT: D0OUT, D1OUT: D1OUT, D2OUT: D2OUT, D3OUT: D3OUT, D4OUT: D4OUT, D5OUT: D5OUT, D6OUT: D6OUT, D7OUT: D7OUT},
	  success: function(data){
	  	console.log(data);
	  },
	  error: function(error){
	  	console.log(error);
	  },
	});
}	

$scope.update_outputs = function(){

	user_id = document.getElementById('user_id_hidden').value;
    sender_id = document.getElementById('sender_id_hidden').value;
    console.log(user_id);
    console.log(sender_id);
    user_id = user_id.replace(/\s/g,'');
    sender_id = sender_id.replace(/\s/g,'');
    var url = window.location.href;
    var to = url.lastIndexOf('/') +1;
    x =  url.substring(0,to);
    $scope.baseUrl = x;
    url = x+'get_uri/get/outputs/'+user_id+'/'+sender_id;
    console.log(url);
    
    $http.get(url)
    .then(function success(response) {
        console.log(response.data);
        $scope.messages = response.data;

		//$scope.out_button_click() = function(){

		//this function turns each button on or off or blue or orange on click
	    $(".round-button-circle-output").on("click", function(e) {
	    	$('#update_digitals').css('visibility','hidden');
	    	e.preventDefault();
	    	color = $(this).css("background-color");
	    	////////////////console.log(color);
	    	text = $(this).text();
	    	////////////////console.log(text);
	    	id = $(this).attr('id');
	    	////////////////console.log(id);
	    	if (id === "round-button-circle-output-1"){
	    		outputD0 = $('#round-button-output-1').text();
	    		////////////////console.log(outputD0);
	    		if (outputD0 === "ON"){
	    			$('#round-button-circle-output-1').css('background','#ffad33');
					$('#round-button-output-1').html('OFF');	
					$('#D0OUT').val('OFF');			    			
	    		} else {
	       			$('#round-button-circle-output-1').css('background','#0080FF');
					$('#round-button-output-1').html('ON');
					$('#D0OUT').val('ON');			    				
	    		}
	    	}
	    	if (id === "round-button-circle-output-2"){
	    		outputD1 = $('#round-button-output-2').text();
	    		if (outputD1 === "ON"){
	    			$('#round-button-circle-output-2').css('background','#ffad33');
					$('#round-button-output-2').html('OFF');		
					$('#D1OUT').val('OFF');			    					    			
	    		} else {
	       			$('#round-button-circle-output-2').css('background','#0080FF');
					$('#round-button-output-2').html('ON');	
					$('#D1OUT').val('ON');			    				
	    		}
	    	}				    	
	    	if (id === "round-button-circle-output-3"){
	    		outputD2 = $('#round-button-output-3').text();
	    		if (outputD2 === "ON"){
	    			$('#round-button-circle-output-3').css('background','#ffad33');
					$('#round-button-output-3').html('OFF');
					$('#D2OUT').val('OFF');			    			
	    		} else {
	       			$('#round-button-circle-output-3').css('background','#0080FF');
					$('#round-button-output-3').html('ON');	
					$('#D2OUT').val('ON');			    				
	    		}
	    	}
	    	if (id === "round-button-circle-output-4"){
	    		outputD3 = $('#round-button-output-4').text();
	    		if (outputD3 === "ON"){
	    			$('#round-button-circle-output-4').css('background','#ffad33');
					$('#round-button-output-4').html('OFF');				    			
					$('#D3OUT').val('OFF');			    			
	    		} else {
	       			$('#round-button-circle-output-4').css('background','#0080FF');
					$('#round-button-output-4').html('ON');	
					$('#D3OUT').val('ON');			    				
	    		}
	    	}
	      	if (id === "round-button-circle-output-5"){
	    		outputD4 = $('#round-button-output-5').text();
	    		if (outputD4 === "ON"){
	    			$('#round-button-circle-output-5').css('background','#ffad33');
					$('#round-button-output-5').html('OFF');				    			
					$('#D4OUT').val('OFF');			    			
	    		} else {
	       			$('#round-button-circle-output-5').css('background','#0080FF');
					$('#round-button-output-5').html('ON');	
					$('#D4OUT').val('ON');			    				
	    		}
	    	}
	    	if (id === "round-button-circle-output-6"){
	    		outputD5 = $('#round-button-output-6').text();
	    		if (outputD5 === "ON"){
	    			$('#round-button-circle-output-6').css('background','#ffad33');
					$('#round-button-output-6').html('OFF');				    			
					$('#D5OUT').val('OFF');			    			
	    		} else {
	       			$('#round-button-circle-output-6').css('background','#0080FF');
					$('#round-button-output-6').html('ON');	
					$('#D5OUT').val('ON');			    				
	    		}
	    	}
	    	if (id === "round-button-circle-output-7"){
	    		outputD6 = $('#round-button-output-7').text();
	    		if (outputD6 === "ON"){
	    			$('#round-button-circle-output-7').css('background','#ffad33');
					$('#round-button-output-7').html('OFF');				    			
					$('#D6OUT').val('OFF');			    			
	    		} else {
	       			$('#round-button-circle-output-7').css('background','#0080FF');
					$('#round-button-output-7').html('ON');	
					$('#D6OUT').val('ON');			    				
	    		}
	    	}
	    	if (id === "round-button-circle-output-8"){
	    		outputD7 = $('#round-button-output-8').text();
	    		if (outputD7 === "ON"){
	    			$('#round-button-circle-output-8').css('background','#ffad33');
					$('#round-button-output-8').html('OFF');				    			
					$('#D7OUT').val('OFF');			    			
	    		} else {
	       			$('#round-button-circle-output-8').css('background','#0080FF');
					$('#round-button-output-8').html('ON');	
					$('#D7OUT').val('ON');			    				
	    		}
	    	}
	    	////////////////console.log(id);
	    });
	//}

    }, function error(response){
        console.log(response.statusText);
    });

}

$scope.update_outputs();	
	
	  	
  	  
  if (D0OUT === "HI"){
 		$('#round-button-circle-output-1').css('background','#0080FF');
 		$("#round-button-output-1").text("ON");
  }	else {
  		$('#round-button-circle-output-1').css('background','#ffad33');
 		$("#round-button-output-1").text("OFF");
  }	
  if (D1OUT === "HI"){
 		$('#round-button-circle-output-2').css('background','#0080FF');
 		$("#round-button-output-2").text("ON");
  }	else {
  		$('#round-button-circle-output-2').css('background','#ffad33');
 		$("#round-button-output-2").text("OFF");
  }
  if (D2OUT === "HI"){
 		$('#round-button-circle-output-3').css('background','#0080FF');
 		$("#round-button-output-3").text("ON");
  }	else {
  		$('#round-button-circle-output-3').css('background','#ffad33');
 		$("#round-button-output-3").text("OFF");
  }	
  if (D3OUT === "HI"){
 		$('#round-button-circle-output-4').css('background','#0080FF');
 		$("#round-button-output-4").text("ON");
  }	else {
  		$('#round-button-circle-output-4').css('background','#ffad33');
 		$("#round-button-output-4").text("OFF");
  }	
  if (D4OUT === "HI"){
 		$('#round-button-circle-output-5').css('background','#0080FF');
 		$("#round-button-output-5").text("ON");
  }	else {
  		$('#round-button-circle-output-5').css('background','#ffad33');
 		$("#round-button-output-5").text("OFF");
  }	
  if (D5OUT === "HI"){
 		$('#round-button-circle-output-6').css('background','#0080FF');
 		$("#round-button-output-6").text("ON");
  }	else {
  		$('#round-button-circle-output-6').css('background','#ffad33');
 		$("#round-button-output-6").text("OFF");
  }		
  if (D6OUT === "HI"){
 		$('#round-button-circle-output-7').css('background','#0080FF');
 		$("#round-button-output-7").text("ON");
  }	else {
  		$('#round-button-circle-output-7').css('background','#ffad33');
 		$("#round-button-output-7").text("OFF");
  }
  if (D7OUT === "HI"){
 		$('#round-button-circle-output-8').css('background','#0080FF');
 		$("#round-button-output-8").text("ON");
  }	else {
  		$('#round-button-circle-output-8').css('background','#ffad33');
 		$("#round-button-output-8").text("OFF");
  }		

$(".round-button-circle-output").trigger( "click" );

//}
//$scope.out_button_click();	


  D0OUT = document.getElementById('D0OUT').value;
  D1OUT = document.getElementById('D1OUT').value;
  D2OUT = document.getElementById('D2OUT').value;
  D3OUT = document.getElementById('D3OUT').value;
  D4OUT = document.getElementById('D4OUT').value;
  D5OUT = document.getElementById('D5OUT').value;
  D6OUT = document.getElementById('D6OUT').value;
  D7OUT = document.getElementById('D7OUT').value;
  //selectoption = "<?php echo $selectOption;?>";
  console.log('stored digital outputs','selectoption',D0OUT,D1OUT,D2OUT,D3OUT,D4OUT,D5OUT,D6OUT,D7OUT);
  ////////////////console.log(['string of original outputs', D0OUT, D1OUT, D2OUT,D3OUT,D4OUT,D5OUT,D6OUT,D7OUT]);
  if (D0OUT === "HI"){
 		$('#round-button-circle-output-1').css('background','#0080FF');
 		$("#round-button-output-1").text("ON");
  }	else {
  		$('#round-button-circle-output-1').css('background','#ffad33');
 		$("#round-button-output-1").text("OFF");
  }	
  if (D1OUT === "HI"){
 		$('#round-button-circle-output-2').css('background','#0080FF');
 		$("#round-button-output-2").text("ON");
  }	else {
  		$('#round-button-circle-output-2').css('background','#ffad33');
 		$("#round-button-output-2").text("OFF");
  }
  if (D2OUT === "HI"){
 		$('#round-button-circle-output-3').css('background','#0080FF');
 		$("#round-button-output-3").text("ON");
  }	else {
  		$('#round-button-circle-output-3').css('background','#ffad33');
 		$("#round-button-output-3").text("OFF");
  }	
  if (D3OUT === "HI"){
 		$('#round-button-circle-output-4').css('background','#0080FF');
 		$("#round-button-output-4").text("ON");
  }	else {
  		$('#round-button-circle-output-4').css('background','#ffad33');
 		$("#round-button-output-4").text("OFF");
  }	
  if (D4OUT === "HI"){
 		$('#round-button-circle-output-5').css('background','#0080FF');
 		$("#round-button-output-5").text("ON");
  }	else {
  		$('#round-button-circle-output-5').css('background','#ffad33');
 		$("#round-button-output-5").text("OFF");
  }	
  if (D5OUT === "HI"){
 		$('#round-button-circle-output-6').css('background','#0080FF');
 		$("#round-button-output-6").text("ON");
  }	else {
  		$('#round-button-circle-output-6').css('background','#ffad33');
 		$("#round-button-output-6").text("OFF");
  }		
  if (D6OUT === "HI"){
 		$('#round-button-circle-output-7').css('background','#0080FF');
 		$("#round-button-output-7").text("ON");
  }	else {
  		$('#round-button-circle-output-7').css('background','#ffad33');
 		$("#round-button-output-7").text("OFF");
  }
  if (D7OUT === "HI"){
 		$('#round-button-circle-output-8').css('background','#0080FF');
 		$("#round-button-output-8").text("ON");
  }	else {
  		$('#round-button-circle-output-8').css('background','#ffad33');
 		$("#round-button-output-8").text("OFF");
  }	

$(".round-button-circle-output").trigger( "click" );


	
}]);