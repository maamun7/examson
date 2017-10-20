<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Questions extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function total_question()
	{
		$this->db->select('*');
		$this->db->from('question'); 
		$this->db->where(array('status'=>1));
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function get_list($limit,$page)
	{
		$where=array('b.is_delete'=>0,'b.published'=>1,'c.is_delete'=>0,'c.published'=>1);
		
		$this->db->select('a.*,b.chapter_name,c.subject_name');
		$this->db->from('question a'); 
		$this->db->join('chapter b','b.id=a.chapter_id'); 
		$this->db->join('subject c','c.id = b.subject_id'); 
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
	
	public function get_questions_details($question_id)
	{
		$this->db->select('*');
		$this->db->from('question');
		$this->db->where(array('id'=>$question_id));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function get_all_options($question_id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('question_options a');
		$this->db->join('question_answer b','b.answer_option_id = a.id','left'); 
		$this->db->where(array('a.question_id'=>$question_id));		
		$this->db->order_by('a.id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
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

	public function get_chapters($subject_id)
	{
		$this->db->select('id,chapter_name');
		$this->db->from('chapter'); 
		$this->db->where(array('subject_id '=>$subject_id,'is_delete'=>0,'published'=>1));
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
		$this->db->where(array('sub_category_id'=>$subject_id,'published'=>1,'is_delete'=>0));
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function insert_question($question_data)
	{
		$this->db->insert('question',$question_data);
		return $this->db->insert_id();
	}

	public function insert_option($option_data)
	{
		$this->db->insert('question_options',$option_data);
		return $this->db->insert_id();
	}

	public function insert_right_answer($answer_data)
	{
		$this->db->insert('question_answer',$answer_data);
		return true;
	}
	
	public function get_edit_data($question_id)
	{
		$where = array('a.id'=>$question_id,'b.is_delete'=>0,'c.is_delete'=>0,'d.is_delete'=>0,'e.is_delete'=>0);

		$a_table = 'a.id as question_id,a.details,a.chapter_id,a.image as ques_pic,a.image_path as ques_pic_path';
		
		$this->db->select($a_table.',x.*,y.*,b.id as chapter_id,c.id as subject_id,d.id as sub_category_id,e.id as category_id');
		$this->db->from('question a'); 
		$this->db->join('question_options x','x.question_id = a.id'); 
		$this->db->join('question_answer y','y.answer_option_id = x.id','left'); 
		$this->db->join('chapter b','b.id = a.chapter_id'); 
		$this->db->join('subject c','c.id = b.subject_id'); 
		$this->db->join('main_category d','d.id = c.sub_category_id'); 
		$this->db->join('main_category e','e.id = d.parent_id'); 
		$this->db->order_by('x.id','asc'); 
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function get_all_chapters($subject_id)
	{
		$this->db->select('id,chapter_name');
		$this->db->from('chapter'); 
		$this->db->where(array('subject_id'=>$subject_id,'published'=>1,'is_delete'=>0));
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function update_question($question_id,$question_data)
	{
		$this->db->where('id',$question_id);
		$this->db->update('question',$question_data); 
		return true;
	}
	
	public function update_option($option_id,$option_data)
	{
		$this->db->where('id',$option_id);
		$this->db->update('question_options',$option_data); 
		return true;
	}
	
	public function update_right_answer($question_id,$option_id)
	{
		
		$this->db->select('question_id');
		$this->db->from('question_answer');
		$this->db->where(array('question_id'=>$question_id));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$this->db->where('question_id',$question_id);
			$this->db->update('question_answer',array('answer_option_id'=>$option_id));
			return true; 
		}

		$this->db->insert('question_answer',array('answer_id'=>null,'question_id'=>$question_id,'answer_option_id'=>$option_id));
		return true;
	}
	
	public function do_change_status($question_id)
	{
		
		$this->db->select('status');
		$this->db->from('question');
		$this->db->where(array('id'=>$question_id,'status'=>1));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$this->db->where('id',$question_id);
			$this->db->update('question',array('status'=>0));
			return true; 
		}

		$this->db->where('id',$question_id);
		$this->db->update('question',array('status'=>1)); 
		return true;
	}
	
	public function do_delete($question_id)
	{
		$this->db->where('id',$question_id);
		$this->db->delete('question'); 
		return true;
	}

	public function get_all_option_ids($question_id)
	{
		$this->db->select('id');
		$this->db->from('question_options');
		$this->db->where(array('question_id'=>$question_id));		
		$this->db->order_by('id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function do_delete_picture($table_name,$id)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where(array('id'=>$id));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();			
			$origin_pic = $result[0]['image_path']."".$result[0]['image'];
			$thum_path = substr($result[0]['image_path'], 0, -6);
			$thum_pic = $thum_path."/".$result[0]['image'];

            if (file_exists($origin_pic)) {
            	unlink($origin_pic);
            }

            if (file_exists($thum_pic)) {
            	unlink($thum_pic);
            }
		}
		$data = array(
			'image'			=> "",
			'image_path'	=> ""
			);

		$this->db->where('id',$id);
		$this->db->update($table_name,$data); 

		return true;
	}
	
	public function do_delete_option($option_id)
	{
		$this->db->select('*');
		$this->db->from('question_options');
		$this->db->where(array('id'=>$option_id));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();			
			$origin_pic = $result[0]['image_path']."".$result[0]['image'];
			$thum_path = substr($result[0]['image_path'], 0, -6);
			$thum_pic = $thum_path."/".$result[0]['image'];
            if (file_exists($origin_pic)) {
            	unlink($origin_pic);
            }

            if (file_exists($thum_pic)) {
            	unlink($thum_pic);
            }
		}

		$this->db->where('id',$option_id);
		$this->db->delete('question_options'); 

		$this->do_delete_right_answer($option_id);
		return true;
	}	
	private function do_delete_right_answer($option_id)
	{
		$this->db->where('answer_option_id',$option_id);
		$this->db->delete('question_answer'); 
		return true;
	}
	
	public function get_search_items($key_word)
	{
		$where=array('b.is_delete'=>0,'b.published'=>1,'c.is_delete'=>0,'c.published'=>1);
		
		$this->db->select('a.*,b.chapter_name,c.subject_name');
		$this->db->from('question a'); 
		$this->db->join('chapter b','b.id=a.chapter_id'); 
		$this->db->join('subject c','c.id = b.subject_id'); 
		$this->db->where($where);
		$this->db->order_by('a.id','asc');
		$this->db->like('details',$key_word,'both');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function get_search_user_data($user_id)
	{
		$where=array('b.is_delete'=>0,'b.published'=>1,'c.is_delete'=>0,'c.published'=>1,'x.user_id'=>$user_id);
		
		$this->db->select('a.*,x.first_name,x.last_name,b.chapter_name,c.subject_name');
		$this->db->from('question a'); 
		$this->db->join('users x','x.user_id=a.creator_id'); 
		$this->db->join('chapter b','b.id=a.chapter_id'); 
		$this->db->join('subject c','c.id = b.subject_id'); 
		$this->db->where($where);
		$this->db->order_by('a.id','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}
	
	public function get_system_users()
	{
		$where = array('a.status'=>1,'b.user_type'=>1);
		
		$this->db->select('*');
		$this->db->from('users a'); 		
		$this->db->join('user_login b','b.user_id=a.user_id'); 
		$this->db->where($where);
		$this->db->order_by('a.first_name','asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

}