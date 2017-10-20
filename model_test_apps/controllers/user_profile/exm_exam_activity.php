<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exm_exam_activity extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->output->nocache();		
        $this->user_template->current_menu = 'exam_activity';
		$this->load->library('user_profile/exam_activity');
		$this->load->model('user_profile/exam_activities');
    }
	
	public function index(){
        $CI =& get_instance();
        $this->auth->check_user_auth();
        $CI->load->model('user_profile/exam_activities');

		$content = $this->exam_activity->get_exam_activity_view();
        $no_of_exam = $this->exam_activities->count_awaited_exam();
		$sub_menu = array(
			array('label'=> 'Activity log', 'url' => 'exam_activity','class' =>'exam-activity-nav-active'),
			array('label'=> 'Awaited exams <span class="awaited-exam-notific">'.$no_of_exam."</span>", 'url' => 'exam_activity/awaited_exam')
		);
		$this->user_template->exam_activity_template($content,$sub_menu);		
	}

	public function awaited_exam(){
		$CI =& get_instance();
		$this->auth->check_user_auth();
		$content = $this->exam_activity->get_awaited_exam_view();
		$sub_menu = array(
            array('label'=> 'Activity log', 'url' => 'exam_activity'),
            array('label'=> 'Awaited exams', 'url' => 'exam_activity/awaited_exam','class' =>'exam-activity-nav-active')
		);
		$this->user_template->exam_activity_template($content,$sub_menu);
	}
}