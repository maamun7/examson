<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exam_center {
	var $error = array();
	var $is_exceed_limit = FALSE;
	public function get_exam_selector_view()
	{
		$CI =& get_instance();
		$CI->load->model('front/exam_centers');	
		$data = array();
		$data['title'] = 'Select Subject and Chapter to strat Exam';

		//Get category
		$data['main_categories'] = "";
		$main_cat_id = "";
		$all_left_cat = $CI->exam_centers->get_left_category();
		if(!empty($all_left_cat)){
			$data['main_categories'] = $all_left_cat;
			$main_cat_id = $all_left_cat[0]['id'];
		}
		$list_view =  $CI->parser->parse('front/subject-select-page',$data,true);
		return $list_view;
	}

	public function get_topmenu_subjects_chapters($category_id)
	{
		$CI =& get_instance();
		$CI->load->model('front/exam_centers');	
		$data = array();
		
		$all_top_cat = $CI->exam_centers->get_top_category($category_id);			
		$top_menu_html="<ul>";
            if(!empty($all_top_cat)) {
                $i = 0;
                foreach ($all_top_cat as $top_categorie) {
                    $top_active_menu = "";
                    if ($i == 0) {
                        $top_active_menu = "top-active-menu";
                    }

                    $top_menu_html .= "<li>";
                    $top_menu_html .= "<span class='top-active " . $top_active_menu . "' onclick='click_by_top_menu(" . $top_categorie['id'] . ",this)'>" . $top_categorie['name'] . "</span>";
                    $top_menu_html .= "</li>";
                    $i++;
                }
            }else{
                $top_menu_html .= "<li> Not found any Category </li>";
            }
		$top_menu_html.="</ul>";	

		$data['top_menu']=$top_menu_html;

		if(!empty($all_top_cat)){
			$subjects = $CI->exam_centers->get_all_subjects($all_top_cat[0]['id']);
			$sub_chap_html="<div style=''>";
			if(!empty($subjects)){				
				foreach ($subjects as $key => $value) {
					$chapters = $CI->exam_centers->get_all_chapters($value['subject_id']);
					if(!empty($chapters)){
						$sub_chap_html.="<div class='subject-name'>".$value['subject_name']."</div>";
						$sub_chap_html.="<div class='chapters'>";									
							$sub_chap_html.="<div class='checkbox'>";
								foreach ($chapters as $index => $val) {
									$checked_sts = "";
									$is_checked = $this->checked_selected_status($val['chapter_id']);
									if ($is_checked) {
										$checked_sts = "checked='checked'";
									}
									$no_of_ques = $CI->exam_centers->get_chapter_question($val['chapter_id']);
									$sub_chap_html.="<label><input type='checkbox' ".$checked_sts." value='".$val['chapter_id']."=".$val['chapter_name']."' onchange='checked_unchecked_chapter(this)'>".$val['chapter_name']." (".$no_of_ques.") </label> &nbsp;";
								}
							$sub_chap_html.="</div>";
						$sub_chap_html.="</div>";
					}
				}	
			}
			$sub_chap_html.="</div>";			
        }
		$data['subject_chapter']=$sub_chap_html;

		return $data;

		// onchange='checked_unchecked_chapter(".this.")'
	}

	public function get_subjects_chapters($top_menu_id)
	{
		$CI =& get_instance();
		$CI->load->model('front/exam_centers');	
		$data = array();

		$subjects = $CI->exam_centers->get_all_subjects($top_menu_id);

		$sub_chap_html="<div style=''>";
		if(!empty($subjects)){				
			foreach ($subjects as $key => $value) {
				$chapters = $CI->exam_centers->get_all_chapters($value['subject_id']);
				if(!empty($chapters)){
					$sub_chap_html.="<div class='subject-name'>".$value['subject_name']."</div>";
					$sub_chap_html.="<div class='chapters'>";									
						$sub_chap_html.="<div class='checkbox'>";
							foreach ($chapters as $index => $val) {
								$checked_sts = "";
								$is_checked = $this->checked_selected_status($val['chapter_id']);
								if ($is_checked) {
									$checked_sts = "checked='checked'";
								}
								$no_of_ques = $CI->exam_centers->get_chapter_question($val['chapter_id']);
								$sub_chap_html.="<label><input type='checkbox' ".$checked_sts." value='".$val['chapter_id']."=".$val['chapter_name']."' onchange='checked_unchecked_chapter(this)'>".$val['chapter_name']." (".$no_of_ques.") </label> &nbsp;";
							}
						$sub_chap_html.="</div>";
					$sub_chap_html.="</div>";
				}
			}	
		}
		$sub_chap_html.="</div>";	
		
		$data['subject_chapter']=$sub_chap_html;
		return $data;
	}

	public function get_selected_chapter_html_view()
	{
		$CI =& get_instance();
		$chapters= $CI->session->userdata('selected_chapter');

		if(!empty($chapters)) {
			$html="<div style='text-align:left;'>";
				if ($this->is_exceed_limit) {					
					$html.="<span>You can select maximum 10 Chapters</span>";
				}				

				$html.="<form action='".base_url()."exam-center/create_exam' name='' method='post' id='exam_starts'>";
                    $html.="<input type='text' class='border2 form-control' name='exam_name' placeholder='Enter exam name'>";
                    $html.="<br/>";

                    foreach ($chapters[0] as $value) {
						if ($value['id'] !='') {				
							$html.="<span class='glyphicon glyphicon-check'></span> ".$value['name']." <span onclick=\"unchecked_chapter('".$value['id']."=".$value['name']."')\" style='cursor: pointer;'>&times </span><br/>";	
							$html.="<input type='hidden' name='chapter_id[]' value='".$value['id']."'>";	
						}
					}

                    $html.="<span>&nbsp;</span>";
					$html.="<div class='input-group'>";
						$html.="<span class='border2 bg input-group-addon'>Number of Questions</span>";
						$html.="<input type='text' class='border2 form-control' name='total_question'>";
					$html.="</div>";
					$html.="<span>&nbsp;</span>";
					$html.="<div class='input-group'>";
						$html.="<span class='border2 bg input-group-addon'>Time limit (In Minute)</span>";
						$html.="<input type='text' class='border2 form-control' name='duration_time'>";
					$html.="</div>";
				$html.="</form>";
			$html.="</div>";
			return $html;
		}else{
			$html=0;				
			return $html;
		}
	}

	private function checked_selected_status($chapter_id)
	{
		$CI =& get_instance();
		$ids=array();
		if($CI->session->userdata('selected_chapter')){		
			$chapters= $CI->session->userdata('selected_chapter');
			//Create an array using all chapter ids
			foreach ($chapters[0] as $key => $chapter) {
				$ids[]=$chapter['id'];
			}
			//Check if already exist
			if (in_array($chapter_id, $ids, true)) {
				return TRUE;	
			}
		}
		return FALSE;
	}

	public function get_model_test_view($location_id)
	{
		$CI =& get_instance();
		$CI->load->model('front/exam_centers');	
		$json = array();

        $all_top_cat = $CI->exam_centers->get_model_test_cat($location_id);

        $top_menu_html="<ul>";
        if(!empty($all_top_cat)) {
            $i = 0;
            foreach ($all_top_cat as $top_categorie) {
                $top_active_menu = "";
                if ($i == 0) {
                    $top_active_menu = "top-active-menu";
                }

                $top_menu_html .= "<li>";
                $top_menu_html .= "<span class='top-active " . $top_active_menu . "' onclick='click_model_test_top_menu(" . $top_categorie['cat_id'] . ",this)'>" . $top_categorie['category_name'] . "</span>";
                $top_menu_html .= "</li>";
                $i++;
            }
        }else{
            $top_menu_html .= "<li> Not found any Category </li>";
        }
        $top_menu_html.="</ul>";

		$json['top_menu']=$top_menu_html;

        $sub_chap_html="<div style=''>";
        if($all_top_cat){
            $subjects = $CI->exam_centers->get_model_test_sub_cat($all_top_cat[0]['cat_id']);
            if($subjects) {
                foreach ($subjects as $key => $value) {
                    $model_test = $CI->exam_centers->get_model_test($value['sub_cat_id']);
                    if ($model_test) {
                        $sub_chap_html .= "<div class='subject-name'>" . $value['sub_cat_name'] . "</div>";
                        $sub_chap_html .= "<div class='chapters'>";
                        $sub_chap_html .= "<div class='checkbox'>";

                        foreach ($model_test as $index => $val) {
                            $sub_chap_html .= "<label>";
                                $sub_chap_html .= "<form name='model_test' id='model_test' action='" . base_url() . "exam/start_model_test' method='POST'>";
                                $sub_chap_html .= "<input type='checkbox' class='model_test' name='model_test' value='" . $val['id'] . "' onchange='select_model_test(this)'>" . $val['exam_name'] . " &nbsp;";
                                $sub_chap_html .= "</form>";
                            $sub_chap_html .= "</label>";
                        }
                        $sub_chap_html .= "</div>";
                        $sub_chap_html .= "</div>";
                    }
                }
            }
        }
        $sub_chap_html.="</div>";

		$json['subject_chapter'] = $sub_chap_html;
        return $json;
	}

	public function get_model_test_view_by_top_menu($cat_id)
	{
		$CI =& get_instance();
		$CI->load->model('front/exam_centers');
		$json = array();

        $sub_chap_html="<div style=''>";
        $subjects = $CI->exam_centers->get_model_test_sub_cat($cat_id);
        if($subjects) {
            foreach ($subjects as $key => $value) {
                $model_test = $CI->exam_centers->get_model_test($value['sub_cat_id']);
                if ($model_test) {
                    $sub_chap_html .= "<div class='subject-name'>" . $value['sub_cat_name'] . "</div>";
                    $sub_chap_html .= "<div class='chapters'>";
                    $sub_chap_html .= "<div class='checkbox'>";

                    foreach ($model_test as $index => $val) {
                        $sub_chap_html .= "<label>";
                            $sub_chap_html .= "<form name='model_test' id='model_test' action='" . base_url() . "exam/start_model_test' method='POST'>";
                            $sub_chap_html .= "<input type='checkbox' class='model_test' name='model_test' value='" . $val['id'] . "' onchange='select_model_test(this)'>" . $val['exam_name'] . " &nbsp;";
                            $sub_chap_html .= "</form>";
                        $sub_chap_html .= "</label>";
                    }
                    $sub_chap_html .= "</div>";
                    $sub_chap_html .= "</div>";
                }
            }
        }

        $sub_chap_html.="</div>";

		$json['subject_chapter'] = $sub_chap_html;
        return $json;
	}

	public function validateForm()
	{	
		$CI =& get_instance();
        if(isset($_POST['exam_name'])){
            if(strlen($CI->input->post('total_question'))==''){
                $this->error['Exam_name']="Required exam name";
            }
        }else{
            $this->error['Exam_name']="";
        }

		if(isset($_POST['total_question'])){
			if(strlen($CI->input->post('total_question'))==''){
				$this->error['NoOfQuestion']="No. of Question is required";
			}elseif(!is_numeric($_POST['total_question'])){
				$this->error['NoOfQuestion']="Required only numeric value";
			}elseif($CI->input->post('total_question')<20 || $CI->input->post('total_question')>100){
				$this->error['NoOfQuestion']="No. of Question must be between 20 to 100 limit";
			}
		}else{			
			$this->error['NoOfQuestion']="";
		}

		if(isset($_POST['duration_time'])){
			if(strlen($CI->input->post('duration_time'))==''){
				$this->error['time_limit']="Time Limit is required";
			}elseif(!is_numeric($_POST['duration_time'])){
				$this->error['time_limit']="Required only numeric value";
			}
		}else{			
			$this->error['time_limit']="";
		}	

		if(isset($_POST['chapter_id'])){
			if($CI->input->post('chapter_id') < 1){
				$this->error['Chapter']="Select Atleast One Chapter";
			}
		}else{
			$this->error['Chapter']="";
		}
		
		if (!$this->error) {
      		return true;
    	} else {
      		return false;
    	}
	}

	public function getError(){
		return $this->error;
	}

}
