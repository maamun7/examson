<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cdashboard extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		//Clear all cache
        $this->output->nocache();
	}
	
	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manage_home');
		$CI->load->library('admin/dashboard');
		if (!$this->a_auth->is_logged())
		{
			$this->output->set_header("Location: ".base_url().'admin/dashboard/login', TRUE, 302);
		}
		$this->a_auth->check_auth();
		$content = $CI->dashboard->admin_home_page();
		$sub_menu = array();
		$this->admin_template->full_html_view($content,$sub_menu);
	}
	
	public function login()
	{	
		if ($this->a_auth->is_logged() )
		{
			$this->output->set_header("Location: ".base_url().'admin/dashboard', TRUE, 302);
		}
		$this->admin_template->admin_login_view();
	}
	
	//* Valid User Check..
	public function do_login()
	{	
		$error = '';
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if ( $username == '' || $password == '' || $this->a_auth->login($username, $password) === FALSE )
		{
			$error = 'Wrong user name or password';
		}
		if ( $error != '' )
		{
			$this->session->set_userdata(array('error_message'=>$error));
			$this->output->set_header("Location: ".base_url().'admin/dashboard/login', TRUE, 302);
		}else{
			$this->output->set_header("Location: ".base_url().'admin/dashboard', TRUE, 302);
        }
	}
	
	public function logout()
	{	
		if ($this->a_auth->logout())
		$this->output->set_header("Location: ".base_url().'admin/dashboard/login', TRUE, 302);
	}

}