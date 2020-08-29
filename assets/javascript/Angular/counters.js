app.controller("counters", [ '$scope', '$rootScope', '$http', function($scope, $rootScope, $http) {

    $scope.get_historical_counter_data = function(){
      userid = document.getElementById('hiddenuserid').value;
      senderid = document.getElementById('hiddensenderid').value;

      var url = window.location.href;
      var to = url.lastIndexOf('/') +1;
      x =  url.substring(0,to);
      $scope.baseUrl = x;

      url = x+'get_uri/get/all/'+userid+'/'+senderid;
      console.log(url);
      $http.get(url)
        .then(function success(response) {
          console.log(response.data);
            $scope.historical_counter_data = response.data;
        }, function error(response){
            console.log(response);
      });
    }
    
    $scope.get_historical_counter_data();

    $scope.add_input_information_counter = function(){ 
      user_id = document.getElementById('hiddenuserid').value;
      sender_id = document.getElementById('hiddensenderid').value;

      console.log('add counter information');

      var url = window.location.href;
      var to = url.lastIndexOf('/') +1;
      x =  url.substring(0,to);
      $scope.baseUrl = x;
      console.log($scope.selected_counter);
      alarm_name = $scope.selected_counter.name;

      url = x+'get_uri/add/counters/'+user_id+'/'+sender_id+'/'+alarm_name;
      console.log(url);
      var data =  $.param({ 
          name: $scope.selected_counter.name,
          label_name: $scope.selected_counter.label_name, 
          min: $scope.selected_counter.min, 
          max: $scope.selected_counter.max, 
          units: $scope.selected_counter.units, 
          email_on: document.getElementById("email_check").checked, 
          threshold: $scope.selected_counter.threshold, 
          reset: $scope.selected_counter.reset, 
          direction: document.getElementById("direction_check").checked, 
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
          console.log(response.data.counter_id)
           $scope.get_counters_again(response.data.counter_id);
            $('#config_set').css('display','inline-block');
            setTimeout(function(){ $('#config_set').css('display','none'); }, 3000);

            }, function error(response){
              console.log(response);
        });

      
    }

    $scope.update_counters = function(){

    userid = document.getElementById('hiddenuserid').value;
    senderid = document.getElementById('hiddensenderid').value;

    var url = window.location.href;
    var to = url.lastIndexOf('/') +1;
    x =  url.substring(0,to);
    $scope.baseUrl = x;

    url = x+'get_uri/get/counters/'+userid+'/'+senderid;
    $http.get(url)
        .then(function success(response) {
            //console.log(response.data);
            //$scope.counters = [response.data[28],response.data[29],response.data[30],response.data[31]];
            $scope.counters = response.data;
            $scope.selected_counter = $scope.counters[0];
            $scope.selected_counter_name = $scope.counters[0];

            console.log($scope.counters);
            // for (i=0;i<4;i++){
            //     if($scope.counters[i].direction){
            //         $scope.counters[i].direction = response.data[i].direction; 
            //     }
            //     if($scope.counters[i].units){
            //         $scope.counters[i].units = response.data[i].units; 
            //     }
            //     if($scope.counters[i].min){
            //         $scope.counters[i].min = response.data[i].min; 
            //     }
            //     if($scope.counters[i].max){
            //         $scope.counters[i].max = response.data[i].max; 
            //     }
            //     if($scope.counters[i].email){
            //         $scope.counters[i].email = response.data[i].email; 
            //     }
            //     if($scope.counters[i].threshold){
            //         $scope.counters[i].threshold = response.data[i].threshold; 
            //     }
            //     if($scope.counters[i].reset){
            //         $scope.counters[i].reset = response.data[i].reset; 
            //     }
            //     if($scope.counters[i].units){
            //         $scope.counters[i].units = response.data[i].units; 
            //     }
            //     if($scope.counters[i].labelname){
            //         $scope.counters[i].labelname = response.data[i].label_name; 
            //     }
            // }

            console.log('counters',$scope.counters);

            // var slider1 = document.getElementById('test-slider1');
            //    noUiSlider.create(slider1, {
            //    start: [200, 800],
            //    connect: true,
            //    step: 10,
            //    direction:'rtl',
            //    orientation: 'vertical', 
            //    range: {
            //      'min': 0,
            //      'max': 1000
            //    },
            //   });

            //    var min_c0 = document.getElementById('min_c0');

            //    var max_c0 = document.getElementById('max_c0');

            //    slider1.noUiSlider.on('update', function( values, handle ) {

            //     var value = values[handle];

            //     if ( handle ) {
            //       max_c0.value = value;
            //       //$scope.selected_counter.max = value;
            //     } else {
            //       min_c0.value = Math.round(value);
            //     //  $scope.selected_counter.min = value;
            //     }
            //   });

            //   min_c0.addEventListener('change', function(){
            //     slider1.noUiSlider.set([this.value, null]);
            //   });

            //   max_c0.addEventListener('change', function(){
            //     slider1.noUiSlider.set([null, this.value]);
            //   });

             
            url = x+'get_uri/get/all/'+userid+'/'+senderid;

            data = {c0_labelname: $scope.c0_labelname, c1_labelname:$scope.c1_labelname,c2_labelname:$scope.c2_labelname,c3_labelname:$scope.c3_labelname}
            $http.get(url, data)
                .then(function success(response) {
                    $scope.messagedata = response.data;
                    c0_1 = response.data[0].C0;
                    c1_1 = response.data[0].C1;
                    c2_1 = response.data[0].C2;
                    c3_1 = response.data[0].C3;   
                    c0_2 = response.data[1].C0;
                    c1_2 = response.data[1].C1;
                    c2_2 = response.data[1].C2;
                    c3_2 = response.data[1].C3;  
                    c0_3 = response.data[2].C0;
                    c1_3 = response.data[2].C1;
                    c2_3 = response.data[2].C2;
                    c3_3 = response.data[2].C3;  

                    $scope.drawBasic($scope.c0_labelname, $scope.c1_labelname, $scope.c2_labelname, $scope.c3_labelname, c0_1, c1_1, c2_1, c3_1, c0_2, c1_2, c2_2, c3_2, c0_3, c1_3, c2_3, c3_3);   

                }, function error(response){
                    //console.log(response.statusText);
                });
        }, function error(response){
            //console.log(response.statusText);
        });
    }

    $scope.update_counters();

	  $scope.drawBasic = function (c0_labelname, c1_labelname, c2_labelname, c3_labelname, c0_1, c1_1, c2_1, c3_1, c0_2, c1_2, c2_2, c3_2, c0_3, c1_3, c2_3, c3_3) {

      google.load("visualization", "1", {packages:['gauge']});
      var data = google.visualization.arrayToDataTable([
        ['Counters', 'Count1', 'Count2', 'Count3',{ role: 'style' }, { role: 'annotation' } ],
        [$scope.counters[0].label_name, parseInt(c0_3), parseInt(c0_2), parseInt(c0_1), 'stroke-color: #703593; stroke-width: 4; fill-color: #b87333', c0_labelname],
        [$scope.counters[1].label_name,  parseInt(c1_3), parseInt(c1_2), parseInt(c1_1),'stroke-color: #703593; stroke-width: 4; fill-color: #76A7FA', c1_labelname],
        [$scope.counters[2].label_name,  parseInt(c2_3), parseInt(c2_2), parseInt(c2_1), 'stroke-color: #703593; stroke-width: 4; fill-color: #C5A5CF', c2_labelname],
        [$scope.counters[3].label_name,  parseInt(c3_3), parseInt(c3_2), parseInt(c3_1), 'stroke-color: #703593; stroke-width: 4; fill-color: #BC5679', c3_labelname],
      ]);
      var options = {
        //title: 'Counters',
        height:'400',
        //width: '900',
        chartArea: {
         width: '90%',
         height: '400px'
        },
        legend: {position:'none'},
        hAxis: {
         title: 'Counts',
          minValue: 0,
        },
        vAxis: {
          baseline:0,
          viewWindowMode: "explicit", viewWindow:{ min: 0 }
        },
        backgroundColor: '#FFFFDb',
      };
       var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart_div'));
       chart.draw(data, options);
    }

    $scope.add_counter_alarm = function(){
      user_id = document.getElementById('hiddenuserid').value;
      sender_id = document.getElementById('hiddensenderid').value;

      var url = window.location.href;
      var to = url.lastIndexOf('/') +1;
      x =  url.substring(0,to);
      $scope.baseUrl = x;

      no_counters = ('#counter_alarm_number').find(":selected").text();
      name_counter = $('#counter_alarm_name').find(":selected").text();

      console.log(no_counters);
      console.log(name_counter);

      url = x+'get_uri/add/new_counter/'+user_id+'/'+sender_id+'/'+name_counters+'/'+no_counter;

      var config = {
              headers : {
                  'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
              }
          }

      $http.post(url, data, config)
          .then(function success(response) {
            console.log(response);
              }, function error(response){
                console.log(response);
          });

    }

    $scope.select_alarm_name = function(){
      console.log('select alarm name');
      $scope.selected_counter = $scope.selected_counter_name;
      console.log($scope.selected_counter);
      //native javascript implementation of checkbox selection
       if ($scope.selected_counter.direction == 'true'){
        document.getElementById("direction_check").checked = true;
        console.log('direction_check');
      } else if ($scope.selected_counter.direction == 'false'){
        document.getElementById("direction_check").checked = false;
                console.log('direction_uncheck');

      }
      if ($scope.selected_counter.email_on == 'true'){
        document.getElementById("email_check").checked = true;
                console.log('email_check');

      } else if ($scope.selected_counter.email_on == 'false'){
        document.getElementById("email_check").checked = false;
                console.log('email_uncheck');

      }
    }     

    $scope.$watch('counters',function(newVal,oldVal){
      console.log($scope.counters);
      console.log($scope.selected_counter);
    });

    $scope.$watch('selected_counters',function(newVal,oldVal){
      console.log($scope.selected_counter);
    });

    $scope.reset_counter = function(){


    }

    $scope.change_email_on = function(){
     // $scope.selected_counter.email_on = $scope.email_on;
    }

    $scope.update_direction = function(value, value2){
      $scope.direction = value;
      $scope.selected_counter.direction = value;
      console.log(value);
      console.log(value2);
    }

$scope.get_counters_again = function(current_counter){
  console.log(current_counter);
  $scope.current_counter = current_counter;
  userid = document.getElementById('hiddenuserid').value;
    senderid = document.getElementById('hiddensenderid').value;

    var url = window.location.href;
    var to = url.lastIndexOf('/') +1;
    x =  url.substring(0,to);
    $scope.baseUrl = x;

    url = x+'get_uri/get/counters/'+userid+'/'+senderid;
    $http.get(url)
      .then(function success(response) {
          console.log($scope.current_counter);
          $scope.counters = response.data;
          $scope.selected_counter = $scope.counters[$scope.current_counter-1];
          $scope.selected_counter_name = $scope.counters[$scope.current_counter-1];

          console.log($scope.counters);
          console.log($scope.selected_counters);
          console.log($scope.selected_counter_name);

          
          console.log('counters',$scope.counters);

      }, function error(response){
          //console.log(response.statusText);
      });
}


// $scope.$watch('selected_counter.min', function(newvalue,oldvalue) {
//     var slider1 = document.getElementById('test-slider1');
//      slider1.noUiSlider.set([newvalue, null]);
//   });
// $scope.$watch('selected_counter.max', function(newvalue,oldvalue) {
//     var slider1 = document.getElementById('test-slider1');
//      slider1.noUiSlider.set([null, newvalue]);
//   });

}]);