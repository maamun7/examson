<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main_category {
	var $error = array();
	public function get_list($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/main_categories');		
		$all_category = $CI->main_categories->get_category_list(0,1,$limit,$page);

		if(!empty($all_category)){
			$i = $page;
			foreach($all_category as $k=>$val){
				$i++;
				$all_category[$k]['sl']= $i;
				if($val['published']==1){
					$all_category[$k]['sts_class']="fa-check-square-o";
				}else{
					$all_category[$k]['sts_class']="fa-times";
				}
			}
		}	

		$data = array(
			'title' => 'Category List',
			'category_lists' => $all_category,
			'links' => $links
		);

		$list_view =  $CI->parser->parse('admin/main_category/index',$data,true);
		return $list_view;
	}
	
	public function get_search_view($key_words)
	{
		$CI =& get_instance();
		$CI->load->model('admin/main_categories');
		$all_category = $CI->main_categories->get_search_items($key_words);
		$i=0;
		if(!empty($all_category)){
			$i = 0;
			foreach($all_category as $k=>$val){
				$i++;
				$all_category[$k]['sl']= $i;
				if($val['published']==1){
					$all_category[$k]['sts_class']="fa-check-square-o";
				}else{
					$all_category[$k]['sts_class']="fa-times";
				}
			}
		}	
		$data = array(
				'title' => 'Suppliers List',
				'category_lists' => $all_category,
			);
		$main_categoryList = $CI->parser->parse('admin/main_category/search_list',$data,true);
		return $main_categoryList;
	}

	public function add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/main_categories');
		$this->data['error_warning'] = "";
		if (isset($this->error['error_category_name'])) {
			$this->data['error_category_name'] = $this->error['error_category_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_category_name'] = '';
		}
		
		$this->data['category_name_value'] = $CI->input->post('category_name');
		$this->data['category_alias_value'] = $CI->input->post('category_alias');
		$this->data['link_url_value'] = $CI->input->post('link_url');
		$this->data['parent_cat_value'] = $CI->input->post('parent_cat_id');
		$this->data['meta_keyword_value'] = $CI->input->post('meta_keyword');
		$this->data['meta_description_value'] = $CI->input->post('meta_description');
		$this->data['published_sts_value'] = $CI->input->post('published_sts');

		$this->data['title'] = 'Add New Category';
		$this->data['action'] = base_url().'admin/main_category/add';
		$this->data['parent_categories'] = $CI->main_categories->get_parent_categories();

		$html_view = $CI->parser->parse('admin/main_category/add',$this->data,true);
		return $html_view;
	}

	public function edit_form($category_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/main_categories');
		$this->data['error_warning'] = "";
		if (isset($this->error['error_category_name'])) {
			$this->data['error_category_name'] = $this->error['error_category_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_category_name'] = '';
		}

		$edit_data = $CI->main_categories->get_edit_data($category_id);

		if(!empty($edit_data)){
			$this->data['cat_id'] = $edit_data[0]['id'];
			$this->data['category_name_value'] = $edit_data[0]['name'];
			$this->data['category_alias_value'] = $edit_data[0]['alias'];
			$this->data['link_url_value'] = $edit_data[0]['link'];
			$this->data['parent_cat_value'] = $edit_data[0]['parent_id'];
			$this->data['meta_keyword_value'] = $edit_data[0]['meta_keyword'];
			$this->data['meta_description_value'] = $edit_data[0]['meta_description'];
			$this->data['published_sts_value'] = $edit_data[0]['published'];

			/*
			$parent_cats = $CI->main_categories->get_parent_categories();
			foreach ($parent_cats as $key => $value) {
				if ($edit_data[0]['parent_id']==$value) {
					$parent_cats[$key]["selected"]= 'selected="selected"';
				}
			}*/
			$this->data['parent_categories'] = $CI->main_categories->get_parent_categories();

		}

		$this->data['cat_id'] = $category_id;
		if(isset($_POST['category_name'])){
			$this->data['category_name_value'] = $CI->input->post('category_name');
		}

		if(isset($_POST['category_alias'])){
			$this->data['category_alias_value'] = $CI->input->post('category_alias');
		}

		if(isset($_POST['main_category_email'])){
			$this->data['main_category_email_value'] = $CI->input->post('main_category_email');
		}

		if(isset($_POST['link_url'])){
			$this->data['link_url_value'] = $CI->input->post('link_url');
		}

		if(isset($_POST['parent_cat_id'])){
			$this->data['parent_cat_value'] = $CI->input->post('parent_cat_id');
		}

		if(isset($_POST['meta_keyword'])){
			$this->data['meta_keyword_value'] = $CI->input->post('meta_keyword');
		}

		if(isset($_POST['meta_description'])){
			$this->data['meta_description_value'] = $CI->input->post('meta_description');
		}

		if(isset($_POST['published_sts'])){
			$this->data['published_sts_value'] = $CI->input->post('published_sts');
		}
		$this->data['title'] = 'Edit Category';
		$this->data['action'] = base_url().'admin/main_category/edit/'.$category_id;
		$html_view = $CI->parser->parse('admin/main_category/edit',$this->data,true);
		return $html_view;
	}

	public function validateForm()
	{	
		$CI =& get_instance();

		if(isset($_POST['category_name'])){
			if(strlen($CI->input->post('category_name'))==''){
				$this->error['error_category_name']="Category name is required";
			} elseif(strlen($CI->input->post('category_name'))<3 || strlen($CI->input->post('category_name'))>140){
				$this->error['error_category_name']="Category name must be between 3 to 140 characters";
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
