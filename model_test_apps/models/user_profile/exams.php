<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exams extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_question_sets($exam_id)
	{
		$where=array('id'=>$exam_id);
		$this->db->select('no_of_question,duration,subject_ids,question_ids');
		$this->db->from('all_exam');
		$this->db->where($where);  
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function get_exam_subject_name($subject_id){
		$this->db->select('c.subject_name,d.name as sub_cat_name,e.name as cat_name');
		$this->db->from('subject c'); 
		$this->db->join('main_category d','d.id = c.sub_category_id'); 
		$this->db->join('main_category e','e.id = d.parent_id');
		$this->db->where('c.id',$subject_id);		
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();
		}
		return false;
	}

	public function save_during_exam_state($exam_id,$final_ques_ids,$assign_id)
	{
		//Check if already exist this exam
		$is_exist = $this->this_exam_if_exist($exam_id);
		if ($is_exist) {
		
			$i = 0;
			$data = array();
			foreach ($final_ques_ids as $key => $q_id) {$i++;
				$current=0;
				if ($i==1) {
					$current=1;
				}
				$data['sequence_exam_id'] = null;
				$data['exam_id'] = $exam_id;
				$data['user_id'] = $this->a_auth->get_user_id();
				$data['question_id'] = $q_id;
				$data['sequence_number'] = $i;
				$data['is_current'] = $current;
				$data['is_answered'] = "";
				$data['is_marked'] = "";
				$data['assign_id'] = $this->session->userdata('assign_id');
				$this->db->insert('during_exam_state',$data);
			}

            //Now exam_status will change to 2 which is mean this exam is not completed or just running
            $where = array('exam_id'=>$exam_id,'id'=>$assign_id,'assign_to'=>$this->a_auth->get_user_id());
            $this->db->where($where);
            $this->db->update('assigned_exam',array('exam_status'=>2));
        }
		//Return Saved Questions Sets
		$question_sets = $this->get_saved_question_sets($exam_id,$assign_id);
		return $question_sets;
	}

	public function this_exam_if_exist($exam_id)
	{
		$where=array('exam_id'=>$exam_id,'user_id'=>$this->a_auth->get_user_id());
		$this->db->select('exam_id');
		$this->db->from('during_exam_state'); 		
		$this->db->where($where);  
		$query = $this->db->get();
		if ($query->num_rows() > 0) {	
			return false;
		}else{
			return true;
		}
	}

	public function get_saved_question_sets($exam_id,$assign_id)
	{
		$where=array('exam_id'=>$exam_id,'assign_id'=>$assign_id);
		$this->db->select('*');
		$this->db->from('during_exam_state'); 		
		$this->db->where($where);  
		$query = $this->db->get();
		if ($query->num_rows() > 0) {	
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function get_question_option($question_id,$sequence_no,$exam_id,$assign_id)
	{
		$where = array(
			'a.id'=>$question_id,
			'b.is_delete'=>0,
			'c.is_delete'=>0,
			'd.is_delete'=>0,
			'e.is_delete'=>0,
			'f.sequence_number'=>$sequence_no,
			'f.exam_id'=>$exam_id,
			'f.assign_id'=>$assign_id,
		);

		$a_table = 'a.id as question_id,a.details,a.image as ques_pic,a.image_path as ques_pic_path';
		
		$this->db->select($a_table.',x.*,f.sequence_number');
		$this->db->from('question a'); 
		$this->db->join('question_options x','x.question_id = a.id'); 
		$this->db->join('chapter b','b.id = a.chapter_id'); 
		$this->db->join('subject c','c.id = b.subject_id'); 
		$this->db->join('main_category d','d.id = c.sub_category_id'); 
		$this->db->join('main_category e','e.id = d.parent_id'); 
		$this->db->join('during_exam_state f','f.question_id = x.question_id'); 
		$this->db->order_by('x.id','asc'); 
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			return $query->result_array();	
		}
		return false;
	}

	public function save_user_feedback($data,$exam_id,$question_id,$sequence_no,$assign_id)
	{
		$where = array(
			'question_id'		=>$question_id,
			'sequence_number'	=>$sequence_no,
			'exam_id'			=>$exam_id,
			'assign_id'		=>$assign_id
		);
		$this->db->where($where);
		$this->db->update('during_exam_state',$data); 

		//Another update for changing current question
		$sequence_no =$sequence_no+1;
		$this->update_current_question($exam_id,$sequence_no,$question_id ="",$assign_id);
		//Return Saved Questions Sets
		$question_sets = $this->get_saved_question_sets($exam_id,$assign_id);
		return $question_sets;
	}

	public function update_current_question($exam_id,$sequence_no,$question_id,$assign_id)
	{	
		$where = array();
		$where['exam_id'] = $exam_id;
		$where['sequence_number'] = $sequence_no;
		$where['assign_id'] = $assign_id;
		if ($question_id !="") {
			$where['question_id'] = $question_id;
		}
		$this->db->where($where);
		$this->db->update('during_exam_state',array('is_current'=>1)); 
		return true;
	}

	// If user click on the single questions
	public function single_exam_question($exam_id,$question_id,$sequence_no,$assign_id)
	{
		//All exam current question value update into zero
		$this->update_all_current_question($exam_id,$assign_id);

		//Another update for changing current question
		$this->update_current_question($exam_id,$sequence_no,$question_id,$assign_id);
		//Return Saved Questions Sets
		$question_sets = $this->get_saved_question_sets($exam_id,$assign_id);
		return $question_sets;
	}

	public function update_all_current_question($exam_id,$assign_id)
	{		
		$this->db->where(array('exam_id'=>$exam_id,'assign_id'=>$assign_id));
		$this->db->update('during_exam_state',array('is_current'=>0)); 
		return true;
	}

	public function get_result_making_data($exam_id,$question_id,$user_id,$assign_id)
	{	
		$return_result = array();	
		$where = array(
			'exam_id'		=>$exam_id,
			'question_id'	=>$question_id,
			'user_id'		=>$user_id,
			'assign_id'		=>$assign_id
		);

		$this->db->select('answer_id');
		$this->db->from('during_exam_state'); 		
		$this->db->where($where);  
		$query = $this->db->get();
		if ($query->num_rows() > 0) {	
			$result = $query->result_array();
			$return_result['ans_option_id'] = $result[0]['answer_id'];
		}else{
			$return_result['ans_option_id'] = "";
		}

		//Get original option id
		$this->db->select('answer_option_id');
		$this->db->from('question_answer'); 		
		$this->db->where('question_id',$question_id);  
		$q = $this->db->get();
		if ($q->num_rows() > 0) {	
			$another_result = $q->result_array();
			$return_result['original_option_id'] = $another_result[0]['answer_option_id'];
		}else{
			$return_result['original_option_id'] = "";
		}

		return $return_result;
	}

	public function save_result($data,$exam_id,$user_id)
	{

        $data['id'] 		= null;
		$where = array(
			'exam_id'		=>$exam_id,
			'user_id'		=>$user_id
		);

		$this->db->select('attempt_time,total_correct');
		$this->db->from('all_exam_result');
		$this->db->where($where);
        $this->db->order_by('id','desc');
        $this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {	
			$result = $query->result_array();
			$data['attempt_time'] 	= $result[0]['attempt_time'] +1;
			$data['previous_score'] = $result[0]['total_correct'];
		}else{
			$data['attempt_time'] 	= 1;
            $data['previous_score'] = 0;
		}

        $this->db->insert('all_exam_result',$data);
        $result_id = $this->db->insert_id();

        //Save to exam and result relation table
        $relation_data 	= array("exam_id" => $exam_id,"result_id" => $result_id);
        $this->db->insert('exam_result_relation',$relation_data);
		return $result_id;
	}

	public function delete_exam_state($exam_id,$user_id,$assign_id)
	{	
		$where = array(
			'exam_id'		=>$exam_id,
			'user_id'	    =>$user_id,
            'assign_id'		=>$assign_id
		);
		$this->db->where($where);
		$this->db->delete('during_exam_state');
		return true;
	}

	public function change_exam_status($exam_id,$user_id,$assign_id)
	{
		$where = array(
			'exam_id'	=>$exam_id,
			'assign_to'	=>$user_id,
            'id'	=>$assign_id
		);
		$this->db->where($where);
		$this->db->update('assigned_exam',array('exam_status'=>1));
		return true;
	}

	public function update_popular_model_test($exam_id)
	{
		$where = array(
			'exam_id'	=>$exam_id
		);
        $this->db->select('*');
        $this->db->from('popular_model_test');
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->where('exam_id', $exam_id);
            $this->db->set('total_participate', 'total_participate+1', FALSE);
            $this->db->update('popular_model_test');
        }else{
            $this->db->insert('popular_model_test',array('exam_id' => $exam_id,'total_participate' => 1));
        }
        return true;
	}

	public function get_report_data($user_id,$result_id)
	{	
		$where = array(
			'a.user_id'	=>$user_id,
            'a.id'	=>$result_id
		);
		$this->db->select('a.*,c.exam_name,d.assign_at');
		$this->db->from('all_exam_result a');
        $this->db->join('exam_result_relation b','b.result_id = a.id');
        $this->db->join('all_exam c','c.id = a.exam_id');
        $this->db->join('assigned_exam d','d.exam_id = a.exam_id');
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {	
			return $query->result_array();
		}else{
			return false;
		}
	}

	//This function return a single questio and its all option for showing question wise report
	public function get_question_and_answer($question_id)
	{
		$where = array(
			'a.id'=>$question_id,
			'b.is_delete'=>0,
			'c.is_delete'=>0,
			'd.is_delete'=>0,
			'e.is_delete'=>0
		);

		$a_table = 'a.id as question_id,a.details,a.image as ques_pic,a.image_path as ques_pic_path';
		
		$this->db->select($a_table.',x.*');
		$this->db->from('question a'); 
		$this->db->join('question_options x','x.question_id = a.id'); 
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

	public function get_all_subject_ids($exam_id)
	{
		$where=array('id'=>$exam_id);
		$this->db->select('subject_ids');
		$this->db->from('all_exam');
		$this->db->where($where);  
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}

	public function get_all_subject_names($subject_ids)
	{
		$this->db->select('subject_name');
		$this->db->from('subject'); 		
		$this->db->where_in('id',$subject_ids);  
		$this->db->order_by('id','asc');  		 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}
	}

}