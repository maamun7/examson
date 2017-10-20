<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_test_categories extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function count_category()
	{
		return $this->db->count_all("model_test_category");
	}
	
	public function get_category_list($limit,$page)
	{
		$this->db->select('*');
		$this->db->from('model_test_category'); 
		$this->db->where(array('is_delete'=>0));
		$this->db->order_by('id','asc');
		$this->db->limit($limit,$page); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function insert($data)
	{
		$this->db->insert('model_test_category',$data);
		return true;
	}
	
	public function get_edit_data($cat_id)
	{
		$this->db->select('*');
		$this->db->from('model_test_category');
		$this->db->where('id',$cat_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function update($data,$cat_id)
	{
		$this->db->where('id',$cat_id);
		$this->db->update('model_test_category',$data); 
		return true;
	}
	
	public function do_change_status($category_id)
	{
		$this->db->select('published');
		$this->db->from('model_test_category');
		$this->db->where(array('id'=>$category_id,'published'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$this->db->where('id',$category_id);
			$this->db->update('model_test_category',array('published'=>0));
			return true; 
		}

		$this->db->where('id',$category_id);
		$this->db->update('model_test_category',array('published'=>1)); 
		return true;
	}
	
	public function do_delete($category_id)
	{
		$this->db->where('id',$category_id);
		$this->db->update('model_test_category',array('is_delete'=>1)); 
		return true;
	}

}