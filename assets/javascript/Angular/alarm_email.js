app.controller("alarm_email", [ '$scope', '$rootScope', '$http', function($scope, $rootScope, $http) {

    $scope.on_page_load = function(){
         user_id = document.getElementById('hiddenuserid').value;
        sender_id = document.getElementById('hiddensenderid').value;
        $scope.sender_id = sender_id;
        $scope.user_id = user_id;
        console.log(sender_id);
        console.log(user_id);

        var url = window.location.href;
        var to = url.lastIndexOf('/') +1;
        x =  url.substring(0,32);
        $scope.baseUrl = x;

        var url = x+'get_uri/get/alarm/'+sender_id+'/'+user_id;

        console.log(url);
        $http.get(url)
        .then(function success(response) {
            $scope.email_alarms = response.data;
            $scope.selected_email_alarm = $scope.email_alarms[0];
            console.log(response.data);
            console.log($scope);

            var selected_email = response.data[0];
            console.log(selected_email.alarm_name);
            console.log(selected_email.alarm_number);
            //$scope.email_alarms = response.data;
            $("#message").val(response.data[0]['message']);
            $("#from").val(response.data[0]['from']);
            $("#to").val(response.data[0]['to']);
            $("#subject").val(response.data[0]['subject']);
            $("#alarm_name option[value="+selected_email.alarm_name+"]").prop('selected',true);
            $("#alarm_number option[value="+selected_email.alarm_number+"]").prop('selected',true);

        }, function error(response){
            console.log(response.statusText);
        });
    }
   
   $scope.on_page_load();

    $scope.select_alarm = function() {
        console.log($scope.selected_email_alarm);
        $scope.selected_alarm_number = $scope.selected_email_alarm.alarm_number;
        $scope.selected_alarm_name = $scope.selected_email_alarm.alarm_name;
        $scope.update_email_message();
    }

    $scope.clear_fields = function (){
            $("#message").val("");
            $("#from").val("");
            $("#to").val("");
            $("#subject").val("");
            $("#alarm_name option[value='']").prop('selected',true);
        }

    $scope.update_email_message = function(){
        var url = window.location.href;
        var to = url.lastIndexOf('/') +1;
        x =  url.substring(0,32);
        $scope.baseUrl = x;

        var alarm_number = $scope.selected_email_alarm.alarm_number;
        var alarm_name = $scope.selected_email_alarm.alarm_name;
        console.log(alarm_name);
        console.log(alarm_number)
       // alarm_name = 'a0';
       // alarm_number = 1;

        var url = x+'get_uri/get/specific_alarm/'+$scope.sender_id+'/'+$scope.user_id+'/'+$scope.selected_alarm_name+'/'+$scope.selected_alarm_number;

        console.log(url);
        $http.get(url)
        .then(function success(response) {


            var selected_email = response.data[0];
            console.log(selected_email.alarm_name);
            console.log(selected_email.alarm_number);
            //$scope.email_alarms = response.data;
            $("#message").val(response.data[0]['message']);
            $("#from").val(response.data[0]['from']);
            $("#to").val(response.data[0]['to']);
            $("#subject").val(response.data[0]['subject']);
            $("#alarm_name option[value="+selected_email.alarm_name+"]").prop('selected',true);
            $("#alarm_number option[value="+selected_email.alarm_number+"]").prop('selected',true);
        }, function error(response){
            console.log(response.statusText);
        });

    }

    $scope.update_email_message();
        
    $scope.updatebutton = function() {
         console.log('submit button pressed');
          var data = $('#email_alarm_form').serialize();
          console.log(data);
          $.ajax({
          type: 'POST',
          url: $scope.baseUrl+'sendreport/update',
          data: data,
          dataType:'jsonp',
          success: function(res) {
                console.log(res);
                $('#fillinputs').css('display','inline');
                //location.reload();
            },
          error: function(err){
            console.log(err);
          }
        });
     };

     $scope.add_email_to = function(){
        $scope.divHtmlVar = $scope.divHtmlVar + "<input style='font-size:12px;' style='margin:0;'type='email' size='50' type='text' name='to' id='to'>"; 

     }

}]);