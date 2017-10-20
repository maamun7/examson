<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

	public function is_logged()
	{
		$CI =& get_instance();
        if($CI->session->userdata('sid_web'))
		{
			return true;
		}		
		return false;
	}
	
	function check_user_auth($url='')
	{   		
		$CI =& get_instance();
        if($url==''){$url = base_url();}
        if ($this->is_logged())
		{
           //echo "Iff";exit;
			$user_type = $this->get_user_type();
			if ($user_type != 2) {				
           		redirect($url,'refresh'); exit;
			}
        }else{

            //echo "Els";exit;

            $present_url = current_url();
            $CI->session->set_userdata(array('present_url' => $present_url));
            $CI->session->set_userdata(array('error_message' => "You are not logged in"));

        	$url = base_url().'auth/signin';
        	redirect($url,'refresh'); exit;
        }
	}
	
	function check_admin_auth($url='')
	{   
        if($url==''){$url = base_url().'admin/dashboard/login';}
		$CI =& get_instance();
        if($this->is_logged())
		{
			if(!$this->is_admin())
			{
				$this->logout();
				$error = "You are not authorized for this part";
				$CI->session->set_userdata(array('error_message'=>$error));
				redirect($url,'refresh'); exit;
			}
        }else{
			$error = "Please Log in to Access !";
            $CI->session->set_userdata(array('error_message'=>$error));
			redirect($url,'refresh'); exit;
		}
	}
	
	//Logout....
	public function logout()
	{
		$CI =& get_instance();
		$user_data = array(
				'sid_web' 		=> '',
				'user_id' 		=> '',
				'user_type' 	=> '',
				'user_name' 	=> ''
			);
        $CI->session->unset_userdata($user_data);
        //$CI->session->sess_destroy();
		return true;
	}
	
	public function get_user_name()
	{
		$CI =& get_instance();
		$CI->load->model('front/auths');
		return $CI->session->userdata('user_name');
	}
	
	public function set_cookie_check()
	{
		$CI =& get_instance();
        $CI->load->library('signin');
		//If exist Cookie
		$getcokie =  get_cookie('goFor_yourExam');
		if($getcokie){
			list($email,$password) = explode("-",$getcokie);
			$this->signin->create_session($email,$password);
		}
	}
	
	public function get_user_id()
	{
		$CI =& get_instance();
		$CI->load->model('front/auths');
		return $CI->session->userdata('user_id');
	}
	
	public function get_user_type()
	{
		$CI =& get_instance();
		return $CI->session->userdata('user_type');
	}
	
	// checking user has role and return role id
    private function has_role($user_id){
        $CI =& get_instance();
        $CI->load->model('users');
        $role = $CI->users->get_by_user_id($user_id);
        $role_id = $role[0]['role_id'];
        return $role_id;
    }

    // if user has desired task permission
    function check_permission($slug, $redirect=true, $user_id = 0)
    {
        $CI =& get_instance();
		$CI->load->model('users');
        if ( $user_id == 0 )
        {
            $user_id = $this->get_user_id();
        }

        // if user has the role and permission
        // then return true
        // else
        // return to dashbord or the referrer and show 'You dont have permission to access this page'

        $role_id = $this->has_role($user_id);
        
        // if Administrator role
        if ( $role_id === '1')
            return true;
        $res = $CI->users->get_by_role_id_and_slug($role_id,$slug);
        if(count($res) > 0){
            return true;
        }else{
            if( $redirect )
            {
                $CI->session->set_userdata(array('error_message'=>"You don't have permission to access this page!"));
                redirect(base_url().'admin/dashboard','refresh');
            }
            else
                return false;
            //$CI->output->set_header("Location: ".base_url().'admin/dashboard', TRUE, 302);
        }
    }

}