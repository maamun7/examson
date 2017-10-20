<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class chapters extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function total_chapter()
	{
		$this->db->select('*');
		$this->db->from('chapter'); 
		$this->db->where(array('is_delete'=>0));
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function get_list($limit,$page)
	{
		$where=array('a.is_delete'=>0,'b.is_delete'=>0,'c.is_delete'=>0,'d.is_delete'=>0);
		
		$this->db->select('a.*,b.subject_name,c.name as sub_cat_name,d.name as category_name');
		$this->db->from('chapter a'); 
		$this->db->join('subject b','b.id = a.subject_id'); 
		$this->db->join('main_category c','c.id = b.sub_category_id'); 
		$this->db->join('main_category d','d.id = c.parent_id'); 
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

	public function get_categories($category_id)
	{	
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

	public function get_subjects($sub_cat_id)
	{
		$this->db->select('id,subject_name');
		$this->db->from('subject'); 
		$this->db->where(array('sub_category_id '=>$sub_cat_id,'is_delete'=>0));
		$this->db->order_by('id','asc');
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

	public function get_all_subject($subject_id)
	{
		$this->db->select('id,subject_name');
		$this->db->from('subject'); 
		$this->db->where(array('id'=>$subject_id,'published'=>1,'is_delete'=>0));
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function insert($data)
	{
		$this->db->insert('chapter',$data);
		return true;
	}
	
	public function get_edit_data($chapter_id)
	{
		$where=array('a.id'=>$chapter_id,'a.is_delete'=>0,'b.is_delete'=>0,'c.is_delete'=>0,'d.is_delete'=>0);
		
		$this->db->select('a.*,b.id as subject_id,c.id as sub_category_id,d.id as category_id');
		$this->db->from('chapter a'); 
		$this->db->join('subject b','b.id = a.subject_id'); 
		$this->db->join('main_category c','c.id = b.sub_category_id'); 
		$this->db->join('main_category d','d.id = c.parent_id'); 
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function update($data,$chapter_id)
	{
		$this->db->where('id',$chapter_id);
		$this->db->update('chapter',$data); 
		return true;
	}
	
	public function do_change_status($chapter_id)
	{
		
		$this->db->select('published');
		$this->db->from('chapter');
		$this->db->where(array('id'=>$chapter_id,'published'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$this->db->where('id',$chapter_id);
			$this->db->update('chapter',array('published'=>0));
			return true; 
		}

		$this->db->where('id',$chapter_id);
		$this->db->update('chapter',array('published'=>1)); 
		return true;
	}
	
	public function do_delete($chapter_id)
	{
		$this->db->where('id',$chapter_id);
		$this->db->update('chapter',array('is_delete'=>1)); 
		return true;
	}
	
	public function get_search_items($key_word)
	{
		$where=array('a.is_delete'=>0,'b.is_delete'=>0,'c.is_delete'=>0,'d.is_delete'=>0);
		
		$this->db->select('a.*,b.subject_name,c.name as sub_cat_name,d.name as category_name');
		$this->db->from('chapter a'); 
		$this->db->join('subject b','b.id = a.subject_id'); 
		$this->db->join('main_category c','c.id = b.sub_category_id'); 
		$this->db->join('main_category d','d.id = c.parent_id'); 
		$this->db->order_by('id','asc');
		$this->db->like('chapter_name',$key_word,'both');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

}