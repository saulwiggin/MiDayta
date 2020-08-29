
<div class="container" style="padding-bottom: 400px;">
	<div class="dashboard-header">
		<div class="row">
			<div class="Welcome">
				<h1 style="margin-top:20px; margin-left:340px;"><b> <?php echo ucwords($user[0]['companyname']);?></b></h1>
				<h3 style='margin-top: 20px;margin-left: 340px;'><i><?php print_r($user[0]['description']);?></i></h3>
				<img style=' position: absolute;  left: 950;'id ="logo" border="1" src="<?php echo base_url();?>Uploads/<?php echo $user[0]['company_logo'];?>" width ="133" height="133"> </p>
				<?php  
				<div class="navigation_bar">
					<div style="margin-top: -45px"class="dropdown">
					  <button style='position: absolute;    top: -110;    left: 1025;'class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					    Menu
					    <span class="caret"></span>
					    </button>
						<ul class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu1" style=' position: absolute;   top: -110;   left: 1015;'>
 				 		<li> </li>
			 			<li> <a href="<?php echo base_url('rawdata/raw_data_for_user').'?username='.$username; ?>">Live Data Table</a></li>
		 				<li> <a href="<?php echo base_url('rawdata/email_log');?><?php echo '?user_id='.$user_id;?>">Email Log</a></li>
						<li> <a href="#" id="contactUs">Help Button</a>  </li>
<!-- 			 		<li> <a href="<?php echo base_url('sendreport');?>">Setup Alarm</a></li>
 -->
<!-- 					<li> <a href="<?php echo base_url('explain'); ?>"> About Us </a></li>
 -->					<li> <a href="<?php echo base_url('User/login');?>">Logout</a> </li>
					</ul>
					</div>
					<form action='<?php echo base_url('sendreport').'?username='.$username; ?>' method='post'>
					<button style='margin-top:170; margin-left:1025; width:120;' type="submit" class="btn btn-default"  id='alarmsetup<?php echo $i;?>' name='alarmsetup<?php echo $i;?>' value='<?php echo $user_inputs[$selected_device][$i]['name'];?>'><span class="glyphicon glyphicon-envelope"></span> Email Alert</button>
					<input style='display:none' id='hiddenuserid'name='hiddenuserid' value='<?php echo $user_id;?>'></input>
					<input style='display:none' id='hiddensenderid'name='hiddensenderid' value='<?php echo $sender_id;?>'></input>
					</form>
					<!-- disabled while under construction -->
					<a style=' position: absolute; top: 420; left:1030;width:120;display:block'class='btn btn-default' href="<?php echo base_url('configure_dashboard').'?username='.$username; ?>"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Configuration</a>
					<a style=' position: absolute; top: 480; left:1030; width:120;display:block'class='btn btn-default 'href="#" id="chart_analogues">Gauges</a>
 			 			 <a style=' position: absolute; top: 520; left:1030;width:120;display:block'class='btn btn-default 'href="#" id="chart_digitals">Inputs</a>
 			 			 <a style=' position: absolute; top: 560; left:1030;width:120;display:block'class='btn btn-default 'href="#" id="chart_charts"> Graph</a>
 			 			 <a style=' position: absolute; top: 600; left:1030;width:120;display:block'class='btn btn-default 'href="#" id="chart_counters">Bar Chart</a>
						 <a style=' position: absolute; top: 640; left:1030;width:120;display:block'class='btn btn-default 'href="#" id="chart_outputs">Outputs</a>
						 <a style=' position: absolute; top: 680; left:1030;width:120;display:block'class='btn btn-default 'href="#" id="save"><span class="glyphicon glyphicon-floppy-disk"></span> Save</a>
    					<div class="alert alert-success" style='display:none;position:absolute;left: 1035px;top: 960px;' id='message_received'><label style='margin: 2; display: inline-block;'><b> Message Received</b></label></div>
    					<script>
    					$( document ).ready(function() {
							
							refresh_page();
							$.ajax({
						        url: '<?php echo base_url('get_uri/add_incoming_admin');?>',
						        type: 'POST',
						        
						        
						        success: function(data3) {
						            console.log('add incoming', data3);
						            if (data3.last_update_time){
						         	   $('#message_received').css('display','inline-block');
						        	}
						            refresh_page();
						        },
						        error : function(error) {
						        	console.log('add incoming', error);
						    	}
						    });
						});
    					$(function(){
    						
    						user_id = <?php echo $user_id;?>;
    						sender_id = '<?php echo $sender_id;?>';
    						
    							$.ajax({
								 dataType:'json',
								 
								  url: '<?php echo base_url('/get_uri/get/configuration_for_sender_id');?>'+'/<?php echo $sender_id;?>',
								 
								  success: function(data){
								  	
									$('#chart_div').css('display', data[0].display_gauges);
	    							$('#digital_inputs').css('display', data[0].display_digitals);
	    							$('#container').css('display',data[0].display_chart);
	    							$('#bar_chart_div').css('display',data[0].display_bar_chart);
	    							$('#digital_outputs').css('display',data[0].display_output);
	    							$('#outputs_header').css('display',data[0].display_output);
	    							$('#button_outputs_update').css('display',data[0].display_output);
								  },
								  error: function(error){
								  	
								  },
								});
    						$('#save').on('click',function(e){
    							show_gauges = $('#chart_div').css('display');
    							show_digitals = $('#digital_inputs').css('display');
    							show_charts = $('#container').css('display');
    							show_counters = $('#bar_chart_div').css('display');
    							show_outputs = $('#digital_outputs').css('display');
    							
    							e.preventDefault();
    							$.ajax({
								  
								  type: "POST",
								  url: '<?php echo base_url('/get_uri/post_configuration')?>',
								  data: {user_id: user_id, sender_id: sender_id, show_gauges: show_gauges, show_digitals: show_digitals, show_charts: show_charts, show_bar_chart: show_counters, show_output: show_outputs},
								  success: function(data){
								  	
								  },
								  error: function(error){
								  	
								  },
								});
    						});
						$('#chart_analogues').on('click',function(e){
							$('#chart_div').toggle('slow');
							$('#chart_div').removeAttr('overflow');
							$('#chart_div').css('overflow','visible');
							$('#chart_analogues').toggleClass('active');
							e.preventDefault();
						});
						$('#chart_counters').on('click',function(e){
							$('#bar_chart_div').slideToggle('slow');
							$('#chart_counters').toggleClass('active');
							e.preventDefault();
						});
						$('#chart_charts').on('click',function(e){
							$('#container').slideToggle('slow');
							$('#chart_charts').toggleClass('active');
							e.preventDefault();
						});
						$('#chart_digitals').on('click',function(e){
							$('#digital_inputs').toggle('slow');
							$('#digital_inputs').removeAttr('overflow');
							$('#digital_inputs').css('overflow','visible');
							$('#chart_digitals').toggleClass('active');
							e.preventDefault();
						});
						$('#chart_outputs').on('click',function(e){
							$('#digital_outputs').slideToggle('slow');
							$('#outputs_header').toggle();
							$('#button_outputs_update').toggle();
							$('#digital_outputs').removeAttr('overflow');
							$('#digital_outputs').css('overflow','visible');
							$('#chart_outputs').toggleClass('active');
							$('#update_digitals').css('visibility','hidden');
							e.preventDefault();
						});
					
					
					
					



					
					
					
					

					
					
					
					
					


					
					
					
					

					
					
					
					
					
					


					
					
					
					
					
					

					
					     					});

					</script>
					<!-- <form action="<?php echo base_url('User/login'); ?>" method="get">
				<button style="margin-top:-170px;"id="logout" padding="150px"> Logout </button>
				<p class="testp"></p>
				</form>  </p>  -->
			<script>
			$(function() {
							  refresh_page();
			  $("#dialog").dialog({autoOpen : false, modal : true, show : "blind", hide : "blind"});
			  $("#contactUs").click(function() {
			    $("#dialog").dialog("open");
			    return false;
			  });
			});
			</script>
				</div>
				<?php 
		 </div>
		<!--   <span id="ajax">Get Messages from API using AJAX to automatically update page without reload.</span>
		  -->
