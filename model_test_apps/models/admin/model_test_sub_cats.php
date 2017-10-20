<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_test_sub_cats extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function count_sub_category()
	{
		return $this->db->count_all("model_test_sub_cat");
	}
	
	public function get_sub_cat_list($limit,$page)
	{
		$this->db->select('a.*,b.category_name');
		$this->db->from('model_test_sub_cat a'); 
		$this->db->join('model_test_category b','b.id = a.category_id'); 
		$this->db->where(array('a.is_delete'=>0,'b.is_delete'=>0));
		$this->db->order_by('a.id','asc');
		$this->db->limit($limit,$page); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function get_category_list()
	{
		$this->db->select('id,category_name');
		$this->db->from('model_test_category'); 
		$this->db->where(array('is_delete'=>0));
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function insert($data)
	{
		$this->db->insert('model_test_sub_cat',$data);
		return true;
	}
	
	public function get_edit_data($id)
	{
		$this->db->select('*');
		$this->db->from('model_test_sub_cat');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function update($data,$id)
	{
		$this->db->where('id',$id);
		$this->db->update('model_test_sub_cat',$data); 
		return true;
	}
	
	public function do_change_status($sub_cat_id)
	{
		$this->db->select('published');
		$this->db->from('model_test_sub_cat');
		$this->db->where(array('id'=>$sub_cat_id,'published'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$this->db->where('id',$sub_cat_id);
			$this->db->update('model_test_sub_cat',array('published'=>0));
			return true; 
		}

		$this->db->where('id',$sub_cat_id);
		$this->db->update('model_test_sub_cat',array('published'=>1)); 
		return true;
	}
	
	public function do_delete($id)
	{
		$this->db->where('id',$id);
		$this->db->update('model_test_sub_cat',array('is_delete'=>1)); 
		return true;
	}

}