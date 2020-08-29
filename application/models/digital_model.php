<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Digital_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    function add($data){
        $this->db->insert($data);
    }
    function get_digital_outputs_for_senderid_and_userid($user_id, $sender_id){
        $query = $this->db->get('digital_outputs',array('user_id' =>$user_id, 'sender_id' => $sender_id));
        return $query->result_array();
    }
    function update_digital($data){
        //print_r($data);
        $this->db->where('user_id', $data['user_id']);
        $this->db->where('sender_id', $data['sender_id']);
        $this->db->update('digital_outputs', $data);
    }
}