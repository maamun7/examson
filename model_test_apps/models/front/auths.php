<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class auths extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function check_valid_user($username,$password)
	{ 	
		$password = md5("onexam".$password);
        $this->db->where(array('username'=>$username,'password'=>$password,'is_active'=>'1','can_login'=>'1','user_type'=>2,'security_code'=>''));
		$query = $this->db->get('user_login');
		if ($query->num_rows() > 0) {			
			return true;
		}else{
			return false;
		}	

	}

	function get_session_data($username,$password)
	{ 	
		$password = md5("onexam".$password);
        $this->db->where(array('username'=>$username,'password'=>$password,'is_active'=>'1','can_login'=>'1','user_type'=>2,'security_code'=>''));
		$query = $this->db->get('user_login');
		$result =  $query->result_array();

		if (count($result) == '1')
		{
			$user_id = $result[0]['user_id'];

			if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			    $login_ip = $_SERVER['HTTP_CLIENT_IP'];
			} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			    $login_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			} else {
			    $login_ip = $_SERVER['REMOTE_ADDR'];
			}

			$login_time = date('Y-m-d h:i:s', time());
			$user_agent = $_SERVER['HTTP_USER_AGENT'];

			$logged_data = array(
				'last_login' => $login_time ,
				'user_agent' => $user_agent,
				'login_ip' => $login_ip
			);

			$this->db->where('user_id',$user_id);
			$this->db->update('user_login',$logged_data);

			$this->db->select('a.*,b.*');
			$this->db->from('user_login a');
			$this->db->join('users b','b.user_id = a.user_id');
			$this->db->where('a.user_id',$user_id);
			$query = $this->db->get();
			return $query->result_array();
		}
		return false;
	}

	function get_by_user_id($user_id)
	{
		$this->db->where('user_id',$user_id);
        $q = $this->db->get('user_role_relation');
        return $q->result_array();
	}

	function check_by_user_id($user_id)
	{
		$this->db->where('user_id',$user_id);
        $q = $this->db->get('users');
        return $q->result_array();
	}
}