<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_job extends CI_Controller {

	public function index(){

		$this->email();

	}

	public function test(){
		echo 'test';
	}

	// addition for AES 20/10/2017
	public function send_email_counter_24(){
		//echo 'send email counters 24 hours';

		$this->load->model('data_model','counters');
		$counters_24hours = $this->counters->get_counters_for_AES();
		//print_r($counters_24hours);

		$message = '<table><thead><th>Datetime</th><th>Sender ID</th><th>C0</th><th>C1</th><th>C2</th><th>C3</th></thead>';
		foreach($counters_24hours as $row){
			$message = $message . '<tr><td>' . $row['datestring'] . '</td><td>' . $row['sender_id'] . '</td><td>' . $row['C0'] . '</td><td>' . $row['C1'] . '</td><td>' . $row['C2'] . '</td><td>' . $row['C3'] . '</td></tr>'; 
		}
		$message = $message .'</table>';
		print_r($message);
		
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'mydatame@googlemail.com',
		    'smtp_pass' => 'aypywxtagrvlcspz',
		    'mailtype' => 'html',
		    'newline' => "\r\n"
		);
		$this->email->initialize($config);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$from = 'mydata@gmail.com';
		$this->email->from($from);
		//$to = 'saulwiggin@googlemail.com';
		$to = 'hugh.davidson@eu.jll.com';
		$this->email->to($to);
		$cc = 'TAthey@aesltd.net';
		$this->email->cc($cc);
		$subject = 'counters for the last 24 hours';
		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();

		print_r($this->email->debugger());
	}



	public function email(){

		$this->load->model('device_model');
		$all_sender_ids = $this->device_model->get_all_sender_ids();
		$limit = count($all_sender_ids);
		print_r($all_sender_ids);
		foreach ($all_sender_ids as $sender_id){
			$sender_id = $sender_id['sender_id'];

			echo '<b>'.$sender_id.'</b>'; 

			$this->load->model('input_model','conf');
			$inputs = $this->conf->get_inputs_for_sender_id($sender_id);
			$this->load->model('data_model', 'data_model');
			$last_message = $this->data_model->get_last_message_for_sender_id($sender_id);
			$last_message = $last_message[0];

			for ($i=1;$i<4;$i++){
				// alarm 1
				$name = $inputs[$i-1]['name'];
				$input_id = $inputs[$i-1]['input_id'];
				$scaleby =($inputs[$i-1]['max']-$inputs[$i-1]['min'])/1024;
				//echo 'theshold'.$inputs[$i-1]['threshold'];
				echo 'Alarm 1 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold'].'<br>reset:'.$inputs[$i-1]['reset_level'].'<br>is_on:'.$inputs[$i-1]['is_on'].'<br>direction:'.$inputs[$i-1]['direction'].'</h2><br>';
				echo 'Alarm 2 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold2'].'<br>reset:'.$inputs[$i-1]['reset2'].'<br>is_on:'.$inputs[$i-1]['is_on2'].'<br>direction:'.$inputs[$i-1]['direction2'].'</h2><br>';
				echo 'Alarm 3 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold3'].'<br>reset:'.$inputs[$i-1]['reset3'].'<br>is_on:'.$inputs[$i-1]['is_on3'].'<br>direction:'.$inputs[$i-1]['direction3'].'</h2><br>';
				echo 'Alarm 4 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold4'].'<br>reset:'.$inputs[$i-1]['reset4'].'<br>is_on:'.$inputs[$i-1]['is_on4'].'<br>direction:'.$inputs[$i-1]['direction4'].'</h2><br>';
				if ($inputs[$i]['is_email'] == 1){
					if ($inputs[$i-1]['type'] == 'analogue'){
						if ($inputs[$i-1]['threshold'] < $last_message[$name]*$scaleby){
							if ($inputs[$i-1]['is_on'] == 1){	
									if ($inputs[$i-1]['direction'] == 1){
										//echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
										$this->load->model('input_model','inp');
										echo 'Email Sent:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
									    $this->inp->turn_off($sender_id,$input_id);
									    $alarm_no = 1;
										$this->send_email($sender_id, $name, $alarm_no);
									//} else {
									//	echo $this->email->print_debugger();
									//}
										} else {
											echo $name.'direction is not pos to negative for ' . $inputs[$i-1]['direction'];
									}
								} else {
									echo '<br>alarm is not on for ' .$name;
							}
						} else { 
							echo $name . 'is too small. less than threshold'. $inputs[$i-1]['threshold']. '.At '.$last_message[$name]*$scaleby; 
						}
					} else {
						echo '<br>'.$name.'is not analogue';
					}
				} else {
					echo $name. 'not email set';
				}
				//reset analogue
				//reset levels
				if ($inputs[$i-1]['is_email'] == 1){ 
					if ($inputs[$i-1]['is_on'] == 0){
						if($inputs[$i-1]['direction'] == 1){
							echo 'name:'.$inputs[$i-1]['name'].'last_message:'.$last_message[$name]. 'reset_level'.$inputs[$i-1]['reset_level'].'direction:'.$inputs[$i-1]['direction'];
							if ($last_message[$name]*$scaleby < $inputs[$i-1]['reset_level']){
								$this->load->model('input_model','inp');
								$this->inp->turn_on($sender_id, $name);
								echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET11</h2>'.'<br>';
							} else {
								echo 'message is grt reset level with direction 1 for ' . $name;
							}
						} else { 
						echo $name. 'direction is 0'; 
						}
					} else { 
					echo $name . ' is not on';
					}
				} else {
					echo 'email not set';
				} 
			//}
			// alarm 2
				$name = $inputs[$i-1]['name'];
				$input_id = $inputs[$i-1]['input_id'];
				$scaleby =($inputs[$i-1]['max']-$inputs[$i-1]['min'])/1024;
				if ($inputs[$i]['is_email2'] == 1){
					if ($inputs[$i-1]['type'] == 'analogue'){
						if ($inputs[$i-1]['threshold2'] < $last_message[$name]*$scaleby){
							if ($inputs[$i-1]['is_on2'] == 1){	
									if ($inputs[$i-1]['direction2'] == 1){
										//echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
										$this->load->model('input_model','inp');
										echo 'Email Sent:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
									    $this->inp->turn_off2($sender_id,$input_id);
									    $alarm_no = 2;
										$this->send_email($sender_id, $name, $alarm_no);
									//} else {
									//	echo $this->email->print_debugger();
									//}
										} else {
											echo $name.'direction is not pos to negative for ' . $inputs[$i-1]['direction'];
									}
								} else {
									echo '<br>alarm is not on for ' .$name;
							}
						} else { 
							echo $name . 'is too small. less than threshold'. $inputs[$i-1]['threshold']. '.At '.$last_message[$name]*$scaleby; 
						}
					} else {
						echo '<br>'.$name.'is not analogue';
					}
				} else {
					echo $name. 'not email set';
				}
				//reset analogue
				//reset levels
				if ($inputs[$i-1]['is_email2'] == 1){ 
					if ($inputs[$i-1]['is_on2'] == 0){
						if($inputs[$i-1]['direction2'] == 1){
							//echo 'name:'.$inputs[$i-1]['name'].'last_message:'.$last_message[$name]. 'reset_level'.$inputs[$i-1]['reset_level'].'direction:'.$inputs[$i-1]['direction'];
							if ($last_message[$name]*$scaleby < $inputs[$i-1]['reset_level2']){
								$this->load->model('input_model','inp');
								$this->inp->turn_on2($sender_id, $name);
								echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET11</h2>'.'<br>';
							} else {
								echo 'message is grt reset level with direction 1 for ' . $name;
							}
						} else { 
						echo $name. 'direction is 0'; 
						}
					} else { 
					echo $name . ' is not on';
					}
				} else {
					echo 'email not set';
				} 
			//}
			// alarm 3
				$name = $inputs[$i-1]['name'];
				$input_id = $inputs[$i-1]['input_id'];
				$scaleby =($inputs[$i-1]['max']-$inputs[$i-1]['min'])/1024;
				//echo 'theshold'.$inputs[$i-1]['threshold'];
				//echo 'Alarm 1 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold'].'<br>reset:'.$inputs[$i-1]['reset_level'].'<br>is_on:'.$inputs[$i-1]['is_on'].'<br>direction:'.$inputs[$i-1]['direction'].'</h2><br>';
				//echo 'Alarm 2 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold2'].'<br>reset:'.$inputs[$i-1]['reset2'].'<br>is_on:'.$inputs[$i-1]['is_on2'].'<br>direction:'.$inputs[$i-1]['direction2'].'</h2><br>';
				//echo 'Alarm 3 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold3'].'<br>reset:'.$inputs[$i-1]['reset3'].'<br>is_on:'.$inputs[$i-1]['is_on3'].'<br>direction:'.$inputs[$i-1]['direction3'].'</h2><br>';
				//echo 'Alarm 4 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold4'].'<br>reset:'.$inputs[$i-1]['reset4'].'<br>is_on:'.$inputs[$i-1]['is_on4'].'<br>direction:'.$inputs[$i-1]['direction4'].'</h2><br>';
				if ($inputs[$i]['is_email3'] == 1){
					if ($inputs[$i-1]['type'] == 'analogue'){
						if ($inputs[$i-1]['threshold3'] < $last_message[$name]*$scaleby){
							if ($inputs[$i-1]['is_on3'] == 1){	
									if ($inputs[$i-1]['direction3'] == 1){
										//echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
										$this->load->model('input_model','inp');
										echo 'Email Sent:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
									    $this->inp->turn_off3($sender_id,$input_id);
									    $alarm_no = 3;
										$this->send_email($sender_id, $name, $alarm_no);
									//} else {
									//	echo $this->email->print_debugger();
									//}
										} else {
											Echo $name.'direction is not pos to negative for ' . $inputs[$i-1]['direction'];
									}
								} else {
									echo '<br>alarm is not on for ' .$name;
							}
						} else { 
							echo $name . 'is too small. less than threshold'. $inputs[$i-1]['threshold']. '.At '.$last_message[$name]*$scaleby; 
						}
					} else {
						echo '<br>'.$name.'is not analogue';
					}
				} else {
					echo $name. 'not email set';
				}
				//reset analogue
				//reset levels
				if ($inputs[$i-1]['is_email3'] == 1){ 
					if ($inputs[$i-1]['is_on3'] == 0){
						if($inputs[$i-1]['direction3'] == 1){
							//echo 'name:'.$inputs[$i-1]['name'].'last_message:'.$last_message[$name]. 'reset_level'.$inputs[$i-1]['reset_level'].'direction:'.$inputs[$i-1]['direction'];
							if ($last_message[$name]*$scaleby < $inputs[$i-1]['reset_level3']){
								$this->load->model('input_model','inp');
								$this->inp->turn_on3($sender_id, $name);
							//	echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET11</h2>'.'<br>';
							} else {
								echo 'message is grt reset level with direction 1 for ' . $name;
							}
						} else { 
						echo $name. 'direction is 0'; 
						}
					} else { 
					echo $name . ' is not on';
					}
				} else {
					echo 'email not set';
				} 
			//}
			// alarm 4
				$name = $inputs[$i-1]['name'];
				$input_id = $inputs[$i-1]['input_id'];
				$scaleby =($inputs[$i-1]['max']-$inputs[$i-1]['min'])/1024;
				//echo 'theshold'.$inputs[$i-1]['threshold'];
				//echo 'Alarm 1 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold'].'<br>reset:'.$inputs[$i-1]['reset_level'].'<br>is_on:'.$inputs[$i-1]['is_on'].'<br>direction:'.$inputs[$i-1]['direction'].'</h2><br>';
				//echo 'Alarm 2 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold2'].'<br>reset:'.$inputs[$i-1]['reset2'].'<br>is_on:'.$inputs[$i-1]['is_on2'].'<br>direction:'.$inputs[$i-1]['direction2'].'</h2><br>';
				//echo 'Alarm 3 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold3'].'<br>reset:'.$inputs[$i-1]['reset3'].'<br>is_on:'.$inputs[$i-1]['is_on3'].'<br>direction:'.$inputs[$i-1]['direction3'].'</h2><br>';
				//echo 'Alarm 4 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold4'].'<br>reset:'.$inputs[$i-1]['reset4'].'<br>is_on:'.$inputs[$i-1]['is_on4'].'<br>direction:'.$inputs[$i-1]['direction4'].'</h2><br>';
				if ($inputs[$i]['is_email4'] == 1){
					if ($inputs[$i-1]['type'] == 'analogue'){
						if ($inputs[$i-1]['threshold4'] < $last_message[$name]*$scaleby){
							if ($inputs[$i-1]['is_on4'] == 1){	
									if ($inputs[$i-1]['direction4'] == 1){
										//echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
										$this->load->model('input_model','inp');
										echo 'Email Sent:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name;
									    $this->inp->turn_off4($sender_id,$input_id);
									    $alarm_no = 4;
										$this->send_email($sender_id, $name, $alarm_no);
									//} else {
									//	echo $this->email->print_debugger();
									//}
										} else {
											echo $name.'direction is not pos to negative for ' . $inputs[$i-1]['direction'];
									}
								} else {
									echo '<br>alarm is not on for ' .$name;
							}
						} else { 
							echo $name . 'is too small. less than threshold'. $inputs[$i-1]['threshold']. '.At '.$last_message[$name]*$scaleby; 
						}
					} else {
						echo '<br>'.$name.'is not analogue';
					}
				} else {
					echo $name. 'not email set';
				}
				//reset analogue
				//reset levels
				if ($inputs[$i-1]['is_email4'] == 1){ 
					if ($inputs[$i-1]['is_on4'] == 0){
						if($inputs[$i-1]['direction4'] == 1){
							//echo 'name:'.$inputs[$i-1]['name'].'last_message:'.$last_message[$name]. 'reset_level'.$inputs[$i-1]['reset_level'].'direction:'.$inputs[$i-1]['direction'];
							if ($last_message[$name]*$scaleby < $inputs[$i-1]['reset_level4']){
								$this->load->model('input_model','inp');
								$this->inp->turn_on4($sender_id, $name);
								echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET11</h2>'.'<br>';
							} else {
								echo 'message is grt reset level with direction 1 for ' . $name;
							}
						} else { 
						echo $name. 'direction is 0'; 
						}
					} else { 
					echo $name . ' is not on';
					}
				} else {
					echo 'email not set';
				} 
			}
			//}
			//digital
			for($i=22;$i<=30;$i++){
				$name = $inputs[$i-1]['name'];
				$input_id = $inputs[$i-1]['input_id'];
				//echo 'name:'.$name;
				//echo 'input_id:'.$input_id;
				if($inputs[$i-1]['is_email'] == 1){
					if ($inputs[$i-1]['type'] == 'digital'){
						if ($inputs[$i-1]['is_on'] == 1){
							if ($last_message[$name] == "HI"){ $MSGhi = 1;} else {$MSGhi = 0;}
								if ($last_message[$name] == "LO"){ $MSGlo = 1;} else {$MSGlo = 0;}
									if ($MSGhi == $inputs[$i-1]['HI'] || $MSGlo == $inputs[$i-1]['LO']){
										echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
										$alarm_no = 1;
										$this->send_email($sender_id, $name, $alarm_no);
									} else {
								echo $name.'digital input is not equal to threshold'.'<br>';
							}
						} else {
							// should this be alarm be reset?
							// if ($MSGlo !== $inputs[$i-1]['LO']){
							// 	$this->model->load('input_model', 'input_model');
							// 	$this->input_model->turn_on($sender_id, $name);
							 	echo 'alarm'.$name.'has been turned on. msg is '. $MSGhi . ' ' . $MSGlo . ' where HI is ' . $inputs[$i]['HI']. 'and LO is ' .$inputs[$i]['LO'].'<br>';
							// }
							echo 'digital input' . $name . 'is not on'.'<br>';
						}
					} else {
						echo $name . 'input is not digital'.'<br>';
					}
				} else {
				 	echo $name . 'is not email';
				}
				if($inputs[$i-1]['is_email'] == 1){
					if ($inputs[$i-1]['type'] == 'digital'){
						if ($inputs[$i-1]['is_on'] == 0){
							if ($last_message[$name] == 'LO' && $inputs[$i-1]['HI'] == 1){
								//$this->model->load('input_model', 'input_model');
								//$this->input_model->turn_on($sender_id, $name);
								//echo $name .'<h2 style="margin:100px;color:red;"">'.$name.'RESET</h2>'.'<br>';
								$this->load->model('input_ model', 'input_model');
								$this->input_model->turn_on($sender_id, $name);
							} else { 
							//	echo $name.' msg is '.$inputs[$i-1]['HI']. 'when '.$last_message[$name];
							}
							if ($last_message[$name] == 'HI' && $inputs[$i-1]['LO'] == 1){
								//$this->model->load('input_model', 'input_model');
								//$this->input_model->turn_on($sender_id, $name);
							    echo $name .'<h2 style="margin:100px;color:red;"">'.$name.'RESET</h2>'.'<br>';
								$this->load->model('input_ model', 'input_model');
								$this->input_model->turn_on($sender_id, $name);
							} else 
							{ 
								echo $name.'msg is LO and inputs is '/$inputs[$i-1]['HI'];
							}					
						} else { 
						echo $name.'is already on';
						}
					} else {
						echo $name . 'is not a digital';
					} 
				} else {
					echo 'is not email';
				}
			}
			//digital alarm 2
			for($i=22;$i<=30;$i++){
				$name = $inputs[$i-1]['name'];
				$input_id = $inputs[$i-1]['input_id'];
				echo 'name:'.$name;
				echo 'input_id:'.$input_id;
				if($inputs[$i-1]['is_email2'] == 1){
					if ($inputs[$i-1]['type'] == 'digital'){
						if ($inputs[$i-1]['is_on2'] == 1){
							if ($last_message[$name] == "HI"){ $MSGhi = 1;} else {$MSGhi = 0;}
								if ($last_message[$name] == "LO"){ $MSGlo = 1;} else {$MSGlo = 0;}
									if ($MSGhi == $inputs[$i-1]['HI'] || $MSGlo == $inputs[$i-1]['LO']){
										echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
										$alarm_no = 2;
										$this->send_email($sender_id, $name, $alarm_no);
									} else {
								echo $name.'digital input is not equal to threshold'.'<br>';
							}
						} else {
							// should this be alarm be reset?
							// if ($MSGlo !== $inputs[$i-1]['LO']){
							// 	$this->model->load('input_model', 'input_model');
							// 	$this->input_model->turn_on($sender_id, $name);
							 	echo 'alarm'.$name.'has been turned on. msg is '. $MSGhi . ' ' . $MSGlo . ' where HI is ' . $inputs[$i]['HI']. 'and LO is ' .$inputs[$i]['LO'].'<br>';
							// }
							echo 'digital input' . $name . 'is not on'.'<br>';
						}
					} else {
						echo $name . 'input is not digital'.'<br>';
					}
				} else {
				 	echo $name . 'is not email';
				}
				if($inputs[$i-1]['is_email2'] == 1){
					if ($inputs[$i-1]['type'] == 'digital'){
						if ($inputs[$i-1]['is_on2'] == 0){
							if ($last_message[$name] == 'LO' && $inputs[$i-1]['HI'] == 1){
								//$this->model->load('input_model', 'input_model');
								//$this->input_model->turn_on($sender_id, $name);
								//echo $name .'<h2 style="margin:100px;color:red;"">'.$name.'RESET</h2>'.'<br>';
								$this->load->model('input_ model', 'input_model');
								$this->input_model->turn_on2($sender_id, $name);
							} else { 
							//	echo $name.' msg is '.$inputs[$i-1]['HI']. 'when '.$last_message[$name];
							}
							if ($last_message[$name] == 'HI' && $inputs[$i-1]['LO'] == 1){
								//$this->model->load('input_model', 'input_model');
								//$this->input_model->turn_on($sender_id, $name);
							 //   echo $name .'<h2 style="margin:100px;color:red;"">'.$name.'RESET</h2>'.'<br>';
								$this->load->model('input_ model', 'input_model');
								$this->input_model->turn_on2($sender_id, $name);
							} else 
							{ 
								echo $name.'msg is LO and inputs is '/$inputs[$i-1]['HI'];
							}					
						} else { 
						echo $name.'is already on';
						}
					} else {
						echo $name . 'is not a digital';
					} 
				} else {
					echo 'is not email';
				}
			}
			// counter
			for ($i=29;$i<=33;$i++){
				$name = $inputs[$i-1]['name'];
				$input_id = $inputs[$i-1]['input_id'];
				echo $name;
				//echo $input_id;
				echo $last_message[$name];
				//echo 'theshold'.$inputs[$i-1]['threshold'];
				//echo 'Alarm 1 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold'].'<br>reset:'.$inputs[$i-1]['reset_level'].'<br>is_on:'.$inputs[$i-1]['is_on'].'<br>direction:'.$inputs[$i-1]['direction'].'</h2><br>';
				//echo 'Alarm 2 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold2'].'<br>reset:'.$inputs[$i-1]['reset2'].'<br>is_on:'.$inputs[$i-1]['is_on2'].'<br>direction:'.$inputs[$i-1]['direction2'].'</h2><br>';
				//echo 'Alarm 3 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold3'].'<br>reset:'.$inputs[$i-1]['reset3'].'<br>is_on:'.$inputs[$i-1]['is_on3'].'<br>direction:'.$inputs[$i-1]['direction3'].'</h2><br>';
				//echo 'Alarm 4 name:'.$name.'<br>message:'.$last_message[$name]*$scaleby.'<br>threshold:'.$inputs[$i-1]['threshold4'].'<br>reset:'.$inputs[$i-1]['reset4'].'<br>is_on:'.$inputs[$i-1]['is_on4'].'<br>direction:'.$inputs[$i-1]['direction4'].'</h2><br>';
				if ($inputs[$i-1]['is_email'] == 1){
					if ($inputs[$i-1]['type'] == 'counter'){
						if ($inputs[$i-1]['threshold'] < $last_message[$name]){
							if ($inputs[$i-1]['is_on'] == 1){	
									echo 'email sent for'.$inputs[$i-1]['name'].'<br>';
									$this->load->model('input_model','inp');
									echo 'EMAIL SENT:'.$sender_id.'INPUT_ID'.$input_id.'name'.$name. ' value ' .$last_message[$name] . ' threshold ' . $inputs[$i-1]['threshold'];
								    $this->inp->turn_off($sender_id,$input_id);
								    $alarm_no = 1;
									$this->send_email($sender_id, $name, $alarm_no);
								//} else {
								//	echo $this->email->print_debugger();
								//}
								} else {
									echo '<br>alarm is not on for ' .$name;
							}
						} else { 
							echo $name . 'is too small. less than threshold'. $inputs[$i-1]['threshold']. '.At '.$last_message[$name]*$scaleby; 
						}
					} else {
						echo '<br>'.$name.'is not counter';
					}
				} else {
					echo $name. 'not email set';
				}
				//reset levels
				if ($inputs[$i-1]['is_email'] == 1){ 
					if ($inputs[$i-1]['type'] == 'counter'){
						if ($inputs[$i-1]['is_on'] == 0){
							//echo 'name:'.$inputs[$i-1]['name'].'last_message:'.$last_message[$name]. 'reset_level'.$inputs[$i-1]['reset_level'].'direction:'.$inputs[$i-1]['direction'];
							if ($last_message[$name]*$scaleby < $inputs[$i-1]['reset_level']){
								$this->load->model('input_model','inp');
								$this->inp->turn_on($sender_id, $name);
								echo '<h2 style="margin:100px;color:red;"">'.$name.'RESET11</h2>'.'<br>';
							} else {
								echo 'message is grt reset level with direction 1 for ' . $name;
							}				
						} else { 
						echo $name . ' is not on';
					}
					} else {
						echo '<br>'.$name.'is not counter';
					}
				} else {
					echo 'email not set';
				} 
			}
		}
				
	}									
			
	public function send_email($sender_id, $name, $alarm_no){
		$this->load->model('device_model');
		$user_id = $this->device_model->get_user_id_for_sender_id($sender_id);
		$user_id = $user_id[0]['user_id'];
		date_default_timezone_set('Europe/London');
		$date = date("Y-m-d H:i:s");
		$timestamp = strtotime($date);
		$this->load->model('device_model', 'device_model');
		$results = $this->device_model->get_dataloggerid_for_senderid($sender_id);
		$datalogger_id = $results[0]['datalogger_id'];
		$results = $this->device_model->get_device_name_for_senderid($sender_id);
		$machine_name = $results[0]['machine_name'];
		echo '<b>machinename'.$machine_name.'</b>';
		$results = $this->device_model->get_user_id_for_datalogger_id($datalogger_id);
		$results = $this->input_model->get_input_id_for_sender_id($name,$sender_id);
		$input_id = $results[0]['input_id'];
		$this->load->model('alarm_model', 'alarm');
		$email = $this->alarm_model->get_email_for_alarm($user_id, $sender_id, $name, $alarm_no);
		$alarm_id = $email['alarm_id'];
		$this->alarm->update_email_sent($alarm_id);
		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.googlemail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'mydatame@googlemail.com',
		    'smtp_pass' => 'aypywxtagrvlcspz',
		    'mailtype' => 'text',
		    'newline' => "\r\n"
		);
		$config['smtp_host'] = "ssl://smtp.gmail.com";
		$this->email->initialize($config);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$from = $email[0]['from'];
		$this->email->from($from);
		$to = $email[0]['to'];
		$this->email->to($to);
		$subject = $email[0]['subject'];
		$this->email->subject($subject);
		$usermessage = $email[0]['message'];
		if (!isset($usermessage)){
			$usermessage = "User message has not been set";
		}
		$this->load->model('input_model','conf');
		$inputs = $this->conf->get_inputs_for_sender_id($sender_id);
		$scaleby =($inputs[$input_id-1]['max']-$inputs[$input_id-1]['min'])/1024;
		$this->load->model('data_model', 'data_model');
		$last_message = $this->data_model->get_last_message_for_sender_id($sender_id);
		$last_message = $last_message[0];
		$answer = $this->data_model->get_messages_for_userid_and_senderid($user_id,$sender_id);
		$last_message = array_pop($answer);
		//echo $input_id;
		//PRINT_R($last_message);
		$last = count($last_message);
		//echo 'THIS IS THE LAST MESSAGE VALUE' . $last_message[$input_id+2] . 'at the MESSAGE ID ' . $last_message[0];
		$ucname = strtoupper($name);
		$letter = str_split($ucname,1);
		$poshname = $letter[0] . 'in' . $letter[1];
		if ($letter[0] == 'c'){
			$poshname = $name;
		}
		$last_value = $last_message[$ucname];
		//echo 'LAST VALUE' . $last_value;
		if ($inputs[$input_id-1]['type'] == 'analogue'){
		    $scaled_value = $last_value*$scaleby;
		    $scaled_threshold = $last_value*$scaleby;
			$message =  $inputs[$input_id-1]['label_name'] . " Alarm " . $alarm_no . ' - ' . $inputs[$input_id-1]['label_name'] 
			. "\r\n". "With the value ". $scaled_value. " surpassing the threshold ". $scaled_threshold		 
			. "\r\n" . "This reading occured at " . date("Y-m-d H:i:s", $timestamp) . "\r\n" . $usermessage
			. "\r\n" . "Sent from Device " . $machine_name;
			  echo $message;
		}
		if ($inputs[$input_id-1]['HI'] = 1) {$msg='HI';} else {$msg='LO';}
		if ($inputs[$input_id-1]['type'] == 'digital'){
			$message = $usermessage . "\r\n" . "\r\n" . $inputs[$input_id-1]['label_name'] . " was triggered with value " . $msg . " at " . date("Y-m-d H:i:s", $timestamp) . " (" . $poshname . " alarm " . $alarm_no . ")"
			. "\r\n" . "Sent from Device " . $machine_name;		
		}
		if ($inputs[$input_id-1]['type'] == 'counter'){

		    $message =  $inputs[$input_id-1]['label_name'] . " Alarm " . $alarm_no . ' - ' . $inputs[$input_id-1]['label_name'] 
			. "\r\n". "With the value ". $last_value . " surpassing the threshold ". $inputs[$input_id-1]['threshold'] 			 
		    . "\r\n" . "This reading occured at " . date("Y-m-d H:i:s", $timestamp) . "\r\n" . $usermessage
	    	. "\r\n" . "Sent from Device " . $machine_name;
		}		
		$this->email->message($message);

		$data = array(
		 	'user_id' => $user_id,
		 	'sender_id' => $sender_id,
		 	'alarm_no' => $alarm_no,
			'time' => $timestamp,
			'message' => $message,
			'to' => $to,
			'from' => $from,
			'subject' => $subject,
			'usermessage' => $usermessage,
			'type' => $inputs[$input_id-1]['type'],
			'scaleby' => $scaleby,
			'value' => $scaled_value,
			'threshold' => $inputs[$input_id-1]['threshold'] ,
			'is_on' => $inputs[$input_id-1]['is_on'],
			'direction' => $inputs[$input_id-1]['direction'],
			'reset_level' => $inputs[$input_id-1]['reset_level'],
			'threshold' => $inputs[$input_id-1]['threshold'] ,
			'is_on' => $inputs[$input_id-1]['is_on'],
			'direction' => $inputs[$input_id-1]['direction'],
			'reset_level' => $inputs[$input_id-1]['reset_level'],
			'threshold2' => $inputs[$input_id-1]['threshold2'] ,
			'is_on2' => $inputs[$input_id-1]['is_on2'],
			'direction2' => $inputs[$input_id-1]['direction2'],
			'reset2' => $inputs[$input_id-1]['reset2'],
			'threshold3' => $inputs[$input_id-1]['threshold3'] ,
			'is_on3' => $inputs[$input_id-1]['is_on3'],
			'direction3' => $inputs[$input_id-1]['direction3'],
			'reset3' => $inputs[$input_id-1]['reset3'],
			'threshold4' => $inputs[$input_id-1]['threshold4'] ,
			'is_on4' => $inputs[$input_id-1]['is_on4'],
			'direction4' => $inputs[$input_id-1]['direction4'],
			'reset4' => $inputs[$input_id-1]['reset4'],
			'label_name' => $inputs[$input_id-1]['label_name'],
			'units' => $inputs[$input_id-1]['units'],
			'name' => $inputs[$input_id-1]['name']
		);
		//echo '<b>value is data array is</b>'.$data['value'];
		$this->load->model('email_model', 'emaily');
		$this->emaily->add_email($data);
		$this->load->model('user_model', 'user');
		$this->user->log_time_email_sent($user_id);
		$this->load->model('device_model', 'device');
		$this->device->update_time($sender_id);
		$this->device->update_email_sent_time($sender_id);
		if ($this->email->send()){
			$is_sent = true;					
			} else {
				$is_sent = false;
				$error_email = $this->email->print_debugger();
			}
			$this->load->model('input_model','inp');
				if ($alarm_no == 1){
				    $this->inp->turn_off($sender_id,$input_id);
					$this->input_model->email_sent($name, $sender_id, $user_id, $alarm_no);
				}
				if ($alarm_no == 2){
				    $this->inp->turn_off2($sender_id,$input_id);
					$this->input_model->email_sent($name, $sender_id, $user_id, $alarm_no);
				}			
				if ($alarm_no == 3){
				    $this->inp->turn_off3($sender_id,$input_id);
					$this->input_model->email_sent($name, $sender_id, $user_id, $alarm_no);
				}	
				if ($alarm_no == 4){
				    $this->inp->turn_off4($sender_id,$input_id);
					$this->input_model->email_sent($name, $sender_id, $user_id, $alarm_no);
			}

		$this->load->model('input_model','input_model');
		$results = $this->input_model->get_input($user_id, $sender_id, $name);	
		$result = $this->input_model->email_reset($name, $sender_id, $user_id, $alarm_no);
		$results = array($name, $alarm_no, $last_message, $scaled_value, $usermessage, $to, $email, $user_id, $sender_id, $is_sent, $error_email, $email_sent, $alarm_id);
		print_r(json_encode($results));

	}
}