<!-- 		  <span id="ajax">Get Messages from API using AJAX to automatically update page without reload.</span>
 -->
		 <script>
		 
		

		

		 function refresh_page(){
			
			console.log('page refresh');
			sender_id = $('#choose_datalogger').val();
			
			
			    $.ajax({
			    	url: "<?php echo base_url();?>get_uri/get/all/<?php echo $user[0]['user_id'];?>/<?php echo $sender_id;?>",
			    	dataType:'json',
			    	error : function(error) {
			    		console.log('error in ajax call');
						console.log(error);
					},
			    	success: function(result){
			        	$("#ajax").html(result);
				    	
				    	
				    	console.log(result);
				    	
				    	count = 0;
				    	
				    	
				    		
				    		var d_0 = result[count].D0;
					    	var d_1 = result[count].D1;
					    	var d_2 = result[count].D2;
					    	var d_3 = result[count].D3;
					    	var d_4 = result[count].D4;
					    	var d_5 = result[count].D5;
					    	var d_6 = result[count].D6;
					    	var d_7 = result[count].D7;
					    	
					    	var c0 = result[count].C0;
							var c1 = result[count].C1;
							var c2 = result[count].C2;
							var c3 = result[count].C3;
							var a0 = result[count].A0;
							var a1 = result[count].A1;
							var a2 = result[count].A2;
							var a3 = result[count].A3;
							var a4 = result[count].A4;
							var a5 = result[count].A5;
							var a6 = result[count].A6;
							var a7 = result[count].A7;
							var a8 = result[count].A8;
							var a9 = result[count].A9;
							var a10 = result[count].A10;
							var a11 = result[count].A11;
							var a12 = result[count].A12;
							var a13 = result[count].A13;
							var a14 = result[count].A14;
							var a15 = result[count].A15;
							var a16 = result[count].A16;
							var a17 = result[count].A17;
							var a18 = result[count].A18;
							var a19 = result[count].A19;
							var datetime = result[count].datetime;
							var date = new Date(datetime*1000);
							var hours = date.getHours();
							var minutes = "0" + date.getMinutes();
							var seconds = "0" + date.getSeconds();
							var formattedTime = hours + ':' + minutes.substr(-2) + ':' + seconds.substr(-2);
							$('#datetime').html(formattedTime);
							console.log([c0, c1, c2, c3]);
							console.log([a0,a1,a2,a3,a4,a5,a6,a7,a8,a9,a10,a11,a12,a13,a14,a15,a16,a17,a18,a19]);
							analogues = [a0,a1,a2,a3,a4,a5,a6,a7,a8,a9,a10,a11,a12,a13,a14,a15,a16,a17,a18,a19];
							console.log(analogues);
							init(a0,a1,a2,a3, c0, c1, c2, c3);
				    if (d_0 === "HI"){
						document.getElementById("round-button-1").text = "ON";
						$('#round-button-circle-1').css('background','green');
					} else {
						document.getElementById("round-button-1").text = "OFF";
						
						 $('#round-button-circle-1').css('background','red');
					}
					if (d_1 === "HI"){
						document.getElementById("round-button-2").text = "ON";
						 $('#round-button-circle-2').css('background','green');
					} else {
						document.getElementById("round-button-2").text = "OFF";
						
						 $('#round-button-circle-2').css('background','red');
					}
					if (d_2 === "HI"){
						document.getElementById("round-button-3").text = "ON";
						 $('#round-button-circle-3').css('background','green');
					} else {
						document.getElementById("round-button-3").text = "OFF";
						 $('#round-button-circle-3').css('background','red');
						
					}
					if (d_3 === "HI"){
						document.getElementById("round-button-4").text = "ON";
						 $('#round-button-circle-4').css('background','green');
					} else {
						document.getElementById("round-button-4").text = "OFF";
						 $('#round-button-circle-4').css('background','red');
						
					}
					if (d_4 === "HI"){
						document.getElementById("round-button-5").text = "ON";
						$('#round-button-circle-5').css('background','green');
					} else {
						document.getElementById("round-button-5").text = "OFF";
						$('#round-button-circle-5').css('background','red');
						
					}
					if (d_5 === "HI"){
						document.getElementById("round-button-6").text = "ON";
						$('#round-button-circle-6').css('background','green');
					} else {
						document.getElementById("round-button-6").text = "OFF";
						
						$('#round-button-circle-6').css('background','red');
					}
					if (d_6 === "HI"){
						document.getElementById("round-button-7").text = "ON";
						$('#round-button-circle-7').css('background','green');
					} else {
						document.getElementById("round-button-7").text = "OFF";
						
						$('#round-button-circle-7').css('background','red');
					}
					if (d_7 === "HI"){
						document.getElementById("round-button-8").text = "ON";
						$('#round-button-circle-8').css('background','green');
					} else {
						document.getElementById("round-button-8").text = "OFF";
						
						$('#round-button-circle-8').css('background','red');
					}
		        }

		    });
			
		 }
			 refresh_page();
		 </script>
		 <?php 
		 <?php if (count($messages) == 0){
			
		} ?>
		</div>
		<?php $last = count($messages)-1;?>
		<?php 
		<?php
		$max = 0;
		for ($i=0; $i<$last; $i++){
				if ($messages[$i]['A0'] > $max){
					$max = $messages[$i]['A0'];
					
				}
				if ($messages[$i]['A1'] > $max){
					$max = $messages[$i]['A1'];
					
				}
				if ($messages[$i]['A2'] > $max){
					$max = $messages[$i]['A2'];
					
				}
				if ($messages[$i]['A3'] > $max){
					$max = $messages[$i]['A3'];
					
				}
		}
		?>
		<?php $min_date = $messages[0]['datetime']; ?>

		<?php $max_date = $messages[$last]['datetime']; ?>
		<!--<button style="margin-left:100px;"type='submit' name='Refresh' onclick="refresh_page()">Refresh</button>-->
	</div>
	<div class="row">
		<div class="span2">
			<div class="chart_and_choose_logger" style="margin-left: 70px;">
						<div class="md-2">
						<?php $datalogger_count = count($datalogger);?>
						<form class="form-horizontal" method="post">
							<div class="form-inline">
								<div class="form-group">
									<div class="block" style='visibility: visible;'>
								<label class="col-sm-2 control-label"><select style='position:absolute;top:640;left:950; width: auto;
'class="form-control" name='choose_datalogger' id='choose_datalogger'>
								    	<?php for ($i=0;$i<count($datalogger);$i++){ ?>
								    		<?php 
								    		<option name='datalogger<?php echo $i;?>' value='<?php echo $datalogger[$i]['sender_id'];?>'>
									    	<?php echo $datalogger[$i]['machine_name'];?></option>
								  	<?php  } ?>
								</select>
<!-- 								<input hidden id='hiddenvalue' name='hiddenvalue' value='<?php echo $i;?>'></input>
 -->								<button class="btn btn-default"type="submit" style='position:absolute;top:680;left:950;'>Select</button> </label>
								</div>
							</div>
						</div>
						</form>
					</div>
					<?php if (isset($_POST["choose_datalogger"])) {$selectOption = $_POST['choose_datalogger'];} else {$selectOption=0;} ?>
					<?php 
					<?php 
					<script>
					console.log('<?php echo $min_date;?>');
					$('#choose_datalogger').on('change', function(){
						
						
					});
					$('#choose_datalogger option[value='+'<?php echo $sender_id;?>'+']').prop('selected', true);
					</script>

					<script>
					selected_option = '<?php echo $selectOption;?>';
					
					$('#choose_datalogger option[value='+selected_option+']').prop('selected',true);
					selected_datalogger = $('#choose_datalogger').val();
					count = <?php echo count($messages); ?>
					</script>
					<?php 
			</div>
		</div>
					<div class="row">
<!-- 				<div class="gauges" style="margin:100px; align:center;    margin-top: -1100px;margin-left: 165px;">
 -->				 	<div id="chart_div" style=" height: 120px;    position: absolute; top: 80px;left: 250px;"></div>

				 	<script>
				 	messages = <?php echo count($messages);?>;
				 	
				 	if (messages===0){
				 			
					 		$('#chart_div').css('visibility','hidden');
				 		} else {
					 		$('#chart_div').css('visibility','visible');
					 		
				 		}
				 	</script>
 					</div>
		<div class="row">
