<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cmodel_test extends CI_Controller {
	
	function __construct() {
      parent::__construct();	  
	  $this->admin_template->current_menu = 'model_test';
    }
	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manager_model_test');
		$CI->load->library('admin/model_test');
		$CI->load->model('admin/model_tests');

		$base_url = base_url()."admin/model_test/index";
		$total_rows = $this->model_tests->count_model_test();	
		$limit_per_page = 25;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment='');
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
	    $links = $this->pagination->create_links();
		
        $content = $CI->model_test->get_list($limit_per_page,$page,$links);
        $sub_menu = array(
				array('label'=> 'Model Test', 'url' => 'admin/model_test','class' =>'active'),
				array('label'=> 'Add New', 'url' => 'admin/model_test/add')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}
	
	public function add()
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('add_model_test');
		$this->load->library('admin/model_test');
		$this->load->model('admin/model_tests');

		if($this->model_test->validateForm()){
            $final_q_ids = ",";
            $subject_ids_array = [];
            $subject_ids = $this->input->post('subject_ids',TRUE);
            foreach ($subject_ids as $key => $val) {
                $q_limit = $this->input->post($val);
                if($q_limit != ''){
                    $sub_id = $val;
                    $final_q_ids .= $this->model_tests->get_question_ids($sub_id,$q_limit);
                    $subject_ids_array[$sub_id] = $q_limit;
                }
            }

			$data = array(
				'id' 	                => null,
				'exam_name' 	        => $this->input->post('model_test_name',TRUE),
				'no_of_question'	    => $this->input->post('no_of_question',TRUE),
				'duration' 			    => $this->input->post('duration_time',TRUE),
                'subject_ids' 			=> json_encode($subject_ids_array),
				'question_ids' 		    => $final_q_ids,
				'exam_type' 		    => 1,
                'model_test_status' 	=> $this->input->post('published_sts',TRUE),
				'created_at' 		    => current_bd_date_time(),
                'model_test_sub_cat'    => $this->input->post('sub_cat_id',TRUE),
				'creator_id' 		    => $this->a_auth->get_user_id()
			);	

			$CI->model_tests->insert($data);

			$this->session->set_userdata(array('message'=>"Successfully Added !"));
			redirect(base_url('admin/model_test'));
			exit;	
		}else{
			$content = $CI->model_test->add_form();
			$sub_menu = array(
				array('label'=> 'Model Test', 'url' => 'admin/model_test'),
				array('label'=> 'Add New', 'url' => 'admin/model_test/add','class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}

	public function load_chapter_questions()
	{
		$CI =& get_instance();		
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('model_test_category');
		$this->load->library('admin/model_test');
		$subject_id =  $_POST['subject_id'];
		$content = $this->model_test->get_chapter_questions_view($subject_id);

		echo json_encode($content);
	}
	
	public function edit($model_test_id=null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_model_test');
		$CI->load->library('admin/model_test');
		$CI->load->model('admin/model_tests');
		if (!$model_test_id) {			
			$this->session->set_userdata(array('error_message'=>"Did not select Category !"));
			redirect(base_url('admin/model_test'));
			exit();
		}
		
		if($this->model_test->validateForm()){
			//$cat_id = $this->input->post('cat_id');
            $final_q_ids = ",";
            $subject_ids_array = [];
            $subject_ids = $this->input->post('subject_ids',TRUE);
            foreach ($subject_ids as $key => $val) {
                $q_limit = $this->input->post($val);
                if($q_limit != ''){
                    $sub_id = $val;
                    $final_q_ids .= $this->model_tests->get_question_ids($sub_id,$q_limit);
                    $subject_ids_array[$sub_id] = $q_limit;
                }
            }

            $data = array(
                'exam_name' 	        => $this->input->post('model_test_name',TRUE),
                'no_of_question'	    => $this->input->post('no_of_question',TRUE),
                'duration' 			    => $this->input->post('duration_time',TRUE),
                'subject_ids' 			=> json_encode($subject_ids_array),
                'question_ids' 		    => $final_q_ids,
                'exam_type' 		    => 1,
                'model_test_status' 	=> $this->input->post('published_sts',TRUE),
                'created_at' 		    => current_bd_date_time(),
                'model_test_sub_cat'    => $this->input->post('sub_cat_id',TRUE),
                'creator_id' 		    => $this->a_auth->get_user_id()
            );

            $CI->model_tests->update($data,$model_test_id);
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));
			redirect(base_url('admin/model_test'));
		}else{
			$content = $CI->model_test->edit_form($model_test_id);
			$sub_menu = array(
				array('label'=> 'Model Test', 'url' => 'admin/model_test'),
				array('label'=> 'Add New', 'url' => 'admin/model_test/add'),
				array('label'=> 'Edit', 'url' => 'admin/model_test/edit/'.$model_test_id,'class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}

    public function model_sub_categories()
    {
        $CI =& get_instance();
        $this->a_auth->check_auth();
        $this->a_auth->check_permission('edit_model_test');
        $CI->load->model('admin/model_tests');

        $cat_id =  $_POST['cat_id'];
        $categories = $CI->model_tests->get_sub_categories($cat_id);
        if ($categories) {
            echo"<option value=''>...Select Sub Category...</option>";
            foreach($categories as $category)
            {
                echo "<option value='$category->id'> $category->sub_cat_name </option>";
            }
        } else {
            echo"<option value=''>..No Sub Category Found..</option>";
        }

    }

    public function load_all_subjects()
    {
        $CI =& get_instance();
        $this->a_auth->check_auth();
        $this->a_auth->check_permission('add_model_test');
        $CI->load->model('admin/model_tests');
        $CI->load->library('admin/model_test');

        $sub_cat_id =  $_POST['sub_cat_id'];
        $content = $this->model_test->get_all_subjects_view($sub_cat_id);

        echo json_encode($content);
        //print_r($content);

    }

	public function change_status()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manager_model_test');
		$CI->load->model('admin/model_tests');
		$mod_test_id =  $_POST['mod_test_id'];
		$CI->model_tests->do_change_status($mod_test_id);
		$this->session->set_userdata(array('message'=>"Successfully Deleted !"));
		redirect(base_url('admin/model_test'));
		return true;	
	}
	
	public function delete()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_model_test');
		$CI->load->model('admin/model_tests');
		$mod_test_id =  $_POST['mod_test_id'];
		$CI->model_tests->do_delete($mod_test_id);
		$this->session->set_userdata(array('message'=>"Successfully Deleted !"));
		redirect(base_url('admin/model_test'));
		return true;	
	}		

}