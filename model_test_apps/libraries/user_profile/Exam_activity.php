<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Exam_activity {
	public function get_exam_activity_view(){		
		$CI =& get_instance();
		$CI->load->model('user_profile/exam_activities');
		$data = array();
		$exam_list = $CI->exam_activities->get_exam_list();
		
		if(!empty($exam_list)){
            $i = 0;
			foreach($exam_list as $k=>$val){$i++;

				$exam_list[$k]['final_status']= "Completed";
				$exam_list[$k]['report']= "<a href='".base_url()."exam/report/".$val['result_id']."'> Generate </a>";

                if($val['exam_type']==1){
                    $exam_list[$k]['final_exam_type']= "Model test";
                }else{
                    $exam_list[$k]['final_exam_type']= "General test";
                }

                $exam_list[$k]['final_date'] = date_am_pm_format($val['examed_on']);

                if($val['assign_by'] == $val['user_id']){
                    $exam_list[$k]['assigned_by'] = "Myself";
                }else{
                    $exam_list[$k]['assigned_by'] = $val['first_name']." ".$val['last_name'] ;
                }


                //Stripe table row color
                if( $i%2 == 1){
                    $exam_list[$k]['stripe_class']= "tr_odd_color";
                }else{
                    $exam_list[$k]['stripe_class']= "";
                }

			}
		}

		$data['title'] = 'Exam activity';
		$data['exam_lists'] = $exam_list;
		$html_view = $CI->parser->parse('user_profile/exam_activity/activity_log',$data,true);
		return $html_view;
	}

    public function get_awaited_exam_view(){
		$CI =& get_instance();
		$CI->load->model('user_profile/exam_activities');
		$data = array();
		$exam_list = $CI->exam_activities->get_awaited_exam_list();

		if(!empty($exam_list)){
            $i = 0;
			foreach($exam_list as $k=>$val){$i++;

                $exam_list[$k]['final_status']= "Not-completed";
                if($val['exam_type']==1){
                    $exam_list[$k]['report']= "<a href='".base_url()."exam/exam_start/".$val['id']."/".$val['assign_id']."/1'> Start Exam </a>";
                }else{
                    $exam_list[$k]['report']= "<a href='".base_url()."exam/exam_start/".$val['id']."/".$val['assign_id']."/0'> Start Exam  </a>";
                }

                if($val['exam_type']==1){
                    $exam_list[$k]['final_exam_type']= "Model test";
                }else{
                    $exam_list[$k]['final_exam_type']= "General test";
                }

                $exam_list[$k]['final_date'] = date_am_pm_format($val['assign_at']);

                if($val['assign_by'] == $val['assign_to']){
                    $exam_list[$k]['assigned_by'] = "Myself";
                }else{
                    $exam_list[$k]['assigned_by'] = $val['first_name']." ".$val['last_name'] ;
                }


                //Stripe table row color
                if( $i%2 == 1){
                    $exam_list[$k]['stripe_class']= "tr_odd_color";
                }else{
                    $exam_list[$k]['stripe_class']= "";
                }

			}
		}

		$data['title'] = 'Awaited exams';
		$data['exam_lists'] = $exam_list;
		$html_view = $CI->parser->parse('user_profile/exam_activity/activity_log',$data,true);
		return $html_view;
	}
}