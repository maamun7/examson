<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_test_sub_cat{
	var $error = array();
	public function get_subcat_list($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/model_test_sub_cats');		
		$model_sub_cat = $CI->model_test_sub_cats->get_sub_cat_list($limit,$page);

		if(!empty($model_sub_cat)){
			$i = $page;
			foreach($model_sub_cat as $k=>$val){
				$i++;
				$model_sub_cat[$k]['sl']= $i;
			}
		}	

		$data = array(
			'title' => 'Model Test Category List',
			'sub_cat_lists' => $model_sub_cat,
			'links' => $links
		);

		$list_view =  $CI->parser->parse('admin/model_test_sub_cat/index',$data,true);
		return $list_view;
	}

	public function add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/model_test_sub_cats');
		$this->data['error_warning'] = "";		
		
		if (isset($this->error['error_category_name'])) {
			$this->data['error_category_name'] = $this->error['error_category_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_category_name'] = '';
		}
		
		if (isset($this->error['error_sub_category_name'])) {
			$this->data['error_sub_category_name'] = $this->error['error_sub_category_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_sub_category_name'] = '';
		}
		
		if(isset($_POST['category_id'])){
			$this->data['category_value'] = $CI->input->post('category_id');
		}
		if(isset($_POST['sub_cat_name'])){
			$this->data['sub_cat_name_value'] = $CI->input->post('sub_cat_name');
		}

		$this->data['category_lists'] = $CI->model_test_sub_cats->get_category_list();
		$this->data['title'] = 'Add New Sub Category';
		$this->data['action'] = base_url().'admin/model_test_sub_category/add';

		$html_view = $CI->parser->parse('admin/model_test_sub_cat/add',$this->data,true);
		return $html_view;
	}

	public function edit_form($sub_cat_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/model_test_sub_cats');
		$this->data['error_warning'] = "";
		if (isset($this->error['error_category_name'])) {
			$this->data['error_category_name'] = $this->error['error_category_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_category_name'] = '';
		}
		
		if (isset($this->error['error_sub_category_name'])) {
			$this->data['error_sub_category_name'] = $this->error['error_sub_category_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_sub_category_name'] = '';
		}

		$edit_data = $CI->model_test_sub_cats->get_edit_data($sub_cat_id);

		if(!empty($edit_data)){
			$this->data['sub_cat_id'] = $edit_data[0]['id'];
			$this->data['category_value'] = $edit_data[0]['category_id'];
			$this->data['sub_cat_name_value'] = $edit_data[0]['sub_cat_name'];
		}

		$this->data['id'] = $sub_cat_id;
		
		
		if(isset($_POST['category_id'])){
			$this->data['category_value'] = $CI->input->post('category_id');
		}
		if(isset($_POST['sub_cat_name'])){
			$this->data['sub_cat_name_value'] = $CI->input->post('sub_cat_name');
		}
		
		$this->data['title'] = 'Edit Sub Category';
		$this->data['category_lists'] = $CI->model_test_sub_cats->get_category_list();
		$this->data['action'] = base_url().'admin/model_test_sub_category/edit/'.$sub_cat_id;
		$html_view = $CI->parser->parse('admin/model_test_sub_cat/edit',$this->data,true);
		return $html_view;
	}

	public function validateForm()
	{	
		$CI =& get_instance();

		if(isset($_POST['category_id'])){
			if(strlen($CI->input->post('category_id')) < 1){
				$this->error['error_category_name']="Select Model Test Category";
			}
		} else {
			$this->error['error_category_name']="";
		}
		
		if(isset($_POST['sub_cat_name'])){
			if(strlen($CI->input->post('sub_cat_name'))==''){
				$this->error['error_sub_category_name']="Model Test Sub Category name is required";
			} elseif(strlen($CI->input->post('sub_cat_name'))<3 || strlen($CI->input->post('sub_cat_name'))>140){
				$this->error['error_sub_category_name']="Model Test Sub Category name must be between 3 to 140 characters";
			}
		} else {
			$this->error['error_sub_category_name']="";
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
}
