<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exam_activities extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_exam_list()
    {
        /*$where = array('y.user_id' => $this->auth->get_user_id(),'a.is_delete' => 0);
        $items = "a.exam_name,a.exam_type,y.id as result_id,c.assign_by,c.assign_to,c.assign_at,d.first_name,d.last_name";
        $this->db->select($items);
        $this->db->from('all_exam a');
        $this->db->join('exam_result_relation x','x.exam_id = a.id','left');
        $this->db->join('all_exam_result y','y.id = x.result_id','left');
        $this->db->join('assigned_exam c','c.exam_id = y.exam_id','left');
        $this->db->join('users d','d.user_id = c.assign_by');
        $this->db->where($where);
        // $this->db->order_by('created_at','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }*/
/*
        $where = array('c.user_id' => $this->auth->get_user_id(),'a.is_delete' => 0);
        $items = "a.exam_name,a.exam_type,c.id as result_id,d.assign_by,d.assign_to,d.assign_at,e.first_name,e.last_name";
        $this->db->select('*');
        $this->db->from('all_exam a');
        $this->db->join('exam_result_relation b','b.exam_id = a.id');
        $this->db->join('all_exam_result c','c.id = b.result_id');
        $this->db->join('assigned_exam d','d.exam_id = b.exam_id');
        $this->db->join('users e','e.user_id = d.assign_by');
        $this->db->where($where);
        // $this->db->order_by('created_at','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
        */

        $where = array('c.user_id' => $this->auth->get_user_id(),'a.is_delete' => 0);
        $items = "a.exam_name,a.exam_type,c.id as result_id,c.user_id,c.assign_by,c.examed_on,d.first_name,d.last_name";
        $this->db->select($items);
        $this->db->from('all_exam a');
        $this->db->join('exam_result_relation b','b.exam_id = a.id');
        $this->db->join('all_exam_result c','c.id = b.result_id');
        $this->db->join('users d','d.user_id = c.assign_by');
        $this->db->where($where);
        // $this->db->order_by('created_at','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function count_awaited_exam()
    {
        $where = array('assign_to' => $this->auth->get_user_id(),'exam_status !=' =>1);
        $items = "exam_id";
        $this->db->select($items);
        $this->db->from('assigned_exam');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }else{
            return false;
        }
    }


    public function get_awaited_exam_list()
    {
        $where = array('c.assign_to' => $this->auth->get_user_id(),'c.exam_status !=' =>1);
        $items = "a.id,a.exam_name,a.no_of_question,a.exam_type,c.id as assign_id,c.exam_status,c.assign_by,c.assign_to,c.assign_at,d.first_name,d.last_name";
        $this->db->select($items);
        $this->db->from('all_exam a');
        $this->db->join('assigned_exam c','c.exam_id = a.id');
        $this->db->join('users d','d.user_id = c.assign_by');
        $this->db->where($where);
        // $this->db->order_by('created_at','desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }
}