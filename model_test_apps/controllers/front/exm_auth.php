<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exm_auth extends CI_Controller {
	
	function __construct() {
      parent::__construct();
    }
	
	//User signup/register
	public function signup()
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
            $verify_code = "";
            $this->signup->send_verification_mail_to_user($verify_code);

			$this->session->set_userdata(array('message'=>"Succesfully registered,Send mail to user !"));
			redirect(base_url());
			exit;

		}else{		
			$content = $this->signup->get_signup_view();
			$left_menu = array();
			$this->template->home_template($content,$left_menu);
		}	
	}
	
	public function verify_registration()
	{
		
	}
	
	//User sign in
	public function signin()
	{
		$CI =& get_instance();
		$this->load->library('auth');
		$this->load->library('front/signin');
		$this->load->model('front/auths');

		if($this->signin->validateSigninData()){

			$user_name = $this->input->post('user_name');
			$password = $this->input->post('password');

			//Go to create session and cookie
			$this->signin->create_session($user_name,$password);

			$user_type = $this->auth->get_user_type();

			//redirec to page after logedin
				
			if ($user_type == 1)
			{
				//Go to admin
				$this->output->set_header("Location: ".base_url().'admin/cdashboard/login', TRUE, 302);
			} elseif ($user_type == 2) {
				//Go to
                $present_url = $CI->session->userdata('present_url');
                $CI->session->unset_userdata(array('present_url'=>""));

                if($present_url ==''){
                    $url = base_url();
                }else{
                    $url = $present_url;
                }
                //redirect($url,'refresh'); exit;
				$this->output->set_header("Location: ".$url, TRUE, 302);
			}	
		}else{		
			$content = $this->signin->get_signin_view();
			$left_menu = array();
			$this->template->home_template($content,$left_menu);
		}	
	}
	
	//Logout
	public function signout()
	{
		$CI =& get_instance();
		$this->load->library('front/exam_center');
		
		$content = $this->exam_center->get_exam_selector_view();
		$sub_menu = array();
		$this->template->exam_select_template($content,$sub_menu);
	}
}