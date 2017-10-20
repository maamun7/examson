<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_template {
	var $current_menu = 'home';
	
	function flash_message()
	{
		$CI =& get_instance();
		$CI->load->library('parser');
		
		$message = '';
		$message_class = '';
		$html = '';
		
		if($CI->session->userdata('message') != '')
		{
			$message = $CI->session->userdata('message');
			$message_class = 'msg-success';
		}elseif($CI->session->userdata('info_message') != '')
		{
			$message = $CI->session->userdata('info_message');
			$message_class = 'msg-info';
		}elseif($CI->session->userdata('warning_message') != '')
		{
			$message = $CI->session->userdata('warning_message');
			$message_class = 'msg-warning';
		}elseif($CI->session->userdata('error_message') != '')
		{
			$message = $CI->session->userdata('error_message');
			$message_class = 'msg-danger';
		}

		$data = array(
			'message' => $message,
			'message_class' => $message_class
		);

		if($message != ''){
			$html = $CI->parser->parse('common/front/message',$data,true);
		}

		$CI->session->unset_userdata('message');
		$CI->session->unset_userdata('info_message');
		$CI->session->unset_userdata('warning_message');
		$CI->session->unset_userdata('error_message');
		return $html;
	}
	
	public function template($content,$sub_menu=''){
        $CI =& get_instance();
        $CI->load->model('user_profile/eusers');
        $message = $this->flash_message();
        $top_menu='';
        $left_menu='';
        $image = '';
        $short_name = '';
		$menu_template = 'common/front/top_menu';
        if($CI->auth->is_logged())
		{
            $menu_template = 'common/front/loggedin_top_menu';
            $login_data = $CI->eusers->get_login_info();
            $image = $login_data[0]['image'];
            $short_name = $login_data[0]['first_name'];
            if ($image == "") {
                $image = "default.jpg";
            }
		}

        $menu_data = array(
            'active' => $this->current_menu,
            'image'=> $image,
            'short_name'=> $short_name,
        );

        $top_menu = $CI->parser->parse($menu_template,$menu_data,true);
        $footer_menu = $CI->parser->parse('common/front/footer_menu',[],true);

        $data = array(
			'main_menus' 	=> $top_menu,
			'sub_menu' 		=> $sub_menu,
            'footer_menus' 	=> $footer_menu,
			'content' 		=> $content,
			'msg_content' 	=> $message
		);
		$CI->parser->parse('user_profile/template/user_profile',$data);
	}
	
	public function account_template($content,$left_menus=''){
	
		$CI =& get_instance();		
		$CI->load->model("user_profile/eusers");
		$message = $this->flash_message();
		$top_menu='';
		$left_menu='';
		$image = '';
		$short_name = '';
		
		$menu_template = 'common/front/top_menu';
		$acc_template = 'user_profile/include/account_info';
		$left_menu_template = 'user_profile/include/left_menu';
        $footer_menu = '';
		
		if ($CI->auth->is_logged())
		{
            $menu_template = 'common/front/loggedin_top_menu';
			$login_data = $CI->eusers->get_login_info();
			$image = $login_data[0]['image'];
			$short_name = $login_data[0]['first_name'];
			if ($image == "") {
				$image = "default.jpg";
			}
			$account_data = array(
				'name'=> $login_data[0]['first_name']." ".$login_data[0]['last_name'],
				'image'=> $image,
				'address'=> $login_data[0]['address'],
				'phone'=> $login_data[0]['phone'],
				'mobile'=> $login_data[0]['mobile'],
			);

            $account_view = $CI->parser->parse($acc_template,$account_data,true);

            $menu_data = array(
                'active' => $this->current_menu,
                'image'=> $image,
                'short_name'=> $short_name,
            );

            $top_menu = $CI->parser->parse($menu_template,$menu_data,true);
            $footer_menu = $CI->parser->parse('common/front/footer_menu',[],true);

            if ( $left_menus != '' )
            {
                // insert empty text to non assigned elments
                foreach($left_menus as $k=>$sub){
                    if(!isset($sub['class']))$left_menus[$k]['class']='';
                }
                $left_menu = $CI->parser->parse($left_menu_template, array('left_menu'=>$left_menus), true);
            }
		}

		$data = array(
			'account_info' 	=> $account_view,
			'main_menus' 	=> $top_menu,
			'left_menus' 	=> $left_menu,
            'footer_menus' 	=> $footer_menu,
			'content' 		=> $content,
			'msg_content' 	=> $message
		);
		$CI->parser->parse('user_profile/template/user_account',$data);
	}
	
	public function exam_activity_template($content,$left_menus=''){
	
		$CI =& get_instance();		
		$CI->load->model("user_profile/eusers");
		$message = $this->flash_message();
		$logged_info='';
		$top_menu='';
		$left_menu='';
		$image = '';
		$short_name = '';
		
		$menu_template = 'common/front/top_menu';
		$acc_template = 'user_profile/include/account_info';
		$left_menu_template = 'user_profile/include/exam_activity_menu';
        $footer_menu = '';
		
		if ($CI->auth->is_logged())
		{
            $menu_template = 'common/front/loggedin_top_menu';
			$login_data = $CI->eusers->get_login_info();
			$image = $login_data[0]['image'];
			$short_name = $login_data[0]['first_name'];
			if ($image == "") {
				$image = "default.jpg";
			}
			$account_data = array(
				'name'=> $login_data[0]['first_name']." ".$login_data[0]['last_name'],
				'image'=> $image,
				'address'=> $login_data[0]['address'],
				'phone'=> $login_data[0]['phone'],
				'mobile'=> $login_data[0]['mobile'],
			);
            $footer_menu = $CI->parser->parse('common/front/footer_menu',[],true);
		}		
				
		$account_view = $CI->parser->parse($acc_template,$account_data,true);		
		
		$log_info = array(
			'email' => $CI->session->userdata('user_name'),
			'logout' => base_url().'user_profile/dashboard/logout'
		); 
		$logged_info = ""; //$CI->parser->parse($logged_data,$log_info,true);
		
		$menu_data = array(
			'active' => $this->current_menu,			
			'image'=> $image,
			'short_name'=> $short_name,
		);
		
		$top_menu = $CI->parser->parse($menu_template,$menu_data,true);	
		
		if ( $left_menus != '' )
		{
			// insert empty text to non assigned elments
			foreach($left_menus as $k=>$sub){
				if(!isset($sub['class']))$left_menus[$k]['class']='';
			}
			$left_menu = $CI->parser->parse($left_menu_template, array('left_menu'=>$left_menus), true);
		}
		
		$data = array(
			'login_data' 	=> $logged_info,
			'account_info' 	=> $account_view,
			'main_menus' 	=> $top_menu,
			'left_menus' 	=> $left_menu,
            'footer_menus' 	=> $footer_menu,
			'content' 		=> $content,
			'msg_content' 	=> $message
		);
		$CI->parser->parse('user_profile/template/user_exam_activity',$data);
	}
}