<h2> Table of All EMAILS SENT  </h2>
<a href="<?php echo base_url('setup_users');?>">Back</a> 
<!-- <div id="search">
		<h2>Search Sender Id:</h2>
		<input type="text" id="search_box" placeholder="Type to search">
</div>   -->
<?php // print_r($config); ?>
<div id="wrold-table">
	<table id="my-wrold-table">
		<thead>
			<tr>
			<th> Sender ID </th>
			<th> Datetime </th>
			<th> to </th>
			<th> from </th>
			<th> subject </th>		
						<th> message </th>
			<th> type </th>
						<th> value </th>
									<th> threshold</th>	
											<th> direction </th>	
													<th> reset</th>
					</tr>
 		</thead>
 		<tbody>
 		<?php if (isset($email)){  ?>
	 		<?php $i = count($email); ?>
			<?php foreach ($email as $email) { ?>
			<tr>
				<td id="hello-wrold"> <?php echo $email['sender_id'] ?> </td>
				<td> <?php echo $email['datetime']; ?></td>
	 			<td> <?php echo $email['to']; ?> </td>
	 			<td> <?php echo $email['from']; ?> </td>
	 			<td> <?php echo $email['subject']; ?> </td>
	 			<td> <?php echo $email['message']; ?> </td>
	 			<td> <?php echo $email['type']; ?> </td>
	 			<td> <?php echo $email['value']; ?> </td>
	 			<td> <?php echo $email['threshold']; ?> </td>
	 			<td> <?php echo $email['direction']; ?> </td>
	 			<td> <?php echo $email['reset_level']; ?> </td>

			</tr>
			<?php } ?>
		<?php } else { echo "no messages"; } ?>
	</tbody>
	</table>
</div>

<script> 
	// var $rows = $('#my-wrold-table tr');
	// $('#search_box').keyup(function() {
	//     var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase().toString();
	//     //val = val.tostring();
	//     console.log(typeof val);
	//     $rows.show().not('thead tr').filter(function() {
	//         var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
	//         return !~text.indexOf(val);
	//     }).hide();
	// });
</script>

<!--  	<button name='clear all' onclick="clear_all()">Clear All</button>
 --> 