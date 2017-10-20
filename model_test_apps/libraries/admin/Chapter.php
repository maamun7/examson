<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chapter {
	var $error = array();
	public function get_list_view($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/chapters');		
		$all_chapter = $CI->chapters->get_list($limit,$page);
		if(!empty($all_chapter)){
			$i = $page;
			foreach($all_chapter as $k=>$val){
				$i++;
				$all_chapter[$k]['sl']= $i;
				if($val['published']==1){
					$all_chapter[$k]['sts_class']="fa-check-square-o";
				}else{
					$all_chapter[$k]['sts_class']="fa-times";
				}
			}
		}	

		$data = array(
			'title' => 'Chapter List',
			'chapter_lists' => $all_chapter,
			'links' => $links
		);
		$list_view =  $CI->parser->parse('admin/chapter/index',$data,true);
		return $list_view;
	}
	
	public function get_search_view($key_words)
	{
		$CI =& get_instance();
		$CI->load->model('admin/chapters');
		$all_chapter = $CI->chapters->get_search_items($key_words);
		$i=0;
		if(!empty($all_chapter)){
			$i = 0;
			foreach($all_chapter as $k=>$val){
				$i++;
				$all_chapter[$k]['sl']= $i;
				if($val['published']==1){
					$all_chapter[$k]['sts_class']="fa-check-square-o";
				}else{
					$all_chapter[$k]['sts_class']="fa-times";
				}
			}
		}	
		$data = array(
				'title' => 'Chapter List',
				'chapter_lists' => $all_chapter,
			);
		$chapterList = $CI->parser->parse('admin/chapter/index',$data,true);
		return $chapterList;
	}

	public function add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/chapters');
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
			
		if (isset($this->error['error_chapter_name'])) {
			$this->data['error_chapter_name'] = $this->error['error_chapter_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_chapter_name'] = '';
		}
			
		if (isset($this->error['error_ordering'])) {
			$this->data['error_ordering'] = $this->error['error_ordering'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_ordering'] = '';
		}
		
		$this->data['chapter_name_value'] = $CI->input->post('chapter_name');
		$this->data['parent_cat_value'] = $CI->input->post('category_id');
		$this->data['sub_cat_id_value'] = $CI->input->post('sub_cat_id');
		$this->data['published_sts_value'] = $CI->input->post('published_sts');
		$this->data['ordering_value'] = $CI->input->post('ordering');

		$this->data['title'] = 'Add New Chapter';
		$this->data['action'] = base_url().'admin/chapter/add';
		$this->data['parent_categories'] = $CI->chapters->get_parent();

		$html_view = $CI->parser->parse('admin/chapter/add',$this->data,true);
		return $html_view;
	}

	public function edit_form($chapter_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/chapters');
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
			
		if (isset($this->error['error_chapter_name'])) {
			$this->data['error_chapter_name'] = $this->error['error_chapter_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_chapter_name'] = '';
		}
			
		if (isset($this->error['error_ordering'])) {
			$this->data['error_ordering'] = $this->error['error_ordering'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_ordering'] = '';
		}

		$edit_data = $CI->chapters->get_edit_data($chapter_id);

		if(!empty($edit_data)){
			$this->data['parent_cat_value'] = $edit_data[0]['category_id'];
			$sub_cat_id_value = $edit_data[0]['sub_category_id'];
			$subject_id_value = $edit_data[0]['subject_id'];
			$this->data['chapter_name_value'] = $edit_data[0]['chapter_name'];
			$this->data['ordering_value'] = $edit_data[0]['ordering'];
			$this->data['published_sts_value'] = $edit_data[0]['published'];
			$this->data['parent_categories'] = $CI->chapters->get_parent();

			$get_sub_categories= $CI->chapters->get_sub_category($edit_data[0]['category_id']);
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

			$subjects= $CI->chapters->get_all_subject($edit_data[0]['subject_id']);	
						
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
		}

		$this->data['chapter_id'] = $chapter_id;

		if(isset($_POST['chapter_name'])){
			$this->data['chapter_name_value'] = $CI->input->post('chapter_name');
		}

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
		$this->data['action'] = base_url().'admin/chapter/edit/'.$chapter_id;
		$html_view = $CI->parser->parse('admin/chapter/edit',$this->data,true);
		return $html_view;
	}

	public function validateForm()
	{	
		$CI =& get_instance();

		if(isset($_POST['category_id'])){
			if(strlen($CI->input->post('category_id')) < 1){
				$this->error['error_category_id']="Select Category Name";
			} 
		} else {
			$this->error['error_category_id']="";
		}	

		if(isset($_POST['sub_cat_id'])){
			if(strlen($CI->input->post('sub_cat_id')) < 1){
				$this->error['error_sub_cat_id']="Select Sub Category Name";
			} 
		} else {
			$this->error['error_sub_cat_id']="";
		}	

		if(isset($_POST['subject_id'])){
			if(strlen($CI->input->post('subject_id')) < 1){
				$this->error['error_subject_id']="Select Subject Name";
			} 
		} else {
			$this->error['error_subject_id']="";
		}

		if(isset($_POST['chapter_name'])){
			if(strlen($CI->input->post('chapter_name'))==''){
				$this->error['error_chapter_name']="Chapter name is required";
			} elseif(strlen($CI->input->post('chapter_name'))<3 || strlen($CI->input->post('chapter_name'))>140){
				$this->error['error_chapter_name']="Chapter name must be between 3 to 140 characters";
			}
		} else {
			$this->error['error_chapter_name']="";
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
