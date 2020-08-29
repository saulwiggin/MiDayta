app.controller("digital_inputs", [ '$scope', '$rootScope', '$http', function($scope, $rootScope, $http) {

$scope.get_digitals = function(){

	userid = document.getElementById('user_id_hidden').value;
    senderid = document.getElementById('sender_id_hidden').value;

    var url = window.location.href;
    var to = url.lastIndexOf('/') +1;
    x =  url.substring(0,to);
    $scope.baseUrl = x;

    url = x+'get_uri/get/get_last_message/'+senderid;

    $http.get(url)
        .then(function success(response) {
            $scope.digital_inputs = response.data;
            console.log($scope.digital_inputs[0]);
            var d_0 = $scope.digital_inputs[0].D0;
            var d_1 = $scope.digital_inputs[0].D1;
            var d_2 = $scope.digital_inputs[0].D2;
            var d_3 = $scope.digital_inputs[0].D3;
            var d_4 = $scope.digital_inputs[0].D4;
            var d_5 = $scope.digital_inputs[0].D5;
            var d_6 = $scope.digital_inputs[0].D6;
            var d_7 = $scope.digital_inputs[0].D7;
            if (d_0 === "HI"){
                    document.getElementById("round-button-1").text = "ON";
                    $('#round-button-circle-1').css('background','green');
                } else {
                    document.getElementById("round-button-1").text = "OFF";
                    // $('#round-button-1').click();
                     $('#round-button-circle-1').css('background','red');
                }
                if (d_1 === "HI"){
                    document.getElementById("round-button-2").text = "ON";
                     $('#round-button-circle-2').css('background','green');
                } else {
                    document.getElementById("round-button-2").text = "OFF";
                    // $('#round-button-2').click();
                     $('#round-button-circle-2').css('background','red');   
                }
                if (d_2 === "HI"){
                    document.getElementById("round-button-3").text = "ON";
                     $('#round-button-circle-3').css('background','green');     
                } else {
                    document.getElementById("round-button-3").text = "OFF";
                     $('#round-button-circle-3').css('background','red');
                    // $('#round-button-3').click();                                        
                }
                if (d_3 === "HI"){
                    document.getElementById("round-button-4").text = "ON";
                     $('#round-button-circle-4').css('background','green');             
                } else {
                    document.getElementById("round-button-4").text = "OFF";
                     $('#round-button-circle-4').css('background','red');               
                    // $('#round-button-4').click();
                }
                if (d_4 === "HI"){
                    document.getElementById("round-button-5").text = "ON";
                    $('#round-button-circle-5').css('background','green');              
                } else {
                    document.getElementById("round-button-5").text = "OFF";
                    $('#round-button-circle-5').css('background','red');                
                    // $('#round-button-5').click();
                }
                if (d_5 === "HI"){
                    document.getElementById("round-button-6").text = "ON";
                    $('#round-button-circle-6').css('background','green');              
                } else {
                    document.getElementById("round-button-6").text = "OFF";
                    // $('#round-button-6').click();
                    $('#round-button-circle-6').css('background','red');                
                }
                if (d_6 === "HI"){
                    document.getElementById("round-button-7").text = "ON";
                    $('#round-button-circle-7').css('background','green');              
                } else {
                    document.getElementById("round-button-7").text = "OFF";
                    // $('#round-button-7').click();
                    $('#round-button-circle-7').css('background','red');                
                }
                if (d_7 === "HI"){
                    document.getElementById("round-button-8").text = "ON";
                    $('#round-button-circle-8').css('background','green');      
                } else {
                    document.getElementById("round-button-8").text = "OFF";
                    // $('#round-button-8').click();
                    $('#round-button-circle-8').css('background','red');            
                }      
        }, function error(response){
            console.log(response.statusText);
        });
    }
$scope.get_digitals();

$scope.get_digital_config = function(){
  userid = document.getElementById('user_id_hidden').value;
  senderid = document.getElementById('sender_id_hidden').value;

  var url = window.location.href;
  var to = url.lastIndexOf('/') +1;
  x =  url.substring(0,to);
  $scope.baseUrl = x;
  userid = userid.replace(/\s/g,'');
  senderid = senderid.replace(/\s/g,'');

  url = x+'get_uri/get/digitals/'+userid+'/'+senderid;
  console.log(url);
  $http.get(url)
    .then(function success(response) {
      console.log(response.data);
        $scope.digitals = response.data;
        console.log($scope.digitals);
        $scope.selected_digital = $scope.digitals[0];
        $scope.selected_digital_name = $scope.selected_digital;
        console.log($scope.selected_digital);
        if ($scope.selected_digital.HI == 'true'){
            document.getElementById("HI_d0").checked = true;
            console.log('HI_check');
          } else if ($scope.selected_digital.HI == 'false'){
            document.getElementById("HI_d0").checked = false;
                    console.log('HI_uncheck');

          }
         if ($scope.selected_digital.LO == 'true'){
            document.getElementById("LO_d0").checked = true;
            console.log('LO_check');
          } else if ($scope.selected_digital.LO == 'false'){
            document.getElementById("LO_d0").checked = false;
                    console.log('LO_uncheck');

          }
          if ($scope.selected_digital.email_on == 'true'){
            document.getElementById("email_on_d0").checked = true;
                    console.log('email_check');

          } else if ($scope.selected_digital.email_on == 'false'){
            document.getElementById("email_on_d0").checked = false;
                    console.log('email_uncheck');

          }
    }, function error(response){
        console.log(response);
  });
}

$scope.get_digital_config();

 $scope.select_alarm_name = function(){
  console.log('select alarm name');
  $scope.selected_digital = $scope.selected_digital_name;
  $scope.checked_value_LO = $scope.selected_digital.LO;   
  //$scope.selected_digital.email_on = false; 
  console.log($scope.selected_digital);
  //console.log($scope.checked_value_LO);
}

$scope.$watch('digitals',function(newVal,oldVal){
  console.log($scope.digitals);
  console.log($scope.selected_digital);
});

$scope.add_input_information_digital = function(){ 
  user_id = document.getElementById('user_id_hidden').value;
  sender_id = document.getElementById('sender_id_hidden').value;

  console.log('add digital information');

  var url = window.location.href;
  var to = url.lastIndexOf('/') +1;
  x =  url.substring(0,to);
  $scope.baseUrl = x;
  console.log($scope.selected_digital);
  alarm_no = $scope.selected_digital.alarm_number;
  alarm_name = $scope.selected_digital.name;

  user_id = user_id.replace(/\s/g,'');
  sender_id = sender_id.replace(/\s/g,'');

  url = x+'get_uri/add/digital/'+user_id+'/'+sender_id+'/'+alarm_name;
  console.log(url);
  var data =  $.param({ 
     // name: $scope.selected_digital.name,
      label_name: $scope.selected_digital.label_name, 
      email_on: document.getElementById("email_on_d0").checked, 
      HI: document.getElementById("HI_d0").checked, 
      LO: document.getElementById("LO_d0").checked, 
  });
  console.log(data);
  var config = {
          headers : {
              'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
          }
      }

  $http.post(url, data, config)
    .then(function success(response) {
      console.log(response);
      $scope.get_digitals_again(response.data.digital_id);
      $('#config_set').css('display','inline-block');
      setTimeout(function(){ $('#config_set').css('display','none'); }, 3000);

        }, function error(response){
          console.log(response);
    });
}

  $scope.select_alarm_name = function(){
    console.log('select alarm name');
    $scope.selected_digital = $scope.selected_digital_name;
    console.log($scope.selected_digital);
    //native javascript implementation of checkbox selection
     if ($scope.selected_digital.HI == 'true'){
      document.getElementById("HI_d0").checked = true;
      console.log('HI_check');
    } else if ($scope.selected_digital.HI == 'false'){
      document.getElementById("HI_d0").checked = false;
              console.log('HI_uncheck');

    }
   if ($scope.selected_digital.LO == 'true'){
      document.getElementById("LO_d0").checked = true;
      console.log('LO_check');
    } else if ($scope.selected_digital.LO == 'false'){
      document.getElementById("LO_d0").checked = false;
              console.log('LO_uncheck');

    }
    if ($scope.selected_digital.email_on == 'true'){
      document.getElementById("email_on_d0").checked = true;
              console.log('email_check');

    } else if ($scope.selected_digital.email_on == 'false'){
      document.getElementById("email_on_d0").checked = false;
              console.log('email_uncheck');

    }
  }     

  $scope.$watch('digitals',function(newVal,oldVal){
    console.log($scope.digitals);
    console.log($scope.selected_digital);
  });

  $scope.$watch('selected_digital',function(newVal,oldVal){
    console.log($scope.selected_digital);
  });

$scope.get_digitals_again = function(current_digital){
  console.log(current_digital);
  $scope.current_digital = current_digital;
  userid = document.getElementById('user_id_hidden').value;
  senderid = document.getElementById('sender_id_hidden').value;
  userid = userid.replace(/\s/g,'');
  senderid = senderid.replace(/\s/g,'');
  var url = window.location.href;
  var to = url.lastIndexOf('/') +1;
  x =  url.substring(0,to);
  $scope.baseUrl = x;

  url = x+'get_uri/get/digitals/'+userid+'/'+senderid;
  $http.get(url)
    .then(function success(response) {
        console.log($scope.current_digital);
        $scope.digitals = response.data;
        $scope.selected_digital = $scope.digitals[$scope.current_digital-1];
        $scope.selected_digital_name = $scope.digitals[$scope.current_digital-1];
        $scope.select_alarm_name();

        console.log($scope.digitals);
        console.log($scope.selected_digital);
        console.log($scope.selected_digital_name);
       if ($scope.selected_digital.HI == 'true'){
            document.getElementById("HI_d0").checked = true;
            console.log('HI_check');
          } else if ($scope.selected_digital.HI == 'false'){
            document.getElementById("HI_d0").checked = false;
                    console.log('HI_uncheck');

          }
         if ($scope.selected_digital.LO == 'true'){
            document.getElementById("LO_d0").checked = true;
            console.log('LO_check');
          } else if ($scope.selected_digital.LO == 'false'){
            document.getElementById("LO_d0").checked = false;
                    console.log('LO_uncheck');

          }
          if ($scope.selected_digital.email_on == 'true'){
            document.getElementById("email_on_d0").checked = true;
                    console.log('email_check');

          } else if ($scope.selected_digital.email_on == 'false'){
            document.getElementById("email_on_d0").checked = false;
                    console.log('email_uncheck');

          }
        console.log('digitals',$scope.digitals);

    }, function error(response){
        //console.log(response.statusText);
    });
  }

}]);