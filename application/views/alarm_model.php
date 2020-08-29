<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alarm_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }


    function get_alarm($user_id){
        $query = $this->db->get('alarm_email',array('user_id' =>$user_id));
        return $query->result_array();

    }

    function add_alarm($data){
        $this->db->insert('alarm_email', $data);

    }

    function update_alarm($alarm_id, $data){

        $this->db->where('alarm_id', $alarm_id);
        $this->db->update('alarm_logs', $data);
    }
    function delete_alarm(){
        $this->db->where('alarm_id', $alarm_id);
        $this->db->delete('alarm_logs');
    }
    function get_alarmid_with_userid($user_id){
        $this->db->where('User_id', $user_id);
        $this->db->select('alarm_id');
        $alarm_ID = $this->db->get('alarm_email');
        return $alarm_ID;
    }
    function get_email_details($alarm_id){
        $this->db->where('alarm_ID', $alarm_id);
        $this->db->select('subject, email_address, message, email2');
        $email = $this->db->get('alarm_email', 1);
        return $email->result_array();
    }

    function update_alarm_using_sender_id($sender_id, $data){
        $this->db->where('sender_id',$sender_id);
        $results = $this->db->update('alarm_email', $data);
        //return $results->result_array();
    }
}