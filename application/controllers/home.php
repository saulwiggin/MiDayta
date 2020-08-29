<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){

		$username = $this->uri->segment(5);
		$this->load->model('user_model');
		$user_id = $this->user_model->get_user_id($username);
		$user_id = $user_id[0]['user_id'];
		$data['user_id'] = $user_id;
		$this->load->model('device_model');
		$sender_id = $this->device_model->get_sender_id_for_user($user_id);
    	$sender_id = $sender_id[0]['sender_id']; 
    	$data['sender_id'] = $sender_id;

		$user_messages = $this->data_model->get_messages_for_user($user_id);
		$data['messages'] = $user_messages;
		$this->load->model('input_model');
		$input_data = $this->input_model->get_all_inputs_for_user($user_id, $sender_id);
		$data['config'] = $input_data;
		$this->load->model('device_model');
		$datalogger = $this->device_model->get_device_for_user($user_id);
		$data['datalogger'] = $datalogger;
		$this->load->model('user_model');
		$user = $this->user_model->get_user($user_id);
		$data['user'] = $user;

		$this->load->view('header');
		$this->load->view('sidenav1',$data);
		$this->load->view('device_information', $data);
		$this->load->view('sidenav2');
		$this->load->view('footer');
	}

}