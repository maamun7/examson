<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home {
	public function get_home_view()
	{
		$CI =& get_instance();
        $CI->load->model('front/homes');

        $popular_exam_list = $CI->homes->get_popular_exams();

        if(!empty($popular_exam_list)){
            foreach($popular_exam_list as $k=>$val){
                $popular_exam_list[$k]['start_link']= "<a href='".base_url()."exam/start_model_test/".$val['id']."'> Start Exam  </a>";
            }
        }
        $exam_taker_list = $CI->homes->get_exam_taker_list();

        if(!empty($exam_taker_list)){
            foreach($exam_taker_list as $key => $value){
                $exam_taker_list[$key]['score'] = ($value['total_correct'] * 100)/$value['total_question']  ."%";
                $exam_taker_list[$key]['final_date'] = only_date_in_numeric_format($value['examed_on']);
                $exam_taker_list[$key]['final_time'] = get_time_from_full_date($value['examed_on']);
            }
        }

		$data = array(
			'title' => 'Welcome to Ready for exam !!!',
			'is_active_view' => $CI->auth->is_logged(),
			'popular_exams' => $popular_exam_list,
			'exam_takers' => $exam_taker_list,
		);
		$list_view =  $CI->parser->parse('front/home',$data,true);
		return $list_view;
	}
}
