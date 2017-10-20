<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Signup {
	var $error = array();

	public function get_signup_view()
	{
		$CI =& get_instance();
		$CI->load->model('front/signups');
		
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
		
		if (isset($this->error['error_user_name'])) {
			$this->data['error_user_name'] = $this->error['error_user_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_user_name'] = '';
		}
		
		if (isset($this->error['error_password'])) {
			$this->data['error_password'] = $this->error['error_password'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_password'] = '';
		}
		
		if (isset($this->error['error_mobile_no'])) {
			$this->data['error_mobile_no'] = $this->error['error_mobile_no'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_mobile_no'] = '';
		}
		
		if (isset($this->error['error_user_type'])) {
			$this->data['error_user_type'] = $this->error['error_user_type'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_user_type'] = '';
		}
		
		if (isset($this->error['error_institute_name'])) {
			$this->data['error_institute_name'] = $this->error['error_institute_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_institute_name'] = '';
		}

		if(isset($_POST['first_name'])){
			$this->data['first_name_value'] = $CI->input->post('first_name');
		}

		if(isset($_POST['last_name'])){
			$this->data['last_name_value'] = $CI->input->post('last_name');
		}

		if(isset($_POST['user_name'])){
			$this->data['user_name_value'] = $CI->input->post('user_name');
		}

		if(isset($_POST['mobile_no'])){
			$this->data['mobile_no_value'] = $CI->input->post('mobile_no');
		}

		if(isset($_POST['user_type'])){
			$this->data['user_type_value'] = $CI->input->post('user_type');
		}

		if(isset($_POST['institute_name'])){
			$this->data['institute_name_value'] = $CI->input->post('institute_name');
		}

		$this->data['title'] = 'User registration';
		$this->data['action'] = base_url().'auth/signup';
		$html_view = $CI->parser->parse('front/signin-signup/signup',$this->data,true);
		return $html_view;
	}

	public function validateSignupData()
	{	
		$CI =& get_instance();
		$CI->load->model('front/signups');

		if(isset($_POST['first_name'])){
			if($CI->input->post('first_name') ==''){
				$this->error['error_first_name']="First name is required";
			} elseif(strlen($CI->input->post('first_name'))<3 || strlen($CI->input->post('first_name'))>25){
				$this->error['error_first_name']="First name must be between 3 to 25 characters";
			}
		} else {
			$this->error['error_first_name'] = "";
		}

		if(isset($_POST['last_name'])){
			if($CI->input->post('last_name') ==''){
				$this->error['error_last_name']="Last name is required";
			} elseif(strlen($CI->input->post('last_name'))<3 || strlen($CI->input->post('last_name'))>25){
				$this->error['error_last_name']="Last name must be between 3 to 25 characters";
			}
		} else {
			$this->error['error_last_name'] = "";
		}

		if(isset($_POST['user_name'])){
			if($CI->input->post('user_name') ==''){
				$this->error['error_user_name']="User name/email is required";
			} elseif(!filter_var($CI->input->post('user_name'), FILTER_VALIDATE_EMAIL)) {
			    $this->error['error_user_name']="Invalid user name/email";
			} elseif($CI->signups->email_existency_check($CI->input->post('user_name')) === TRUE) {
			    $this->error['error_user_name']="Already exist your provided email id";
			}
		} else {
			$this->error['error_user_name'] = "";
		}

		if(isset($_POST['password'])){
			if($CI->input->post('password') ==''){
				$this->error['error_password'] = "Password is required";
			} elseif(strlen($CI->input->post('password'))<8 || strlen($CI->input->post('password'))>30){
				$this->error['error_password']="Password must be between 8 to 30 characters";
			}
		} else {
			$this->error['error_password'] = "";
		}

		if(isset($_POST['mobile_no'])){
			if($CI->input->post('mobile_no') ==''){
				$this->error['error_mobile_no']="Mobile number is required";
			} elseif(strlen($CI->input->post('mobile_no'))<6 || strlen($CI->input->post('mobile_no'))>20){
				$this->error['error_mobile_no']="Mobile number must be between 6 to 20 characters";
			}
			/*
			 elseif(! is_int($CI->input->post('mobile_no'))){
				$this->error['error_mobile_no']="Mobile number must be numeric number";
			}
			*/
		} else {
			$this->error['error_mobile_no']="";
		}

		if(isset($_POST['user_type'])){
			if($CI->input->post('user_type') == ''){
				$this->error['error_user_type']="Select user type";
			} 
		} else {
			$this->error['error_user_type']="";
		}

		if(isset($_POST['user_type']) && $CI->input->post('user_type') == 3){
			if(isset($_POST['institute_name'])){
				if($CI->input->post('institute_name') ==''){
					$this->error['error_institute_name'] = "Institute name is required";
				} 
			} else {
				$this->error['error_institute_name'] = "";
			}				
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}

    public function send_verification_mail_to_user($verify_code)
    {
        $CI =& get_instance();

        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $this->email->initialize($config);

        if ($email_id) {
            $this->email->from("Cellex Support Team");
            $email_subject="Cellex Limited";

            $full_message  ="Dear Concern,<br/>";
            $full_message .="Greetings from Model test.<br/>";
            $full_message .="The status of your quarry / complain is: <br/>";
            $full_message .="<strong>Ticket Number: “".$password."”</strong> [ Please keep the Ticket Number for further uses ]<br/>";
            $full_message .="<strong>Estimated Time Required :  “". $password ."”  Minutes</strong><br/>";
            $full_message .="Phone: <strong>(+88) 01790 33 22 00</strong><br/>";
            $full_message .="Skype ID: <strong>cellex_noc</strong><br/>";
            $full_message .="<a href='www.cellexltd.com' target='_blank'>www.cellexltd.com </a>";

            $this->email->to($email_id);
            $this->email->subject($email_subject);
            $this->email->message($full_message);
            $this->email->send();
        }
    }
}
