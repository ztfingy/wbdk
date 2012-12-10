<?php

/** 
 * @author Fei
 * 
 * 
 */
class Welcome extends MY_Controller {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	
	function index(){
		redirect('admin/field_group/');
	}
}

?>