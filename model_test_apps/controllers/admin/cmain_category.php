<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cmain_category extends CI_Controller {
	
	function __construct() {
      parent::__construct();	  
	  $this->admin_template->current_menu = 'main_category';
    }
	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manager_category');
		$CI->load->library('admin/main_category');
		$CI->load->model('admin/main_categories');

		$base_url = base_url()."admin/main_category/index";
		$total_rows = $this->main_categories->count_category();	
		$limit_per_page = 25;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment='');
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
	    $links = $this->pagination->create_links();
		
        $content = $CI->main_category->get_list($limit_per_page,$page,$links);
        $sub_menu = array(
				array('label'=> 'Manage Category', 'url' => 'admin/main_category','class' =>'active'),
				array('label'=> 'New Category', 'url' => 'admin/main_category/add')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}
	
	public function add()
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('add_category');
		$CI->load->library('admin/main_category');
		$CI->load->model('admin/main_categories');
		
		if($this->main_category->validateForm()){

			$category_name = $this->input->post('category_name');
			$category_alias = strtolower($this->input->post('category_alias'));
			if($category_alias =="" ){
				$category_alias = strtolower($this->input->post('category_name'));
			}

			$data = array(
				'id' 	=> null,
				'name' 				=> $this->input->post('category_name'), 
				'alias' 			=> $category_alias , 
				'link' 				=> $this->input->post('link_url'), 
				'published' 		=> $this->input->post('published_sts'),
				'parent_id' 		=> $this->input->post('parent_cat_id'),
				'meta_description'	=> $this->input->post('meta_description'),
				'meta_keyword' 		=> $this->input->post('meta_keyword'),
				'created_at' 		=> current_bd_date_time(),
				'creator_id' 		=> $this->a_auth->get_user_id()
			);	

			$CI->main_categories->insert($data);

			$this->session->set_userdata(array('message'=>"Successfully Added !"));
			if(isset($_POST['add-category'])){
				redirect(base_url('admin/main_category'));
				exit;
			}elseif(isset($_POST['add-category-another'])){
				redirect(base_url('admin/main_category/add'));
				exit;
			}
				
		}else{
			$content = $CI->main_category->add_form();
			$sub_menu = array(
				array('label'=> 'Manage Category', 'url' => 'admin/main_category'),
				array('label'=> 'New Category', 'url' => 'admin/main_category/add','class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function edit($category_id=null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_category');
		$CI->load->library('admin/main_category');
		$CI->load->model('admin/main_categories');
		if (!$category_id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select Category !"));
			redirect(base_url('admin/main_category'));
			exit();
		}
		
		if($this->main_category->validateForm()){
			$category_name = $this->input->post('category_name');
			$category_alias = strtolower($this->input->post('category_alias'));
			if($category_alias =="" ){
				$category_alias = strtolower($this->input->post('category_name'));
			}

			$cat_id = $this->input->post('cat_id');
			$data = array(
				'name' 				=> $this->input->post('category_name'), 
				'alias' 			=> $category_alias , 
				'link' 				=> $this->input->post('link_url'), 
				'published' 		=> $this->input->post('published_sts'),
				'parent_id' 		=> $this->input->post('parent_cat_id'),
				'meta_description'	=> $this->input->post('meta_description'),
				'meta_keyword' 		=> $this->input->post('meta_keyword'),
				'edited_at' 		=> current_bd_date_time(),
				'editor_id' 		=> $this->a_auth->get_user_id()
			);	
			$CI->main_categories->update($data,$cat_id);
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));
			redirect(base_url('admin/main_category'));
		}else{
			$content = $CI->main_category->edit_form($category_id);
			$sub_menu = array(
				array('label'=> 'Manage Category', 'url' => 'admin/main_category'),
				array('label'=> 'New Category', 'url' => 'admin/main_category/add'),
				array('label'=> 'Edit Category', 'url' => 'admin/main_category/edit/'.$category_id,'class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function delete()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_category');
		$CI->load->model('admin/main_categories');
		$category_id =  $_POST['cat_id'];
		$CI->main_categories->do_delete($category_id);
		$this->session->set_userdata(array('message'=>"Successfully Deleted !"));
		redirect(base_url('admin/main_category'));
		return true;	
	}	
	
	public function search_item()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manager_category');
		$CI->load->library('admin/main_category');	
		$key_word = $this->input->post('key_word');	
		if($key_word =="") {
			$this->session->set_userdata(array('warning_message'=>"You didn't type any keyword !"));
			redirect(base_url('admin/main_category'));
		}		
        $content = $CI->main_category->get_search_view($key_word);
        $sub_menu = array(
				array('label'=> 'Manage Category', 'url' => 'admin/main_category'),
				array('label'=> 'New Category', 'url' => 'admin/main_category/add'),
				array('label'=> 'Search Category', 'url' => 'admin/main_category','class' =>'active')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}	

}