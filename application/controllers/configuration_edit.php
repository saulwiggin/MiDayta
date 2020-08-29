<!-- <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>configuration table</title> 
</head>
<body> --> 
<!-- 	<h1> Hi, Welcome to your Data.me </h1>
 -->	
<?php //print_r($config); ?>
<?php// print_r($machine_name); ?>
<?php //print_r($username);  ?>
 <h2>Configuration Page</h2>
	<a href="#" id="contactUs">Help Button</a>  
		<p> <form action="<?php echo base_url('/rawdata'); ?>" method="get">
	<button id="logout" padding="150px"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Display Data </button>
	<p class="testp"></p>
	</form> 
                 
	<div id="dialog" title="Contact form">
	    <p>In this section you can configuration how you want your data to be displayed. Here you can configure your dashboard. To change these to align with your desired
			units input max and min values along with what the units are as well as what you want to call the input. Min and max values can
			be set for digital inputs.</p>
			<p> These inputs belong to datalogger <?php echo $machine_name[0]['machine_name']; ?> and user <?php echo $username;?>. </p>
	</div>
	<script>
	$(function() {
	  // this initializes the dialog (and uses some common options that I do)
	  $("#dialog").dialog({autoOpen : false, modal : true, show : "blind", hide : "blind"});

	  // next add the onclick handler
	  $("#contactUs").click(function() {
	    $("#dialog").dialog("open");
	    return false;
	  });
	});
	</script>
	<p> <form action="<?php echo base_url('User/login'); ?>" method="get">
	<button id="logout" padding="150px"> Logout </button>
	<p class="testp"></p>
	</form> 
	<script>
	function configure_dashboard(){
		$.ajax({
	            type: 'POST',
	            url: '<?php echo base_url();?>display/scaling',
	            data: $('configuration_table').serialize(),
	            success: function (res) {
	              if (res){
						// Show Entered Value
						console.log('succesful', number);
						}
				},
				 error: function(e) {
					//called when there is an error
					console.log(e.message);
				  }
	        });
		window.location="<?php base_url();?>display/scaling";
	}

	function number_of_inputs(){
		number = $('#number_inputs').val();
		$.ajax({
		  type: 'POST',
		  url: '<?php echo base_url();?>/configure_dashboard',
		  data: {'number': number},
		  success: function(res) {
			if (res){
				console.log('succesful', number);
				}
			}
		});
	}
	
	</script>
	<?php //for ($i=0; $i=count($config);$i++){ ?>
	<?php // print_r($config); ?>
	<?php //} ?>
