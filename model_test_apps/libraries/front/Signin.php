<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Signin {
	var $error = array();

	public function get_signin_view()
	{
		$CI =& get_instance();
		$CI->load->model('front/signins');
		
		$this->data['error_warning'] = "";
		
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
		
		if (isset($this->error['error_invalid_user'])) {
			$this->data['error_invalid_user'] = $this->error['error_invalid_user'];
		} else {
			$this->data['error_invalid_user'] = '';
		}

		if(isset($_POST['user_name'])){
			$this->data['user_name_value'] = $CI->input->post('user_name');
		}

		$this->data['title'] = 'User login';
		$this->data['action'] = base_url().'auth/signin';
		$html_view = $CI->parser->parse('front/signin-signup/signin',$this->data,true);
		return $html_view;
	}

	public function validateSigninData()
	{	
		$CI =& get_instance();
		$CI->load->model('front/auths');

		if(isset($_POST['user_name'])){
			if($CI->input->post('user_name') ==''){
				$this->error['error_user_name']="User name/email is required";
			} elseif(!filter_var($CI->input->post('user_name'), FILTER_VALIDATE_EMAIL)) {
			    $this->error['error_user_name']="Invalid user name/email";
			}
		} else {
			$this->error['error_user_name'] = "";
		}

		if(isset($_POST['password'])){
			if($CI->input->post('password') ==''){
				$this->error['error_password'] = "Password is required";
			}
		} else {
			$this->error['error_password'] = "";
		}


		if(isset($_POST['user_name']) && isset($_POST['password'])){
			if($CI->auths->check_valid_user($CI->input->post('user_name'),$CI->input->post('password')) === false){
				$this->error['error_invalid_user'] = "Incorrect email or password !";
			}
		} else {
			$this->error['error_invalid_user'] = "";
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}

	//Login....
	public function create_session($username,$password)
	{
		$CI =& get_instance();
		$CI->load->model('front/auths'); 
		$result = $CI->auths->get_session_data($username,$password);

        if ($result)
		{
			$key = md5(time());
			$key = str_replace("1", "z", $key);
			$key = str_replace("2", "J", $key);
			$key = str_replace("3", "y", $key);
			$key = str_replace("4", "R", $key);
			$key = str_replace("5", "Kd", $key);
			$key = str_replace("6", "jX", $key);
			$key = str_replace("7", "dH", $key);
			$key = str_replace("8", "p", $key);
			$key = str_replace("9", "Uf", $key);
			$key = str_replace("0", "eXnyiKFj", $key);
			$sid_web = substr($key, rand(0, 3), rand(28, 32));
			
			// codeigniter session stored data			
			$user_data = array(
				'sid_web' 		=> $sid_web,
				'user_id' 		=> $result[0]['user_id'],
				'user_type' 	=> $result[0]['user_type'],
				'user_name' 	=> $result[0]['username']
			);
           $CI->session->set_userdata($user_data);
            //Set Cookie
            $gefcokie =  get_cookie('goFor_yourExam');
            if(! $gefcokie){
                $save_details = $CI->input->post('save_detail');
                if($save_details != ""){
                    $cookie = array(
                        'name'   => 'yourExam',
                        'value'  => $user_name.'-'.$password,
                        'expire' => '86500',
                        //'domain' => '.some-domain.com',
                        'path'   => '/',
                        'prefix' => 'goFor_',
                        'secure' => FALSE
                    );
                    $this->input->set_cookie($cookie);
                }
            }
            return TRUE;
		}else{
			return FALSE;
        }
	}
}
