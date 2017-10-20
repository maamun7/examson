<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Eusers extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function check_current_password($password)
	{	
		$where = array('user_id' => $this->auth->get_user_id(),'password'=>$password); 
		$this->db->select('username');
		$this->db->from('user_login'); 
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return true;
		}else{
			return false;
		}
	}

	public function update_login_info($login_info)
	{
		$where = array('user_id' => $this->auth->get_user_id()); 		
		$this->db->where($where); 				
		$this->db->update('user_login',$login_info);  
		return true;		
	}

	public function get_personal_info()
	{
		$where = array('user_id' => $this->auth->get_user_id()); 
		$this->db->select('*');
		$this->db->from('users'); 
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}	
	}

	public function update_personal_info($personal_info)
	{
		$where = array('user_id' => $this->auth->get_user_id()); 		
		$this->db->where($where); 				
		$this->db->update('users',$personal_info);  
		return true;		
	}	

	public function get_notification_info()
	{
		$where = array('user_id' => $this->auth->get_user_id()); 
		$this->db->select('*');
		$this->db->from('user_email_notifications'); 
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}	
	}
	
	public function isnot_already_entry()
	{	
		$where = array('user_id' => $this->auth->get_user_id()); 
		$this->db->select('*');
		$this->db->from('user_email_notifications'); 
		$this->db->where($where);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return true;
		}else{
			return false;
		}
	}
	
	public function entry_email_notification()
	{	
		$data = array(
			'id' 					=> Null,
			'user_id' 				=> $this->auth->get_user_id(),
			'assigned_exam'			=>0,
			'send_exam'				=>0,
			'send_exam_report'		=>0,
			'monthly_newsletter'	=>0
		);	
		$this->db->insert('user_email_notifications',$data);  
		return true;		
	}
	
	public function update_email_notification($notification_info)
	{
		$where = array('user_id' => $this->auth->get_user_id()); 		
		$this->db->where($where); 				
		$this->db->update('user_email_notifications',$notification_info);  
		return true;		
	}	
	
	public function get_login_info()
	{
		$where = array('user_id' => $this->auth->get_user_id()); 
		$this->db->select('first_name,last_name,address,gender,image,mobile,phone');
		$this->db->from('users'); 
		$this->db->where($where); 
		$query = $this->db->get();
		if ($query->num_rows() > 0) {			
			return $query->result_array();
		}else{
			return false;
		}	
	}
}