<form name="configure_input_form" action="<?php echo base_url(); ?>configure_dashboard/add_labels" method="post">
	<table class="table"id="inputs_table"style="float:left;	border: 6px groove black;">
		<thead><tr><th>Name</th><th>Chart Name</th><th>Trigger Direction</th><th>Reset Level</th>
			<th>Alarm Threshold	</th>		
					<!-- <th>Alarm Threshold 2</th> -->
			<!-- <th>Chart Type</th> --><th>Units</th><th>Min</th><th>Max</th><th>Is Charted?</th></tr>
		</thead>
		<tbody>
			<?php $count=count($config); ?>
			<?php for ($i=0; $i < $count; $i++){ ?>
			<tr><td>
					<div class="col-md-2">
						<?php echo $config[$i]['name'];?>
						<span name="name<?php echo $i;?>" id="name<?php echo $i;?>" value="<?php echo $config[$i]['name'];?>"></span>
					</div>
				</td>
				<td>
					<div class="col-md-2">
						<input size="8"name="label<?php echo $i;?>" type="text" id="label<?php echo $i;?>" value="<?php echo $config[$i]['label_name'];?>">
					</div>
				</td>
				<td>
				<input type="checkbox" style="margin:10px;"name="direction<?php echo $i;?>" id="direction<?php echo $i;?>"value="1">
				<script>
				    var direction = <?php echo $config[$i]['direction'];?>;
				    	if (direction === 1){
					        $("#direction<?php echo $i;?>").attr("checked", "checked");
				    	}
				</script>
				</td>
				<td>
					<div class="col-md-2">
						<input size="4" name="reset<?php echo $i;?>" type="text" id="reset<?php echo $i;?>"
						placeholder="####" 
						value="<?php echo $config[$i]['reset_level'];?>">
					</div>
				</td>
				<td>
					<?php if($config[$i]['type'] != "digital"){ ?>
					<div class="col-md-2" id="thislist">
						<!-- <ul id="thresholdlist">
							 	<li style="display: inline;"class="form-inline" id="threshold1" name="threshold1"> <?php echo $config[$i]['threshold'];?><label class="form-inline">Hi to Lo</label><input class="form-control" id="direction1" name="direction1"type="checkbox"></input><input class="form-control" id="reset1" name="reset1"size="8"type="text"></input><label class="form-inline">Reset Level</label></li>
							 	<li style="display: inline;"class="form-inline" id="threshold2"name="threshold2"> <?php echo $config[$i]['threshold2'];?><label class="form-inline">Hi to Lo<input class="form-control" id="direction2" name="direction2"type="checkbox"></input><input class="form-control" id="reset2" name="reset2"size="8"type="text"></input></label><label class="form-inline">Reset Level</label></li>
							 	<li style="display: inline;"class="form-inline" id="threshold3"name="threshold3"> <?php echo $config[$i]['threshold3'];?><label class="form-inline">Hi to Lo<input class="form-control"id="direction3" name="direction3"type="checkbox"></input><input class="form-control"id="reset3" name="reset3"size="8"type="text"></input></label><label class="form-inline">Reset Level</label></li>
							 	<li style="display: inline;"class="form-inline" id="threshold4"name="threshold4"> <?php echo $config[$i]['threshold4'];?><label class="form-inline">Hi to Lo<input class="form-control"id="direction4"name="direction4" type="checkbox"></input><input class="form-control"id="reset4" name="reset4"size="8"type="text"></input></label><label class="form-inline">Reset Level</label></li>
							 	<li style="display: inline;"class="form-inline" id="threshold5"name="threshold5"> <?php echo $config[$i]['threshold5'];?><label class="form-inline">Hi to Lo<input class="form-control"id="direction5"name="direction5" type="checkbox"></input><input class="form-control"id="reset5" name="reset5"size="8"type="text"></input></label><label class="form-inline">Reset Level</label></li>
							 	<li style="display: inline;"class="form-inline" id="threshold6"name="threshold6"> <?php echo $config[$i]['threshold6'];?><label class="form-inline">Hi to Lo<input class="form-control"id="direction6" name="direction6"type="checkbox"></input><input class="form-control"id="reset6" name="reset6"size="8"type="text"></input></label><label class="form-inline">Reset Level</label></li>
						</ul> -->
						<input size="4" id="threshold<?php echo $i;?>" name="threshold<?php echo $i;?>" type="text" id="threshold<?php echo $i;?>"
						placeholder="<?php if ($config[$i]['type'] == 'digital'){ echo "HI/LO"; } else {echo "####";}?>" 
						value="<?php echo $config[$i]['threshold'];?>">
						<!-- <button type="button"id ="button<?php echo $i;?>" onclick="add_li();">Add</button>
						<button type="button" onclick="remove_li()">Remove</button> -->
					</div>
					<script>
					//$('button<?php echo $i;?>').on('click', function(){
					function add_li(){
						console.log('button clicked');
						var list = document.getElementById('thislist');
						var threshold = document.getElementById('threshold<?php echo $i;?>').value;
						console.log(threshold);
						var newentry = document.createElement('li');
						newentry.appendChild(document.createTextNode(threshold));
						list.appendChild(newentry);
						$('#thresholdlist li:last').append('<input class="form-control" id="direction" type="checkbox"></input><input class="form-control" id="reset1" size="8"type="text"></input>');
						    //alert('brap');
							 input = $('#threshold<?php echo $i;?>').val();
							 threshold_1 = <?php echo $config[$i]['threshold'];?>;
							 threshold_2 = <?php echo $config[$i]['threshold2'];?>;
							 threshold_3 = <?php echo $config[$i]['threshold3'];?>;
							 threshold_4 = <?php echo $config[$i]['threshold4'];?>;
							 threshold_5 = <?php echo $config[$i]['threshold5'];?>;
							 threshold_6 = <?php echo $config[$i]['threshold6'];?>;
							 console.log(threshold_1);
							 console.log(threshold_2);
							 console.log(threshold_3);
							 console.log(threshold_4);
							 console.log(threshold_5);
							 console.log(threshold_6);
							// $('#list ul').append('<li></li>');
							// $("#thislist ul").append('<li>'+input+'<input id="direction<?php echo $i;?>" type="checkbox"></li>');
					//})}
					}
					function remove_li(){
						td = <?php echo $i;?>;
						console.log(td);
							val = $('#threshold<?php echo $i;?>').val();
							console.log(val);
							//$('#list ul').remove(":contains('"+ val + "')");
							//$('div:contains("'+val+'")').css('background-color', 'red');
							$('#list li:last').remove();
						 };
						 function stuffhiddenvalues(){
							$('#thislist ul.selector li')
								.each(function(i) {
									$("<input name='threshold-"+ i +"'>")
									.val($(this).html())
									.appendTo('form.selector');
									$("<input name='direction-"+ i +"'>")
									.val($(this).html())
									.appendTo('form.selector');
									$("<input name='reset-"+ i +"'>")
									.val($(this).html())
									.appendTo('form.selector');
								}
							}
					</script>
					<?php } else { ?>
					<div class="checkbox">
						<label class="form-control" style="width:55%;">
							<input style="margin:5px;"type="checkbox" name="HI<?php echo $i;?>" id="HI<?php echo $i;?>"value="1">Hi</label>
					</div>
					<div class="checkbox">
						<label class="form-control" style="width:55%;">
							<input style="margin:5px;" type="checkbox" name="LO<?php echo $i;?>" id="LO<?php echo $i;?>"value="1">Lo</label>
					</div>
					<script>
				    var HI = <?php echo $config[$i]['HI'];?>;
				    	if (HI === 1){
					        $("#HI<?php echo $i;?>").attr("checked", "checked");
				    	}
				    var LO = <?php echo $config[$i]['LO'];?>;
				    	if (LO === 1){
					        $("#LO<?php echo $i;?>").attr("checked", "checked");
				    	}
					</script>
					<?php } ?>
				</td>
<!-- 				<td>
					<div class="col-md-2">
						<input size="4" name="threshold2<?php echo $i;?>" type="text" id="threshold2<?php echo $i;?>"
						placeholder="<?php if ($config[$i]['type'] == 'digital'){ echo "HI/LO"; } else {echo "###";}?>" 
						value="<?php echo $config[$i]['threshold2'];?>">
					</div>
				</td> -->
<!-- 				<td><select name="type<?php echo $i;?>" id="type<?php echo $i;?>"> <option value="1">Button</option>
											 <option  value="2">Tank</option>
											 <option  value="3">Dial</option>
											 <option  value="4">Chart</option>
											 <option  value="5">Table</option>
										</select> </td> -->
				<td>
					<?php if($config[$i]['type'] != "digital"){ ?>
					<select name="units<?php echo $i;?>" id="units<?php echo $i;?>">
						<option value="meter">Meter</option>
						<option value="kilogram">Kilogram</option>
						<option value="second">Second</option>
						<option value="ampere">Ampere</option>
						<option value="kelvin">Kelvin</option>
						<option value="mole">Mole</option>
						<option value="candle">Candle</option>
						<option value="radian">Radian</option>
						<option value="steradian">Steradian</option>
						<option value="hertz">Hertz</option>
						<option value="newton">Newton</option>
						<option value="pascal">Pascal</option>
						<option value="joule">Joule</option>
						<option value="watt">Watt</option>
						<option value="celsius">Celsius</option>
						<option value="coulomb">Coulomb</option>
						<option value="volt">Volt</option>
						<option value="ohm">Ohm</option>
						<option value="siemens">Siemens</option>
						<option value="farad">Farad</option>
					</select>
					<?php } ?>
					<?php //echo $config[$i]['units'];?>
				</td>
<!-- 					<input size="15" name="units<?php echo $i;?>" type="text" id="units<?php echo $i;?>"value="<?php echo $config[$i]['units'];?>"></td>
 --><!-- 				<td>

					<div id="slider_range<?php echo $i;?>"style="width:200px"></div>
					<?php if($config[$i]['type'] != "digital"){ ?>
					<script>
					$("#slider_range<?php echo $i;?>").slider({
						range:true,
					    min: 0,
      					max: 500,
						values: [ <?php echo $config[$i]['min'];?>, <?php echo $config[$i]['max'];?> ]
					});
					$('#slider_range<?php echo $i;?>').change(function(e, ui) {
    					$('#min<?php echo $i;?>').val('value', ui.value);
    					$('#max<?php echo $i;?>').val('value', ui.value);
					});		
					</script>
					<input hidden size="5"name="min<?php echo $i;?>" type="text" id="min<?php echo $i;?>"value="<?php echo $config[$i]['min'];?>">
					<input hidden size="5"name="max<?php echo $i;?>" type="text" id="max<?php echo $i;?>"value="<?php echo $config[$i]['max'];?>">
					<?php } else { ?>
 					<label>Min</label><input size="5"name="min<?php echo $i;?>" type="text" id="min<?php echo $i;?>"value="<?php echo $config[$i]['min'];?>">
					<label>Max</label><input size="5"name="max<?php echo $i;?>" type="text" id="max<?php echo $i;?>"value="<?php echo $config[$i]['max'];?>">
					<?php } ?>
 				</td> -->
				<td>
					<?php if($config[$i]['type'] != "digital"){ ?>
					<input style="margin:5px;"size="5"name="min<?php echo $i;?>" type="text" id="min<?php echo $i;?>"value="<?php echo $config[$i]['min'];?>">
					<div id="slider_min<?php echo $i;?>"style="width:100px"></div>
					<script>
					$("#slider_min"+<?php echo $i;?>+"").slider({
						min:-512,
						max:512,
						value: 100,
						slide: function(event, ui){
							$('#min'+<?php echo $i;?>+'').val(ui.value);
						}
					});
					</script>
					<?php } elseif ($config[$i]['type'] == "counter"){?>
					<script>
						$("#slider_min"+<?php echo $i;?>+"").slider({
						min:-5000,
						max:5000,
						value: 100,
						slide: function(event, ui){
							$('#min'+<?php echo $i;?>+'').val(ui.value);
						}
					});
					</script>
					<?php } ?>
				</td>
				<td>
					<?php if($config[$i]['type'] != 'digital'){ ?>
					<input style="margin:5px;"size="5"name="max<?php echo $i;?>" type="text" id="max<?php echo $i;?>"value="<?php echo $config[$i]['max'];?>">
					<div id="slider_max<?php echo $i;?>"style="width:100px"></div>
					<script>
					$("#slider_max"+<?php echo $i;?>+"").slider({
						min:-512,
						max:512,
						value: 100,
						slide: function(event, ui){
							$('#max'+<?php echo $i;?>+'').val(ui.value);
						}
					});
					</script>
					<?php } else {?>
					<script>
						$("#slider_max"+<?php echo $i;?>+"").slider({
						min:-5000,
						max:5000,
						value: 100,
						slide: function(event, ui){
							$('#max'+<?php echo $i;?>+'').val(ui.value);
						}
					});
					</script>
					<?php } ?>
				</td>
				<td>
					<input type="checkbox" style="margin:10px;"name="is_graphed<?php echo $i;?>" id="is_graphed<?php echo $i;?>"value="1">
				<script>
				    var charted = <?php echo $config[$i]['is_graphed'];?>;
				    	if (charted === 1){
					        $("#is_graphed<?php echo $i;?>").attr("checked", "checked");
				    	}
				</script>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>	
	<hr>

<button type="submit">Update configuration!</button>

</form>

<!-- </body>
 -->
<?php $count = count($config); ?>
<script>
	$("#inputs_table tr").click(function(){
		$(this).toggleClass("highlight");
	});
	window.onload = function(){ 
		//for (i=0; i=<?php echo $count;?>; i++){
			// document.getElementById("name0").value='<?php echo $config[0]['name'];?>';
			// document.getElementById("label0").value='<?php echo $config[0]['label_name'];?>';
			// document.getElementById("threshold0").value='<?php echo $config[0]['threshold'];?>';
			// document.getElementById("type0").value='<?php echo $config[0]['display_type'];?>';
			// document.getElementById("units0").value='<?php echo $config[0]['units'];?>';
			// document.getElementById("scaling0").value='<?php echo $config[0]['scaling_factor'];?>';
		// //}

		// 	if (document.getElementById("type0").val = 3){
		// 		console.log("dial is selected" +document.getElementById("type0").val);
		// 		document.getElementById("dial").style.display = "show";
		// 	}
	}
	// $(function() {
	//      $('#inputs_table').find('tr').each(
	//         function() {
	//           $(this).css('background', '#FFFFFF');  
	//         });
	// });

	</script>
	<script>
		var val = "kelvin";
		var str0 = "<?php echo $config[0]['units'];?>";
		var str1 = "<?php echo $config[1]['units'];?>";
		var str2 = "<?php echo $config[2]['units'];?>";
		var str3 = "<?php echo $config[3]['units'];?>";
		var str4 = "<?php echo $config[4]['units'];?>";
		var str5 = "<?php echo $config[5]['units'];?>";
		var str6 = "<?php echo $config[6]['units'];?>";
		var str7 = "<?php echo $config[7]['units'];?>";
		var str8 = "<?php echo $config[8]['units'];?>";
		var str9 = "<?php echo $config[9]['units'];?>";
		var str10 = "<?php echo $config[10]['units'];?>";
		var str11 = "<?php echo $config[11]['units'];?>";
		var str12 = "<?php echo $config[12]['units'];?>";
		var str13 = "<?php echo $config[13]['units'];?>";
		var str14 = "<?php echo $config[14]['units'];?>";
		var str15 = "<?php echo $config[15]['units'];?>";
		var str16 = "<?php echo $config[16]['units'];?>";
		var str17 = "<?php echo $config[17]['units'];?>";
		var str18 = "<?php echo $config[18]['units'];?>";
		var str19 = "<?php echo $config[19]['units'];?>";
		var str20 = "<?php echo $config[20]['units'];?>";
		var str21 = "<?php echo $config[21]['units'];?>";
		var str22 = "<?php echo $config[22]['units'];?>";
		var str23 = "<?php echo $config[23]['units'];?>";
		var str24 = "<?php echo $config[24]['units'];?>";
		var str25 = "<?php echo $config[25]['units'];?>";
		var str26 = "<?php echo $config[26]['units'];?>";
		var str27 = "<?php echo $config[27]['units'];?>";
		var str28 = "<?php echo $config[28]['units'];?>";
		var str29 = "<?php echo $config[29]['units'];?>";
		var str30 = "<?php echo $config[30]['units'];?>";
		var str31 = "<?php echo $config[31]['units'];?>";
		var str32 = "<?php echo $config[32]['units'];?>";
		var units =[];
		console.log(str0);
				console.log(str1);

		// <?php 
		// for ($i=0; $i<20; $i++){ 
		// 	$units = $config[$i]['units'];
		// } ?>
		//var str = <?php echo $config[$i]['units'];?>
		console.log(val);
		console.log(units);
		$("#units0").val(str0);
		$("#units1").val(str1);
		$("#units2").val(str2);
		$("#units3").val(str3);
		$("#units4").val(str4);
		$("#units5").val(str5);
		$("#units6").val(str6);
		$("#units7").val(str7);
		$("#units8").val(str8);
		$("#units9").val(str9);
		$("#units10").val(str10);
		$("#units11").val(str11);
		$("#units12").val(str12);
		$("#units13").val(str13);
		$("#units14").val(str14);
		$("#units15").val(str15);
		$("#units16").val(str16);
		$("#units17").val(str17);
		$("#units18").val(str18);
		$("#units19").val(str19);
		$("#units20").val(str20);
		$("#units21").val(str21);
		$("#units22").val(str22);
		$("#units23").val(str23);
		$("#units24").val(str24);
		$("#units25").val(str25);
		$("#units26").val(str26);
		$("#units27").val(str27);
		$("#units28").val(str28);
		$("#units29").val(str29);
		$("#units30").val(str30);
		$("#units31").val(str31);
		$("#units32").val(str32);
	</script>
<!-- 
</html>