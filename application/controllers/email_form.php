<div id="email-form" style="margin:100px;">
	<a href="<?php echo base_url();?>rawdata">Return to dashboard</a>
	<?php // print_r($alarm_table); ?>
	<?php //print_r($users); ?>
	<?php // print_r($devices); ?>
	<?php //print_r($config); ?>
	<h1> Alarm Table </h1>
	<p> This email is sent whenever a analogue or counter or digital input which is set to feature an alarm either crosses a 
		threshold or goes to the alarm setting. the message will automatically contain details of which alarm name this is
		to the sender you specify below with a message contained below. </p>
	
	<!-- <p> Available Alarms: 
			<form method="post">
				<select id="devices_dropdown" name="devices_dropdown">
				<?php for ($i =0; $i<count($alarm_table); $i++){ ?> 
					<?php echo "<option value=".$i.">".$alarm_table[$i]['subject']."</option>";?>
				<?php } ?>
				<select>
				<button type="submit" value="refresh" name='refresh' onclick='get_user_info()'>Refresh</button>
 				<button type="button" name='Clear Fields' onclick='clear_fields()'>Clear Fields </button></p>
		</form>
	 	<hr>
	</p>  -->
	<form method="POST" action="<?php echo base_url();?>sendreport/submit">

<!-- 		<div> 
		<h2> User ID </h2> 
			<input size="25" type="text" name="user_id" id="user_id" value="<?php echo $alarm_table['user_id'];?>"> 
		</div>	
		<div>
		<h2> Sender ID </h2> 
			<input size="25" type="text" name="sender_id" id="sender_id" value="<?php echo $alarm_table['sender_id'];?>"> 
		</div> -->
		<div>
		<h2> From </h2> 
			<input size="50" type="text" name="from" id="from" value="<?php echo $alarm_table['from'];?>"> 
		</div>
		<div> 
		<h2> To</h2> 
			<input size="50" type="text" name="to" id="to" value="<?php echo $alarm_table['to'];?>"> 
		</div>
				<!-- <div> 
		<h2> Email 2</h2> 
			<input size="50" type="text" name="email2" id="email2" value="<?php echo $alarm_table['email2'];?>"> 
		</div>
				<div> 
		<h2> Email 3</h2> 
			<input size="50" type="text" name="email3" id="email3" value="<?php echo $alarm_table['email3'];?>"> 
		</div>
				<div> 
		<h2> Email 4</h2> 
			<input size="50" type="text" name="email4" id="email4" value="<?php echo $alarm_table['email4'];?>"> 
		</div>
				<div> 
		<h2> Email 5</h2> 
			<input size="50" type="text" name="email5" id="email5" value="<?php echo $alarm_table['email5'];?>"> 
		</div>
				<div> 
		<h2> Email 6</h2> 
			<input size="50" type="text" name="email6" id="email6" value="<?php echo $alarm_table['email6'];?>"> 
		</div> -->

				<div> 
				<h2> Subject </h2> 
					<input size="50"type="text" name="subject" id="subject" value="<?php echo $alarm_table['subject']; ?>"> 
				</div>
				<div> 

<!-- 		<div> 
		<h2> Alarm </h2> 
			<input size="50"type="text" name="alarm" id="alarm" value="<?php echo $alarm_table['alarm']; ?>"> 
		</div> -->

		<div> 
		<h2> Alarm Name </h2> 
			<input size="50"type="text" name="alarm_name" id="alarm_name" value="<?php echo $alarm_table['alarm_name']; ?>"> 
		</div>

		<h2> Message </h2> 
			<textarea cols="100" rows="10" name="message" id="message"value="<?php echo "big tatty bo";?>"></textarea> 
		</div>

		<!-- <p> Email this to all? </p>
		<input type="checkbox" name="email_all" value="<?php echo $alarm_table['email_all'];?>"> </br> -->
	<div id="list">
		<?php //echo $email; ?>
			<!-- <input type="text" placeholder="email" id="addemail" name="addemail">
			<button type="button" onclick="function1()">Add</button>
			<hr> -->
			<h2> User List </h2>
			<ul id="list">
			<li id="element1" value="<?php echo $email;?>"><em></em></li>
			<li id="element2"value="<?php echo $email2;?>"><em></em></li>
			<li id="element3" value="<?php echo $email3;?>"><em></em></li>
			</ul>
		</div> 
		<br>
		<button type="submit">Update!</button>
<!-- 		<button type="submit" value="add_alarm" name='add_alarm' onclick=''>Add</button>
 -->	</form>
</div>
<script>
function function1() {
    var ul = document.getElementById("list");
    var li = document.createElement("li");
    var children = ul.children.length + 1
    var input = $('#addemail').val();
    console.log(input);
    li.setAttribute("id", "element"+children)
    li.appendChild(document.createTextNode(input));
    ul.appendChild(li)
}
$(document).ready(function(){
    document.getElementById("message").value = "<?php echo $alarm_table['message'];?>";
    document.getElementById("from").value = "<?php echo $alarm_table['from'];?>";
    document.getElementById("to").value = "<?php echo $alarm_table['to'];?>";
});
</script>