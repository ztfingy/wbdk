<?php

/** 
 * @author Figo
 * 
 * 
 */
class Error extends MY_Controller {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	function index(){
		
	}
	
	function no_admin_rights(){
		$data['error_message'] = 'no admin rights!!';
		$this->template->set_content('error',$data);
		$this->template->build();
	}
}

?>