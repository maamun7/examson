<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_test_category{
	var $error = array();
	public function get_list($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/model_test_categories');		
		$model_category = $CI->model_test_categories->get_category_list($limit,$page);

		if(!empty($model_category)){
			$i = $page;
			foreach($model_category as $k=>$val){
				$i++;
				$model_category[$k]['sl']= $i;
				if($val['published']==1){
					$model_category[$k]['sts_class']="fa-check-square-o";
				}else{
					$model_category[$k]['sts_class']="fa-times";
				}
				
				if($val['location_id']==1){
					$model_category[$k]['location_name']="Bangladesh";
				}elseif($val['location_id']==2){
					$model_category[$k]['location_name']="India";
				}else{
					$model_category[$k]['location_name']="Others Location";
				}
			}
		}	

		$data = array(
			'title' => 'Model Test Category List',
			'category_lists' => $model_category,
			'links' => $links
		);

		$list_view =  $CI->parser->parse('admin/model_test_category/index',$data,true);
		return $list_view;
	}

	public function add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/model_test_categories');
		$this->data['error_warning'] = "";
		if (isset($this->error['error_category_name'])) {
			$this->data['error_category_name'] = $this->error['error_category_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_category_name'] = '';
		}
		
		$this->data['category_name_value'] = $CI->input->post('category_name',TRUE);
		
		if($CI->input->post('location_id',TRUE) !== null){			
			$this->data['location_id_value'] = $CI->input->post('location_id',TRUE);
		}else{
			$this->data['location_id_value'] = 1;
		}
		
		if($CI->input->post('published_sts',TRUE) !== null){			
			$this->data['published_sts_value'] = $CI->input->post('published_sts',TRUE);
		}else{
			$this->data['published_sts_value'] = 1;
		}

		$this->data['title'] = 'Add New Category';
		$this->data['action'] = base_url().'admin/model_test_category/add';

		$html_view = $CI->parser->parse('admin/model_test_category/add',$this->data,true);
		return $html_view;
	}

	public function edit_form($category_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/model_test_categories');
		$this->data['error_warning'] = "";
		if (isset($this->error['error_category_name'])) {
			$this->data['error_category_name'] = $this->error['error_category_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_category_name'] = '';
		}

		$edit_data = $CI->model_test_categories->get_edit_data($category_id);

		if(!empty($edit_data)){
			$this->data['cat_id'] = $edit_data[0]['id'];
			$this->data['category_name_value'] = $edit_data[0]['category_name'];
			$this->data['location_id_value'] = $edit_data[0]['location_id'];
			$this->data['published_sts_value'] = $edit_data[0]['published'];

		}

		$this->data['cat_id'] = $category_id;
		if(isset($_POST['category_name'])){
			$this->data['category_name_value'] = $CI->input->post('category_name');
		}
		
		if(isset($_POST['location_id'])){
			$this->data['location_id_value'] = $CI->input->post('location_id');
		}
		
		if(isset($_POST['published_sts'])){
			$this->data['published_sts_value'] = $CI->input->post('published_sts');
		}
		$this->data['title'] = 'Edit Category';
		$this->data['action'] = base_url().'admin/model_test_category/edit/'.$category_id;
		$html_view = $CI->parser->parse('admin/model_test_category/edit',$this->data,true);
		return $html_view;
	}

	public function validateForm()
	{	
		$CI =& get_instance();

		if(isset($_POST['category_name'])){
			if(strlen($CI->input->post('category_name'))==''){
				$this->error['error_category_name']="Model Test Category name is required";
			} elseif(strlen($CI->input->post('category_name'))<3 || strlen($CI->input->post('category_name'))>140){
				$this->error['error_category_name']="Model Test Category name must be between 3 to 140 characters";
			}
		} else {
			$this->error['error_category_name']="";
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
}
