<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cmodel_test_sub_cat extends CI_Controller {
	
	function __construct() {
      parent::__construct();	  
	  $this->admin_template->current_menu = 'model_test_sub_cat';
    }
	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manage_model_test_sub_cat');
		$CI->load->library('admin/model_test_sub_cat');
		$CI->load->model('admin/model_test_sub_cats');

		$base_url = base_url()."admin/model_test_sub_category/index";
		$total_rows = $this->model_test_sub_cats->count_sub_category();	
		$limit_per_page = 100;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment='');
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
	    $links = $this->pagination->create_links();
		
        $content = $CI->model_test_sub_cat->get_subcat_list($limit_per_page,$page,$links);
        $sub_menu = array(
				array('label'=> 'Sub Category', 'url' => 'admin/model_test_sub_category','class' =>'active'),
				array('label'=> 'Add New', 'url' => 'admin/model_test_sub_category/add')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}
	
	public function add()
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('add_model_test_sub_cat');
		$CI->load->library('admin/model_test_sub_cat');
		$CI->load->model('admin/model_test_sub_cats');
		
		if($this->model_test_sub_cat->validateForm()){
			$data = array(
				'sub_cat_name' 		=> $this->input->post('sub_cat_name',TRUE),  
				'category_id' 		=> $this->input->post('category_id',TRUE), 
				'created_at' 		=> current_bd_date_time(),
				'creator_id' 		=> $this->a_auth->get_user_id()
			);	

			$CI->model_test_sub_cats->insert($data);

			$this->session->set_userdata(array('message'=>"Successfully Added !"));
			redirect(base_url('admin/model_test_sub_category'));
			exit;	
		}else{
			$content = $CI->model_test_sub_cat->add_form();
			$sub_menu = array(
				array('label'=> 'Model Test Sub Category', 'url' => 'admin/model_test_sub_category'),
				array('label'=> 'Add New', 'url' => 'admin/model_test_sub_category/add','class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function edit($id=null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_model_test_sub_cat');
		$CI->load->library('admin/model_test_sub_cat');
		$CI->load->model('admin/model_test_sub_cats');
		if (!$id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select Sub Category !"));
			redirect(base_url('admin/model_test_sub_cat'));
			exit();
		}
		
		if($this->model_test_sub_cat->validateForm()){
			$id = $this->input->post('id');
			$data = array(
				'sub_cat_name' 		=> $this->input->post('sub_cat_name',TRUE),  
				'category_id' 		=> $this->input->post('category_id',TRUE), 
				'edited_at' 		=> current_bd_date_time(),
				'editor_id' 		=> $this->a_auth->get_user_id()
			);	

			$CI->model_test_sub_cats->update($data,$id);
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));
			redirect(base_url('admin/model_test_sub_category'));
		}else{
			$content = $CI->model_test_sub_cat->edit_form($id);
			$sub_menu = array(
				array('label'=> 'Model Test Sub Category', 'url' => 'admin/model_test_sub_category'),
				array('label'=> 'Add New', 'url' => 'admin/model_test_sub_category/add'),
				array('label'=> 'Edit', 'url' => 'admin/model_test_sub_category/edit/'.$id,'class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function delete()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_model_test_sub_cat');
		$CI->load->model('admin/model_test_sub_cats');
		$id =  $_POST['sub_cat_id'];
		$CI->model_test_sub_cats->do_delete($id);
		$this->session->set_userdata(array('message'=>"Successfully Deleted !"));
		redirect(base_url('admin/model_test_sub_category'));
		return true;	
	}		

}