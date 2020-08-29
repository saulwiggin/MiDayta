<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configure_dashboard extends CI_Controller {

	public function index()
	{
		$is_logged_in = $this->session->userdata('logged_in');
		$is_logged_in = TRUE;
		//print_r($_POST);
		if ($is_logged_in == TRUE){
			//print_r($this->session->all_userdata());
			$this->load->model('user_model', 'user');
			//$username = $this->session->userdata('username');
			$username = $_GET['username'];
			$data['username'] = $username;
			$user_id = $this->user->get_user_id($username);
			$user_id = $user_id[0]['user_id'];
			$data['user_id'] = $user_id;
			$this->load->model('device_model','device');
			$all_sender_ids = $this->device->get_sender_ids_for_user($user_id);
			$data['all_sender_ids'] = $all_sender_ids;
			//print_r($all_sender_ids);
			$sender_id = $this->device->get_sender_id_for_user($user_id);
			$sender_id = $sender_id[0]['sender_id'];
			$data['sender_id'] = $sender_id;
			$machine_name = $_POST['selecteddevice'];
			$this->load->model('device_model', 'devices');
			$results = $this->devices->get_datalogger_id_for_machine_name($machine_name);
			$datalogger_id = $results[0]['datalogger_id'];
			$this->load->model('device_model', 'device_model');
			$number_of_dataloggers = $this->device_model->get_number_of_devices_for_user($user_id);
			//$number_of_dataloggers = $results;
			//$number_of_dataloggers = $this->device_model->get_number_dataloggers($user_id);
			$this->load->model('input_model', 'inputs');
			//echo '<br>userId' . $user_id;
			$inputs = $this->inputs->get_inputs_for_user_id($user_id);
			$inputs = array_chunk($inputs, 32);
			$data['user_inputs'] = $inputs;
			//print_r($inputs);
			$this->load->model('device_model', 'device_model');
			$result = $this->device_model->get_device_for_user($user_id);
			$data['devices'] = $result;
			$this->load->model('input_model', 'inp');
			$input_configs = $this->inp->get_inputs_for_sender_id($sender_id);
			$data['config'] = $input_configs;
			$number = $this->input->post('number');
			$data['number'] = $number;
			$this->load->model('device_model','device');
			$data['machine_name'] = $this->device->get_machinename_for_sender_id($sender_id);
			$this->load->view('header');
			$this->load->view('configuration', $data);
			$this->load->view('footer');
		} else {
			$this->session->unset_userdata(array("username"=>"","logged_in"=>"","password"=>"","user_id"=>""));
			$this->session->sess_destroy();
			$this->logout();
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('c=User&m=login');
	}

	public function add_labels(){

		$username = $this->session->userdata('username');
		$user_id = $this->user_model->get_user_id($username);
		$user_id = $_POST['hiddenuser_id'];
		$sender_id = $_POST['hiddensender_id'];
		
		//echo 'threshold3';
		//print_r($_POST);
		$data = $_POST;
		//echo 'test threshold';
		//print_r($data);
		for ($i=0;$i<32;$i++){
			if($_POST['min'.$i.'-0']){
				$min = $_POST['min'.$i.'-0'];
			} else {
				$min = 0;
			}
			if($_POST['is_email'.$i.'-0']){
				$is_email = $_POST['is_email'.$i.'-0'];
			} else {
				$is_email = 0;
			}
			if($_POST['max'.$i.'-0']){
				$max = $_POST['max'.$i.'-0'];
			} else {
				$max = 100;
			}
			if($_POST['max'.$i.'-0'] == 0){
				$max = 100;
			}
			if($_POST['reset'.$i.'-0']){
				$reset = $_POST['reset'.$i.'-0'];
			} else {
				$reset= 0.0;
			}
			if($_POST['threshold'.$i.'-0']){
				$threshold = $_POST['threshold'.$i.'-0'];
			} else {
				$threshold = 0.0;
			}
			if($_POST['reset'.$i.'-1']){
				$reset2 = $_POST['reset'.$i.'-1'];
			} else {
				$reset2 = 0.0;
			}
			if($_POST['threshold'.$i.'-1']){
				$threshold2 = $_POST['threshold'.$i.'-1'];
			} else {
				$threshold2 = 0.0;
			}
			if($_POST['reset'.$i.'-2']){
				$reset3 = $_POST['reset'.$i.'-2'];
			} else {
				$reset3 = 0.0;
			}
			if($_POST['threshold'.$i.'-2']){
				$threshold3 = $_POST['threshold'.$i.'-2'];
			} else {
				$threshold3 = 0.0;
			}
			if($_POST['reset'.$i.'-3']){
				$reset4 = $_POST['reset'.$i.'-3'];
			} else {
				$reset4 = 0.0;
			}
			if($_POST['threshold'.$i.'-3']){
				$threshold4 = $_POST['threshold'.$i.'-3'];
			} else {
				$threshold4 = 0.0;
			}
			if($_POST['HI'.$i.'-0']){
				$hi = $_POST['HI'.$i.'-0'];
			} else {
				$hi = 0;
			}
			if($_POST['LO'.$i.'-0']){
				$lo = $_POST['LO'.$i.'-0'];
			} else {
				$lo = 0;
			}
			if($_POST['HI'.$i.'-1']){
				$hi1 = $_POST['HI'.$i.'-1'];
			} else {
				$hi1 = 0;
			}
			if($_POST['LO'.$i.'-1']){
				$lo1 = $_POST['LO'.$i.'-1'];
			} else {
				$lo1 = 0;
			}
			$data = array(
				//'name' => $_POST['name0'],
				'label_name' => $_POST['label'.$i.'-0'],
				'direction' => $_POST['direction'.$i.'-0'],
				'reset_level' => $reset,
				'threshold' => $threshold,
				'direction2' => $_POST['direction'.$i.'-1'],
				'reset2' => $reset2,
				'threshold2' => $threshold2,
				'direction3' => $_POST['direction'.$i.'-2'],
				'reset3' => $reset3,
				'threshold3' => $threshold3,
				'direction4' => $_POST['direction'.$i.'-3'],
				'reset4' => $reset4,
				'threshold4' => $threshold4,
				'units' => $_POST['units'.$i.'-0'],
				'min' => $min,
				'max' => $max,
				//'is_graphed' => $_POST['is_graphed'.$i.'-0'],
				'HI' => $hi,
				'LO' => $lo,
				'HI2' => $hi1,
				'LO2' => $lo1,
				'is_email' => $is_email,
				'is_email2' => $_POST['is_email'.$i.'-1'],
				'is_email3' => $_POST['is_email'.$i.'-2'],
				'is_email4' => $_POST['is_email'.$i.'-3']
				);
			if ($_POST['units'.$i.'-0'] == 'none'){
				$data['units'] = $_POST['customunits'.$i];
			}
			$input_id = $i+1;
			//echo '<br> User id' . $user_id;
			//echo '<br> senderid'.$sender_id;
			//echo '<br input id'.$input_id;
			$this->load->model('input_model');
			$this->input_model->update_input($user_id, $sender_id, $input_id, $data);
			//}
		}

		//$this->index();
		$test = array($user_id,$sender_id,$input_id,$data, $min, $max);
		$json = json_encode($test);
		//print_r($_POST);
		$post = $_POST;
		$json = json_encode($post);
		print_r($json);
		
	}

	public function ajax_return(){

		$this->load->view('success_msg');
	}

	public function get_inputs_for_device(){
		$user_id = $_POST['user_id'];
		$selected_device = $_POST['selected_device'];
		$this->load->model('input_model', 'inputs');
		$inputs = $this->inputs->get_inputs_for_user_id($user_id);
		$inputs = array_chunk($inputs, 32);
		$data['user_inputs'] = $inputs;
	}

	public function save_row_numbers(){
		print_r($_POST);
		$this->load->model('input_model','inputs');
		$this->inputs->save_number_of_alarms($user_id, $sender_id, $_POST);
	}

	public function get_row_numbers(){
		//echo 'row numbers';
		$user_id = '17';
		$sender_id = '0000001';
		$this->load->model('input_model','input_model');
		$results = $this->input_model->get_row_numbers($user_id,$sender_id);
		$json = json_encode($results);
		print_r($json);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */