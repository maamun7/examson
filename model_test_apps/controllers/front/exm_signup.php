<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exm_signup extends CI_Controller {
	
	function __construct() {
      parent::__construct();
    }
	
	public function index()
	{
		$CI =& get_instance();
		$this->load->library('front/signup');
		
		if($this->signup->validateSignupData()){
			$CI->load->model('signups');
			$security_key = md5(time() ."". $this->input->post('user_name',TRUE));

			$basic_data = array(
				'user_id' 		=> Null,
				'first_name' 	=> $this->input->post('first_name',TRUE),
				'last_name' 	=> $this->input->post('last_name',TRUE),
				'mobile' 		=> $this->input->post('mobile_no',TRUE),
				'created_at' 	=> current_bd_date_time(),
				'status' 		=> 1
			);

			$user_id = $this->signups->insert_basic_info($basic_data);

			$login_data = array(
				'id' 				=> Null,
				'user_id' 			=> $user_id,
				'username' 			=> $this->input->post('user_name',TRUE),
				'password' 			=> md5("onexam".$this->input->post('password',TRUE)),
				'user_type' 		=> $this->input->post('user_type'),
				'is_active' 		=> 0,
				'can_login' 		=> 0,
				'security_code' 	=> $security_key
			);
			$this->signups->insert_login_info($login_data);

			//Send mail to user

			$this->session->set_userdata(array('message'=>"Succesfully registered,Send mail to user !"));
			redirect(base_url());
			exit;

		}else{		
			$content = $this->signup->get_signup_view();
			$left_menu = array();
			$this->template->home_template($content,$left_menu);
		}	
	}
}