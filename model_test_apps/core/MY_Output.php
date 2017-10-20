<?php
 
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
/**
 * Description of MY_Output
 *
 * @author Soumitra
 */
class MY_Output extends CI_Output { 
    function nocache() {
		//$this->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->set_header('Pragma: no-cache');
		//$this->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }
}
 
/* End of file MY_Output.php */
/* Location: ./application/core/MY_Output.php */