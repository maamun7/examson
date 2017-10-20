<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exm_signin extends CI_Controller {
	
	function __construct() {
      parent::__construct();
    }
	
	public function index()
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
}