<!-- 		<div class="span6" style="float:center;margin-left:75px;">
 --><!-- 			<h5 style="margin-left:300px;">Digitals</h5>
 -->				<div id='digital_inputs' class="digital_inputs" style="    position: absolute; top: 400; left: 390;">
					   <div class="buttons" style='    margin-left: -10;'>
		<!-- 					   <form action="<?php echo base_url('index.php/rawdata/configure_digital_inputs')?>" method="POST">
		 -->						  <div id="button-1" style="border:black, 1px;">
		 								<div class="panel panel-default">
											  <div class="panel-body">
										  <h6><b><label id='labeld0'><?php echo $config[20]['label_name']; ?></label></b></h6>
								      <div class="round-button" ><div class="round-button-circle" id="round-button-circle-1" style='width:108px'>
								      <a onclick="button_click()" href="#" class="round-button" id="round-button-1"value="Off" style='width:80px;'>
								        <?php if ($messages[$last]['D0'] = "HI") {echo "ON"; }
								        else {echo "Off";  } ?></a></div></div>
									</div>
								</div>
							</div>
								<div id="button-2" >
									<div class="panel panel-default">
									  <div class="panel-body">
										  <h6><b><label id='labeld1'><?php echo $config[21]['label_name']; ?></label></b></h6>
								      <div class="round-button" ><div class="round-button-circle" id="round-button-circle-2"style='width:108px'>
								      <a onclick="button_click()" href="#" class="round-button" id="round-button-2"value="Off"style='width:80px;'>
								        <?php if ($messages[$last]['D1'] = "HI") {echo "ON"; }
								        else {echo "Off";  } ?></a></div></div>
									</div>
								</div>
							</div>
							<div id="button-3">
							<div class="panel panel-default">
						  <div class="panel-body">
										  <h6><b><label id='labeld2'><?php echo $config[22]['label_name']; ?></label></b></h6>
								      <div class="round-button" ><div class="round-button-circle" id="round-button-circle-3"style='width:108px'>
								      <a onclick="button_click()" href="#" class="round-button" id="round-button-3"value="Off"style='width:80px;'>
								        <?php if ($messages[$last]['D2'] = "HI") {echo "ON"; }
								        else {echo "Off";  } ?></a></div></div>
									</div>
								</div>
							</div>

									<div id="button-4" >
										<div class="panel panel-default">
						  <div class="panel-body">
										  <h6><b><label id='labeld3'><?php echo $config[23]['label_name']; ?></label></b></h6>
								      <div class="round-button" ><div class="round-button-circle" id="round-button-circle-4"style='width:108px'>
								      <a onclick="button_click()" href="#" class="round-button" id="round-button-4"value="Off"style='width:80px;'>
								        <?php if ($messages[$last]['D3'] = "HI") {echo "ON"; }
								        else {echo "Off";  } ?></a></div></div>
								    </div>
								</div>
									</div>

<!-- 							</div>
	<!--  							<div class="row">
			 -->							<div id="button-5">
											 <div class="panel panel-default">
														  <div class="panel-body">
											  <h6><b><label id='labeld4'><?php echo $config[24]['label_name']; ?></label></b></h6>
									      <div class="round-button"><div class="round-button-circle" id="round-button-circle-5"style='width:108px'>
									      <a onclick="button_click()" href="#" class="round-button"id="round-button-5" value="Off"style='width:80px;'>
									        <?php if ($messages[$last]['D4'] = "HI") {echo "ON"; }
									        else {echo "Off";  } ?></a></div></div>
										</div>
									</div>
								</div>

										<div id="button-6" >
											<div class="panel panel-default">
						  <div class="panel-body">
											  <h6><b><label id='labeld5'><?php echo $config[25]['label_name']; ?></label></b></h6>
									      <div class="round-button" ><div class="round-button-circle" id="round-button-circle-6"style='width:108px'>
									      <a onclick="button_click()" href="#" class="round-button" id="round-button-6"value="Off"style='width:80px;'>
									        <?php if ($messages[$last]['D5'] = "HI") {echo "ON"; }
									        else {echo "Off";  } ?></a></div></div>
										</div>
									</div>
								</div>

										<div id="button-7" >
											<div class="panel panel-default">
						  <div class="panel-body">
											  <h6><b><label id='labeld6'><?php echo $config[26]['label_name']; ?></label></b></h6>
									      <div class="round-button" ><div class="round-button-circle" id="round-button-circle-7"style='width:108px'>
									      <a onclick="button_click()" href="#" class="round-button" id="round-button-7"value="Off"style='width:80px;'>
									        <?php if ($messages[$last]['D6'] = "HI") {echo "ON"; }
									        else {echo "Off";  } ?></a></div></div>
										</div>
									</div>
								</div>

										<div id="button-8" >
											<div class="panel panel-default">
						  <div class="panel-body">
											  <h6><b><label id='labeld7'><?php echo $config[27]['label_name']; ?></label></b></h6>
									      <div class="round-button" ><div class="round-button-circle" id="round-button-circle-8"style='width:108px'>
									      <a onclick="button_click()" href="#" class="round-button" id="round-button-8"value="Off"style='width:80px;'>
									        <?php if ($messages[$last]['D7'] = "HI") {echo "ON"; }
									        else {echo "Off";  } ?></a></div></div>
												</div>
											</div>
										</div>
			<!-- 								</div>
			 -->							</div>

<!-- 								  </div>
 -->			<!-- 			</div>
						</div> -->
<!-- 					<button type="submit">Configure Digital Inputs</button>
 -->				</div>
				<script>
				$(document).ready(function(){
				d0 = $('#labeld0').html();
				d1 = $('#labeld1').html();
				d2 = $('#labeld2').html();
				d3 = $('#labeld3').html();
				d4 = $('#labeld4').html();
				d5 = $('#labeld5').html();
				d6 = $('#labeld6').html();
				d7 = $('#labeld7').html();
				
				if (!d0){
					$('#labeld0').html('xxxxxx');
					$('#labeld0').css('visibility','hidden');
				}
								if (!d1){
					$('#labeld1').html('xxxxxx');
					$('#labeld1').css('visibility','hidden');
				}
								if (!d2){
					$('#labeld2').html('xxxxxx');
					$('#labeld2').css('visibility','hidden');
				}
								if (!d3){
					$('#labeld3').html('xxxxxx');
					$('#labeld3').css('visibility','hidden');
				}
								if (!d4){
					$('#labeld4').html('xxxxxx');
					$('#labeld4').css('visibility','hidden');
				}
								if (!d5){
					$('#labeld5').html('xxxxxx');
					$('#labeld5').css('visibility','hidden');
				}
								if (!d6){
					$('#labeld6').html('xxxxxx');
					$('#labeld6').css('visibility','hidden');
				}
								if (!d7){
					$('#labeld7').html('xxxxxx');
					$('#labeld7').css('visibility','hidden');
				}
				 				});

				  
				  
				  
				  
				  
				  
				</script>
<!-- 					<button class="form-control"type="submit" style="margin:50px;">Update</button>
 -->					</form>
			</div>
<!-- 			</div>
 --><!--  <div class="container"style="width:100px;">
 </div>
 -->
 		</div>
 		<div class="row" style="float:left;width: 200px;margin: 50px;">
		<div class="span2">
		  <div class="datalogger_information" >
		    <h3 style="margin-top:-90px;"class="datalog">SCADA Information</h3>
		    <?php $message_for_datalogger_1 = 0;?>
		    <script>
		    var datalogger_option = document.getElementById('choose_datalogger').value;
		    
		    </script>
		    <script>
		    <table class="table">
<!-- 		     <tr class="datalog">
		    <td class="datalog"><b>Location:</b><br> <?php echo $current_datalogger[0]['location'] ?></td>
		     </tr> -->
		      <tr class="datalog">
		        <td class="datalog"><b>Machine Name:</b><br> <?php echo $current_datalogger[0]['machine_name'] ?></td>
		      </tr>
		      <tr class="datalog">
		        <td class="datalog"><b>Contact number:</b><br> <?php echo $current_datalogger[0]['phone'] ?></td>
		      </tr>
		      <tr class="datalog">
		    <td class="datalog"><b>Last Signal Strength:</b><br> <?php echo $messages[$last]['signal_strength']?></td>
		      </tr>
		      <tr class="datalog">
		    <td class="datalog"><b>Last Sender ID:</b><br> <?php echo $messages[$last]['sender_id']?></td>
		      </tr>
		      <tr class="datalog">
		    <td class="datalog"><b>Last Message: </b><br><span id='datetime'><?php echo gmdate("Y-m-d H:i:s", $messages[$last]['datetime']);?></span></td>
		      </tr>
		    </table>
		  </div>
		</div>
				<script>
			      $(function() {
				    $( "#progressbar" ).progressbar({
				      value: 0
				    });
			        var value = $( "#progressbar" ).progressbar( "option", "value" );
			        
				  });
			</script>
			<div class="block">
				<label style="display:inline-block" id='titleloading'>Loading Bar</label>
				<div style="width:100px;display:inline-block;margin-left:5;"id="progressbar"></div>
				<div style='margin:10;margin-left:-3'class="alert alert-warning" id='bootstrap_warning_message'> This page is loading </div>

			</div>
<!-- 			 <img style='margin:10;    margin-bottom: 30;'id='googlemap'src="http:
--><!-- <div id="map" style='height:200px;width:200px'></div> -->
<?php 
    <script>
      function initMap() {
        var map;
		var geocoder = new google.maps.Geocoder();

		

		    
		    var address = '<?php echo $current_datalogger[0]['postcode'];?>';

		    
		    geocoder.geocode( { 'address' : address }, function( results, status ) {
		        if( status == google.maps.GeocoderStatus.OK ) {

		            
		            map.setCenter( results[0].geometry.location );
		            var marker = new google.maps.Marker( {
		                map     : map,
		                position: results[0].geometry.location
		            } );
		        } else {
		            
		        }
		    } );
		

        map = new google.maps.Map(document.getElementById('map'), {
          
          zoom: 14
        });
      }
    </script>
    <script src="https:
    async defer></script>

