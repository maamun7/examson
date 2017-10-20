<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exm_exam_center extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->user_template->current_menu = 'exam_center';
    }
	
	public function index()
	{
		$CI =& get_instance();
		$this->load->library('front/exam_center');
		
		$content = $this->exam_center->get_exam_selector_view();
		$sub_menu = array();
		$this->template->exam_select_template($content,$sub_menu);
	}
	
	public function load_by_left_menu()
	{
		$CI =& get_instance();
		$this->load->library('front/exam_center');
		$category_id =  $_POST['category_id'];
		$content = $this->exam_center->get_topmenu_subjects_chapters($category_id);

		echo json_encode($content);
	}
	
	public function load_by_top_menu()
	{
		$CI =& get_instance();
		$this->load->library('front/exam_center');
		$top_menu_id =  $_POST['top_menu_id'];
		$content = $this->exam_center->get_subjects_chapters($top_menu_id);

		echo json_encode($content);
	}
	
	// Keep selected items in the cookie
	public function add_selected_chapter()
	{
		$CI =& get_instance();
		$this->load->library('front/exam_center');
		$chapter_id='';
		$chapter_name='';
		if (isset($_POST['selected_item'])) {		
			list($chapter_id,$chapter_name) = explode("=",$_POST['selected_item']);

			//$this->session->unset_userdata('selected_chapter');exit();

			$chapters=array();
			//Get session data
			$chapters= $this->session->userdata('selected_chapter');

			//Check if already exist item in the session
			if(!empty($chapters)) {			
				$this->selected_chapter_calculation($chapter_id,$chapter_name);
				//$chapters= $this->session->userdata('selected_chapter');
			}else{
				$new_chapters=array();
				$new_chapters[]=array('id'=>$chapter_id,'name'=>$chapter_name);
				$this->session->set_userdata(array('selected_chapter' =>array($new_chapters)));
				//$chapters= $this->session->userdata('selected_chapter');
			}
		}

		//return view
		$html_view = $this->exam_center->get_selected_chapter_html_view();
		print_r($html_view);

	}

	private function selected_chapter_calculation($chapter_id,$chapter_name)
	{
		$CI =& get_instance();
		$this->load->library('front/exam_center');
		$ids=array();
		$chapters= $this->session->userdata('selected_chapter');
		//Create an array using all chapter ids
		foreach ($chapters[0] as $key => $chapter) {
			$ids[]=$chapter['id'];
		}
		//Check if already exist
		if ( ! in_array($chapter_id, $ids, true)) {
			$new_chapters=array();
			foreach ($chapters[0] as $index => $valu) {
				$new_chapters[]=array('id'=>$valu['id'],'name'=>$valu['name']);
			}

			//Check maximum chapters limits				
			if (count($new_chapters)>10) {
				 $this->exam_center->is_exceed_limit = TRUE;	
			} else {				
				$new_id=array('id'=>$chapter_id,'name'=>$chapter_name);
				array_push($new_chapters,$new_id);
				$this->session->set_userdata(array('selected_chapter' =>array($new_chapters)));
			}
			
		}
		return TRUE;
	}

	public function remove_selected_chapter()
	{
		$CI =& get_instance();		
		$this->load->library('front/exam_center');
		$chapter_id='';
		$chapter_name='';
		if (isset($_POST['selected_item'])) {		
			list($chapter_id,$chapter_name) = explode("=",$_POST['selected_item']);

			//Get session data
			$chapters= $this->session->userdata('selected_chapter');

			if (!empty($chapters)) {
				
				$targeted_key ='';
				foreach ($chapters[0] as $index => $valu) {
					if ($chapter_id == $valu['id']) {					
						$selected_value=array('id'=>$chapter_id,'name'=>$chapter_name);
						$targeted_key = array_search($selected_value, $chapters[0]);
					}
				}

				if ($targeted_key !=="") {
					//delete targeted value
				    unset($chapters[0][$targeted_key]);

				    //After deleting value, reset session
				    $new_chapters=array();
					foreach ($chapters[0] as $index => $valu) {
						$new_chapters[]=array('id'=>$valu['id'],'name'=>$valu['name']);
					}
					if (!empty($new_chapters)) {
						$this->session->set_userdata(array('selected_chapter' =>array($new_chapters)));
					}else{
						$this->session->unset_userdata('selected_chapter');
					}
				}	
			}
		}
		//return view
		$html_view = $this->exam_center->get_selected_chapter_html_view();
		print_r($html_view);		

	}

    //Load model test
	public function load_model_test()
	{
		$CI =& get_instance();
		$this->load->library('front/exam_center');
		$location_id =  $_POST['location_id'];
		$content = $this->exam_center->get_model_test_view($location_id);
		echo json_encode($content);
	}
    //Load model test by click on the top menu
    public function load_model_test_by_top_menu()
    {
        $CI =& get_instance();
        $this->load->library('front/exam_center');
        $cat_id =  $_POST['top_menu_id'];
        $content = $this->exam_center->get_model_test_view_by_top_menu($cat_id);

        echo json_encode($content);
    }
	
	public function create_exam()
	{
		$CI =& get_instance();
        $this->auth->check_user_auth();
		$CI->load->model('front/exam_centers');
		$this->load->library('front/exam_center');
		//$this->load->library('Encryption');

		if($this->exam_center->validateForm()){
			$time_limit = $this->input->post('duration_time',TRUE);
			$total_question = $this->input->post('total_question',TRUE);
			if ($total_question != "") {
				if ($total_question > 100) {
					$total_question = 100;
				}
			}else{
				//
			}

			$chapter_ids = $this->input->post('chapter_id',TRUE);

			$limit = floor($total_question/count($chapter_ids));

			$counter = 0;
			$question_ids=array();
			$subject_ids=array();
			foreach ($chapter_ids as $key => $chapter_id) {

				// Equal to required question
				$counter = $counter + $limit;
				$left_total = $total_question - $counter;
				if ($left_total < $limit) {
					$limit = $limit + $left_total;
				}

				//Get Subjects id
				$subject_id = $this->exam_centers->get_exam_subject_id($chapter_id);
				
				//Bind subject id and no of questions per subject
				if ($subject_id) {
					$subject_ids[] = array($subject_id => $limit);
				}

				$question_ids[] = $this->exam_centers->get_exam_questions_ids($chapter_id,$limit);
			}

			//Summation all same subject id if have duplication
			$final_subject_ids = array();
			if (!empty($subject_ids)){ 			
				foreach ($subject_ids as $sub_array) {
					if (!empty($sub_array)){ 
						foreach ($sub_array as $subject_id => $val) {
							if (isset($final_subject_ids[$subject_id]))
						    {						       
								$final_subject_ids[$subject_id]+= $val;
						    }else{
						        $final_subject_ids[$subject_id] = $val;
						    }
						}
					}
				}
			}

			$final_q_ids = array();
			if (!empty($question_ids)){ 			
				foreach ($question_ids as $key => $value) {
					if (!empty($value)){ 
						foreach ($value as $index => $val) {
							$final_q_ids[] = $val['id'];
						}
					}
				}
			}

			$final_q_ids = implode(',',$final_q_ids);			
	        $final_q_ids = ','.$final_q_ids.',';

		/*	$chapter_ids = implode(',',$chapter_ids);
	        $chapter_ids = ','.$chapter_ids.','; */

	        $duration = $this->input->post('duration_time',TRUE);

	        $data = array(
				'id' 				=> null, 
				'exam_name' 	    => $this->input->post('exam_name',TRUE),
				'no_of_question' 	=> $this->input->post('total_question',TRUE),
				'duration' 			=> $duration,
				'subject_ids' 		=> json_encode($final_subject_ids),
				'question_ids'		=> $final_q_ids,
				'user_id' 			=> $this->a_auth->get_user_id(),
				'created_at' 		=> current_bd_date_time()
			);
			$exam_id = $this->exam_centers->insert_exam($data);

            $assign_info = array(
                'id' 				=> null,
                'exam_id' 	        => $exam_id,
                'assign_by' 		=> $this->a_auth->get_user_id(),
                'assign_to' 		=> $this->a_auth->get_user_id(),
                'assign_at' 		=> current_bd_date_time()
            );
            $assign_id = $this->exam_centers->insert_assign_info($assign_info);
			//Remove chapter id from sessions
			$CI->session->unset_userdata('selected_chapter');
			//Set session for inserted exam id
			$user_data = array('exam_id' => $exam_id,'exam_type' => 2,'duration' =>$duration,'assign_id' => $assign_id);
            $CI->session->set_userdata($user_data);
			$this->session->set_userdata(array('message'=>"Successfully added your exam test !"));
			redirect(base_url("exam/start"));
	    }else{	
	    	$error = $this->exam_center->getError();
	    	$msg = "";
	    	if ($error['Chapter'] != "") {
	    		$msg .= $error['Chapter']."<br/>";
	    	}else if ($error['time_limit'] != "") {
	    		$msg .= $error['time_limit']."<br/>";
	    	}else if ($error['total_question'] != "") {
	    		$msg .= $error['total_question'];
	    	}else if ($error['NoOfQuestion'] != "") {
	    		$msg .= $error['NoOfQuestion']."<br/>";
	    	}else if ($error['Exam_name'] != "") {
	    		$msg .= $error['Exam_name']."<br/>";
	    	}
			$this->session->set_userdata(array('warning_message'=>$msg));
			redirect(base_url('exam-center'));
	    }
	}
}