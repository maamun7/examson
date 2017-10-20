<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Homes extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_popular_exams()
    {
        $where=array('a.exam_type' => 1);
        $this->db->select('a.id,a.exam_name');
        $this->db->from('all_exam a');
        $this->db->join('popular_model_test b','b.exam_id = a.id');
        $this->db->where($where);
        $this->db->order_by('b.total_participate','desc');
        $this->db->limit(5);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }

    public function get_exam_taker_list()
    {
        $items = "a.total_question,a.total_correct,a.examed_on,b.first_name,b.last_name";
        $this->db->select($items);
        $this->db->from('all_exam_result a');
        $this->db->join('users b','b.user_id = a.user_id');
        $this->db->order_by('a.id','desc');
        $this->db->limit(4);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }else{
            return false;
        }
    }
}