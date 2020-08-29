<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Device_model extends CI_Model {

	public function add($data){
		$this->db->insert('devices',$data);
	}
	public function delete_device($device_id){
		$this->db->where('datalogger_id', $device_id);
		$this->db->delete('devices');
	}
	public function configure_digital_inputs($data){
		$this->db->where('device_id', $data['device_id']);
		$this->db->get('devices',$data);
	}
	public function add_labels($data){
		$q = $this->db->insert('labels',$data);
		return $q;
	}
	public function add_max_value($data){
		$q = $this->db->insert('max_value',$data);
	return $q;
	}
	public function add_SI_units($data){
		$q = $this->db->insert('si_units',$data);
	return $q;
	}
	public function add_is_display($data){
		$q = $this->db->insert('si_units',$data);
	return $q;
	}
	public function read_is_display($data){
		$q = $this->db->get('si_units',$data);
	return $q;
	}
	public function get_device_for_user($user_id){
		$this->db->where('user_id', $user_id);
		$results = $this->db->get('devices');
		return $results->result_array();
	}
	public function get_device_for_sender_id($sender_id){
		$this->db->where('sender_id', $sender_id);
		$results=$this->db->get('devices');
		return $results->result_array();
	}
	public function update_device_for_sender_id($sender_id, $data){
		$this->db->where('sender_id', $sender_id);
		$this->db->update('devices', $data);
	}
	public function delete_device_for_sender_id($sender_id){
		$this->db->where('sender_id', $sender_id);
		$this->db->delete('devices');
	}
	public function update_time($sender_id){
		$this->db->where('sender_id', $sender_id);
		$this->db->select('last_update_time');
		$now = time();
		$data['update_time'] = $now;
		$this->db->update('devices', $data);
	}
	public function get_last_update_time($sender_id){
		$this->db->where('sender_id', $sender_id);
		$this->db->select('update_time');
		$results = $this->db->get('devices');
		return $results->result_array();
	}
	public function get_machinename_for_sender_id($sender_id){
		$this->db->where('sender_id', $sender_id);
		$this->db->select('machine_name');
		$results = $this->db->get('devices');
		return $results->result_array();
	}
		public function get_userid_for_sender_id($sender_id){
		$this->db->where('sender_id', $sender_id);
		$this->db->select('user_id');
		$results = $this->db->get('devices');
		return $results->result_array();
	}
}

?>
		