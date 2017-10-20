<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cquestion extends CI_Controller {
	
	function __construct() {
      parent::__construct();	  
	  $this->admin_template->current_menu = 'question';
    }
	public function index()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manage_question');
		$CI->load->library('admin/question');
		$CI->load->model('admin/questions');

		$base_url = base_url()."admin/question/index";
		$total_rows = $this->questions->total_question();	
		$limit_per_page = 25;
		$config = get_pagination_config($base_url,$total_rows,$limit_per_page,$uri_segment='');
		$this->pagination->initialize($config);	
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;		
	    $links = $this->pagination->create_links();
		
        $content = $CI->question->get_list_view($limit_per_page,$page,$links);
        $sub_menu = array(
				array('label'=> 'Manage Question and Options', 'url' => 'admin/question','class' =>'active'),
				array('label'=> 'New Question and Options', 'url' => 'admin/question/add')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}

	public function view_options($question_id=null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manage_question');
		$CI->load->library('admin/question');
		$CI->load->model('admin/questions');
		
		if (!$question_id) {			
			$this->session->set_userdata(array('error_message'=>"Didn't select question !"));
			redirect(base_url('admin/question'));
			exit();
		}				
        $data = array(
        	"questions_details" =>$this->questions->get_questions_details($question_id),
        	"options" =>$this->questions->get_all_options($question_id)
        );
		$CI->load->view("admin/question/options",$data);
	}
	
	public function add()
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('add_question');
		$this->load->library('admin/question');
		$this->load->model('admin/questions');
		
		if($this->question->validateForm()){	
			if($this->question->picture_name != ""){
				$this->create_image_thumb($this->question->picture_name);
			}

			$question_data = array(
				'id' 				=> null, 
				'details' 			=> html_entity_decode($this->input->post('question_name',TRUE),ENT_QUOTES,'utf-8'),
				'image' 			=> $this->question->picture_name,
				'image_path' 		=> $this->question->picture_path,
				'chapter_id' 		=> $this->input->post('chapter_id',TRUE),
				'status' 			=> $this->input->post('published_sts',TRUE),
				'created_at' 		=> current_bd_date_time(),
				'creator_id' 		=> $this->a_auth->get_user_id()
			);	

			$question_id = $this->questions->insert_question($question_data);

			$option_names = $this->input->post('option_name',TRUE);
			$i=0;
			foreach ($option_names as $key => $value) {$i++;
				
				$picture_name = "";
				$picture_path = "";

				if(isset($_FILES['option_img_'.$i]['name']) AND $_FILES['option_img_'.$i]['name'] !='')
				{
					$img_name = "opns-".date('Y').'-'.time();
					$options['upload_path'] = './uploads/question/options_orgn';	
					$options['allowed_types'] = 'gif|jpg|png|jpeg';
					$options['max_size']	= '5000';
					$options['file_name']= $img_name;
				
					$this->load->library('upload');
		            $this->upload->initialize($options);
					
					
					if (!$this->upload->do_upload('option_img_'.$i))
					{
						$error= $CI->upload->display_errors();	
						$this->session->set_userdata(array('message'=>$error));
						redirect(base_url('admin/question'));
						exit;
					} else {
						$data = $this->upload->data();	
						$picture_name = $data['file_name'];
						$picture_path =  $data['file_path'];
						$this->create_option_thumb($picture_name);
					}
				}

				$option_data = array(
					'id' 				=> null, 
					'option_details' 	=> html_entity_decode($option_names[$key],ENT_QUOTES,'utf-8'), 
					'image' 			=> $picture_name,
					'image_path' 		=> $picture_path,
					'question_id' 		=> $question_id,
					'status' 			=> 1
				);	
				$option_id = $this->questions->insert_option($option_data);

				$right_answer = $this->input->post('right_answer_'.$i,TRUE);
				if ($right_answer ==1) {
					$answer_data = array(
						'answer_id' 		=> null, 
						'question_id' 		=> $question_id, 
						'answer_option_id' 	=> $option_id
					);
					$this->questions->insert_right_answer($answer_data);
				}				
			}
			
			$this->session->set_userdata(array('message'=>"Successfully Added !"));
			if(isset($_POST['add-question'])){
				redirect(base_url('admin/question'));
				exit;
			}elseif(isset($_POST['add-another-question'])){
				redirect(base_url('admin/question/add'));
				exit;
			}				
		}else{
			$content = $CI->question->add_form();
			$sub_menu = array(
				array('label'=> 'Manage Question and Options', 'url' => 'admin/question'),
				array('label'=> 'New Question and Options', 'url' => 'admin/question/add','class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function edit($question_id=null)
	{			
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_question');
		$this->load->library('admin/question');
		$this->load->model('admin/questions');
		
		if($this->question->validateForm()){

			$question_data = array();
			$question_id = $this->input->post('question_id',TRUE);
			//If select new image
			if($this->question->picture_name != ""){
				//delete previous image
				$this->questions->do_delete_picture('question',$question_id);
				//create new thumbnail for new image 
				$this->create_image_thumb($this->question->picture_name);
				//insert new image
				$question_data['image']	= $this->question->picture_name;
				$question_data['image_path'] = $this->question->picture_path;
			}
		
			$question_data['details'] 		= html_entity_decode($this->input->post('question_name',TRUE),ENT_QUOTES,'utf-8');
			$question_data['chapter_id'] 	= $this->input->post('chapter_id',TRUE);
			$question_data['status'] 		=  $this->input->post('published_sts',TRUE);
			$question_data['edited_at'] 	=  current_bd_date_time();
			$question_data['editor_id'] 	=  $this->a_auth->get_user_id();					
			//insert updated questions 
			$this->questions->update_question($question_id,$question_data);

			//option update start
			$option_names = $this->input->post('option_name',TRUE);
			$option_ids = $this->input->post('option_id',TRUE);
			$i=0;
			foreach ($option_names as $key => $value) {$i++;
				$option_data = array();

				$picture_name = "";
				$picture_path = "";
				if(isset($_FILES['option_img_'.$i]['name']) AND $_FILES['option_img_'.$i]['name'] !='')
				{
					$img_name = "opns-".date('Y').'-'.time();
					$options['upload_path'] = './uploads/question/options_orgn';	
					$options['allowed_types'] = 'gif|jpg|png|jpeg';
					$options['max_size']	= '5000';
					$options['file_name']= $img_name;
				
					$this->load->library('upload');
		            $this->upload->initialize($options);
					
					
					if (!$this->upload->do_upload('option_img_'.$i))
					{
						$error= $CI->upload->display_errors();	
						$this->session->set_userdata(array('message'=>$error));
						redirect(base_url('admin/question'));
						exit;
					} else {
						$data = $this->upload->data();
						if ($option_ids[$key] !='') {							
							$this->questions->do_delete_picture('question_options',$option_ids[$key]);
						}

						//insert new image
						$option_data['image'] = $data['file_name'];
						$option_data['image_path'] =  $data['file_path'];

						//create new thumbnail for new image 
						$this->create_option_thumb($option_data['image']);
					}
				}

				if ($option_ids[$key] !='') {					
					$option_data['option_details']	= html_entity_decode($option_names[$key],ENT_QUOTES,'utf-8'); 					
					$option_data['question_id']	= $question_id;
					$option_id = $option_ids[$key] ;
					$this->questions->update_option($option_id,$option_data);
					
				}else{						
					$option_data['id']	= null ; 
					$option_data['option_details']	= html_entity_decode($option_names[$key],ENT_QUOTES,'utf-8'); 					
					$option_data['question_id']	= $question_id;
					$option_data['status']	= 1;
					$option_id = $this->questions->insert_option($option_data);
				}					

				$right_answer = $this->input->post('right_answer_'.$i,TRUE);
				if ($right_answer ==1) {					
					$this->questions->update_right_answer($question_id,$option_id);
				}				
			}
			
			$this->session->set_userdata(array('message'=>"Successfully Updated !"));			
			redirect(base_url('admin/question'));
			exit;
				
		}else{
			$content = $CI->question->edit_form($question_id);
			$sub_menu = array(
				array('label'=> 'Manage Question and Options', 'url' => 'admin/question'),
				array('label'=> 'New Question and Options', 'url' => 'admin/question/add'),
				array('label'=> 'Edit Question and Options', 'url' => 'admin/question/edit/'.$question_id,'class' =>'active')
			);
			$this->admin_template->full_html_view($content,$sub_menu);
		}
	}
	
	public function sub_categories()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_question');
		$CI->load->model('admin/questions');
		
		$cat_id =  $_POST['cat_id'];	
		$categories = $CI->questions->get_categories($cat_id);
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
		$this->a_auth->check_permission('edit_question');
		$CI->load->model('admin/questions');
		
		$sub_cat_id =  $_POST['sub_cat_id'];	
		$subjects = $CI->questions->get_subjects($sub_cat_id);
		if ($subjects) {
			echo"<option value=''>...Select Question and Options...</option>";
			foreach($subjects as $subject)
			{		
				echo "<option value='$subject->id'>$subject->subject_name</option>";
			}
		} else {			
			echo"<option value=''>..No Question and Options Found..</option>";
		}
		
	}
	
	public function chapters()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('edit_question');
		$CI->load->model('admin/questions');
		
		$subject_id =  $_POST['subject_id'];	
		$chapters = $CI->questions->get_chapters($subject_id);
		if ($chapters) {
			echo"<option value=''>...Select Chapter...</option>";
			foreach($chapters as $chapter)
			{		
				echo "<option value='$chapter->id'>$chapter->chapter_name</option>";
			}
		} else {			
			echo"<option value=''>..No Chapter Found..</option>";
		}
		
	}

	public function change_status()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('change_question_status');
		$CI->load->model('admin/questions');
		$question_id =  $_POST['question_id'];
		$CI->questions->do_change_status($question_id);
		$this->session->set_userdata(array('message'=>"Successfully Status Changed !"));
		redirect(base_url('admin/question'));
		return true;	
	}	

	public function delete()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_question');
		$CI->load->model('admin/questions');
		$question_id =  $_POST['question_id'];
		//delete question picture
		$this->questions->do_delete_picture('question',$question_id);
		//delete database value
		$this->questions->do_delete($question_id);

		//get options
		$all_options = $this->questions->get_all_option_ids($question_id);
		if (! empty($all_options)) {		
			foreach ($all_options as $value) {
				$this->questions->do_delete_option($value['id']);
			}
		}
		$this->session->set_userdata(array('message'=>"Successfully Deleted !"));
		redirect(base_url('admin/question'));
		return true;	
	}

	public function delete_question_picture()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_question_picture');
		$this->load->model('admin/questions');
		$question_id =  $_POST['question_id'];
		$this->questions->do_delete_picture('question',$question_id);
		$this->session->set_userdata(array('message'=>"Successfully Picture Deleted !"));
		//redirect(base_url('admin/question'));
		return true;	
	}

	public function delete_option_picture()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_option_picture');
		$this->load->model('admin/questions');
		$option_id =  $_POST['option_id'];
		$this->questions->do_delete_picture('question_options',$option_id);
		$this->session->set_userdata(array('message'=>"Successfully Picture Deleted !"));
		//redirect(base_url('admin/question'));
		return true;	
	}	

	//delete option as wel as picture
	public function delete_option()
	{	
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('delete_option');
		$this->load->model('admin/questions');
		$option_id =  $_POST['option_id'];
		$this->questions->do_delete_option($option_id);
		$this->session->set_userdata(array('message'=>"Successfully Picture Deleted !"));
		//redirect(base_url('admin/question'));
		return true;	
	}	
	
	public function search_item()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('manage_question');
		$this->load->library('admin/question');	
		$key_word = $this->input->post('key_word',TRUE);	
		if($key_word =="") {
			$this->session->set_userdata(array('warning_message'=>"You didn't type any keyword !"));
			redirect(base_url('admin/question'));
		}		
        $content = $CI->question->get_search_view($key_word);
        $sub_menu = array(
				array('label'=> 'Manage Question and Options', 'url' => 'admin/question'),
				array('label'=> 'New Question and Options', 'url' => 'admin/question/add'),
				array('label'=> 'Search By Keyword', 'url' => 'admin/question','class' =>'active')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}	
	
	// Search by user id
	public function search_by_user()
	{
		$CI =& get_instance();
		$this->a_auth->check_auth();
		$this->a_auth->check_permission('search_by_user');
		$this->load->library('admin/question');	
		$user_id = $this->input->post('user_id',TRUE);	
		if($user_id =="") {
			$this->session->set_userdata(array('warning_message'=>"You didn't select user !"));
			redirect(base_url('admin/question'));
		}		
        $content = $CI->question->get_search_user_view($user_id);
        $sub_menu = array(
				array('label'=> 'Manage Question and Options', 'url' => 'admin/question'),
				array('label'=> 'New Question and Options', 'url' => 'admin/question/add'),
				array('label'=> 'Search By User', 'url' => 'admin/question','class' =>'active')
			);
		$this->admin_template->full_html_view($content,$sub_menu);
	}	

	//Create Product Thumb
	private function create_image_thumb($file_name)
	{
		$original_path = './uploads/question/questions_orgn';
		$thumbs_path = $_SERVER['DOCUMENT_ROOT'].'/examson/uploads/question/questions/';
	
		$this->load->library('image_lib');
		// CONFIGURE IMAGE LIBRARY
		$config['image_library']    = 'gd2';
		$config['source_image']     = $original_path."/".$file_name ;
		$config['new_image']        = $thumbs_path;
		$config['maintain_ratio']   = FALSE;
		$config['height']           = 260;
		$config['width']            = 940;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
	}

	//Create Product Thumb
	private function create_option_thumb($file_name)
	{
		$original_path = './uploads/question/options_orgn';
		$thumbs_path = $_SERVER['DOCUMENT_ROOT'].'/examson/uploads/question/options/';
	
		$this->load->library('image_lib');
		// CONFIGURE IMAGE LIBRARY
		$config['image_library']    = 'gd2';
		$config['source_image']     = $original_path."/".$file_name ;
		$config['new_image']        = $thumbs_path;
		$config['maintain_ratio']   = FALSE;
		$config['height']           = 260;
		$config['width']            = 940;
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
	}

}