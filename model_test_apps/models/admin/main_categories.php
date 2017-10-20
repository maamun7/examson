<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main_categories extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public $data;
	public function count_category()
	{
		return $this->db->count_all("main_category");
	}
	
	public function get_category_list($parent,$level,$limit,$page)
	{
		$this->db->select('*');
		$this->db->from('main_category'); 
		$this->db->where(array('is_delete'=>0,'parent_id'=>$parent));
		$this->db->order_by('ordering','asc');
		$this->db->limit($limit,$page); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			$result =$query->result_array();
			foreach($result as $indx=>$val){
				$val['level'] = $level;
				$this->data[] = $val;
				$this->get_category_list($val['id'],$level + 1,$limit,$page);
			}
			return $this->data;
		}else{
			return false;
		}
	}
	
	public function get_parent_categories()
	{
		$this->db->select('id,name');
		$this->db->from('main_category');
		$this->db->where(array('is_delete'=>0,'published'=>1,'parent_id'=>0));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function insert($data)
	{
		$this->db->insert('main_category',$data);
		return true;
	}
	
	public function get_edit_data($cat_id)
	{
		$this->db->select('*');
		$this->db->from('main_category');
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
		$this->db->update('main_category',$data); 
		return true;
	}
	
	public function do_delete($category_id)
	{
		$this->db->where('id',$category_id);
		$this->db->update('main_category',array('is_delete'=>1)); 
		return true;
	}
	
	public function get_search_items($key_word)
	{
		$this->db->select('*');
		$this->db->from('main_category');
		$this->db->like('name',$key_word,'both');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

}