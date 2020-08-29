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

    function update_input($user_id, $sender_id, $input_id, $data){
        //echo 'USERID' . $user_id;
        //echo 'SENDERID' .$sender_id;
        //echo 'INPUTID'.$input_id;
        //print_r($data);
        $this->db->update('inputs', $data, array('user_id' => $user_id, 'sender_id' => $sender_id, 'input_id' => $input_id));
    }
    function get_inputs_for_sender_id($sender_id){
        $this->db->where('sender_id', $sender_id);
        $this->db->order_by('input_id','asc');
        $results = $this->db->get('inputs');
        return $results->result_array();
    }
    function turn_off($sender_id,$input_id){
        echo $input_id."turning alarm off".$sender_id;
        $this->db->where('sender_id', $sender_id);
        $this->db->where('input_id', $input_id);
        $off = 0;
        echo $off;
        $data['is_on'] = $off;
        echo 'data off ' . $off;
        $this->db->update('inputs', $data);
    }
    function turn_on($sender_id,$name){
        echo $name."alarm 1 IS TURNED ON FOR " .$sender_id;
        $this->db->where('sender_id', $sender_id);
        $this->db->where('name', $name);
        $on = 1;
        $data['is_on'] = $on;
        echo 'data on' .$on;
        $this->db->update('inputs', $data);
    }
    function turn_on_alarm2($sender_id,$name){
        echo $name."alarm 2 IS TURNED ON FOR " .$sender_id;
        $this->db->where('sender_id', $sender_id);
        $this->db->where('name', $name);
        $on = 1;
        $data['is_on2'] = $on;
        echo 'data on' .$on;
        $this->db->update('inputs', $data);
    }
    function add_default_configuration($name, $data){
        $data['name'] == $name;
        $this->db->add('inputs', $data);
    }
    function add_input_for_device($data){
        $this->db->insert($data);
    }
    function delete_inputs_for_user($user_id){
        $this->db->where('user_id', $user_id);
        $this->db->delete('inputs');
    }
    // function get_input_id_for_input_name($name,sender_id){
    //      echo 'get input';
    //      $this->db->where('sender_id', $sender_id);
    //      $this->db->where('name', $name);
    //      $this->db->select('input_id');
    //      $results = $this->db->get('inputs');
    //      return $results->result_array();
    //  }
    function get_input_id_for_sender_id($sender_id, $name){
        echo 'get input if for:' .$name;
        $this->db->where('sender_id',$sender_id);
        $this->db->where('name', $name);
        $this->db->select('input_id');
        $results = $this->db->get('inputs');
        return $results->result_array();
    }
}