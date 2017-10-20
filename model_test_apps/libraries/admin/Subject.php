<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subject {
	var $error = array();
	public function get_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/subjects');		
		$all_subject = $CI->subjects->get_list($limit,$page);
		if(!empty($all_subject)){
			$i = $page;
			foreach($all_subject as $k=>$val){
				$i++;
				$all_subject[$k]['sl']= $i;
				if($val['published']==1){
					$all_subject[$k]['sts_class']="fa-check-square-o";
				}else{
					$all_subject[$k]['sts_class']="fa-times";
				}
			}
		}	
		$data = array(
			'title' => 'Subject List',
			'subject_lists' => $all_subject,
			'links' => $links
		);
		$list_view =  $CI->parser->parse('admin/subject/index',$data,true);
		return $list_view;
	}
	
	public function get_search_view($key_words)
	{
		$CI =& get_instance();
		$CI->load->model('admin/subjects');
		$all_subject = $CI->subjects->get_search_items($key_words);
		$i=0;
		if(!empty($all_subject)){
			$i = 0;
			foreach($all_subject as $k=>$val){
				$i++;
				$all_subject[$k]['sl']= $i;
				if($val['published']==1){
					$all_subject[$k]['sts_class']="fa-check-square-o";
				}else{
					$all_subject[$k]['sts_class']="fa-times";
				}
			}
		}	
		$data = array(
				'title' => 'Subject List',
				'subject_lists' => $all_subject,
			);
		$subjectList = $CI->parser->parse('admin/subject/index',$data,true);
		return $subjectList;
	}

	public function add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/subjects');
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
			
		if (isset($this->error['error_subject_name'])) {
			$this->data['error_subject_name'] = $this->error['error_subject_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_subject_name'] = '';
		}
			
		if (isset($this->error['error_ordering'])) {
			$this->data['error_ordering'] = $this->error['error_ordering'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_ordering'] = '';
		}
		
		$this->data['subject_name_value'] = $CI->input->post('subject_name');
		$this->data['parent_cat_value'] = $CI->input->post('category_id');
		$this->data['sub_cat_id_value'] = $CI->input->post('sub_cat_id');
		$this->data['published_sts_value'] = $CI->input->post('published_sts');
		$this->data['ordering_value'] = $CI->input->post('ordering');

		$this->data['title'] = 'Add New Subject';
		$this->data['action'] = base_url().'admin/subject/add';
		$this->data['parent_categories'] = $CI->subjects->get_parent();

		$html_view = $CI->parser->parse('admin/subject/add',$this->data,true);
		return $html_view;
	}

	public function edit_form($subject_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/subjects');
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
			
		if (isset($this->error['error_subject_name'])) {
			$this->data['error_subject_name'] = $this->error['error_subject_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_subject_name'] = '';
		}
			
		if (isset($this->error['error_ordering'])) {
			$this->data['error_ordering'] = $this->error['error_ordering'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_ordering'] = '';
		}

		$edit_data = $CI->subjects->get_edit_data($subject_id);

		if(!empty($edit_data)){
			$this->data['parent_cat_value'] = $edit_data[0]['category_id'];
			$sub_cat_id_value = $edit_data[0]['sub_category_id'];
			$this->data['subject_name_value'] = $edit_data[0]['subject_name'];
			$this->data['ordering_value'] = $edit_data[0]['ordering'];
			$this->data['published_sts_value'] = $edit_data[0]['published'];
			$this->data['parent_categories'] = $CI->subjects->get_parent();
			
			$get_sub_categories= $CI->subjects->get_sub_category($edit_data[0]['category_id']);
			if(isset($_POST['sub_cat_id'])){
				$sub_cat_id_value = $CI->input->post('sub_cat_id');
			}
			foreach($get_sub_categories as $key=>$value){
					if($sub_cat_id_value == $value['id']){
						$get_sub_categories[$key]['selected']='selected="selected"';
					}
				else{
	                $get_sub_categories[$key]['selected']='';
	            }
			}
			$this->data['get_sub_categories'] = $get_sub_categories;
		}

		$this->data['subject_id'] = $subject_id;

		if(isset($_POST['subject_name'])){
			$this->data['subject_name_value'] = $CI->input->post('subject_name');
		}

		if(isset($_POST['category_id'])){
			$this->data['parent_cat_value'] = $CI->input->post('category_id');
		}

		if(isset($_POST['sub_cat_id'])){
			$this->data['sub_cat_id_value'] = $CI->input->post('sub_cat_id');
		}

		if(isset($_POST['ordering'])){
			$this->data['ordering_value'] = $CI->input->post('ordering');
		}

		if(isset($_POST['published_sts'])){
			$this->data['published_sts_value'] = $CI->input->post('published_sts');
		}
		$this->data['title'] = 'Edit Subject';
		$this->data['action'] = base_url().'admin/subject/edit/'.$subject_id;
		$html_view = $CI->parser->parse('admin/subject/edit',$this->data,true);
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

		if(isset($_POST['subject_name'])){
			if(strlen($CI->input->post('subject_name'))==''){
				$this->error['error_subject_name']="Subject name is required";
			} elseif(strlen($CI->input->post('subject_name'))<3 || strlen($CI->input->post('subject_name'))>140){
				$this->error['error_subject_name']="Subject name must be between 3 to 140 characters";
			}
		} else {
			$this->error['error_subject_name']="";
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
