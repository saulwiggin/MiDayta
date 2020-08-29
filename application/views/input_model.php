<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Input_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all_inputs(){
        $query = $this->db->get('inputs');
        return $query->result_array();
    }

    function get_all_inputs_for_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('input_id','asc');
        $inputs = $this->db->get('inputs');
        return $inputs->result_array();
    }

    function get_alarm_threshold($user_id){
        $this->db->where('user_id', $user_id);
        $threshold = $this->db->get('inputs');
        return $threshold->result_array();
    }

    function get_display_type($user_id){

        $this->db->select('type');
        $this->db->where('user_id', $user_id);
        $display_type = $this->db->get('inputs');

        $this->db->where('display_id', $display_type);
        $display_name = $this->db->get('display_types');
    }

    function set_input($data){
        $this->db->insert('inputs', $data);
    }

    function update_input($user_id, $input_id, $data){
        $this->db->update('inputs', $data, array('user_id' => $user_id, 'input_id' => $input_id));
    }
    function get_inputs_for_sender_id($sender_id){
        $this->db->where('sender_id', $sender_id);
        $this->db->order_by('input_id','asc');
        $results = $this->db->get('inputs');
        return $results->result_array();
    }
    function turn_off($sender_id,$name){
        echo "turn off";
        $this->db->where('sender_id', $sender_id);
        $this->db->where('name', $name);
        $data['is_on'] = 0;
        $this->db->update('inputs', $data);
    }
    function turn_on($sender_id,$name){
        $this->db->where('sender_id', $sender_id);
        $this->db->where('name', $name);
        $data['is_on'] = 1;
        $this->db->update('inputs', $data);
    }
}