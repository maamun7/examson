<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard {
	// Retrieve 
	public function admin_home_page()
	{
		$CI =& get_instance();
		/*
		$CI->load->model('reports');
		$purchase_report = $CI->reports->todays_purchase_report();		
		$purchase_amount = 0;
		if(!empty($purchase_report)){
			$i=0;
			foreach($purchase_report as $k=>$v){$i++;
			    $purchase_report[$k]['sl']=$i;
			    $purchase_report[$k]['prchse_date'] = purchase_by_search($purchase_report[$k]['purchase_date']);
				$purchase_amount = $purchase_amount+$purchase_report[$k]['total_credit'];
			}
		}
		$data = array(
			'title' => 'Purchase Report',
			'purchase_amount' 	=>  $purchase_amount,
			'purchase_report' => $purchase_report
		);
		*/
		$data = array();
		$dashboard_view = $CI->parser->parse('admin/dashboard',$data,true);
		return $dashboard_view;
	}
}
?>