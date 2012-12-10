<?php

/** 
 * @author Fei
 * 
 * 
 */
class Alert extends MY_Controller {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	
	function get_recent_alert(){
		$data = array();
		echo json_encode($data);
	}
}

?>