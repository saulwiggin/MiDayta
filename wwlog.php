<?php
	$owner = 'ww';
 	$db = mysql_connect("localhost:3306", "root", "Ye8u27i6WI");
	mysql_select_db("warwick",$db);
 	if (isset($_REQUEST['c']))
 	{
  		$c = $_REQUEST['c'];
		// print_r($c);
		// echo '<br>';
		$ip = $_SERVER['REMOTE_ADDR'];
        $c_array = str_getcsv($c);

		// trim and uppercase the variables
		foreach ($c_array as &$value)
		{
			$value = strtoupper(trim($value));
		}

        $sender_id = $c_array[0];
		$err = '';

		// get previously added string
		$result = mysql_query("SELECT command from Incoming order by idx desc limit 1;",$db);
 		$last_string = mysql_result($result,0);
 		$last_array_explode = explode(",",$last_string);
 		$array_no_date = array_slice($last_array_explode, 4);
 		$last_csv_string_no_date = implode(',',$array_no_date);
  		//print_r('last string='.$last_csv_string_no_date."</br>");
  		$c_array_no_date = array_slice($c_array,4);
		$this_string_no_date = implode(",",$c_array_no_date);
		//print_r('this string ='.$this_string_no_date."</br>");

		//add date at this point. Date from X91000 can not be trusted.
		$c_array[1] = date("Y-m-d H:i:s");
		// echo $c_array[1];
		// echo '<br>';
		// echo validateDate($c_array[1]);
		// echo '<br>';
		// echo count($c_array);
		//validation. Added by RB, Igris Ltd on 17 Dec 2016 to ensure clean data only enters the system
		// ONE OFF EDIT FOR LONDON CLIMATE HIRE
		if($c_array[19] == "NORMAL"){
			$c_array[19] = "HI";
		}
		if($c_array[19] == "FAIL"){
			$c_array[19] =  "LO";
		}
		//print_r($c_array);
		if (
			(count($c_array) == 36)
			&& (strlen($c_array[0]) <= 11)
			//&& (validateDate($c_array[1]))
			&& ($c_array[2] == "SG")
			&& (strlen($c_array[3]) <= 3) && (preg_match('/^[0-9]*$/',$c_array[3]))
			&& ($c_array[4] == "D0")
			&& (($c_array[5] == "HI") || ($c_array[5] == "LO") || ($c_array[5] == ""))
			&& ($c_array[6] == "D1")
			&& (($c_array[7] == "HI") || ($c_array[7] == "LO") || ($c_array[7] == ""))
			&& ($c_array[8] == "D2")
			&& (($c_array[9] == "HI") || ($c_array[9] == "LO") || ($c_array[9] == ""))
			&& ($c_array[10] == "D3")
			&& (($c_array[11] == "HI") || ($c_array[11] == "LO") || ($c_array[11] == ""))
			&& ($c_array[12] == "D4")
			&& (($c_array[13] == "HI") || ($c_array[13] == "LO") || ($c_array[13] == ""))
			&& ($c_array[14] == "D5")
			&& (($c_array[15] == "HI") || ($c_array[15] == "LO") || ($c_array[15] == ""))
			&& ($c_array[16] == "D6")
			&& (($c_array[17] == "HI") || ($c_array[17] == "LO") || ($c_array[17] == ""))
			&& ($c_array[18] == "D7")
			&& (($c_array[19] == "HI") || ($c_array[19] == "LO") || ($c_array[19] == ""))
			&& ($c_array[20] == "A0")
			&& (strlen($c_array[21]) <= 6) && (preg_match('/^[0-9]*$/',$c_array[21]))
			&& ($c_array[22] == "A1")
			&& (strlen($c_array[23]) <= 6) && (preg_match('/^[0-9]*$/',$c_array[23]))
			&& ($c_array[24] == "A2")
			&& (strlen($c_array[25]) <= 6) && (preg_match('/^[0-9]*$/',$c_array[25]))
			&& ($c_array[26] == "A3")
			&& (strlen($c_array[27]) <= 6) && (preg_match('/^[0-9]*$/',$c_array[27]))
			&& ($c_array[28] == "C0")
			&& (strlen($c_array[29]) <= 15) && (preg_match('/^[0-9]*$/',$c_array[29]))
			&& ($c_array[30] == "C1")
			&& (strlen($c_array[31]) <= 15) && (preg_match('/^[0-9]*$/',$c_array[31]))
			&& ($c_array[32] == "C2")
			&& (strlen($c_array[33]) <= 15) && (preg_match('/^[0-9]*$/',$c_array[33]))
			&& ($c_array[34] == "C3")
			&& (strlen($c_array[35]) <= 15) && (preg_match('/^[0-9]*$/',$c_array[35]))
			// validate that string not exactly the same as previous one.
			&& ($last_csv_string_no_date != $this_string_no_date)
		)
		{
			// accept data if valid
			$result = mysql_query("INSERT into Incoming (messtype,ip,command,owner,added) values ('IN','$ip','$c','" . $owner . "',0)",$db);
			if ($result){
				echo 'successfull';
				print_r($result);
				if ($c != "Ack")
				{
					$query = "SELECT D0OUT from digital_outputs WHERE sender_id = '".$sender_id."';";
				    $result1= mysql_query($query, $db);

					$result2= mysql_query("SELECT D1OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
					$result3= mysql_query("SELECT D2OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
					$result4= mysql_query("SELECT D3OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
					$result5= mysql_query("SELECT D4OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
					$result6= mysql_query("SELECT D5OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
					$result7= mysql_query("SELECT D6OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
					$result8= mysql_query("SELECT D7OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);

					echo '#'.'D0,'. mysql_result($result1, 0). ',D1,'. mysql_result($result2, 0). ',D2,'. mysql_result($result3, 0) . ',D3,'. mysql_result($result4, 0). ',D4,'. mysql_result($result5, 0). ',D5,'. mysql_result($result6, 0).  ',D6,'. mysql_result($result7, 0). ',D7,'. mysql_result($result8, 0);
					echo ',ReceivedOK';
				}
			} elseif ($last_csv_string_no_date == $this_string_no_date) {
				echo 'identical message. Change digital input.';
				echo ',ReceivedOK';
			} else {
				echo 'failed';
				die(mysql_error());
			}
		}
		else
		{
			$err = "-Message_Format_Error";
			echo $err;
			$query = "SELECT D0OUT from digital_outputs WHERE sender_id = '".$sender_id."';";
		    $result1= mysql_query($query, $db);

			$result2= mysql_query("SELECT D1OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
			$result3= mysql_query("SELECT D2OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
			$result4= mysql_query("SELECT D3OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
			$result5= mysql_query("SELECT D4OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
			$result6= mysql_query("SELECT D5OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
			$result7= mysql_query("SELECT D6OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);
			$result8= mysql_query("SELECT D7OUT from digital_outputs WHERE sender_id = '".$sender_id."';", $db);

			echo '#'.'D0,'. mysql_result($result1, 0). ',D1,'. mysql_result($result2, 0). ',D2,'. mysql_result($result3, 0) . ',D3,'. mysql_result($result4, 0). ',D4,'. mysql_result($result5, 0). ',D5,'. mysql_result($result6, 0).  ',D6,'. mysql_result($result7, 0). ',D7,'. mysql_result($result8, 0);
}
		// end of validation

		//echo $sender_id . $err;
	   // echo 'end of script';
	}

	function validateDate($date, $format = 'y-m-d H:i:s')
	{
		$d = DateTime::createFromFormat($format, $date);
		return $d && $d->format($format); //date("y-m-d H:i:s"); //
		return $d && $d->format($format) == $date;
	}
?>
