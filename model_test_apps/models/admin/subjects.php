<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subjects extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function total_subject()
	{
		$this->db->select('*');
		$this->db->from('subject');
		$this->db->where('is_delete',0);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function get_list($limit,$page)
	{
		$where=array('a.is_delete'=>0,'b.is_delete'=>0,'c.is_delete'=>0);
		
		$this->db->select('a.*,b.name as sub_cat_name,c.name as category_name');
		$this->db->from('subject a'); 
		$this->db->join('main_category b','b.id = a.sub_category_id'); 
		$this->db->join('main_category c','c.id = b.parent_id'); 
		$this->db->where($where);
		$this->db->order_by('id','asc');
		$this->db->limit($limit,$page); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function get_parent()
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

	public function get_categories($category_id){
	
		$this->db->select('id,name');
		$this->db->from('main_category');
		$this->db->where(array('is_delete'=>0,'published'=>1,'parent_id'=>$category_id));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	public function get_sub_category($category_id){
	
		$this->db->select('id,name');
		$this->db->from('main_category');
		$this->db->where(array('parent_id'=>$category_id,'is_delete'=>0,'parent_id !='=>0));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function insert($data)
	{
		$this->db->insert('subject',$data);

		$this->update_subject_json();
		return true;
	}
	
	public function get_edit_data($subject_id)
	{
		$where=array('a.id'=>$subject_id,'a.is_delete'=>0,'b.is_delete'=>0,'c.is_delete'=>0);
		
		$this->db->select('a.*,b.id as sub_category_id,c.id as category_id');
		$this->db->from('subject a'); 
		$this->db->join('main_category b','b.id = a.sub_category_id'); 
		$this->db->join('main_category c','c.id = b.parent_id'); 
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function update($data,$subject_id)
	{
		$this->db->where('id',$subject_id);
		$this->db->update('subject',$data); 

		$this->update_subject_json();
		return true;
	}
	
	public function do_change_status($subject_id)
	{
		
		$this->db->select('published');
		$this->db->from('subject');
		$this->db->where(array('id'=>$subject_id,'published'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$this->db->where('id',$subject_id);
			$this->db->update('subject',array('published'=>0));
			return true; 
		}

		$this->db->where('id',$subject_id);
		$this->db->update('subject',array('published'=>1)); 
		return true;
	}
	
	public function do_delete($subject_id)
	{
		$this->db->where('id',$subject_id);
		$this->db->update('subject',array('is_delete'=>1)); 

		$this->update_subject_json();
		return true;
	}
	
	public function get_search_items($key_word)
	{
		$where=array('a.is_delete'=>0,'b.is_delete'=>0,'c.is_delete'=>0);
		
		$this->db->select('a.*,b.name as sub_cat_name,c.name as category_name');
		$this->db->from('subject a'); 
		$this->db->join('main_category b','b.id = a.sub_category_id'); 
		$this->db->join('main_category c','c.id = b.parent_id'); 
		$this->db->where($where);
		$this->db->order_by('id','asc');
		$this->db->like('subject_name',$key_word,'both');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function update_subject_json()
	{
		$this->db->select('id,subject_name');
		$this->db->from('subject');
		$this->db->where('published',1);
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$json_data[] = array('label'=>$row->subject_name,'value'=>$row->id);
		}
		$cache_file = $_SERVER['DOCUMENT_ROOT'].'/examson/my-assets/admin/js/autocomplete/subject.json';
		$subjectList = json_encode($json_data);
		file_put_contents($cache_file,$subjectList);
	}
}