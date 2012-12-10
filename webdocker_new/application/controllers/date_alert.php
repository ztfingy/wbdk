<?php

/** 
 * @author Fei
 * 
 * 
 */
class Date_alert extends MY_Controller {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	
	function set_date_alert($product_id,$field_id) {
		$data['product_id'] = $product_id;
		$data['field_id'] = $field_id;
		
		
	}
}

?>