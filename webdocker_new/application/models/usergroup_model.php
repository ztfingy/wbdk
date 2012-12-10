<?php

/** 
 * @author Fei
 * 
 * 
 */
class Usergroup_model extends CI_Model {
	
	/**
	 * 
	 * @access  public
	  
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	
	function get_usergroup($usergroup_id=''){
		if ($usergroup_id!='') {
			$this->db->where('usergroup_id',$usergroup_id);
		}
		$result = $this->db->get('webdocker_usergroup');
		if ($result->num_rows()>0) {
			return $result->result_array();
		}
		return FALSE;
	}
}

?>