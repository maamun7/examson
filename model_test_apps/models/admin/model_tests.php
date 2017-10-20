<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_tests extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function count_model_test()
	{
		$where=array('a.is_delete'=>0,'a.exam_type'=>1,'b.is_delete'=>0);
		
		$this->db->select('a.*,b.id as sub_cat_id,b.sub_cat_name');
		$this->db->from('all_exam a');
		$this->db->join('model_test_sub_cat b','b.id = a.model_test_sub_cat');
		$this->db->where($where);
		$query = $this->db->get();		
		return $query->num_rows();
	}
	
	public function get_category_list($limit,$page)
	{
        $where=array('a.is_delete'=>0,'a.exam_type'=>1,'b.is_delete'=>0);

        $this->db->select('a.*,b.id as sub_cat_id,b.sub_cat_name,c.category_name');
        $this->db->from('all_exam a');
        $this->db->join('model_test_sub_cat b','b.id = a.model_test_sub_cat');
        $this->db->join('model_test_category c','c.id = b.category_id');
        $this->db->where($where);
        $this->db->order_by('a.id','asc');
		$this->db->limit($limit,$page); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function get_parent_categories()
	{
		$this->db->select('*');
		$this->db->from('model_test_category'); 
		$this->db->where(array('is_delete'=>0,'published'=>1));
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function get_subject_parents()
	{
		$where=array('a.is_delete'=>0,'a.published'=>1,'a.parent_id !=' =>0);
		
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

	public function get_all_subjects($sub_cat_id)
	{
		$where=array('a.is_delete'=>0,'a.published'=>1,'a.sub_category_id'=>$sub_cat_id);

		$this->db->select('a.id as subject_id ,a.subject_name');
		$this->db->from('subject a');
		$this->db->order_by('a.id','asc');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function get_question_ids($subject_id,$question_limit)
	{
		$where=array('a.status'=>1,'b.published'=>1,'c.published'=>1,'c.id'=>$subject_id);

		$this->db->select('a.id');
		$this->db->from('question a');
		$this->db->join('chapter b','b.id = a.chapter_id');
		$this->db->join('subject c','c.id = b.subject_id');
		$this->db->order_by('a.id','random');
		$this->db->where($where);
		$this->db->limit($question_limit);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
            $final_id = "";
            //Array to comma separated string
            foreach ($query->result_array() as $key => $val) {
                $final_id .= $val['id'].",";
            }

            return $final_id;
		}else{
			return false;
		}
	}
	
	public function get_all_questions($chapter_id)
	{
		$where=array('a.status'=>1,'a.chapter_id'=>$chapter_id);
		
		$this->db->select('a.id as question_id,a.details');
		$this->db->from('question a'); 
		$this->db->order_by('a.id','asc');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function get_edited_questions($question_ids)
	{
		$this->db->select('a.id as question_id,a.details');
		$this->db->from('question a'); 
		$this->db->order_by('a.id','asc');
		$this->db->where_in($question_ids);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}
	
	public function insert($data)
	{
		$this->db->insert('all_exam',$data);
		return true;
	}
	
	public function get_edit_data($model_test_id)
	{
		$where=array('a.is_delete'=>0,'a.exam_type'=>1,'a.id'=>$model_test_id,'b.is_delete'=>0,'c.is_delete'=>0,'c.published'=>1);
		
		$this->db->select('a.*,b.id as sub_cat_id,b.sub_cat_name,c.id as cat_id,c.category_name');
		$this->db->from('all_exam a');
		$this->db->join('model_test_sub_cat b','b.id = a.model_test_sub_cat');
		$this->db->join('model_test_category c','c.id = b.category_id');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function get_only_subject_name($sub_q_ids)
	{
        $complete_array = [];
        $array = array();
		foreach ($sub_q_ids as $k=>$v) {

            $this->db->select('subject_name');
            $this->db->from('subject');
            $this->db->where('id',$k);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $result = $query->result_array();
                $array['subject_id'] = $k;
                $array['subject_name'] = $result[0]['subject_name'];
                $array['no_of_q'] = $v;
                $complete_array[] = $array;
            }
        }
        return $complete_array;
	}
	
	public function update($data,$model_test_id)
	{
		$this->db->where('id',$model_test_id);
		$this->db->update('all_exam',$data);
		return true;
	}

    public function get_sub_categories($category_id)
    {
        $this->db->select('id,sub_cat_name');
        $this->db->from('model_test_sub_cat');
        $this->db->where(array('is_delete'=>0,'category_id'=>$category_id));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    }
	
	public function do_change_status($mod_test_id)
	{
		$this->db->select('model_test_status');
		$this->db->from('all_exam');
		$this->db->where(array('id'=>$mod_test_id,'model_test_status'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$this->db->where('id',$mod_test_id);
			$this->db->update('all_exam',array('model_test_status'=>0));
			return true; 
		}

		$this->db->where('id',$mod_test_id);
		$this->db->update('all_exam',array('model_test_status'=>1));
		return true;
	}
	
	public function do_delete($mod_test_id)
	{
		$this->db->where('id',$mod_test_id);
		$this->db->update('all_exam',array('is_delete'=>1));
		return true;
	}

}