<!--  			<div id='googlemapbounce'style="width:500px;height:380px;"></div>
 -->
<!--  <img style='margin:10; margin-bottom: 30;'id='googlemap'src="https:
 -->
<!-- 			 <img style='margin:10; margin-bottom: 30;'id='googlemap'src="https:
 -->		<!-- <img style='margin:10; margin-bottom: 30;'id='googlemap'src="http:
  --><!-- 		<h2 style="margin-left:200px;margin-top:-10px;"> Analogue Count </h2>
	        <div class='email_alerts_container' style='position:absolute'>
<!-- 			<h4><b> Emails </b></h4>
 -->			<?php $names = array("a0", "a1","a2","a3", "a4", "a5", "a6","a7","a8","a9","a10","a11","a12","a13","a14","a15","a16","a17","a18","a19");?>
			<?php foreach ($names as $name){ ?>
			<div class="alert alert-success emailalert" style='display:none;' id='email_sent<?php echo $name;?>alarm1'><label style='margin: 2; display: inline;'><?php echo strtoupper($name);?> alarm 1 sent</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sent<?php echo $name;?>alarm2'><label style='margin: 2; display: inline;'><?php echo strtoupper($name);?> alarm 2 sent</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sent<?php echo $name;?>alarm3'><label style='margin: 2; display: inline;'><?php echo strtoupper($name);?> alarm 3 sent</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sent<?php echo $name;?>alarm4'><label style='margin: 2; display: inline;'><?php echo strtoupper($name);?> alarm 4 sent</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_reset<?php echo $name;?>alarm1'><label style='margin: 2; display: inline;'><?php echo strtoupper($name);?> alarm 1 reset</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_reset<?php echo $name;?>alarm2'><label style='margin: 2; display: inline;'><?php echo strtoupper($name);?> alarm 2 reset</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_reset<?php echo $name;?>alarm3'><label style='margin: 2; display: inline;'><?php echo strtoupper($name);?> alarm 3 reset</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_reset<?php echo $name;?>alarm4'><label style='margin: 2; display: inline;'><?php echo strtoupper($name);?> alarm 4 reset</label></div>
			<?php } ?>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sentd0alarm1'><label style='margin: 2; display: inline;'> D0 sent alarm 1</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sentd1alarm1'><label style='margin: 2; display: inline;'>D1 sent alarm 1</label></div>
					<div class="alert alert-success emailalert" style='display:none;' id='email_sentd2alarm1'><label style='margin: 2; display: inline;'>D2 sent alarm 1</label></div>
					<div class="alert alert-success emailalert" style='display:none;' id='email_sentd3alarm1'><label style='margin: 2; display: inline;'>D3 sent alarm 1</label></div>
					<div class="alert alert-success emailalert" style='display:none;' id='email_sentd4alarm1'><label style='margin: 2; display: inline;'>D4 sent alarm 1</label></div>
					<div class="alert alert-success emailalert" style='display:none;' id='email_sentd5alarm1'><label style='margin: 2; display: inline;'>D5 sent alarm 1</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sentd6alarm1'><label style='margin: 2; display: inline;'>D6 sent alarm 1</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sentd7alarm1'><label style='margin: 2; display: inline;'>D7 sent alarm 1</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sentd0alarm2'><label style='margin: 2; display: inline;'> D0 sent alarm 2 </label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sentd1alarm2'><label style='margin: 2; display: inline;'>D1 sent alarm 2</label></div>
					<div class="alert alert-success emailalert" style='display:none;' id='email_sentd2alarm2'><label style='margin: 2; display: inline;'>D2 sent alarm 2</label></div>
					<div class="alert alert-success emailalert" style='display:none;' id='email_sentd3alarm2'><label style='margin: 2; display: inline;'>D3 sent alarm 2</label></div>
					<div class="alert alert-success emailalert" style='display:none;' id='email_sentd4alarm2'><label style='margin: 2; display: inline;'>D4 sent alarm 2</label></div>
					<div class="alert alert-success emailalert" style='display:none;' id='email_sentd5alarm2'><label style='margin: 2; display: inline;'>D5 sent alarm 2</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sentd6alarm2'><label style='margin: 2; display: inline;'>D6 sent alarm 2</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sentd7alarm2'><label style='margin: 2; display: inline;'>D7 sent alarm 2</label></div><br>
					<div class="alert alert-success emailalert" style='display:none;' id='email_sentc0'><label style='margin: 2; display: inline;'>C0 sent</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sentc1'><label style='margin: 2; display: inline;'>C1 sent</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sentc2'><label style='margin: 2; display: inline;'>C2 sent</label></div>
				<div class="alert alert-success emailalert" style='display:none;' id='email_sentc3'><label style='margin: 2; display: inline;'>C3 sent</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetd0alarm1'><label style='margin: 2; display: inline;'>d0 reset alarm1</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetd1alarm1'><label style='margin: 2; display: inline;'> d1 reset alarm1</label></div>
					<div class="alert alert-info emailalert" style='display:none;' id='email_resetd2alarm1'><label style='margin: 2; display: inline;'>d2 reset alarm1</label></div>
					<div class="alert alert-info emailalert" style='display:none;' id='email_resetd3alarm1'><label style='margin: 2; display: inline;'>d3 reset alarm1</label></div>
					<div class="alert alert-info emailalert" style='display:none;' id='email_resetd4alarm1'><label style='margin: 2; display: inline;'>d4 reset alarm1</label></div>
					<div class="alert alert-info emailalert" style='display:none;' id='email_resetd5alarm1'><label style='margin: 2; display: inline;'>d5 reset alarm1</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetd6alarm1'><label style='margin: 2; display: inline;'>d6 reset alarm1</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetd7alarm1'><label style='margin: 2; display: inline;'>d7 reset alarm1</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetd0alarm2'><label style='margin: 2; display: inline;'>d0 reset alarm1</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetd1alarm2'><label style='margin: 2; display: inline;'> d1 reset alarm2</label></div>
					<div class="alert alert-info emailalert" style='display:none;' id='email_resetd2alarm2'><label style='margin: 2; display: inline;'>d2 reset alarm2</label></div>
					<div class="alert alert-info emailalert" style='display:none;' id='email_resetd3alarm2'><label style='margin: 2; display: inline;'>d3 reset alarm2</label></div>
					<div class="alert alert-info emailalert" style='display:none;' id='email_resetd4alarm2'><label style='margin: 2; display: inline;'>d4 reset alarm2</label></div>
					<div class="alert alert-info emailalert" style='display:none;' id='email_resetd5alarm2'><label style='margin: 2; display: inline;'>d5 reset alarm2</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetd6alarm2'><label style='margin: 2; display: inline;'>d6 reset alarm2</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetd7alarm2'><label style='margin: 2; display: inline;'>d7 reset alarm2</label></div><br>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetc0'><label style='margin: 2; display: inline;'>c0 reset</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetc1'><label style='margin: 2; display: inline;'>c1 reset</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetc2'><label style='margin: 2; display: inline;'>c2 reset</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_resetc3'><label style='margin: 2; display: inline;'>c3 reset</label></div>
				<div class="alert alert-info emailalert" style='display:none;' id='email_reset'><label>email</label></div><br>
				<div class="alert alert-danger emailalert" style='display:none;' id='no_analogues_charted'><label style='margin: 20px; display: inline;'>No Analogues charted</label></div>
				<div class="alert alert-danger emailalert" style='display:none;' id='alarmnotconfigured'><label style='margin: 20px; display: inline;'></label></div>
			</div>
			<script>
				

				
				
				
				
				
				
				
				
				
				
				
				
				
				
				



				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				

				


				
				</script>
				<div id='email_sent'></div>
 			    </div>
		</div>
		<script type="text/javascript" src="https:
		<script type="text/javascript">
			var scaley = [(<?php echo $config[0]['max'];?>-<?php echo $config[0]['min']?>)/1024,
			 			  (<?php echo $config[1]['max'];?>-<?php echo $config[1]['min']?>)/1024,
				   	      (<?php echo $config[2]['max'];?>-<?php echo $config[2]['min']?>)/1024,
						  (<?php echo $config[3]['max'];?>-<?php echo $config[3]['min']?>)/1024];

					var dats =[<?php echo $messages[$last]['A0'];?>,<?php echo $messages[$last]['A1'];?>,
					<?php echo $messages[$last]['A2'];?>,<?php echo $messages[$last]['A3'];?>];
					var scaled_value = [];
					console.log(dats);
					console.log(scaley);
					  google.load("visualization", "1", {packages:['gauge']});
					  google.setOnLoadCallback(init);
					  function init (a0,a1,a2,a3,c0, c1, c2, c3) {
					  	console.log([a0,a1,a2,a3,c0, c1, c2, c3]);
					    drawBasic(c0,c1,c2,c3);
					    drawChart(a0,a1,a2,a3);
						}
					  function drawChart(a0,a1,a2,a3) {
					  	var scaley = [(<?php echo $config[0]['max'];?>-<?php echo $config[0]['min']?>)/1024,
			 			  (<?php echo $config[1]['max'];?>-<?php echo $config[1]['min']?>)/1024,
				   	      (<?php echo $config[2]['max'];?>-<?php echo $config[2]['min']?>)/1024,
						  (<?php echo $config[3]['max'];?>-<?php echo $config[3]['min']?>)/1024];

					var dats =[<?php echo $messages[$last]['A0'];?>,<?php echo $messages[$last]['A1'];?>,
					<?php echo $messages[$last]['A2'];?>,<?php echo $messages[$last]['A3'];?>];
					  	console.log([a0,a1,a2,a3, scaley, dats]);
						
							scaled_a_1 = Math.round(dats[0]*scaley[0] * 100) / 100;
							scaled_a_2 = Math.round(dats[1]*scaley[1] * 100) / 100;
							scaled_a_3 = Math.round(dats[2]*scaley[2] * 100) / 100;
							scaled_a_4 = Math.round(dats[3]*scaley[3] * 100) / 100;
							
							
							

						
						
						
						if (isNaN(scaled_a_1)){
							scaled_a_1 == 0;
						}
						if (isNaN(scaled_a_2)){
							scaled_a_2 == 0;

						}
						if (isNaN(scaled_a_3)){
							scaled_a_3 == 0;

						}
						if (isNaN(scaled_a_4)){
							scaled_a_4 == 0;

						}

						console.log('corrected scaley',scaled_a_1, scaled_a_2, scaled_a_3, scaled_a_4);
						<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
					    var data = google.visualization.arrayToDataTable([
					      ['Label', 'Value'],
					      ['<?php echo $config[0]['label_name'];?>', scaled_a_1],
					      ['<?php echo $config[1]['label_name'];?>', scaled_a_2],
					      ['<?php echo $config[2]['label_name'];?>', scaled_a_3],
					      ['<?php echo $config[3]['label_name'];?>', scaled_a_4]
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
					</script>
<!-- 			<div class="bar_chart">
 --><!-- 				<div class="container" style="margin-left: 130px;margin-top: -480px;margin-top:120px">
 -->
 	    	</div>
<!-- <div class="container">
 -->	<div class="row" style="float:right;width: 200px;margin-left: -500px;margin-right:700px;margin-top:-200px">
<!-- 		<div class="md-10">
 -->			<?php 
<!-- 		</div>
 -->
 			<div id='slide_chart'>
<!-- 			<div id="chart" style="margin:40px; margin-left: 310px;margin-top: 470px;">
 -->			<div id="container" style="    position: absolute;    top: 900;    left: 350; width:650px"></div>
<!-- 		</div>
 -->		</div>
		</div>
		<div class="row">
<!-- 				<div class="span4">
 -->				  			<div id="bar_chart_div" style="position: absolute;       top: 1350px;    left: 245px;"></div>
				  				<script>
							 		
							 		messages = <?php echo count($messages);?>;
							 		if (messages === 0){
					 					$('#bar_chart_div').css('visibility', 'hidden');
							 		}
							 	</script>
<!-- 				  		</div>
 --><!-- 				 </div>
 -->
<!--</div>-->
<?php 
	<script>
	function drawBasic(c0,c1,c2,c3) {
		 <?php $count = count($messages);?>
		 <?php $c0 = $messages[$count]['C0'];?>
		 <?php $c1 = $messages[$count]['C1'];?>
		 <?php $c2 = $messages[$count]['C2'];?>
		 <?php $c3 = $messages[$count]['C3'];?>
		console.log('console.log',[<?php echo $c0; ?>,<?php echo $c1; ?>,<?php echo $c2; ?>,<?php echo $c3; ?>])
		if (c0 === undefined){
			c0 = <?php echo $messages[$count-1]['C0'];?>;
		}
		if (c1 === undefined){
			c1 = <?php echo $messages[$count-1]['C1'];?>;
		}
		if (c2 === undefined){
			c2 = <?php echo $messages[$count-1]['C2'];?>;
		}
		if (c3  === undefined){
			c3 = <?php echo $messages[$count-1]['C3'];?>;
		}
		console.log([c0,c1,c2,c3]);

	      var data = google.visualization.arrayToDataTable([
	        ['Counters', 'Count',{ role: 'style' }, { role: 'annotation' } ],
	        ['<?php echo $config[28]['label_name'];?>', parseInt(c0), 'stroke-color: #703593; stroke-width: 4; fill-color: #b87333', '<?php echo $config[28]['label_name'];?>'],
	        ['<?php echo $config[29]['label_name'];?>', parseInt(c1), 'stroke-color: #703593; stroke-width: 4; fill-color: #76A7FA', '<?php echo $config[29]['label_name'];?>'],
	        ['<?php echo $config[30]['label_name'];?>', parseInt(c2), 'stroke-color: #703593; stroke-width: 4; fill-color: #C5A5CF', '<?php echo $config[30]['label_name'];?>'],
	        ['<?php echo $config[31]['label_name'];?>', parseInt(c3), 'stroke-color: #703593; stroke-width: 4; fill-color: #BC5679', '<?php echo $config[31]['label_name'];?>'],
	      ]);
	      var options = {
	      	height: 484,
	      	width: 910,
	        title: 'Number of Counts',
	        
	        
	        
	        
	        hAxis: {
	         
	          minValue: 0,
	          
	        },
	        legend: 'none',
	        vAxis: {
	        
	          baseline:0,
	          viewWindowMode: "explicit", viewWindow:{ min: 0 }
	        },
	       
	        backgroundColor: '#FFFFDb',
	      };
	       
		  google.charts.load('current', {packages: ['corechart']});

	       var chart = new google.visualization.ColumnChart(document.getElementById('bar_chart_div'));
	      chart.draw(data, options);
	    }
    </script>
    <?php 
    	</div>
    	<div class="row">
		<div class="span6" style="float:center;margin-left:75px;">
<!-- 			<h3 class ='digital_inputs' id='digitaloutputsheader' style="margin-left:300px;margin-top:340"><b id='outputs_header'>Digital Outputs</b></h3>
 -->				<div id='digital_outputs'class="digital_inputs" style="position: absolute;      top: 1880px;    left: 390px;">
					   <div class="buttons" style='top: 50;'>
		 					   <form action="<?php echo base_url('rawdata/configure_digital_inputs')?>" method="POST">
		 						  <div id="button-1" style="border:black, 1px;">
		 							<div class="panel panel-default">
										  <div class="panel-body">
										  <h6><b><i><span class="label label-default"><?php echo $config[20]['label_name']; ?></span></i></b></h6>
								      <div class="round-button-output" ><div class="round-button-circle-output" id="round-button-circle-output-1"style='width:108px'>
								      <a onclick="out_button_click()" href="#" class="round-button-output" id="round-button-output-1" name="round-button-output-1"value="<?php echo $outputs[0]['D0OUT'];?>"style='width:80px;'></a></div></div>
									</div>
								</div>
							</div>
							<div id="button-2" >
								<div class="panel panel-default">
								  <div class="panel-body">
										  <h6><b><i><span class="label label-default"><?php echo $config[21]['label_name']; ?></span></i></b></h6>
										      <div class="round-button-output" ><div class="round-button-circle-output" id="round-button-circle-output-2"style='width:108px'>
										      <a onclick="out_button_click()" href="#" class="round-button-output" id="round-button-output-2"name="round-button-output-2"value="<?php echo $outputs[0]['D1OUT'];?>"style='width:80px;'> </a></div></div>
											</div>
										</div>
									</div>
									<div id="button-3">
										<div class="panel panel-default">
										  <div class="panel-body">
										  <h6><b><i><span class="label label-default"><?php echo $config[22]['label_name']; ?></span></i></b></h6>
									      <div class="round-button-output" ><div class="round-button-circle-output" id="round-button-circle-output-3"style='width:108px'>
									      <a onclick="out_button_click()" href="#" class="round-button-output" id="round-button-output-3"name="round-button-output-3"value="<?php echo $outputs[0]['D2OUT'];?>"style='width:80px;'></a></div></div>
									</div>
								</div>
							</div>

									<div id="button-4" >
										<div class="panel panel-default">
										  <div class="panel-body">
										  <h6><b><i><span class="label label-default"><?php echo $config[23]['label_name']; ?></span></i></b></h6>
								   		   <div class="round-button-output" ><div class="round-button-circle-output" id="round-button-circle-output-4"style='width:108px'>
								   		   <a onclick="out_button_click()" href="#" class="round-button-output" id="round-button-output-4"name="round-button-output-4"value="<?php echo $outputs[0]['D3OUT'];?>"style='width:80px;'></a></div></div>
								    </div>
								</div>
									</div>

<!-- 							</div>
	<!--  							<div class="row">
			 -->							<div id="button-5">
											 <div class="panel panel-default">
											  <div class="panel-body">
											  <h6><b><i><span class="label label-default"><?php echo $config[24]['label_name']; ?></span></i></b></h6>
									 		     <div class="round-button-output"><div class="round-button-circle-output" id="round-button-circle-output-5"style='width:108px'>
									 		     <a onclick="out_button_click()" href="#" class="round-button-output"id="round-button-output-5" name="round-button-output-5" value="<?php echo $outputs[0]['D4OUT'];?>"style='width:80px;'></a></div></div>
										</div>
									</div>
								</div>

										<div id="button-6" >
											<div class="panel panel-default">
											  <div class="panel-body">
											  <h6><b><i><span class="label label-default"><?php echo $config[25]['label_name']; ?></span></i></b></h6>
									   		   <div class="round-button-output" ><div class="round-button-circle-output" id="round-button-circle-output-6"style='width:108px'>
									   		   <a onclick="out_button_click()" href="#" class="round-button-output" id="round-button-output-6" name="round-button-output-6"value="<?php echo $outputs[0]['D5OUT'];?>"style='width:80px;'></a></div></div>
										</div>
									</div>
								</div>

										<div id="button-7" >
											<div class="panel panel-default">
											  <div class="panel-body">
										  <h6><b><i><span class="label label-default"><?php echo $config[26]['label_name']; ?></span></i></b></h6>
									      <div class="round-button-output" ><div class="round-button-circle-output" id="round-button-circle-output-7"style='width:108px'>
									      <a onclick="out_button_click()" href="#" class="round-button-output" id="round-button-output-7" name="round-button-output-7"value="<?php echo $outputs[0]['D6OUT'];?>"style='width:80px;'> </a></div></div>
										</div>
									</div>
								</div>

										<div id="button-8" >
											<div class="panel panel-default">
											  <div class="panel-body">
										  <h6><b><i><span class="label label-default"><?php echo $config[27]['label_name']; ?></span></i></b></h6>
									      <div class="round-button-output" ><div class="round-button-circle-output" id="round-button-circle-output-8"style='width:108px'>
									      <a onclick="out_button_click()" href="#" class="round-button-output" id="round-button-output-8" name="round-button-output-8"value="<?php echo $outputs[0]['D7OUT'];?>"style='width:80px;'></a></div></div>
												</div>
											</div>
										</div>
			<!-- 								</div>
			 -->							</div>

								  </div>
			<!-- 			</div>
						</div> -->
<!-- 					<button type="submit">Configure Digital Inputs</button>
 -->				</div>
 				<?php 
				<script>
				function out_button_click(){
					
				    $(".round-button-circle-output").on("click", function(e) {
				    	$('#update_digitals').css('visibility','hidden');
				    	e.preventDefault();
				    	color = $(this).css("background-color");
				    	
				    	text = $(this).text();
				    	
				    	id = $(this).attr('id');
				    	
				    	if (id === "round-button-circle-output-1"){
				    		outputD0 = $('#round-button-output-1').text();
				    		
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
				    	
				    });
				}
				  messages = <?php echo count($messages); ?>;
				  
				  if (messages === 0){
				  	
				  	$('.digital_inputs').css('visibility', 'hidden');
				  	
				  	
				  	$('#button_outputs_update').hide();
				  }
				  	function post_outputs(){
						user_id = <?php echo $user[0]['user_id']; ?>;
						sender_id = '<?php echo $sender_id;?>';
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
						$('#sender_id').val(sender_id);
						data_dash = [user_id, sender_id, D0OUT, D1OUT, D2OUT, D3OUT, D4OUT, D5OUT, D6OUT, D7OUT];
						
						$.ajax({
						  
						  type: "POST",
						  url: '<?php echo base_url('/rawdata/configure_digital_inputs')?>',
						  data: {user_id: user_id, sender_id: sender_id, D0OUT: D0OUT, D1OUT: D1OUT, D2OUT: D2OUT, D3OUT: D3OUT, D4OUT: D4OUT, D5OUT: D5OUT, D6OUT: D6OUT, D7OUT: D7OUT},
						  success: function(data){
						  	
						  },
						  error: function(error){
						  	
						  },
						});
					}
				  $(document).ready(function(){
				  	  D0OUT = "<?php echo $outputs[0]['D0OUT'];?>";
					  D1OUT = "<?php echo $outputs[0]['D1OUT'];?>";
					  D2OUT = "<?php echo $outputs[0]['D2OUT'];?>";
					  D3OUT = "<?php echo $outputs[0]['D3OUT'];?>";
					  D4OUT = "<?php echo $outputs[0]['D4OUT'];?>";
					  D5OUT = "<?php echo $outputs[0]['D5OUT'];?>";
					  D6OUT = "<?php echo $outputs[0]['D6OUT'];?>";
					  D7OUT = "<?php echo $outputs[0]['D7OUT'];?>";
					  selectoption = "<?php echo $selectOption;?>";
					  
					  
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
				});
				</script>
				<button id='button_outputs_update'onclick="post_outputs()" class="form-control btn btn-default btn-llg digital_inputs"type="button" style="    width: 100px;    position: absolute;    left: 365;    top: 1850;">Update</button>
				<div class="alert alert-success" style='visibility:hidden;width: 130;       position: absolute;    left: 530;    top: 1827px;' id='update_digitals'><label style='display:inline-block'>Outputs sent</label></div>
				<input  hidden type="text" name="sender_id" id="sender_id" value="<?php echo $sender_id;?>"></input>
				<input hidden type="text" name="D0OUT" id="D0OUT" value="<?php echo $outputs[0]['D0OUT'];?>"></input>
				<input hidden type="text" name="D1OUT" id="D1OUT" value="<?php echo $outputs[0]['D1OUT'];?>"></input>
				<input hidden type="text" name="D2OUT" id="D2OUT" value="<?php echo $outputs[0]['D2OUT'];?>"></input>
				<input hidden type="text" name="D3OUT" id="D3OUT" value="<?php echo $outputs[0]['D3OUT'];?>"></input>
				<input hidden type="text" name="D4OUT" id="D4OUT" value="<?php echo $outputs[0]['D4OUT'];?>"></input>
				<input hidden type="text" name="D5OUT" id="D5OUT" value="<?php echo $outputs[0]['D5OUT'];?>"></input>
				<input hidden type="text" name="D6OUT" id="D6OUT" value="<?php echo $outputs[0]['D6OUT'];?>"></input>
				<input hidden type="text" name="D7OUT" id="D7OUT" value="<?php echo $outputs[0]['D7OUT'];?>"></input>
				<script>
					$('#button_outputs_update').on('click', function(){
						$('#update_digitals').css('visibility','visible');
					})
				</script>
			</form>
<!-- 							<a class="btn btn-primary"href="<?php echo base_url('rawdata/configure_digital_inputs');?>" style="width: 100px; margin:10px; margin-left:300px;">Update</button>
 -->
			</div>
<!-- 			</div>
 --><!--  <div class="container"style="width:100px;">
 </div>
 -->
 		</div>
<!-- </div>

 -->	<div id="dialog" title="Help">
			    <p> <b>The first thing you will want to do after logging in </b>is to configure your charts and emails and send a message from your x9100. The configuration tab in is the menu at the top. This is where you can set which inputs are charted and which send emails. To set up an email alert you want to go to the alarm tab for the input on the configuration page and input an email
			    configuration for that alarm with an email address and message. Once a message has been received by the website the charts will appear and if any thresholds have been passed an email alert will be sent. </p>
			    <br >
				<p> <b>Hello, Welcome to your dashboard.</b> This section explains how to use mydata. To get started lets have a look at the dashboard. Your time display analogue data is displayed on the chart over a time period. Each input can be turned on and off by pressing its label
			    .The counters are visible on a bar chart. You analogues instant values are on the gauges at the top. Your datalogger information is on the left hand side panel. The digital hi and lo are displayed below the gauges and the digital outputs at the bottom of the page which can be configured by clicking on them and updating the string send back to the X9100. </p>
<!-- 				You can configure how you want to display your data on the configuration page. the digital inputs are set using the buttons.
				Information regarding your datalogger can be found on the left hand side of the page. If there is not data or charts showing then
				you might not have sent any messages to your web portal. Issues can usually be resolved by correct configuration. Please make sure you
				have configured the email options in the configuration page to control the email address and custom message of the email. Enjoy your charting dashboard!</p> -->
		</div>
		<!-- <div id="dialog" title="Basic dialog" style="display:hidden">
		  <p> Alarm exceeds the threshold you have set in your configuration. Do you want to send an alarm messages to the email address registered warning of an alarm threshold being reached. </p>
		  </p>
		</div> -->
		<script>
		messages = <?php echo count($messages);?>;
		
		if (messages == 0){
		
			$('#button_outputs_update').css('visibility','hidden');
		}
		</script>
				<div id="dialog2" title="No data or device found.">
			  <p><b>The dashboard is disabled because there is no data.</b>
			  	Select another datalogger or send some data to this datalogger.</p>
		  </div>
		 <script>
		  $(function() {
		    $("#dialog2").dialog({
		        autoOpen: false,
		        height: 275,
		        width: 400,
		        show: {
			        effect: "blind",
			        duration: 1000
			      },
			    hide: {
			        effect: "explode",
			        duration: 2000
			      },
 				position: { my: 'left+300 top', at: 'top+200' },
 				
 				modal: true,
				buttons: {
				        'Close' : function() {
				            $(this).dialog('close');
				        }
				    }
        				
		        
		    });

		  messages = <?php echo count($messages);?>;
		  
		  if (messages === 0){
		  	var options = {
			    autoOpen: false,
		        height: 225,
		        width: 750,
		        show: {
			        effect: "blind",
			        duration: 1000
			      },
			    hide: {
			        effect: "explode",
			        duration: 2000
			      },
 				position: { my: 'left-top', at: 'left-top+200' ,of:'#logo'},
 				buttons: {
				        'Close' : function() {
				            $(this).dialog('close');
				        }
				    }
 				
			};
		  	var myDialog = $("#dialog2").dialog(options);
		  	
		  	
			myDialog.dialog('open');
			myDialog.dialog( "option", "position", { my: 'top', at: 'top+150' } );

		  }
		  });
		  </script>
	</div>
</div>
		<?php 

<script>

</script>
<script>
    $(document).ready(function(){
    	chart_data();
        var myVarb = setInterval(chart_data, 60000);

    })
    num_chart_ajax_calls = 0
    function chart_data(){
    	
	    var seriesOptions = [],
		charted_names = [],
		serialsOptions =[],
		is_charted = [],
	    seriesCounter = 1,
	    
	    names = ['A0','A1','A2','A3'];
	    
	    <?php for ($i=0;$i<4; $i++){ ?>
	     
	     
	   		
	   		
	   		
	   		
	   		
	   		
	    <?php } ?>
	   	
	   
	    
	    
	    
	    
	    
	    
	    
	    var max = 0
	    if (num_chart_ajax_calls = 0){
			$('.block').css('visibility','visible');
	    }
	    num_chart_ajax_calls = num_chart_ajax_calls + 1;
	    	var count2 = 0;

	    $.each(names, function(i, name){
	    	
	    	
	    	
	    	
	    	
	    	var user_id = <?php echo $user[0]['user_id'];?>;
	    	var sender_id = "<?php echo $sender_id;?>";
	    	
	    	
	        $.getJSON('<?php echo base_url();?>get_uri/get/input/'+names[i]+'/'+sender_id, function (data) {
	        	
	        	
	        	count2 = count2 +1;
	        	counterperc = (count2/names.length)*100;
	        	
	        	$( "#progressbar").progressbar( "option", "value", counterperc );
	        	if (counterperc ==95){
	        		$("#progressbar").val("<p class='alert alert-success'>Page is Loaded<p>");
	        		$('#progressbar').css('visibility', 'hidden');
	           		$('#titleloading').css('visibility', 'hidden');
			        $('#bootstrap_warning_message').css('visibility', 'hidden');
	        	}
	        	
	            if (counterperc = 100){
	        		$("#progressbar").val("<p class='alert alert-success'>Page is Loaded<p>");
	        		$('#progressbar').css('visibility', 'hidden');
	           		$('#titleloading').css('visibility', 'hidden');
			        $('#bootstrap_warning_message').css('visibility', 'hidden');
			      }
	        	var number_of_messages = <?php echo count($messages); ?>+1;
	        	
	        	var scales = [(<?php echo $config[0]['max'];?>-<?php echo $config[0]['min'];?>)/1024,
	        	 (<?php echo $config[1]['max'];?>-<?php echo $config[1]['min'];?>)/1024,
	 			   (<?php echo $config[2]['max'];?>-<?php echo $config[2]['min'];?>)/1024,
				 (<?php echo $config[3]['max'];?>-<?php echo $config[3]['min'];?>)/1024,
				(<?php echo $config[4]['max'];?>-<?php echo $config[4]['min'];?>)/1024,
	        	 (<?php echo $config[5]['max'];?>-<?php echo $config[5]['min'];?>)/1024,
	 			   (<?php echo $config[6]['max'];?>-<?php echo $config[6]['min'];?>)/1024,
				(<?php echo $config[7]['max'];?>-<?php echo $config[7]['min'];?>)/1024,
				(<?php echo $config[8]['max'];?>-<?php echo $config[8]['min'];?>)/1024,
	        	 (<?php echo $config[9]['max'];?>-<?php echo $config[9]['min'];?>)/1024,
	 			   (<?php echo $config[10]['max'];?>-<?php echo $config[10]['min'];?>)/1024,
				(<?php echo $config[11]['max'];?>-<?php echo $config[11]['min'];?>)/1024,
				(<?php echo $config[12]['max'];?>-<?php echo $config[12]['min'];?>)/1024,
	        	 (<?php echo $config[13]['max'];?>-<?php echo $config[13]['min'];?>)/1024,
	 			   (<?php echo $config[14]['max'];?>-<?php echo $config[14]['min'];?>)/1024,
				(<?php echo $config[15]['max'];?>-<?php echo $config[15]['min'];?>)/1024,
				(<?php echo $config[16]['max'];?>-<?php echo $config[16]['min'];?>)/1024,
	        	 (<?php echo $config[17]['max'];?>-<?php echo $config[17]['min'];?>)/1024,
	 			   (<?php echo $config[18]['max'];?>-<?php echo $config[18]['min'];?>)/1024,
				(<?php echo $config[19]['max'];?>-<?php echo $config[19]['min']?>)/1024];
				
				
				
	        	
	        	
	        	
				
	        	
	        	
	        	
	        	
	        	
	        	
	        	
	        	var array_length = data.length;
	        	var series = [];
	        	if (names[i] == "A0"){
	        		
	        		scale0 = (<?php echo $config[0]['max'];?>-<?php echo $config[0]['min'];?>)/1024;
	        		
	        		for (i=0; i<=array_length-1; i++){
	        			var num= Math.round(data[i].A0*scales[0] * 100) / 100;
		        		series.push([data[i].datetime*1000,data[i].A0*scales[0]]);
		        		if (data[i].A0*scales[0] > max) {
							max = data[i].A0*scales[0];
						}
					}
					var labelname = "<?php echo $config[0]['label_name'];?>";
					var units = "<?php echo $config[0]['units'];?>";
	        	}
	        	if (names[i] == "A1"){
	        		
	           		
	        		for (i=0; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A1*scales[1]]);
		        		if (data[i].A1*scales[1] > max) {
							max = data[i].A1*scales[1];
						}
					}
					var labelname = "<?php echo $config[1]['label_name'];?>";
					var units = "<?php echo $config[1]['units'];?>";
	        	}
	        	if (names[i] == "A2"){
	           		
	           		
	        		for (i=0; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A2*scales[2]]);
		        		if (data[i].A2*scales[2] > max) {
							max = data[i].A2*scales[2];
						}
					}
					var labelname = "<?php echo $config[2]['label_name'];?>";
					var units = "<?php echo $config[2]['units'];?>";
	        	}
	        	if (names[i] == "A3"){
	        		
	        		
	        		for (i=0; i<=array_length-2; i++){
		        		series.push([data[i].datetime*1000,data[i].A3*scales[3]]);
		        		if (data[i].A3*scales[3] > max) {
							max = data[i].A3*scales[3];
						}
					}
					var labelname = "<?php echo $config[3]['label_name'];?>";
					var units = "<?php echo $config[3]['units'];?>";
		           	}
		           	if (names[i] == "A4"){
	        		series = [[data[0].datetime*1000,data[0].A4]];
	        		for (i=1; i<=array_length-1; i++){

		        		series.push([data[i].datetime*1000,data[i].A4*scales[4]]);

		        		if (data[i].A4*scales[4] > max) {
							max = data[i].A4*scales[4];
						}
					}
					var labelname = "<?php echo $config[16]['label_name'];?>";
					var units = "<?php echo $config[16]['units'];?>";
	        	}
	        	if (names[i] == "A5"){
	        		series = [[data[0].datetime*1000,data[0].A5]];
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A5*scales[5]]);
		        		if (data[i].A5*scales[5] > max) {
							max = data[i].A5*scales[5];
						}
					}
					var labelname = "<?php echo $config[17]['label_name'];?>";
					var units = "<?php echo $config[17]['units'];?>";
	        	}
	        	if (names[i] == "A6"){
	           		series = [[data[0].datetime*1000,data[0].A6]];
	           		
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A6*scales[6]]);
		        		if (data[i].A6*scales[6] > max) {
							max = data[i].A6*scales[6];
						}
					}
					var labelname = "<?php echo $config[18]['label_name'];?>";
					var units = "<?php echo $config[18]['units'];?>";
	        	}
	        	if (names[i] == "A7"){
	        		series = [[data[0].datetime*1000,data[0].A7]];
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A7*scales[7]]);
		        		if (data[i].A7*scales[7] > max) {
							max = data[i].A7*scales[7];
						}
					}
					var labelname = "<?php echo $config[20]['label_name'];?>";
					var units = "<?php echo $config[20]['units'];?>";
		           	}
		           	if (names[i] == "A8"){
	        		series = [[data[0].datetime*1000,data[0].A8]];
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A8*scales[8]]);
		        		if (data[i].A8*scales[8] > max) {
							max = data[i].A8*scales[8];
						}
					}
					var labelname = "<?php echo $config[21]['label_name'];?>";
					var units = "<?php echo $config[21]['units'];?>";
	        	}
	        	if (names[i] == "A9"){
	        		series = [[data[0].datetime*1000,data[0].A9]];
	           		
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A9*scales[9]]);
		        		if (data[i].A9*scales[9] > max) {
							max = data[i].A9*scales[9];
						}
					}
					var labelname = "<?php echo $config[22]['label_name'];?>";
					var units = "<?php echo $config[22]['units'];?>";
	        	}
	        	if (names[i] == "A10"){
	           		series = [[data[0].datetime*1000,data[0].A10]];
	           		
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A10*scales[10]]);
		        		if (data[i].A10*scales[10] > max) {
							max = data[i].A10*scales[10];
						}
					}
					var labelname = "<?php echo $config[23]['label_name'];?>";
					var units = "<?php echo $config[23]['units'];?>";
	        	}
	        	if (names[i] == "A11"){
	        		series = [[data[0].datetime*1000,data[0].A11]];
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A11*scales[11]]);
		        		if (data[i].A11*scales[11] > max) {
							max = data[i].A11*scales[11];
						}
					}
					var labelname = "<?php echo $config[24]['label_name'];?>";
					var units = "<?php echo $config[24]['units'];?>";
		           	}
		           	if (names[i] == "A12"){
	        		series = [[data[0].datetime*1000,data[0].A12]];
	        		for (i=1; i<=array_length-1; i++){

		        		series.push([data[i].datetime*1000,data[i].A12*scales[12]]);

		        		if (data[i].A12*scales[12] > max) {
							max = data[i].A12*scales[12];
						}
					}
					var labelname = "<?php echo $config[25]['label_name'];?>";
					var units = "<?php echo $config[25]['units'];?>";
	        	}
	        	if (names[i] == "A13"){
	        		series = [[data[0].datetime*1000,data[0].A13]];
	           		
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A13*scales[13]]);
		        		if (data[i].A13*scales[13] > max) {
							max = data[i].A13*scales[13];
						}
					}
					var labelname = "<?php echo $config[26]['label_name'];?>";
					var units = "<?php echo $config[26]['units'];?>";
	        	}
	        	if (names[i] == "A14"){
	           		series = [[data[0].datetime*1000,data[0].A14]];
	           		
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A14*scales[14]]);
		        		if (data[i].A14*scales[14] > max) {
							max = data[i].A14*scales[14];
						}
					}
					var labelname = "<?php echo $config[27]['label_name'];?>";
					var units = "<?php echo $config[27]['units'];?>";
	        	}
	        	if (names[i] == "A15"){
	        		series = [[data[0].datetime*1000,data[0].A15]];
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A15*scales[15]]);
		        		if (data[i].A15*scales[15] > max) {
							max = data[i].A15*scales[15];
						}
					}
					var labelname = "<?php echo $config[28]['label_name'];?>";
					var units = "<?php echo $config[28]['units'];?>";
		           	}
		           	if (names[i] == "A16"){
	        		series = [[data[0].datetime*1000,data[0].A16]];
	        		for (i=1; i<=array_length-1; i++){

		        		series.push([data[i].datetime*1000,data[i].A16*scales[16]]);

		        		if (data[i].a_0*scales[0] > max) {
							max = data[i].A16*scales[16];
						}
					}
					var labelname = "<?php echo $config[29]['label_name'];?>";
					var units = "<?php echo $config[29]['units'];?>";
	        	}
	        	if (names[i] == "A17"){
	        		series = [[data[0].datetime*1000,data[0].A17]];
	           		
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A17*scales[17]]);
		        		if (data[i].A17*scales[17] > max) {
							max = data[i].A17*scales[17];
						}
					}
					var labelname = "<?php echo $config[30]['label_name'];?>";
					var units = "<?php echo $config[30]['units'];?>";
	        	}
	        	if (names[i] == "A18"){
	           		series = [[data[0].datetime*1000,data[0].A18]];
	           		
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A18*scales[18]]);
		        		if (data[i].A18*scales[18] > max) {
							max = data[i].A18*scales[18];
						}
					}
					var labelname = "<?php echo $config[31]['label_name'];?>";
					var units = "<?php echo $config[31]['units'];?>";
	        	}
	        	if (names[i] == "A19"){
	        		series = [[data[0].datetime*1000,data[0].A19]];
	        		for (i=1; i<=array_length-1; i++){
		        		series.push([data[i].datetime*1000,data[i].A19*scales[19]]);
		        		if (data[i].A19*scales[19] > max) {
							max = data[i].A19*scales[19];
						}
					}
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
	            	 
	            	
	            	
	            	
	            	
	            	
	                createChart(serialsOptions);
	            }
	        });
	    });
	function createChart(serialsOptions){
		
		
		
		
	    	sorted = _.sortBy(serialsOptions, 'name');
	    	serialsOptions = sorted;
	    	console.log('serialis_options',serialsOptions);
	    	console.log('test date', Date("October 13, 2014 11:13:00").toString());
	    	
	    	
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
	                  return '<span>'+this.series.name+'</span>: <b>'+Highcharts.numberFormat((this.y),2,'.')
	                  +'</b> @ '+ new Date(this.x);
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
	            	min: <?php echo $min_date;?>*1000,
	            	
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
	

</script>
<?php 
<script>

setInterval(function () {
		
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
								
								 
									
								 
								 
								 
								 
								 
								 
								 
								 
								 
								             refresh_page();
								 
								 
								 
								 
								 
				 
				 
			  
			  
			  
			  
			  
	    
	    
	    
	    
	    
 }, 10000);
</script>
<script>



































































































































































































































































































































































































































































































































































































































































































































































































</script>
<script>

















</script>
<div id="dialogIE" title="IE not supported." >
			  <p><b>This application will not work on Internet Explorer. Please download and use google chrome or modzilla firefox to use this application. </b></p>
		  </div>
		 <script>
		  $(function() {
		  	
		  	
		  	
		  	
		    $("#dialogIE").dialog({
		        autoOpen: false,
		        height: 275,
		        width: 300,
		        show: {
			        effect: "blind",
			        duration: 1000
			      },
			    hide: {
			        effect: "explode",
			        duration: 2000
			      },
			      modal:true,
 				
 				
				buttons: {
				        'Close' : function() {
				            $(this).dialog('close');
				        }
				    }
        				
		        
		    });
		   	useragent = '<?php echo $useragent;?>';
		   	
		 
		 
		  if (/MSIE/.test(useragent)){
		  	var options = {
			    autoOpen: false,
		        height: 225,
		        width: 750,
 				
 				buttons: {
				        'Close' : function() {
				            $(this).dialog('close');
				        }
				    }
 				
			};
		  	var myDialog = $("#dialogIE").dialog(options);
		  	
		  	
			myDialog.dialog('open');
			myDialog.dialog( "option", "position", { my: 'top', at: 'top+150' } );
			
		  } else {
		  	
		  }
		});
		  </script>
