<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Question {
	var $error = array();
	public $picture_name;
	public $picture_path;
	public function get_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/questions');		
		$all_question = $CI->questions->get_list($limit,$page);
		if(!empty($all_question)){
			$i = $page;
			foreach($all_question as $k=>$val){
				$i++;
				$all_question[$k]['sl']= $i;
				if($val['status']==1){
					$all_question[$k]['sts_class']="fa-check-square-o";
				}else{
					$all_question[$k]['sts_class']="fa-times";
				}

				if($val['image'] !=Null){
					$all_question[$k]['picture']="Yes";
				}else{
					$all_question[$k]['picture']="No";
				}
			}
		}

		$data = array(
			'title' => 'Question List',
			'question_lists' => $all_question,
			'all_users' => $CI->questions->get_system_users(),
			'links' => $links
		);

		$list_view =  $CI->parser->parse('admin/question/index',$data,true);
		return $list_view;
	}
	
	public function get_search_view($key_words)
	{
		$CI =& get_instance();
		$CI->load->model('admin/questions');
		$all_question = $CI->questions->get_search_items($key_words);
		if(!empty($all_question)){
			$i = 0;
			foreach($all_question as $k=>$val){
				$i++;
				$all_question[$k]['sl']= $i;
				if($val['status']==1){
					$all_question[$k]['sts_class']="fa-check-square-o";
				}else{
					$all_question[$k]['sts_class']="fa-times";
				}

				if($val['image'] !=Null){
					$all_question[$k]['picture']="Yes";
				}else{
					$all_question[$k]['picture']="No";
				}
			}
		}

		$data = array(
			'title' => 'Question List',
			'question_lists' => $all_question,
			'all_users' => $CI->questions->get_system_users(),
		);
		$list_view =  $CI->parser->parse('admin/question/index',$data,true);
		return $list_view;
	}
	
	public function get_search_user_view($user_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/questions');
		$all_question = $CI->questions->get_search_user_data($user_id);
		if(!empty($all_question)){
			$i = 0;
			foreach($all_question as $k=>$val){
				$i++;
				$all_question[$k]['sl']= $i;
				if($val['status']==1){
					$all_question[$k]['sts_class']="fa-check-square-o";
				}else{
					$all_question[$k]['sts_class']="fa-times";
				}
			}
		}

		$data = array(
			'title' => 'Question List',
			'question_lists' => $all_question,
			'all_users' => $CI->questions->get_system_users()
		);
		$list_view =  $CI->parser->parse('admin/question/user_search',$data,true);
		return $list_view;
	}

	public function add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/questions');
		$this->data['error_warning'] = "";
		
		if (isset($this->error['error_category_id'])) {
			$this->data['error_category_id'] = $this->error['error_category_id'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_category_id'] = '';
		}

		if (isset($this->error['error_sub_cat_id'])) {
			$this->data['error_sub_cat_id'] = $this->error['error_sub_cat_id'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_sub_cat_id'] = '';
		}

		if (isset($this->error['error_subject_id'])) {
			$this->data['error_subject_id'] = $this->error['error_subject_id'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_subject_id'] = '';
		}		
			
		if (isset($this->error['error_question_name'])) {
			$this->data['error_question_name'] = $this->error['error_question_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_question_name'] = '';
		}	
			
		if (isset($this->error['error_question_picture'])) {
			$this->data['error_question_picture'] = $this->error['error_question_picture'];
		} else {
			$this->data['error_question_picture'] = '';
		}
			
		if (isset($this->error['error_option_name'])) {
			$this->data['error_option_name'] = $this->error['error_option_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_option_name'] = '';
		}	

		$this->data['question_name_value'] = $CI->input->post('question_name');
		$this->data['parent_cat_value'] = $CI->input->post('category_id');
		$this->data['sub_cat_id_value'] = $CI->input->post('sub_cat_id');
		$this->data['published_sts_value'] = $CI->input->post('published_sts');
		$this->data['ordering_value'] = $CI->input->post('ordering');

		$this->data['title'] = 'Add New Chapter';
		$this->data['action'] = base_url().'admin/question/add';
		$this->data['parent_categories'] = $CI->questions->get_parent();

		$html_view = $CI->parser->parse('admin/question/add',$this->data,true);
		return $html_view;
	}

	public function edit_form($question_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/questions');
		if (isset($this->error['error_category_id'])) {
			$this->data['error_category_id'] = $this->error['error_category_id'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_category_id'] = '';
		}

		if (isset($this->error['error_sub_cat_id'])) {
			$this->data['error_sub_cat_id'] = $this->error['error_sub_cat_id'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_sub_cat_id'] = '';
		}

		if (isset($this->error['error_subject_id'])) {
			$this->data['error_subject_id'] = $this->error['error_subject_id'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_subject_id'] = '';
		}		
			
		if (isset($this->error['error_question_name'])) {
			$this->data['error_question_name'] = $this->error['error_question_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_question_name'] = '';
		}	
			
		if (isset($this->error['error_question_picture'])) {
			$this->data['error_question_picture'] = $this->error['error_question_picture'];
		} else {
			$this->data['error_question_picture'] = '';
		}
			
		if (isset($this->error['error_option_name'])) {
			$this->data['error_option_name'] = $this->error['error_option_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_option_name'] = '';
		}	
		$this->data['all_edit_data'] ='';

		$edit_data = $CI->questions->get_edit_data($question_id);

		if(!empty($edit_data)){
			$this->data['parent_cat_value'] = $edit_data[0]['category_id'];
			$sub_cat_id_value = $edit_data[0]['sub_category_id'];
			$subject_id_value = $edit_data[0]['subject_id'];
			$chapter_id_value = $edit_data[0]['chapter_id'];
			$this->data['question_name_value'] = $edit_data[0]['details'];
			$this->data['ordering_value'] = $edit_data[0]['ordering'];
			$this->data['published_sts_value'] = $edit_data[0]['status'];
			$this->data['parent_categories'] = $CI->questions->get_parent();

			$get_sub_categories= $CI->questions->get_sub_category($edit_data[0]['category_id']);
			if(isset($_POST['sub_cat_id'])){
				$sub_cat_id_value = $CI->input->post('sub_cat_id');
			}
			foreach($get_sub_categories as $key=>$value){
				if($sub_cat_id_value == $value['id']){
					$get_sub_categories[$key]['selected']='selected="selected"';
				} else{
					$get_sub_categories[$key]['selected']='';
	            }
			}
			$this->data['sub_categories'] = $get_sub_categories;

			$subjects= $CI->questions->get_all_subject($edit_data[0]['sub_category_id']);	
						
			if(isset($_POST['subject_id'])){
				$subject_id_value = $CI->input->post('subject_id');
			}
			
			foreach($subjects as $k=>$val){
				if($subject_id_value == $val['id']){
					$subjects[$k]['selected']='selected="selected"';
				}else{
					$subjects[$k]['selected']='';
	            }
			}
			$this->data['subjects'] = $subjects;

			$chapters= $CI->questions->get_all_chapters($edit_data[0]['subject_id']);	
						
			if(isset($_POST['chapter_id'])){
				$chapter_id_value = $CI->input->post('chapter_id');
			}
			
			foreach($chapters as $k=>$val){
				if($chapter_id_value == $val['id']){
					$chapters[$k]['selected']='selected="selected"';
				}else{
					$chapters[$k]['selected']='';
	            }
			}
			$this->data['chapters'] = $chapters;

			$this->data['all_edit_data'] = $edit_data;
		}

		$this->data['question_id'] = $question_id;

		if(isset($_POST['question_name'])){
			$this->data['question_name_value'] = $CI->input->post('question_name');
		}

		$this->data['question_pic'] =  $edit_data[0]['ques_pic'];
		$this->data['image_path'] =  $edit_data[0]['ques_pic_path'];

		if(isset($_POST['category_id'])){
			$this->data['parent_cat_value'] = $CI->input->post('category_id');
		}

		if(isset($_POST['ordering'])){
			$this->data['ordering_value'] = $CI->input->post('ordering');
		}

		if(isset($_POST['published_sts'])){
			$this->data['published_sts_value'] = $CI->input->post('published_sts');
		}
		$this->data['title'] = 'Edit Chapter';
		$this->data['action'] = base_url().'admin/question/edit/'.$question_id;
		$html_view = $CI->parser->parse('admin/question/edit',$this->data,true);
		return $html_view;
	}

	public function validateForm()
	{	
		$CI =& get_instance();

		if(isset($_POST['category_id'])){
			if(strlen($CI->input->post('category_id'))==''){
				$this->error['error_category_id']="Select Category Name";
			} 
		} else {
			$this->error['error_category_id']="";
		}	

		if(isset($_POST['sub_cat_id'])){
			if(strlen($CI->input->post('sub_cat_id'))==''){
				$this->error['error_sub_cat_id']="Select Sub Category Name";
			} 
		} else {
			$this->error['error_sub_cat_id']="";
		}	

		if(isset($_POST['subject_id'])){
			if(strlen($CI->input->post('subject_id'))==''){
				$this->error['error_subject_id']="Select Subject Name";
			} 
		} else {
			$this->error['error_subject_id']="";
		}

		if(isset($_POST['question_name'])){
			if(strlen($CI->input->post('question_name'))==''){
				$this->error['error_question_name']="Question detail is required";
			} elseif(strlen($CI->input->post('question_name'))<3 || strlen($CI->input->post('question_name'))>240){
				$this->error['error_question_name']="Question detail must be between 3 to 240 characters";
			}
		} else {
			$this->error['error_question_name']="";
		}

		if(isset($_FILES['question']['name']) AND $_FILES['question']['name'] !='')
		{
			$img_name = "ques-".date('Y').'-'.time();
			$config['upload_path'] = './uploads/question/questions_orgn';	
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']	= '5000';
			$config['file_name']= $img_name;
		
			$CI->load->library('upload');
            $CI->upload->initialize($config);
			
			if (!$CI->upload->do_upload('question'))
			{
				$this->error['error_question_picture']= $CI->upload->display_errors();	
			} else {
				$data = $CI->upload->data();	
				$this->picture_name = $data['file_name'];
				$this->picture_path =  $data['file_path'];
			}			

		}

		if(isset($_POST['ordering']) && !is_numeric($_POST['ordering'])){
			$this->error['error_ordering']="Required only numeric value";
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
}
