<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Csubject extends CI_Controller {
	
	function __construct() {
      parent::__construct();	  
	  $this->admin_template->current_menu = 'subject';
    }
	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manage_subject');
		$CI->load->library('admin/subject');
		$CI->load->model('admin/subjects');

		$base_url = base_url()."admin/subject/index";
		$total_rows = $this->subjects->total_subject();	
		$limit_per_page = 50;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment='');
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
	    $links = $this->pagination->create_links();
		
        $content = $CI->subject->get_list_view($limit_per_page,$page,$links);
        $sub_menu = array(
				array('label'=> 'Manage Subject', 'url' => 'admin/subject','class' =>'active'),
				array('label'=> 'New Subject', 'url' => 'admin/subject/add')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}
	
	public function add()
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('add_subject');
		$CI->load->library('admin/subject');
		$CI->load->model('admin/subjects');
		
		if($this->subject->validateForm()){
			$data = array(
				'id' 	=> null,
				'sub_category_id' 	=> $this->input->post('sub_cat_id'), 
				'subject_name' 		=> $this->input->post('subject_name'),
				'published' 		=> $this->input->post('published_sts'),
				'ordering'			=> $this->input->post('ordering'),
				'created_at' 		=> current_bd_date_time(),
				'creator_id' 		=> $this->a_auth->get_user_id()
			);	

			$CI->subjects->insert($data);

			$this->session->set_userdata(array('message'=>"Successfully Added !"));
			if(isset($_POST['add-subject'])){
				redirect(base_url('admin/subject'));
				exit;
			}elseif(isset($_POST['add-subject-another'])){
				redirect(base_url('admin/subject/add'));
				exit;
			}
				
		}else{
			$content = $CI->subject->add_form();
			$sub_menu = array(
				array('label'=> 'Manage Subject', 'url' => 'admin/subject'),
				array('label'=> 'New Subject', 'url' => 'admin/subject/add','class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function edit($category_id=null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_subject');
		$CI->load->library('admin/subject');
		$CI->load->model('admin/subjects');
		if (!$category_id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select Subject !"));
			redirect(base_url('admin/subject'));
			exit();
		}
		
		if($this->subject->validateForm()){

			$subject_id = $this->input->post('subject_id');
			$data = array(
				'sub_category_id' 	=> $this->input->post('sub_cat_id'), 
				'subject_name' 		=> $this->input->post('subject_name'),
				'published' 		=> $this->input->post('published_sts'),
				'ordering'			=> $this->input->post('ordering'),
				'edited_at' 		=> current_bd_date_time(),
				'editor_id' 		=> $this->a_auth->get_user_id()
			);	
			$CI->subjects->update($data,$subject_id);
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));
			redirect(base_url('admin/subject'));
		}else{
			$content = $CI->subject->edit_form($category_id);
			$sub_menu = array(
				array('label'=> 'Manage Subject', 'url' => 'admin/subject'),
				array('label'=> 'New Subject', 'url' => 'admin/subject/add'),
				array('label'=> 'Edit Subject', 'url' => 'admin/subject/edit/'.$category_id,'class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function sub_categories()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_subject');
		$CI->load->model('admin/subjects');
		
		$cat_id =  $_POST['cat_id'];	
		$categories = $CI->subjects->get_categories($cat_id);
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

	public function change_status()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('change_subject_status');
		$CI->load->model('admin/subjects');
		$subject_id =  $_POST['sub_id'];
		$CI->subjects->do_change_status($subject_id);
		$this->session->set_userdata(array('message'=>"Successfully Status Changed !"));
		redirect(base_url('admin/subject'));
		return true;	
	}	

	public function delete()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_subject');
		$CI->load->model('admin/subjects');
		$subject_id =  $_POST['sub_id'];
		$CI->subjects->do_delete($subject_id);
		$this->session->set_userdata(array('message'=>"Successfully Deleted !"));
		redirect(base_url('admin/subject'));
		return true;	
	}	
	
	public function search_item()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('subject');
		$CI->load->library('admin/subject');	
		$key_word = $this->input->post('key_word');	
		if($key_word =="") {
			$this->session->set_userdata(array('warning_message'=>"You didn't type any keyword !"));
			redirect(base_url('admin/subject'));
		}		
        $content = $CI->subject->get_search_view($key_word);
        $sub_menu = array(
				array('label'=> 'Manage Subject', 'url' => 'admin/subject'),
				array('label'=> 'New Subject', 'url' => 'admin/subject/add'),
				array('label'=> 'Search Subject', 'url' => 'admin/subject','class' =>'active')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}	

}