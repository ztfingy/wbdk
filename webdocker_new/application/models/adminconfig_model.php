<?php

/** 
 * @author Figo
 * 
 * 
 */
class Adminconfig_model extends CI_Model {
	
	/**
	 * 
	 * @access  public
	  
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	
	function get_adminconfig(){
		$result = $this->db->get('webdocker_adminconfig');
		if ($result->num_rows()>0) {
			return $result->result_array();
		}else{
			return FALSE;
		}
	}
}

?>