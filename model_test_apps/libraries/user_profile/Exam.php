<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exam {
	public function exam_start($question_sets,$exam_id,$subject_ids){
		$CI =& get_instance();
		$CI->load->model('front/exams');
		$duration = $CI->session->userdata('duration');
		$assign_id = $CI->session->userdata('assign_id');
		$i = 0;
		$data = array();
		$exam_sets = array();

		foreach ($question_sets as $key => $value) {$i++;
			$current=0;
			if ($value['is_current'] == 1) {
				$current = 1;
				//Get first question and option
				$question_option = $CI->exams->get_question_option($value['question_id'],$value['sequence_number'],$exam_id,$assign_id);

                foreach ($question_option as $indx => $val) {
					if ($val['id'] == $value['answer_id']) {
						$question_option[$indx]['checked']= "checked='checked'";
					}else{
						$question_option[$indx]['checked']= "";
					}
				}

				$data['question_option'] = $question_option;

				$data['hour'] = "00";
				$data['minute'] = "";
				$data['second'] = "00";
			}

			if ($duration > 0){
				$CI->session->unset_userdata('start_date');
				$start_date = $CI->session->userdata('start_date');

				if ($start_date =="") {						
					$CI->session->set_userdata(array('start_date'=>current_bd_date_time()));
					$start_date = current_bd_date_time();
				}
				$current_time = current_bd_date_time();
				$start_date = new DateTime($start_date);
				$since_start = $start_date->diff(new DateTime($current_time));
				$count_minute = $since_start->days * 24 * 60;
				$count_minute += $since_start->h * 60;
				$count_minute += $since_start->i;

				$duration -= $count_minute;
				if ($count_minute >= $duration) {
					# End exam time
					exit();
				}					

				if (floor($duration/60) > 0) {
					$data['hour'] = floor($duration/60);
				}
				$data['minute'] = $duration % 60;

			}
			$data['question_sets'] = $question_sets;
		}

		//Get Subject Name of Selected Question 
		$data['bredcumbs']="";
		$subjects=array();
		if (!empty($subject_ids)) {		
			foreach ($subject_ids as $subject_id => $val) {
				$subject_name = $CI->exams->get_exam_subject_name($subject_id);
				$subjects[$subject_name[0]['subject_name']] = $val;

				//Get Bredcumbs
				$data['bredcumbs'] = $subject_name[0]['cat_name'] . " > " . $subject_name[0]['sub_cat_name'] ;
			}
		}
		$data['subject_ids'] = $subjects;

        if ($CI->session->userdata('exam_type') == 1) {
            $data['bredcumbs'] = "Model Test > ".$CI->session->userdata('category_name') ."> ".$CI->session->userdata('sub_cat_name');
            $data['subject_ids'] = $CI->session->userdata('exam_name');
        }

		$view =  $CI->load->view('user_profile/exam/exam',$data,true);
		return $view;
	}

	public function exam_submit_view($question_sets,$exam_id){
		$CI =& get_instance();
		$CI->load->model('user_profile/exams');
		$duration= $CI->session->userdata('duration');
        $assign_id= $CI->session->userdata('assign_id');

		$i = 0;
		$data = array();
		$exam_sets = array();
		foreach ($question_sets as $key => $value) {$i++;
			$current=0;
			if ($value['is_current']==1) {
				$current=1;

				//Get first question and option
				$question_option = $CI->exams->get_question_option($value['question_id'],$value['sequence_number'],$exam_id,$assign_id);
				foreach ($question_option as $indx => $val) {
					if ($val['id'] == $value['answer_id']) {
						$question_option[$indx]['checked']="checked='checked'";
					}else{
						$question_option[$indx]['checked']="";
					}
				}

				$data['question_option'] = $question_option;
			}
			$data['question_sets'] = $question_sets;
		}

		if ($duration > 0){

			$start_date = $CI->session->userdata('start_date');
			if ($start_date =="") {						
				$CI->session->set_userdata(array('start_date'=>current_bd_date_time()));
				$start_date = current_bd_date_time();
			}
			$current_time = current_bd_date_time();
			$start_date = new DateTime($start_date);
			$since_start = $start_date->diff(new DateTime($current_time));
			$count_minute = $since_start->days * 24 * 60;
			$count_minute += $since_start->h * 60;
			$count_minute += $since_start->i;

			$duration -= $count_minute;
			if ($count_minute >= $duration) {
				# End exam time
			}					

			if (floor($duration/60) > 0) {
				$data['hour'] = floor($duration/60);
			}
			$data['minute'] = $duration % 60;

		}

        if ($CI->session->userdata('exam_type') == 1) {
            $data['bredcumbs'] = $CI->session->userdata('category_name');
            $data['subject_ids'] = $CI->session->userdata('exam_name');
        }
		
		$data['title'] = '###';
		$view =  $CI->load->view('user_profile/exam/exam_submit',$data,true);
		return $view;
	}


	public function get_report_view(){
		$CI =& get_instance();
		$CI->load->model('user_profile/exams');		
		//$exam_id = $CI->session->userdata('report_exam_id');
        $result_id = $CI->session->userdata('result_id');
		$user_id = $CI->a_auth->get_user_id();
		$report_data = $CI->exams->get_report_data($user_id,$result_id);
		if (!$report_data) {
			# Dont found data
            $CI->session->set_userdata(array('warning_message'=>"Do not found exam !"));
            redirect(base_url("exam_activity"));
            exit();
		}
		//For Subject Names
        $exam_id = $report_data[0]['exam_id'];
		$get_subject_ids = $CI->exams->get_all_subject_ids($exam_id);

		$subject_ids = array();
		if (!empty($get_subject_ids)) {
			$subject_ids = json_decode($get_subject_ids[0]['subject_ids'],true);
		}

		$subjects=array();
		$subject_name_string = "";
		if (!empty($subject_ids)) {	

			//Get final subject ids
			$final_subject_ids = array();
			foreach ($subject_ids as $k => $valu) {
				$final_subject_ids[] = $k;			
			}	

			$subject_names = $CI->exams->get_all_subject_names($final_subject_ids);

			if (!empty($subject_names)) {	
				foreach ($subject_names as $k => $valu) {
					$subject_name_string .= $valu['subject_name'] .",";
					
				}
			}
		}

		$basic_report = array();
		$advance_report = array();
		$circle_data = array();
		$user_answer = array();
		$correct_answer = array();
		$data['final_date'] = "";
		foreach ($report_data as $key => $value) {
			$basic_report['Total Questions'] = $value['total_question'];
			$basic_report['Answer'] = $value['total_correct'] + $value['total_incorrect'];
			$basic_report['Correct'] = $value['total_correct'];
			$basic_report['In correct'] = $value['total_incorrect'];
			$basic_report['Percentage'] = (($value['total_question']*$value['total_correct'])/100);

			$advance_report['Score'] = $value['total_correct'];
			$advance_report['Attempts Time'] = $value['attempt_time'];
			$advance_report['Previous Score'] = $value['previous_score'];
			$advance_report['Time spend/Question'] = ($value['time_spend']*60)/$value['total_question']." Seconds";
			$advance_report["Not Answered"] =  $value['total_not_answered'];
			$circle_data = json_decode($value['correct_incorrect_status'],true);
			$user_answer = json_decode($value['user_answers'],true);
			$correct_answers = json_decode($value['original_answers'],true);
		}

		$question_ans = array();
		$correct_answer_id = 0;
		if (!empty($user_answer)) {			
			$j = 0;
			foreach ($user_answer as $q_id => $user_ans_id) { $j++;
				if ($j==1) {
					$question_ans = $CI->exams->get_question_and_answer($q_id);
					if (!empty($question_ans)) {
						foreach ($question_ans as $in => $va) {

							if ($user_ans_id == $va['id']) {
								$question_ans[$in]['checked'] = "checked='checked'";
							}else{
								$question_ans[$in]['checked'] = "";
							}

							$right_option_id = $correct_answers[$q_id];
							if ($right_option_id== $va['id']) {
								$correct_answer_id = $va['id'];
							}
						}
					}
					break;
				}
			}
		}

		$data['title'] = 'Questionwise Report';
		$data['subject_name'] = $subject_name_string;
		$data['report_data'] = $report_data;
		$data['basic_report'] = $basic_report;
		$data['advance_report'] = $advance_report;
		$data['circle_datas'] = $circle_data;
		$data['question_ans'] = $question_ans;
		$data['correct_option_id'] = $correct_answer_id;
		$data['next_sequence_no'] = 2;
		$data['prev_sequence_no'] = "";
        $data['exam_name'] = $report_data[0]['exam_name'];
        $data['time_taken'] = $report_data[0]['time_spend'];
        $data['final_date'] = date_numeric_format($report_data[0]['assign_at']);
        $data['exam_type'] = "General Test";
        if ($report_data[0]['exam_type'] == 1) {
            $data['exam_type'] = "Model Test";
        }
		$view =  $CI->load->view('user_profile/exam/report',$data,true);
		return $view;
	}


	public function get_question_wise_report_view($question_id,$result_id){
		$CI =& get_instance();
		$CI->load->model('user_profile/exams');		
		$user_id = $CI->a_auth->get_user_id();
		$report_data = $CI->exams->get_report_data($user_id,$result_id);
		if (!$report_data) {
			# Dont found data
			exit();
		}
		$basic_report = array();
		$advance_report = array();
		$circle_data = array();
		$user_answer = array();
		$correct_answer = array();
		foreach ($report_data as $key => $value) {
			$user_answer = json_decode($value['user_answers'],true);
			$correct_answers = json_decode($value['original_answers'],true);
		}

		$question_ans = array();
		$correct_answer_id = 0;
		if (!empty($user_answer)) {			
			$j = 0;
			$next_sequence_no = 2;
			$prev_sequence_no = "";

			foreach ($user_answer as $q_id => $user_ans_id) { $j++;
				if ($q_id == $question_id) {

					$next_sequence_no = $j+1;
					$prev_sequence_no = $j-1;
					$question_sequence_no = $j;
					//add Zero before question sequence number if sequence number is less than 10
					if($question_sequence_no <10){
						$question_sequence_no = "0".$question_sequence_no;
					}

					$question_ans = $CI->exams->get_question_and_answer($q_id);
					if (!empty($question_ans)) {
						foreach ($question_ans as $in => $va) {

							if ($user_ans_id == $va['id']) {
								$question_ans[$in]['checked'] = "checked='checked'";
							}else{
								$question_ans[$in]['checked'] = "";
							}

							$right_option_id = $correct_answers[$q_id];
							if ($right_option_id== $va['id']) {
								$correct_answer_id = $va['id'];
							}
						}
					}
					break;
				}
			}
		}

		$data['title'] = 'Questionwise Report';
		$data['question_ans'] = $question_ans;
		$data['correct_option_id'] = $correct_answer_id;
		$data['quest_sequence_no'] = $question_sequence_no;
		$data['next_sequence_no'] = $next_sequence_no;
		$data['prev_sequence_no'] = $prev_sequence_no;
		$view =  $CI->load->view('user_profile/exam/question_wise_report',$data,true);
		return $view;
	}

}
