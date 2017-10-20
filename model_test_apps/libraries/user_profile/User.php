<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User {

	public function get_user_default(){		
		$CI =& get_instance();
		$data = array(
			'user_name' => $CI->auth->get_user_name()
		);		
		$html_view = $CI->parser->parse('user_profile/user/account',$data,true);
		return $html_view;
	}
	
	public function get_login_edit_view()
	{
		$CI =& get_instance();
		$CI->load->model('user_profile/eusers');
		
		$this->data['error_warning'] = "";
		if (isset($this->error['error_current_password'])) {
			$this->data['error_current_password'] = $this->error['error_current_password'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_current_password'] = '';
		}
		
		if (isset($this->error['error_new_password'])) {
			$this->data['error_new_password'] = $this->error['error_new_password'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_new_password'] = '';
		}
		
		if (isset($this->error['error_confirm_password'])) {
			$this->data['error_confirm_password'] = $this->error['error_confirm_password'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_confirm_password'] = '';
		}
		
		if (isset($this->error['error_alternative_email'])) {
			$this->data['error_alternative_email'] = $this->error['error_alternative_email'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_alternative_email'] = '';
		}

		//$edit_data = $CI->suppliers->get_edit_data($supplier_id);
		
		/*
		if(isset($_POST['current_password'])){
			$this->data['current_password_value'] = $CI->input->post('current_password');
		}

		if(isset($_POST['new_password'])){
			$this->data['new_password_value'] = $CI->input->post('new_password');
		}
		
		
		if(isset($_POST['confirm_password'])){
			$this->data['confirm_password_value'] = $CI->input->post('confirm_password');
		}
		*/

		if(isset($_POST['alternative_email'])){
			$this->data['alternative_email_value'] = $CI->input->post('alternative_email');
		}

		$this->data['title'] = 'Edit Login Info';
		$this->data['user_name'] = $CI->auth->get_user_name();		
		$this->data['action'] = base_url().'user/edit_login_info';		
		$html_view = $CI->parser->parse('user_profile/user/edit_login_info',$this->data,true);
		return $html_view;
	}

	public function validateLoginData()
	{	
		$CI =& get_instance();
		$CI->load->model('user_profile/eusers');

		if(isset($_POST['current_password'])){
			if(strlen($CI->input->post('current_password'))==''){
				$this->error['error_current_password']="Current password is required";
			} elseif(strlen($CI->input->post('current_password'))<6 || strlen($CI->input->post('current_password'))>20){
				$this->error['error_current_password']="Current password must be between 6 to 20 characters";
			} 
			if($CI->eusers->check_current_password(md5("onexam".$CI->input->post('current_password',TRUE))) === false){
				$this->error['error_current_password']="Incorrect current password";
			}
		} else {
			$this->error['error_current_password']="";
		}

		if(isset($_POST['new_password'])){
			if(strlen($CI->input->post('new_password'))==''){
				$this->error['error_new_password']="New password is required";
			} elseif(strlen($CI->input->post('new_password'))<6 || strlen($CI->input->post('new_password'))>20){
				$this->error['error_new_password']="New Password must be between 6 to 20 characters";
			}
		} else {
			$this->error['error_new_password']="";
		}

		if(isset($_POST['confirm_password']) && isset($_POST['new_password'])){
			if($CI->input->post('confirm_password') != $CI->input->post('new_password')){
				$this->error['error_confirm_password']="Retyped password doesn't match with new password";
			} 
		} else {
			$this->error['error_confirm_password']="";
		}

		if(isset($_POST['alternative_email'])){
			if($CI->input->post('alternative_email') !=''){
				if(!filter_var($CI->input->post('alternative_email'), FILTER_VALIDATE_EMAIL)) {
			   		$this->error['error_alternative_email']="Invalid alternative email";
				}
			} 
		} else {
			$this->error['error_alternative_email']="";
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
	
	public function get_personal_info_view(){		
		$CI =& get_instance();
		$CI->load->model('user_profile/eusers');
		$data = array();
		$personal_info = $CI->eusers->get_personal_info();
		if(!empty($personal_info)){
			$data['first_name'] = $personal_info[0]['first_name'];
			$data['last_name'] = $personal_info[0]['last_name'];
			$data['date_of_birth'] = $personal_info[0]['date_of_birth'];
			$data['house'] = $personal_info[0]['address'];
			$data['mobile'] = $personal_info[0]['mobile'];
			$data['education_level'] = $personal_info[0]['education_level'];
			$data['employment_status'] = $personal_info[0]['employment_status'];
		}
		$data['title'] = 'User personal info';
		$html_view = $CI->parser->parse('user_profile/user/personal_info',$data,true);
		return $html_view;
	}
	
	public function get_personal_info_edit_view()
	{
		$CI =& get_instance();
		$CI->load->model('user_profile/eusers');
		
		$this->data['error_warning'] = "";
		if (isset($this->error['error_first_name'])) {
			$this->data['error_first_name'] = $this->error['error_first_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_first_name'] = '';
		}
		
		if (isset($this->error['error_last_name'])) {
			$this->data['error_last_name'] = $this->error['error_last_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_last_name'] = '';
		}
		
		if (isset($this->error['error_date_of_birth'])) {
			$this->data['error_date_of_birth'] = $this->error['error_date_of_birth'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_date_of_birth'] = '';
		}
		
		if (isset($this->error['error_house'])) {
			$this->data['error_house'] = $this->error['error_house'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_house'] = '';
		}
		
		if (isset($this->error['error_mobile'])) {
			$this->data['error_mobile'] = $this->error['error_mobile'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_mobile'] = '';
		}
				
		if (isset($this->error['error_education_level'])) {
			$this->data['error_education_level'] = $this->error['error_education_level'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_education_level'] = '';
		}
				
		if (isset($this->error['error_empl_status'])) {
			$this->data['error_empl_status'] = $this->error['error_empl_status'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_empl_status'] = '';
		}
		
		$personal_info = $CI->eusers->get_personal_info();
		if(!empty($personal_info)){
			$this->data['first_name_value'] = $personal_info[0]['first_name'];
			$this->data['last_name_value'] = $personal_info[0]['last_name'];
			$this->data['dbo_value'] = $personal_info[0]['date_of_birth'];
			$this->data['house_value'] = $personal_info[0]['address'];
			$this->data['mobile_value'] = $personal_info[0]['mobile'];
			$this->data['education_level_value'] = $personal_info[0]['education_level'];
			$this->data['empl_status_value'] = $personal_info[0]['employment_status'];
		}
		
		if(isset($_POST['first_name'])){
			$this->data['first_name_value'] = $CI->input->post('first_name');
		}
		if(isset($_POST['last_name'])){
			$this->data['last_name_value'] = $CI->input->post('last_name');
		}
		if(isset($_POST['date_of_birth'])){
			$this->data['dbo_value'] = $CI->input->post('date_of_birth');
		}
		if(isset($_POST['house'])){
			$this->data['house_value'] = $CI->input->post('house');
		}
		if(isset($_POST['mobile'])){
			$this->data['mobile_value'] = $CI->input->post('mobile');
		}
		if(isset($_POST['education_level'])){
			$this->data['education_level_value'] = $CI->input->post('education_level');
		}
		if(isset($_POST['employment_status'])){
			$this->data['empl_status_value'] = $CI->input->post('employment_status');
		}

		$this->data['title'] = 'Edit Login Info';	
		$this->data['action'] = base_url().'user/edit_personal_info';		
		$html_view = $CI->parser->parse('user_profile/user/edit_personal_info',$this->data,true);
		return $html_view;
	}

	public function validatePersonalData()
	{	
		$CI =& get_instance();
		$CI->load->model('user_profile/eusers');

		if(isset($_POST['first_name'])){
			if($CI->input->post('first_name')==''){
				$this->error['error_first_name']="First name is required";
			}
		} else {
			$this->error['error_first_name']="";
		}

		if(isset($_POST['last_name'])){
			if($CI->input->post('last_name')==''){
				$this->error['error_last_name']="Last name is required";
			}
		} else {
			$this->error['error_last_name']="";
		}

		if(isset($_POST['house'])){
			if($CI->input->post('house')==''){
				$this->error['error_house']="Address is required";
			}
		} else {
			$this->error['error_house']="";
		}

		if(isset($_POST['date_of_birth'])){
			if($CI->input->post('date_of_birth')==''){
				$this->error['error_date_of_birth']="Date of birth is required";
			}
		} else {
			$this->error['error_date_of_birth']="";
		}

		if(isset($_POST['mobile'])){
			if($CI->input->post('mobile')==''){
				$this->error['error_mobile']="Mobile number is required";
			} elseif(strlen($CI->input->post('mobile'))<11 || strlen($CI->input->post('mobile'))>20){
				$this->error['error_mobile']="Current password must be between 11 to 20 characters";
			}
		} else {
			$this->error['error_mobile']="";
		}

		if(isset($_POST['education_level'])){
			if($CI->input->post('education_level')==''){
				$this->error['error_education_level']="Last education level is required";
			}
		} else {
			$this->error['error_education_level']="";
		}

		if(isset($_POST['employment_status'])){
			if($CI->input->post('employment_status')==''){
				$this->error['error_empl_status']="Employment status is required";
			}
		} else {
			$this->error['error_empl_status']="";
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
	
	public function get_email_notification_view(){		
		$CI =& get_instance();
		$CI->load->model('user_profile/eusers');
		$data = array();
		$notification_info = $CI->eusers->get_notification_info();
		//$data['assigned_exam'] = "";$data['send_exam'] = "";$data['send_exam_report'] = "";$data['monthly_newsletter'] = "";
		if(!empty($notification_info)){
			$data['assigned_exam'] = $notification_info[0]['assigned_exam'];
			$data['send_exam'] = $notification_info[0]['send_exam'];
			$data['send_exam_report'] = $notification_info[0]['send_exam_report'];
			$data['monthly_newsletter'] = $notification_info[0]['monthly_newsletter'];
		}
		$data['title'] = 'Email notification';
		$html_view = $CI->parser->parse('user_profile/user/email_notification',$data,true);
		return $html_view;
	}
		
	public function get_notification_edit_view()
	{
		$CI =& get_instance();
		$CI->load->model('user_profile/eusers');
		
		if($CI->eusers->isnot_already_entry() === FALSE){
			//New entry to notification table 
			$CI->eusers->entry_email_notification();
		}
		
		$notification_info = $CI->eusers->get_notification_info();

		if(!empty($notification_info)){
			$this->data['assigned_exam_value'] = $notification_info[0]['assigned_exam'];
			$this->data['send_exam_value'] = $notification_info[0]['send_exam'];
			$this->data['send_exam_report_value'] = $notification_info[0]['send_exam_report'];
			$this->data['monthly_newsletter_value'] = $notification_info[0]['monthly_newsletter'];
		}
		
		$this->data['title'] = 'Edit email notification';	
		$this->data['action'] = base_url().'user/edit_email_notification';		
		$html_view = $CI->parser->parse('user_profile/user/edit_email_notification',$this->data,true);
		return $html_view;
	}
}