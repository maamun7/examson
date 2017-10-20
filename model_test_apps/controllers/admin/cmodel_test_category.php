<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cmodel_test_category extends CI_Controller {
	
	function __construct() {
      parent::__construct();	  
	  $this->admin_template->current_menu = 'model_test_cat';
    }
	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manager_model_test_category');
		$CI->load->library('admin/model_test_category');
		$CI->load->model('admin/model_test_categories');

		$base_url = base_url()."admin/model_test_category/index";
		$total_rows = $this->model_test_categories->count_category();	
		$limit_per_page = 25;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment='');
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
	    $links = $this->pagination->create_links();
		
        $content = $CI->model_test_category->get_list($limit_per_page,$page,$links);
        $sub_menu = array(
				array('label'=> 'Model Test Category', 'url' => 'admin/model_test_category','class' =>'active'),
				array('label'=> 'Add New', 'url' => 'admin/model_test_category/add')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}
	
	public function add()
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('add_model_test_category');
		$CI->load->library('admin/model_test_category');
		$CI->load->model('admin/model_test_categories');
		
		if($this->model_test_category->validateForm()){
			$data = array(
				'id' 	=> null,
				'category_name' 	=> $this->input->post('category_name',TRUE),  
				'location_id' 		=> $this->input->post('location_id',TRUE),
				'published' 		=> $this->input->post('published_sts',TRUE),
				'created_at' 		=> current_bd_date_time(),
				'creator_id' 		=> $this->a_auth->get_user_id()
			);	

			$CI->model_test_categories->insert($data);

			$this->session->set_userdata(array('message'=>"Successfully Added !"));
			redirect(base_url('admin/model_test_category'));
			exit;	
		}else{
			$content = $CI->model_test_category->add_form();
			$sub_menu = array(
				array('label'=> 'Model Test Category', 'url' => 'admin/model_test_category'),
				array('label'=> 'Add New', 'url' => 'admin/model_test_category/add','class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function edit($category_id=null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_model_test_category');
		$CI->load->library('admin/model_test_category');
		$CI->load->model('admin/model_test_categories');
		if (!$category_id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select Category !"));
			redirect(base_url('admin/model_test_category'));
			exit();
		}
		
		if($this->model_test_category->validateForm()){
			//$cat_id = $this->input->post('cat_id');
			$data = array(
				'category_name' 	=> $this->input->post('category_name',TRUE),  
				'location_id' 		=> $this->input->post('location_id',TRUE),  
				'published' 		=> $this->input->post('published_sts',TRUE),
				'edited_at' 		=> current_bd_date_time(),
				'editor_id' 		=> $this->a_auth->get_user_id()
			);	

			$CI->model_test_categories->update($data,$category_id);
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));
			redirect(base_url('admin/model_test_category'));
		}else{
			$content = $CI->model_test_category->edit_form($category_id);
			$sub_menu = array(
				array('label'=> 'Model Test Category', 'url' => 'admin/model_test_category'),
				array('label'=> 'Add New', 'url' => 'admin/model_test_category/add'),
				array('label'=> 'Edit', 'url' => 'admin/model_test_category/edit/'.$category_id,'class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function change_status()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manager_model_test_category');
		$CI->load->model('admin/model_test_categories');
		$category_id =  $_POST['cat_id'];
		$CI->model_test_categories->do_change_status($category_id);
		$this->session->set_userdata(array('message'=>"Successfully Deleted !"));
		redirect(base_url('admin/model_test_category'));
		return true;	
	}
	
	public function delete()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_model_test_category');
		$CI->load->model('admin/model_test_categories');
		$category_id =  $_POST['cat_id'];
		$CI->model_test_categories->do_delete($category_id);
		$this->session->set_userdata(array('message'=>"Successfully Deleted !"));
		redirect(base_url('admin/model_test_category'));
		return true;	
	}		

}