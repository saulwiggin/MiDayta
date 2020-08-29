app.controller("analogues", [ '$scope', '$rootScope', '$http', function($scope, $rootScope, $http) {

$scope.display_analogues = function(){

    num_chart_ajax_calls = 0

    var user_id = document.getElementById('hidden_user_id').value;
    var sender_id = document.getElementById('hidden_sender_id').value;

    var url = window.location.href;
    var to = url.lastIndexOf('/') +1;
    x =  url.substring(0,to);
    $scope.baseUrl = x;
    url = x+'get_uri/get/all/'+user_id+'/'+sender_id;
    
    $http.get(url)
    .then(function success(response) {
        $scope.messages = response.data;

        url = x+'get_uri/get/get_inputs_for_sender_id/'+user_id+'/'+sender_id;
    
        $http.get(url)
        .then(function success(response) {
            $scope.config = response.data;

        var scaley = [( $scope.config[0].max- $scope.config[0].min)/1024,
              ( $scope.config[1].max-$scope.config[1].min)/1024,
              ( $scope.config[2].max-$scope.config[2].min)/1024,
              ( $scope.config[3].max-$scope.config[3].min)/1024];

            var url = window.location.href;
            var to = url.lastIndexOf('/') +1;
            x =  url.substring(0,to);
            $scope.baseUrl = x;
            url = x+'get_uri/get/all/'+user_id+'/'+sender_id;
            //console.log(url);

            $http.get(url)
            .then(function success(response) {
                //console.log(response.data);
                $scope.messages = response.data;
                 google.charts.load('current', {'packages':['gauge']});
                  google.charts.setOnLoadCallback(drawChart);
                  drawChart();
                function drawChart() {
                    //console.log($scope.messages);

                var a0 = $scope.messages[0].A0;
                var a1 = $scope.messages[0].A1;
                var a2 = $scope.messages[0].A2;
                var a3 = $scope.messages[0].A3;

                //console.log([a0,a1,a2,a3, scaley]);
                scaled_a_1 = Math.round(a0*scaley[0] * 100) / 100;
                scaled_a_2 = Math.round(a1*scaley[1] * 100) / 100;
                scaled_a_3 = Math.round(a2*scaley[2] * 100) / 100;
                scaled_a_4 = Math.round(a3*scaley[3] * 100) / 100;
               
                if (isNaN(scaled_a_1)){
                    scaled_a_1 == 0;
                    return
                }
                if (isNaN(scaled_a_2)){
                    scaled_a_2 == 0;
                    return
                }                   
                if (isNaN(scaled_a_3)){
                    scaled_a_3 == 0;
                    return
                }               
                if (isNaN(scaled_a_4)){
                    scaled_a_4 == 0;
                    return
                }
                

                  var data = google.visualization.arrayToDataTable([
                  ['Label', 'Value'],
                  [$scope.config[0]['label_name'], scaled_a_1],
                  [$scope.config[1]['label_name'], scaled_a_2],
                  [$scope.config[2]['label_name'], scaled_a_3],
                  [$scope.config[3]['label_name'], scaled_a_4]
                ]);
                var options = {
                  width: 900, 
                  height: 160,    
                  max: 1024*scaley[0],
                  redFrom: 1024*0.8*scaley[0], 
                  redTo: 1024*scaley[0],
                  yellowFrom:1024*0.6*scaley[0], 
                  yellowTo: 1024*0.8*scaley[0],
                  minorTicks: 5,
                };

                    var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

                 chart.draw(data, options);
             }

                
            $scope.chart_data = function(){
                var seriesOptions = [],
                charted_names = [],
                serialsOptions =[],
                is_charted = [],
                seriesCounter = 1,
                names = ['A0','A1','A2','A3'];
                var max = 0
                if (num_chart_ajax_calls = 0){
                    $('.block').css('visibility','visible');
                }
                num_chart_ajax_calls = num_chart_ajax_calls + 1;
                var count2 = 0;
                $.each(names, function(i, name){
                    //console.log(name);
                    user_id = document.getElementById('hidden_user_id').value;
                    sender_id = document.getElementById('hidden_sender_id').value;

                    var url = window.location.href;
                    var to = url.lastIndexOf('/') +1;
                    x =  url.substring(0,to);
                    $scope.baseUrl = x;

                    url = x+'get_uri/get/input/'+names[i]+'/'+sender_id;
                    $.getJSON(url, function (data) {

                        var number_of_messages = $scope.messages+1;
                        var scales = [($scope.config[0]['max'] - $scope.config[0]['min'])/1024,
                         ($scope.config[1]['max']- $scope.config[1]['min'])/1024,
                           ($scope.config[2]['max']-$scope.config[2]['min'])/1024,
                         ($scope.config[3]['max']- $scope.config[3]['min'])/1024
                        ];
                        
                        var array_length = data.length;
                        if (names[i] == "A0"){
                            series = [[data[0].datetime*1000,data[0].A0]];
                            scale0 = ($scope.config[0]['max']-$scope.config[0]['min'])/1024;
                            for (i=1; i<=array_length-1; i++){
                                var num= Math.round(data[i].A0*scales[0] * 100) / 100;
                                series.push([data[i].datetime*1000,data[i].A0*scales[0]]);
                                if (data[i].A0*scales[0] > max) {
                                    max = data[i].A0*scales[0];
                                }
                            }           
                            var labelname = $scope.config[0]['label_name'];
                            var units = $scope.config[0]['units'];
                        }
                        if (names[i] == "A1"){
                            series = [[data[0].datetime*1000,data[0].A1]];
                            for (i=1; i<=array_length-1; i++){
                                series.push([data[i].datetime*1000,data[i].A1*scales[1]]);
                                if (data[i].A1*scales[1] > max) {
                                    max = data[i].A1*scales[1];
                                }
                            }
                            var labelname = $scope.config[1]['label_name'];
                            var units = $scope.config[1]['units'];
                        }
                        if (names[i] == "A2"){
                            series = [[data[0].datetime*1000,data[0].A2]];
                            for (i=1; i<=array_length-1; i++){
                                series.push([data[i].datetime*1000,data[i].A2*scales[2]]);
                                if (data[i].A2*scales[2] > max) {
                                    max = data[i].A2*scales[2];
                                }
                            }
                            var labelname = $scope.config[2]['label_name'];
                            var units = $scope.config[2]['units'];
                        }
                        if (names[i] == "A3"){
                            series = [[data[0].datetime*1000,data[0].A3]];
                            for (i=1; i<=array_length-1; i++){
                                series.push([data[i].datetime*1000,data[i].A3*scales[3]]);
                                if (data[i].A3*scales[3] > max) {
                                    max = data[i].A3*scales[3];
                                }
                            }
                            var labelname = $scope.config[3]['label_name'];
                            var units = $scope.config[3]['units'];
                            }
                      
                        seriesCounter += 1;
                        
                        seriesOptions[i] = {
                            name: labelname.concat(" " + units),
                            data: series.reverse(),
                            allowPointSelect: true,
                            cursor: 'pointer',
                         
                        };

                        serialsOptions.push(seriesOptions[i]);
                        
                        if (seriesCounter-1 === names.length) {
                            //console.log(serialsOptions);
                            createChart(serialsOptions);
                        }
                    });
                });
                function createChart(serialsOptions){
                    
                    sorted = _.sortBy(serialsOptions, 'name');
                    serialsOptions = sorted;
                    min_date = serialsOptions[0].data[0].datetime;

                    $('#container').highcharts({
                        chart: {
                            zoomType: 'xy'
                        },
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ Highcharts.numberFormat(this.percentage, 2) +' %';
                        },
                        tooltip: {
                            enabled: true,
                            crosshairs: [true,true],
                            formatter:function(){
                              return '<span>'+this.series.name+'</span>: <b>'+Highcharts.numberFormat((this.y),2,'.')+'</b> @ '+ Date(this.x);
                            }
                        },
                        title: {
                            text: 'Analogues Chart'
                        },
                        subtitle: {
                            text: document.ontouchstart === undefined ?
                                    'Click and drag in the area to zoom in on your data' : 'Pinch the chart to zoom in'
                        },
                        xAxis: {
                            type: 'datetime',
                            title: 'Time Message Sent',
                            //min: min_date*1000, 
                        },
                        yAxis: {
                            title: {
                                text: 'Analogue Inputs'
                            },

                        },
                        legend: {
                            enabled: true
                        },
                        plotOptions: {
                            pointFormat: '{point.percentage:.3f}%',
                            area: {
                                fillColor: {
                                    stops: [
                                        [0, Highcharts.getOptions().colors[0]],
                                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                                    ]
                                },
                                marker: {
                                    radius: 2
                                },
                                lineWidth: 1,
                                states: {
                                    hover: {
                                        lineWidth: 1
                                    }
                                },
                                threshold: null
                            }
                        },
                        series: serialsOptions
                    });
                
                    }
                }

                $scope.chart_data();

                }, function error(response){
                    ////console.log(response.statusText);
                });

            }, function error(response){
                ////console.log(response.statusText);
            });
          
        }, function error(response){
            ////console.log(response.statusText);
        });
    }

$scope.display_analogues();

$scope.get_analogue_config = function(){
  userid = document.getElementById('hidden_user_id').value;
  senderid = document.getElementById('hidden_sender_id').value;

  var url = window.location.href;
  var to = url.lastIndexOf('/') +1;
  x =  url.substring(0,to);
  $scope.baseUrl = x;

  url = x+'get_uri/get/analogues/'+userid+'/'+senderid;
  console.log(url);
  $http.get(url)
    .then(function success(response) {
      console.log(response.data);
      // set inputs and selected inputs
        $scope.inputs = response.data;
        $scope.selected_input = response.data[0];
        $('#max_c0').val($scope.selected_input.max);
        $('#min_c0').val($scope.selected_input.min);
        $('#labelname_c0').val($scope.selected_input.label_name);
        $('#units_c0').val($scope.selected_input.units);
        $('#reset_c0').val($scope.selected_input.reset);
        $('#threshold_c0').val($scope.selected_input.threshold);
        $scope.select_alarm_name();
        console.log($scope.selected_input);
    }, function error(response){
        console.log(response);
  });

}

$scope.get_analogue_config();

$scope.select_alarm_name = function(){
      //console.log('select alarm name');
      $scope.selected_input = $scope.selected_input_name;
      //console.log($scope.selected_counter);
    }


   $scope.add_input_information_counter = function(){ 
      user_id = document.getElementById('hidden_user_id').value;
      sender_id = document.getElementById('hidden_sender_id').value;

      console.log('add analogue information');

      var url = window.location.href;
      var to = url.lastIndexOf('/') +1;
      x =  url.substring(0,to);
      $scope.baseUrl = x;
      console.log($scope.selected_input);
      alarm_name = $scope.selected_input.name;

      url = x+'get_uri/add/analogues/'+user_id+'/'+sender_id+'/'+alarm_name;
      console.log(url);
      var data =  $.param({ 
          name: $scope.selected_input.name,
          label_name: $scope.selected_input.label_name, 
          min: document.getElementById("min_c0").value, 
          max: document.getElementById("max_c0").value, 
          units: $scope.selected_input.units, 
          email_on: document.getElementById("email_check").checked, 
          threshold: $scope.selected_input.threshold, 
          reset: $scope.selected_input.reset, 
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
          console.log(response.data.analogue_id)
           $scope.get_inputs_again(response.data.analogue_id);
            $('#config_set').css('display','inline-block');
            setTimeout(function(){ $('#config_set').css('display','none'); }, 3000);
            }, function error(response){
              console.log(response);
        });
    }

 $scope.update_inputs = function(){

    userid = document.getElementById('hidden_user_id').value;
    senderid = document.getElementById('hidden_sender_id').value;

    var url = window.location.href;
    var to = url.lastIndexOf('/') +1;
    x =  url.substring(0,to);
    $scope.baseUrl = x;

    url = x+'get_uri/get/analogues/'+userid+'/'+senderid;
    $http.get(url)
        .then(function success(response) {
            $scope.inputs = response.data;
            $scope.selected_input = $scope.inputs[0];
            $scope.selected_input_name = $scope.inputs[0];

            console.log($scope.inputs);

            console.log('analogues',$scope.inputs);

            var slider1 = document.getElementById('test-slider_a');
               noUiSlider.create(slider1, {
               start: [200, 800],
               connect: true,
               step: 10,
               direction:'rtl',
               orientation: 'vertical', 
               range: {
                 'min': 0,
                 'max': 1024
               },
              });

               var min_c0 = document.getElementById('min_c0');

               var max_c0 = document.getElementById('max_c0');

               slider1.noUiSlider.on('update', function( values, handle ) {

                var value = values[handle];

                if ( handle ) {
                  max_c0.value = value;
                  //$scope.selected_counter.max = value;
                } else {
                  min_c0.value = Math.round(value);
                //  $scope.selected_counter.min = value;
                }
              });

              min_c0.addEventListener('change', function(){
                slider1.noUiSlider.set([this.value, null]);
              });

              max_c0.addEventListener('change', function(){
                slider1.noUiSlider.set([null, this.value]);
              });

             
        }, function error(response){
            //console.log(response.statusText);
        });
    }

    $scope.update_inputs();

  $scope.select_alarm_name = function(){
  console.log('select alarm name');
  $scope.selected_input = $scope.selected_input_name;
  console.log($scope.selected_input);
  //native javascript implementation of checkbox selection
   if ($scope.selected_input.direction == 'true'){
    document.getElementById("direction_check").checked = true;
    console.log('direction_check');
  } else if ($scope.selected_input.direction == 'false'){
    document.getElementById("direction_check").checked = false;
            console.log('direction_uncheck');

  }
  if ($scope.selected_input.email_on == 'true'){
    document.getElementById("email_check").checked = true;
            console.log('email_check');

  } else if ($scope.selected_input.email_on == 'false'){
    document.getElementById("email_check").checked = false;
            console.log('email_uncheck');

  }
}     

$scope.update_direction = function(value, value2){
  $scope.direction = value;
  $scope.selected_input.direction = value;
  console.log(value);
  console.log(value2);
}

$scope.get_inputs_again = function(current_input){
  console.log(current_input);
  $scope.current_input = current_input;
  userid = document.getElementById('hidden_user_id').value;
  senderid = document.getElementById('hidden_sender_id').value;

    var url = window.location.href;
    var to = url.lastIndexOf('/') +1;
    x =  url.substring(0,to);
    $scope.baseUrl = x;

    url = x+'get_uri/get/analogues/'+userid+'/'+senderid;
    $http.get(url)
      .then(function success(response) {
          console.log($scope.current_input);
          $scope.inputs = response.data;
          $scope.selected_input = $scope.inputs[$scope.current_input-1];
          $scope.selected_input_name = $scope.inputs[$scope.current_input-1];

          console.log($scope.inputs);
          console.log($scope.selected_inputs);
          console.log($scope.selected_input_name);

          
          console.log('analogues',$scope.inputs);

      }, function error(response){
          //console.log(response.statusText);
      });
}

// get slider working accurately
$scope.$watch('selected_input.min', function(newvalue,oldvalue) {
    var slider1 = document.getElementById('test-slider_a');
     slider1.noUiSlider.set([newvalue, null]);
  });
$scope.$watch('selected_input.max', function(newvalue,oldvalue) {
    var slider1 = document.getElementById('test-slider_a');
     slider1.noUiSlider.set([null, newvalue]);
  });
// $scope.$watch('inputs',function(newVal,oldVal){
//   console.log($scope.inputs);
//   console.log($scope.selected_input);
// });

// $scope.$watch('selected_inputs',function(newVal,oldVal){
//   console.log($scope.selected_input);
// });

}]);