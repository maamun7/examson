<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exm_exam extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		//Clear all cache
        $this->output->nocache();
        $this->user_template->current_menu = 'exam_center';
    }

    public function exam_start($exam_id,$assign_id,$exam_type){
        $CI =& get_instance();
        $this->auth->check_user_auth();
        $user_data = array('exam_id' => $exam_id,'assign_id' => $assign_id,'exam_type' => $exam_type);
        $CI->session->set_userdata($user_data);
        redirect(base_url("exam/start"));
    }

    public function start_model_test($direct_exam_id = null){
        $CI =& get_instance();
        $this->load->model("front/exam_centers");
        $this->auth->check_user_auth();
        $exam_id = $this->input->post('model_test',TRUE);
        if ($exam_id == '') {
            $exam_id = $direct_exam_id;
        }

        //Insert assign info
        $assign_info = array(
            'id' 				=> null,
            'exam_id' 	        => $exam_id,
            'assign_by' 		=> $this->a_auth->get_user_id(),
            'assign_to' 		=> $this->a_auth->get_user_id(),
            'assign_at' 		=> current_bd_date_time(),
            'exam_status' 		=> 0
        );

        $assign_id = $this->exam_centers->insert_assign_info($assign_info);
        $exam_duration = $this->exam_centers->get_exam_duration($exam_id);

        $user_data = array('exam_id' => $exam_id,'exam_type' => 1,'assign_id' => $assign_id,'duration' => "",'exam_name' => "",'category_name' => "");
        if ($exam_duration) {
            $user_data = array(
                'exam_id' => $exam_id,
                'exam_type' => 1,
                'assign_id' => $assign_id,
                'duration' => $exam_duration[0]['duration'],
                'exam_name' => $exam_duration[0]['exam_name'],
                'category_name' => $exam_duration[0]['category_name'],
                'sub_cat_name' => $exam_duration[0]['sub_cat_name']
            );
        }
        $CI->session->set_userdata($user_data);
        redirect(base_url("exam/start"));
    }

    public function start(){
        $CI =& get_instance();

        $this->auth->check_user_auth();
        $this->load->model("user_profile/exams");
        $this->load->library('user_profile/exam');
        $exam_id = $this->session->userdata('exam_id');
        $exam_type = $this->session->userdata('exam_type');
        $assign_id = $this->session->userdata('assign_id');
        if ($exam_id =="") {
            $this->session->set_userdata(array('warning_message'=>"Did not found exam !"));
            redirect(base_url("exam_activity"));
            exit();
        }

        $question_sets = $this->exams->get_question_sets($exam_id);
        $subject_ids = array();
        $question_id_string="";
        if (!empty($question_sets)) {
            $question_id_string = $question_sets[0]['question_ids'];
            $subject_ids = json_decode($question_sets[0]['subject_ids'],true);
        }

        if ($question_id_string !="") {
            //Remove comma from first and end of question ids strings
            $question_id_string = substr($question_id_string,1);
            $question_id_string = substr($question_id_string,0,-1);
        }else{
            //There is no question for this exam
        }

        //Set question sets into sessions
        $final_ques_ids = explode(",",$question_id_string);

        $exam_question_sets = array();
        if(count($final_ques_ids)>0) {
            //Save to database
            $exam_question_sets = $this->exams->save_during_exam_state($exam_id,$final_ques_ids,$assign_id);
        }

        //Go to exam view page with all exam ids
        $content = $this->exam->exam_start($exam_question_sets,$exam_id,$subject_ids);
        $this->user_template->template($content);
    }

    public function submit_exam(){
        $CI =& get_instance();
        $this->load->model("user_profile/exams");
        $this->load->library('user_profile/exam');

        $exam_id = $this->session->userdata('exam_id');
        $exam_type = $this->session->userdata('exam_type');
        $assign_id = $this->session->userdata('assign_id');
        if ($exam_id =="") {
            if ($exam_type=="basic_exam") {
                //Go to user profile basic exam page
            }elseif ($exam_type=="model_test") {
                //Go to user profile model test exam page
            }
        }

        // Get form submit value
        $question_id = $this->input->post('question_id',TRUE);
        $option_id = $this->input->post('answer_option',TRUE);
        $is_answered = 0;
        $is_no_answered = 1;
        if ($option_id !="") {
            $is_answered = 1;
            $is_no_answered = 0;
        }
        $sequence_no = $this->input->post('sequence_no',TRUE);
        $option_type = $this->input->post('option_type',TRUE);

        //update database value

        $data = array();
        $data['is_current'] = 0;
        $data['is_answered'] = $is_answered;
        $data['is_not_answered'] = $is_no_answered;
        $data['is_marked'] = 0;
        $data['answer_id'] = $option_id;

        switch ($option_type) {
            case 'make_review':
                $data['is_marked'] = 1;
                break;
            case 'skip':
                $data['is_answered'] = 0;
                $data['is_not_answered'] = 1;
                break;
            case 'save_next':
                # code...
                break;
            default:
                # code...
                break;
        }

        $exam_question_sets = array();
        if(count($data)>0) {
            //Save to data base
            $exam_question_sets = $this->exams->save_user_feedback($data,$exam_id,$question_id,$sequence_no,$assign_id);
        }
        //Go to exam view page with exam all ids
        $content = $this->exam->exam_submit_view($exam_question_sets,$exam_id);
        echo $content;
        //$this->user_template->template($content);
    }

    public function single_q_exam(){
        $CI =& get_instance();
        $this->load->model("user_profile/exams");
        $this->load->library('user_profile/exam');

        $exam_id = $this->session->userdata('exam_id');
        $exam_type = $this->session->userdata('exam_type');
        $assign_id = $this->session->userdata('assign_id');
        if ($exam_id =="") {
            if ($exam_type=="basic_exam") {
                //Go to user profile basic exam page
            }elseif ($exam_type=="model_test") {
                //Go to user profile model test exam page
            }
        }

        // Get form ajax
        $ids =  $_POST['ids'];
        list($sequence_no,$question_id)= explode("@",$ids);

        $exam_question_sets = array();
        if($question_id !="" AND $sequence_no !="") {
            //Save to data base
            $exam_question_sets = $this->exams->single_exam_question($exam_id,$question_id,$sequence_no,$assign_id);
        }
        //Go to exam view page with exam all ids
        $content = $this->exam->exam_submit_view($exam_question_sets,$exam_id);
        echo $content;
        //$this->user_template->template($content);
    }

    public function save_user_result(){
        $CI =& get_instance();
        $this->load->model("user_profile/exams");
        $this->load->library('user_profile/exam');

        $exam_id = $this->session->userdata('exam_id');
        $exam_type = $this->session->userdata('exam_type');
        $assign_id = $this->session->userdata('assign_id');
        if ($exam_id =="") {
            // Go te Profile With notifications
            exit();
        }

        // Get all question ids from db

        $question_sets = $this->exams->get_question_sets($exam_id);

        $subject_ids = array();

        $question_id_string="";
        if (!empty($question_sets)) {
            $question_id_string = $question_sets[0]['question_ids'];
        }

        if ($question_id_string !="") {
            //Remove comma from first and end of question ids strings
            $question_id_string = substr($question_id_string,1);
            $question_id_string = substr($question_id_string,0,-1);
        }else{
            //There is no question for this exam
        }

        //Calculate time
        $start_date = $CI->session->userdata('start_date');

        $current_time = current_bd_date_time();
        $start_date = new DateTime($start_date);
        $since_start = $start_date->diff(new DateTime($current_time));
        $count_time = $since_start->days * 24 * 60;
        $count_time += $since_start->h * 60;
        $count_time += $since_start->i;

        $result_id = "";
        //Convert Question String to array
        $final_ques_ids = explode(",",$question_id_string);
        if (!empty($final_ques_ids)) {
            $answered_array = array();
            $orginal_ans_array = array();
            $wrong_right_sts = array();
            $count_wrong_ans = 0;
            $count_right_ans = 0;
            $count_isnot_ans = 0;
            $total_question = 0;
            $user_id = $this->a_auth->get_user_id();
            $assign_id = $this->session->userdata('assign_id');

            foreach ($final_ques_ids as $key => $question_id) {
                $results = $this->exams->get_result_making_data($exam_id,$question_id,$user_id,$assign_id);
                $total_question += 1;
                $answered_array[$question_id] = $results['ans_option_id'];
                $orginal_ans_array[$question_id] = $results['original_option_id'];

                if ($results['original_option_id'] !== "") {
                    if ($results['ans_option_id'] == $results['original_option_id']) {
                        $count_right_ans += 1;
                        $wrong_right_sts[$question_id] = 1;
                    }else{
                        $count_wrong_ans += 1;
                        $wrong_right_sts[$question_id] = 0;
                    }
                }else{
                    $count_isnot_ans += 1;
                    $wrong_right_sts[$question_id] = "";
                }
            }

            $data = array();
            $data['exam_id']					= $exam_id;
            $data['user_id']					= $user_id;
            $data['user_answers'] 				= json_encode($answered_array);
            $data['original_answers'] 			= json_encode($orginal_ans_array);
            $data['correct_incorrect_status'] 	= json_encode($wrong_right_sts);
            $data['total_question'] 			= $total_question;
            $data['total_correct'] 				= $count_right_ans;
            $data['total_incorrect'] 			= $count_wrong_ans;
            $data['total_not_answered'] 		= $count_isnot_ans;
            $data['time_spend'] 				= $count_time;
            $data['exam_type'] 					= $exam_type;
            $data['examed_on'] 					= current_bd_date_time();
            $data['assign_by'] 					= $assign_id;

            $result_id = $this->exams->save_result($data,$exam_id,$user_id);
        }
        //Delete all current exam state
        $this->exams->delete_exam_state($exam_id,$user_id,$assign_id);

        // Change exam status (assign_exam table )
        $this->exams->change_exam_status($exam_id,$user_id,$assign_id);

        // Change popular model test if exam is model test
        if ($exam_type == 1) {
            $this->exams->update_popular_model_test($exam_id);
        }

        // Unset all session
        $CI->session->unset_userdata('exam_id');
        $CI->session->unset_userdata('exam_name');
        $CI->session->unset_userdata('start_date');
        $CI->session->unset_userdata('duration');
        $CI->session->unset_userdata('assign_id');
        $CI->session->unset_userdata('category_name');
        //Saved exam result and going to showing report

        $this->session->set_userdata(array('message'=>"Successfully saved your exam result!"));
        redirect(base_url("exam/report/".$result_id));
    }

    public function report($result_id = null){
        $CI =& get_instance();
        $this->auth->check_user_auth();
        $this->load->library('user_profile/exam');
        if (!$result_id) {
            //You didn't selecet exam to view report
            $this->session->set_userdata(array('warning_message'=>"Did not select exam !"));
            redirect(base_url("exam_activity"));
            exit();
        }
        $this->session->set_userdata(array('result_id'=>$result_id));
        $content = $this->exam->get_report_view();
        $this->user_template->template($content);
    }

    public function question_wise_report(){
        $CI =& get_instance();
        $this->load->library('user_profile/exam');
        $exam_id = $CI->session->userdata('report_exam_id');
        $result_id = $CI->session->userdata('result_id');
        if ($result_id =="") {
            //You didn't selecet exam to view report
            exit();
        }
        $question_id =  $_POST['ques_id'];
        $content = $this->exam->get_question_wise_report_view($question_id,$result_id);
        echo $content;
        //$this->user_template->template($content);
    }

}
// Start exam after selected chapters
