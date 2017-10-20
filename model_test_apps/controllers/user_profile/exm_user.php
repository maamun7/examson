<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exm_user extends CI_Controller {
	
	function __construct() {
		parent::__construct();

		//Clear all cache
        $this->output->nocache();
    }
	
	public function account(){	
		$CI =& get_instance();
        $this->user_template->current_menu = 'user';
		$this->auth->check_user_auth();
		$this->load->library('user_profile/user');
		$content = $this->user->get_user_default();
		$left_menu = array(
			array('label'=> 'Login Settings', 'url' => 'user/account','class' =>'left-nav-active'),
			array('label'=> 'Personal Details', 'url' => 'user/personal_info'),
			array('label'=> 'Sharing Preferences', 'url' => 'user/email_notification'),
			array('label'=> 'Points and Payment Status', 'url' => '#')
		);
		$this->user_template->account_template($content,$left_menu);		
	}

	public function edit_login_info(){	
		$CI =& get_instance();
		$this->auth->check_user_auth();		
		$this->load->library('user_profile/user');
		$this->load->model('user_profile/eusers');
		if($this->user->validateLoginData()){
			$login_info = array(
				'alternative_email' => $this->input->post('alternative_email',TRUE),
				'password' 			=> md5("onexam".$this->input->post('new_password',TRUE)),
				'edited_at' 		=> current_bd_date_time(),
			);

			$CI->eusers->update_login_info($login_info);

			$this->session->set_userdata(array('message'=>"Successfully Added !"));
			redirect(base_url('user/account'));
			exit;	
		}else{		
			$content = $this->user->get_login_edit_view();
			$left_menu = array(
				array('label'=> 'Login Settings', 'url' => 'user/edit_login_info','class' =>'left-nav-active'),
				array('label'=> 'Personal Details', 'url' => 'user/personal_info'),
				array('label'=> 'Sharing Preferences', 'url' => 'user/email_notification'),
				array('label'=> 'Points and Payment Status', 'url' => '#')
			);
			$this->user_template->account_template($content,$left_menu);
		}		
	}	

	public function personal_info(){	
		$CI =& get_instance();	
		$this->auth->check_user_auth();	
		$this->load->library('user_profile/user');
		$content = $this->user->get_personal_info_view();
		$left_menu = array(
			array('label'=> 'Login Settings', 'url' => 'user/account'),
			array('label'=> 'Personal Details', 'url' => 'user/personal_info','class' =>'left-nav-active'),
			array('label'=> 'Sharing Preferences', 'url' => 'user/email_notification'),
			array('label'=> 'Points and Payment Status', 'url' => '#')
		);
		$this->user_template->account_template($content,$left_menu);		
	}

	public function edit_personal_info(){	
		$CI =& get_instance();
		$this->auth->check_user_auth();		
		$this->load->library('user_profile/user');
		$this->load->model('user_profile/eusers');
		if($this->user->validatePersonalData()){
			$personal_info = array(
				'first_name' 		=> $this->input->post('first_name',TRUE),
				'last_name' 		=> $this->input->post('last_name',TRUE),
				'address'			=> $this->input->post('house',TRUE),
				'date_of_birth' 	=> $this->input->post('date_of_birth',TRUE),
				'mobile' 			=> $this->input->post('mobile',TRUE),
				'education_level' 	=> $this->input->post('education_level',TRUE),
				'employment_status' => $this->input->post('employment_status',TRUE),
				'last_edited_at' 	=> current_bd_date_time()
			);
			$CI->eusers->update_personal_info($personal_info);

			$this->session->set_userdata(array('message'=>"Successfully Updated !"));
			redirect(base_url('user/personal_info'));
			exit;	
		}else{		
			$content = $this->user->get_personal_info_edit_view();
			$left_menu = array(
				array('label'=> 'Login Settings', 'url' => 'user/account'),
				array('label'=> 'Personal Details', 'url' => 'user/edit_personal_info','class' =>'left-nav-active'),
				array('label'=> 'Sharing Preferences', 'url' => 'user/email_notification'),
				array('label'=> 'Points and Payment Status', 'url' => '#')
			);
			$this->user_template->account_template($content,$left_menu);
		}		
	}		

	public function email_notification(){	
		$CI =& get_instance();	
		$this->auth->check_user_auth();	
		$this->load->library('user_profile/user');		
		$content = $this->user->get_email_notification_view();
		$left_menu = array(
			array('label'=> 'Login Settings', 'url' => 'user/account'),
			array('label'=> 'Personal Details', 'url' => 'user/personal_info'),
			array('label'=> 'Sharing Preferences', 'url' => 'user/email_notification','class' =>'left-nav-active'),
			array('label'=> 'Points and Payment Status', 'url' => '#')
		);
		$this->user_template->account_template($content,$left_menu);		
	}
	
	public function edit_email_notification(){	
		$CI =& get_instance();
		$this->auth->check_user_auth();		
		$this->load->library('user_profile/user');
		$this->load->model('user_profile/eusers');
		if(isset($_POST['btn_email_nitif'])){
			$notification_info = array(
				'assigned_exam' 		=> $this->input->post('assigned_exam',TRUE),
				'send_exam' 			=> $this->input->post('send_exam',TRUE),
				'send_exam_report'		=> $this->input->post('send_exam_report',TRUE),
				'monthly_newsletter' 	=> $this->input->post('monthly_newsletter',TRUE)
			);
			$CI->eusers->update_email_notification($notification_info);

			$this->session->set_userdata(array('message'=>"Successfully Updated !"));
			redirect(base_url('user/email_notification'));
			exit;	
		}else{		
			$content = $this->user->get_notification_edit_view();
			$left_menu = array(
				array('label'=> 'Login Settings', 'url' => 'user/account'),
				array('label'=> 'Personal Details', 'url' => 'user/edit_personal_info'),
				array('label'=> 'Sharing Preferences', 'url' => 'user/edit_email_notification','class' =>'left-nav-active'),
				array('label'=> 'Points and Payment Status', 'url' => '#')
			);
			$this->user_template->account_template($content,$left_menu);
		}		
	}
	public function sign_out(){	
		$CI =& get_instance();	
		$this->auth->logout();	
		$this->session->set_userdata(array('message'=>"Successfully Sign out!"));
		redirect(base_url());	
	}
}