<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exm_signin extends CI_Controller {
	
	function __construct() {
      parent::__construct();
    }
	
	public function index()
	{
		$CI =& get_instance();
		$this->load->library('front/exam_center');
		
		$content = $this->exam_center->get_exam_selector_view();
		$sub_menu = array();
		$this->template->exam_select_template($content,$sub_menu);
	}
}