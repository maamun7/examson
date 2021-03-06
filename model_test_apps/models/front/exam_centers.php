<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exam_centers extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_left_category()
	{
		$where=array('a.is_delete'=>0,'a.published'=>1,'a.parent_id'=>0);
		
		$this->db->select('a.id,a.name');
		$this->db->from('main_category a'); 
		$this->db->order_by('a.ordering','asc');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function get_top_category($category_id)
	{
		$where=array('a.is_delete'=>0,'a.published'=>1,'a.parent_id'=>$category_id);
		
		$this->db->select('a.id,a.name');
		$this->db->from('main_category a'); 
		$this->db->order_by('a.ordering','asc');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function get_all_subjects($sub_cat_id)
	{
		$where=array('a.is_delete'=>0,'a.published'=>1,'a.sub_category_id'=>$sub_cat_id);
		
		$this->db->select('a.id as subject_id,a.subject_name');
		$this->db->from('subject a'); 
		$this->db->order_by('a.ordering','desc');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function get_all_chapters($subject_id)
	{
		$where=array('a.is_delete'=>0,'a.published'=>1,'a.subject_id'=>$subject_id);
		
		$this->db->select('a.id as chapter_id,a.chapter_name');
		$this->db->from('chapter a'); 
		$this->db->order_by('a.ordering','asc');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function get_chapter_question($chapter_id)
	{
		$where=array('chapter_id'=>$chapter_id);
		$this->db->select('id');
		$this->db->from('question'); 
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->num_rows();
		}else{
			return 0;
		}
	}
	
	public function get_model_test_cat($location_id)
	{
		$where=array('a.is_delete'=>0,'a.published'=>1,'a.location_id'=>$location_id);
		
		$this->db->select('a.id as cat_id,a.category_name');
		$this->db->from('model_test_category a'); 
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function get_model_test_sub_cat($cat_id)
	{
		$where=array('a.is_delete'=>0,'a.category_id'=>$cat_id);

		$this->db->select('a.id as sub_cat_id,a.sub_cat_name');
		$this->db->from('model_test_sub_cat a');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function get_model_test($sub_cat_id)
	{
		$where = array('a.is_delete'=>0,'a.exam_type'=>1,'a.model_test_status'=>1,'a.model_test_sub_cat'=>$sub_cat_id);
		
		$this->db->select('a.id,a.exam_name');
		$this->db->from('all_exam a');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function get_exam_subject_id($chapter_id){
		$this->db->select('a.subject_id');
		$this->db->from('chapter a'); 
		$this->db->join('subject b','b.id = a.subject_id'); 
		$this->db->where('a.id',$chapter_id);		
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result[0]['subject_id'];
		}
		return false;
	}

	public function get_exam_questions_ids($chapter_id,$limit=null){
		$this->db->select('id');
		$this->db->from('question'); 
		$this->db->where('chapter_id',$chapter_id); 
		$this->db->order_by('id', 'RANDOM');
		$this->db->limit($limit);	
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function insert_exam($data){
		$this->db->insert('all_exam',$data);
		return $this->db->insert_id();
	}

    public function insert_assign_info($assign_info){
		$this->db->insert('assigned_exam',$assign_info);
        return $this->db->insert_id();
	}

    public function get_exam_duration($exam_id){
        $this->db->select('a.exam_name,a.duration,b.sub_cat_name,c.category_name');
        $this->db->from('all_exam a');
        $this->db->join('model_test_sub_cat b','b.id = a.model_test_sub_cat');
        $this->db->join('model_test_category c','c.id = b.category_id');
        $this->db->where(array('a.id' => $exam_id,'exam_type' => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
	}
}