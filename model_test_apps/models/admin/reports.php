<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class reports extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Retrieve 
	public function retrieve_purchase_report($product_id){
		$this->db->select("sum(quantity) as 'totalPurchaseQnty'");
		$this->db->from('product_purchase_details');
		$this->db->where(array('product_id'=>$product_id));
		$query = $this->db->get();
		return $query->result_array();
	}

	//Retrieve todays_purchase_report
	public function todays_purchase_report()
	{
		$today = date('Y-m-d');
		$this->db->select("a.*,b.supplier_id,b.supplier_name,sum(c.total_amount) as total_credit");
		$this->db->from('product_purchase a');
		$this->db->join('supplier_information b','b.supplier_id = a.supplier_id');
		$this->db->join('product_purchase_details c','c.purchase_id = a.purchase_id');
		$this->db->where('a.purchase_date',$today);
		$this->db->group_by('a.purchase_id');
		$query = $this->db->get();	
		return $query->result_array();
	}
	public function get_total_purchase_amount(){
		$today = date('Y-m-d');
		$this->db->select("a.adjustment,a.discount,sum(c.total_amount) as total_credit");
		$this->db->from('product_purchase a');
		$this->db->join('product_purchase_details c','c.purchase_id = a.purchase_id');
		//$this->db->where('a.purchase_date',$today);
		$this->db->group_by('a.purchase_id');
		$query = $this->db->get();	
		return $query->result_array();
	}
	
	public function get_date_wise_purchase_amount($start_date,$end_date){
		$dateRange = "a.purchase_date BETWEEN '$start_date%' AND '$end_date%'";
		$this->db->select("a.adjustment,a.discount,sum(c.total_amount) as total_credit");
		$this->db->from('product_purchase a');
		$this->db->join('product_purchase_details c','c.purchase_id = a.purchase_id');
		$this->db->where($dateRange, NULL, FALSE);
		$this->db->group_by('a.purchase_id');
		$query = $this->db->get();	
		return $query->result_array();
	}
	
}