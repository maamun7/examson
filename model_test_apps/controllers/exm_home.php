<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exm_home extends CI_Controller {
	
	function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$CI =& get_instance();
		$this->load->library('front/home');
		
		$content = $CI->home->get_home_view();
		$sub_menu = array();
		$this->template->home_template($content,$sub_menu);
	}
}