<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_test{
	var $error = array();
	public function get_list($limit,$page,$links)
	{
		$CI =& get_instance();
		$CI->load->model('admin/model_tests');		
		$model_test = $CI->model_tests->get_category_list($limit,$page);

		if(!empty($model_test)){
			$i = $page;
			foreach($model_test as $k=>$val){
				$i++;
				$model_test[$k]['sl']= $i;
				if($val['model_test_status']==1){
					$model_test[$k]['sts_class']="fa-check-square-o";
				}else{
					$model_test[$k]['sts_class']="fa-times";
				}
			}
		}	

		$data = array(
			'title' => 'Model Test Category List',
			'category_lists' => $model_test,
			'links' => $links
		);

		$list_view =  $CI->parser->parse('admin/model_test/index',$data,true);
		return $list_view;
	}

	public function add_form()
	{
		$CI =& get_instance();
		$CI->load->model('admin/model_tests');
		$this->data['error_warning'] = "";
		
		if (isset($this->error['error_parent_cat'])) {
			$this->data['error_parent_cat'] = $this->error['error_parent_cat'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_parent_cat'] = '';
		}

        $this->data['parent_cat_value'] = $CI->input->post('parent_cat_id',TRUE);

		if (isset($this->error['error_sub_cat_id'])) {
			$this->data['error_sub_cat_id'] = $this->error['error_sub_cat_id'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_sub_cat_id'] = '';
		}
		
		if (isset($this->error['error_model_test_name'])) {
			$this->data['error_model_test_name'] = $this->error['error_model_test_name'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_model_test_name'] = '';
		}		
		$this->data['model_test_name_value'] = $CI->input->post('model_test_name',TRUE);
		
		if (isset($this->error['error_no_of_question'])) {
			$this->data['error_no_of_question'] = $this->error['error_no_of_question'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_no_of_question'] = '';
		}		
		$this->data['no_of_question_value'] = $CI->input->post('no_of_question',TRUE);
		
		if (isset($this->error['error_duration_time'])) {
			$this->data['error_duration_time'] = $this->error['error_duration_time'];
			$this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
		} else {
			$this->data['error_duration_time'] = '';
		}		
		$this->data['duration_time_value'] = $CI->input->post('duration_time',TRUE);
		
		if($CI->input->post('published_sts',TRUE) !== null){			
			$this->data['published_sts_value'] = $CI->input->post('published_sts',TRUE);
		}else{
			$this->data['published_sts_value'] = 1;
		}

        if (isset($this->error['error_subject_parent'])) {
            $this->data['error_subject_parent'] = $this->error['error_subject_parent'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_parent_cat'] = '';
        }
        $this->data['subject_parent_value'] = $CI->input->post('subject_parent',TRUE);

		$this->data['title'] = 'Add New Model Test';
		$this->data['action'] = base_url().'admin/model_test/add';
		$this->data['parent_categories'] = $CI->model_tests->get_parent_categories();
		$this->data['subject_parents'] = $CI->model_tests->get_subject_parents();

		$html_view = $CI->parser->parse('admin/model_test/add',$this->data,true);
		return $html_view;
	}
	
	public function get_chapter_questions_view($subject_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/model_tests');	
		$json = array();

		$chapters = $CI->model_tests->get_all_chapters($subject_id);
		$sub_chap_html="<div>";
		if(!empty($chapters)){
			$i=0;
			foreach ($chapters as $key => $value) {$i++;
				$class = "select_".$i;
				$questions = $CI->model_tests->get_all_questions($value['chapter_id']);				
				$sub_chap_html.="<div class='form-group'>";
					$sub_chap_html.="<label><input type='checkbox' onchange='checked_unchecked_all(".$i.",this)' value='".$value['chapter_id']."'> &nbsp;".$value['chapter_name']."</label>";
				if(!empty($questions)){
					foreach ($questions as $index => $val) {				
						$sub_chap_html.="<div class='questions checkbox'>";
							$sub_chap_html.="<label><input type='checkbox' name='question_id[]' class='".$class." count_item' onchange='count_checked_items(this)' value='".$val['question_id']."'>".$val['details']."</label>";
						$sub_chap_html.="</div>";	
					}
				}else{
					$sub_chap_html.="<p>No Question found</p>";	
				}	
			}	
		}else{
			$sub_chap_html.="<p>No Chapter found</p>";	
		}
		$sub_chap_html.="</div>";	
		
		$json['chapter_question']=$sub_chap_html;
		return $json;
	}

	public function get_all_subjects_view($sub_cat_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/model_tests');
		$json = array();

		$subjects = $CI->model_tests->get_all_subjects($sub_cat_id);
		$sub_chap_html="";
		if(!empty($subjects)){
			$i=0;
			foreach ($subjects as $key => $value) {$i++;
				$class = "select_".$i;
				$sub_chap_html.="<tr>";
                    $sub_chap_html.="<td class='col-lg-3 text-right'>".$value['subject_name'];
                    $sub_chap_html.="</td>";

                    $sub_chap_html.="<td class='col-lg-4'>";
                        $sub_chap_html.="<input type='hidden' name='subject_ids[]' value='".$value['subject_id']."' />";
                        $sub_chap_html.="<input type='number' class='form-control' name='".$value['subject_id']."' placeholder='Enter No. Of Question for ".$value['subject_name']."' />";
                    $sub_chap_html.="</td>";
                $sub_chap_html.="<td class='col-lg-4'> </td>";
                $sub_chap_html.="</tr>";
			}
		}else{
            $sub_chap_html.="<tr>";
			    $sub_chap_html.="<td class='col-lg-3'> &nbsp; </td>";
                    $sub_chap_html.="<td class='col-lg-4'>No Subject found</td>";
                $sub_chap_html.="<td class='col-lg-4'> &nbsp; </td>";
            $sub_chap_html.="</tr>";
		}

		$json['chapter_question']=$sub_chap_html;
		return $json;
	}

	public function edit_form($model_test_id)
	{
		$CI =& get_instance();
		$CI->load->model('admin/model_tests');
		$this->data['error_warning'] = "";

        if (isset($this->error['error_parent_cat'])) {
            $this->data['error_parent_cat'] = $this->error['error_parent_cat'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_parent_cat'] = '';
        }

        $this->data['parent_cat_value'] = $CI->input->post('parent_cat_id',TRUE);

        if (isset($this->error['error_sub_cat_id'])) {
            $this->data['error_sub_cat_id'] = $this->error['error_sub_cat_id'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_sub_cat_id'] = '';
        }

        if (isset($this->error['error_model_test_name'])) {
            $this->data['error_model_test_name'] = $this->error['error_model_test_name'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_model_test_name'] = '';
        }
        $this->data['model_test_name_value'] = $CI->input->post('model_test_name',TRUE);

        if (isset($this->error['error_no_of_question'])) {
            $this->data['error_no_of_question'] = $this->error['error_no_of_question'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_no_of_question'] = '';
        }
        $this->data['no_of_question_value'] = $CI->input->post('no_of_question',TRUE);

        if (isset($this->error['error_duration_time'])) {
            $this->data['error_duration_time'] = $this->error['error_duration_time'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_duration_time'] = '';
        }
        $this->data['duration_time_value'] = $CI->input->post('duration_time',TRUE);

        if($CI->input->post('published_sts',TRUE) !== null){
            $this->data['published_sts_value'] = $CI->input->post('published_sts',TRUE);
        }else{
            $this->data['published_sts_value'] = '';
        }

        if (isset($this->error['error_subject_parent'])) {
            $this->data['error_subject_parent'] = $this->error['error_subject_parent'];
            $this->data['error_warning'] = "Warning: Please check the form carefully for errors !";
        } else {
            $this->data['error_parent_cat'] = '';
        }
        $this->data['subject_parent_value'] = $CI->input->post('subject_parent',TRUE);

		$edit_data = $CI->model_tests->get_edit_data($model_test_id);

        $subject_ids = array();
		if(!empty($edit_data)){
			$this->data['model_test_id'] = $edit_data[0]['id'];
			$this->data['parent_cat_value'] = $edit_data[0]['cat_id'];
			$this->data['model_test_name_value'] = $edit_data[0]['exam_name'];
			$this->data['no_of_question_value'] = $edit_data[0]['no_of_question'];
			$this->data['duration_time_value'] = $edit_data[0]['duration'];
			$this->data['published_sts_value'] = $edit_data[0]['model_test_status'];
			$this->data['subject_parent_value'] = $edit_data[0]['model_test_sub_cat'];
            $subject_ids = json_decode($edit_data[0]['subject_ids'],TRUE);

            //Remove comma from first and end of question ids strings
            //$question_id_string = substr($question_id_string,1);
            //$question_id_string = substr($question_id_string,0,-1);
            //$sub_q_ids = explode(",",$question_id_string);

            $final_subect_ids = $CI->model_tests->get_only_subject_name($subject_ids);
        }


        $this->data['subject_ids'] = $final_subect_ids;

		$this->data['title'] = 'Edit Category';
		$this->data['action'] = base_url().'admin/model_test/edit/'.$model_test_id;
        $this->data['parent_categories'] = $CI->model_tests->get_parent_categories();
        $this->data['subject_parents'] = $CI->model_tests->get_subject_parents();
		$html_view = $CI->parser->parse('admin/model_test/edit',$this->data,true);
		return $html_view;
	}

	public function validateForm()
	{	
		$CI =& get_instance();
		if(isset($_POST['parent_cat_id'])){
			if($CI->input->post('parent_cat_id') == ''){
				$this->error['error_parent_cat']=" Select Category";
			}
		} else {
			$this->error['error_parent_cat']="";
		}

        if(isset($_POST['sub_cat_id'])){
            if(strlen($CI->input->post('sub_cat_id')) < 1){
                $this->error['error_sub_cat_id']="Select Sub Category Name";
            }
        } else {
            $this->error['error_sub_cat_id']="";
        }
		
		if(isset($_POST['model_test_name'])){
			if(strlen($CI->input->post('model_test_name'))==''){
				$this->error['error_model_test_name']="Model test name is required";
			} elseif(strlen($CI->input->post('model_test_name'))<3 || strlen($CI->input->post('model_test_name'))>140){
				$this->error['error_model_test_name']="Model test name must be between 3 to 140 characters";
			}
		} else {
			$this->error['error_model_test_name']="";
		}
		
		if(isset($_POST['no_of_question'])){
			if(strlen($CI->input->post('no_of_question'))==''){
				$this->error['error_no_of_question']="Number of question is required";
			}elseif(!is_numeric($_POST['no_of_question'])){
				$this->error['error_no_of_question']="Required only numeric value";
			}
		}else{			
			$this->error['error_no_of_question']="";
		}
		
		if(isset($_POST['duration_time'])){
			if(strlen($CI->input->post('duration_time'))==''){
				$this->error['error_duration_time']="Duration Time is required";
			}elseif(!is_numeric($_POST['duration_time'])){
				$this->error['error_duration_time']="Required only numeric value";
			}
		}else{			
			$this->error['error_duration_time']="";
		}

        if(isset($_POST['subject_parent'])){
            if($CI->input->post('subject_parent') == ''){
                $this->error['error_subject_parent']=" Select Subject parent name";
            }
        } else {
            $this->error['error_subject_parent']="";
        }
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}
}
