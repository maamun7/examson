<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cchapter extends CI_Controller {
	
	function __construct() {
      parent::__construct();	  
	  $this->admin_template->current_menu = 'chapter';
    }	
	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manage_chapter');
		$CI->load->library('admin/chapter');
		$CI->load->model('admin/chapters');

		$base_url = base_url()."admin/chapter/index";
		$total_rows = $this->chapters->total_chapter();	
		$limit_per_page = 25;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment='');
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
	    $links = $this->pagination->create_links();
		
        $content = $CI->chapter->get_list_view($limit_per_page,$page,$links);
        $sub_menu = array(
				array('label'=> 'Manage Chapter', 'url' => 'admin/chapter','class' =>'active'),
				array('label'=> 'New Chapter', 'url' => 'admin/chapter/add')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}
	
	public function add()
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('add_chapter');
		$CI->load->library('admin/chapter');
		$CI->load->model('admin/chapters');
		
		if($this->chapter->validateForm()){
			$data = array(
				'id' 	=> null, 
				'subject_id' 		=> $this->input->post('subject_id'), 
				'chapter_name' 		=> $this->input->post('chapter_name'),
				'published' 		=> $this->input->post('published_sts'),
				'ordering'			=> $this->input->post('ordering'),
				'created_at' 		=> current_bd_date_time(),
				'creator_id' 		=> $this->a_auth->get_user_id()
			);	

			$CI->chapters->insert($data);

			$this->session->set_userdata(array('message'=>"Successfully Added !"));
			if(isset($_POST['add-chapter'])){
				redirect(base_url('admin/chapter'));
				exit;
			}elseif(isset($_POST['add-chapter-another'])){
				redirect(base_url('admin/chapter/add'));
				exit;
			}				
		}else{
			$content = $CI->chapter->add_form();
			$sub_menu = array(
				array('label'=> 'Manage Chapter', 'url' => 'admin/chapter'),
				array('label'=> 'New Chapter', 'url' => 'admin/chapter/add','class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function edit($category_id=null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_chapter');
		$CI->load->library('admin/chapter');
		$CI->load->model('admin/chapters');
		if (!$category_id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select Chapter !"));
			redirect(base_url('admin/chapter'));
			exit();
		}
		
		if($this->chapter->validateForm()){

			$chapter_id = $this->input->post('chapter_id');
			$data = array(
				'subject_id' 		=> $this->input->post('subject_id'), 
				'chapter_name' 		=> $this->input->post('chapter_name'),
				'published' 		=> $this->input->post('published_sts'),
				'ordering'			=> $this->input->post('ordering'),
				'edited_at' 		=> current_bd_date_time(),
				'editor_id' 		=> $this->a_auth->get_user_id()
			);
			$CI->chapters->update($data,$chapter_id);
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));
			redirect(base_url('admin/chapter'));
		}else{
			$content = $CI->chapter->edit_form($category_id);
			$sub_menu = array(
				array('label'=> 'Manage Chapter', 'url' => 'admin/chapter'),
				array('label'=> 'New Chapter', 'url' => 'admin/chapter/add'),
				array('label'=> 'Edit Chapter', 'url' => 'admin/chapter/edit/'.$category_id,'class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function sub_categories()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_chapter');
		$CI->load->model('admin/chapters');
		
		$cat_id =  $_POST['cat_id'];	
		$categories = $CI->chapters->get_categories($cat_id);
		if ($categories) {
			echo"<option value=''>...Select Sub Category...</option>";
			foreach($categories as $category)
			{		
				echo "<option value='$category->id'>$category->name</option>";
			}
		} else {			
			echo"<option value=''>..No Sub Category Found..</option>";
		}
		
	}
	
	public function subjects()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_chapter');
		$CI->load->model('admin/chapters');
		
		$sub_cat_id =  $_POST['sub_cat_id'];	
		$subjects = $CI->chapters->get_subjects($sub_cat_id);
		if ($subjects) {
			echo"<option value=''>...Select Sub Category...</option>";
			foreach($subjects as $subject)
			{		
				echo "<option value='$subject->id'>$subject->subject_name</option>";
			}
		} else {			
			echo"<option value=''>..No Sub Category Found..</option>";
		}
		
	}

	public function change_status()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('change_chapter_status');
		$CI->load->model('admin/chapters');
		$chapter_id =  $_POST['chapter_id'];
		$CI->chapters->do_change_status($chapter_id);
		$this->session->set_userdata(array('message'=>"Successfully Status Changed !"));
		redirect(base_url('admin/chapter'));
		return true;	
	}	

	public function delete()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_chapter');
		$CI->load->model('admin/chapters');
		$chapter_id =  $_POST['chapter_id'];
		$CI->chapters->do_delete($chapter_id);
		$this->session->set_userdata(array('message'=>"Successfully Deleted !"));
		redirect(base_url('admin/chapter'));
		return true;	
	}	
	
	public function search_item()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('chapter');
		$CI->load->library('admin/chapter');	
		$key_word = $this->input->post('key_word');	
		if($key_word =="") {
			$this->session->set_userdata(array('warning_message'=>"You didn't type any keyword !"));
			redirect(base_url('admin/chapter'));
		}		
        $content = $CI->chapter->get_search_view($key_word);
        $sub_menu = array(
				array('label'=> 'Manage Chapter', 'url' => 'admin/chapter'),
				array('label'=> 'New Chapter', 'url' => 'admin/chapter/add'),
				array('label'=> 'Search Chapter', 'url' => 'admin/chapter','class' =>'active')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}	

}