<?php

/** 
 * @author Fei
 * 
 * 
 */
class Userteam_model extends CI_Model {
	
	/**
	 * 
	 * @access  public
	  
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	
	function get_userteam($user_team_id=''){
		if ($user_team_id!='') {
			$this->db->where('userteam_id',$user_team_id);
		}
		$result = $this->db->get('webdocker_userteam');
		if ($result->num_rows()>0) {
			return $result->result_array();
		}
		return FALSE;
	}
	
	function check_userteam_right($product_id){
		$this->db->where('teamtask_userteam_id',$this->session->userdata('userteam_id'));
		$this->db->where('teamtask_product_id',$product_id);
		$result = $this->db->get('webdocker_teamtask');
		if ($result->num_rows()>0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function get_userteam_product($userteam_id){
		$this->db->where('teamtask_userteam_id',$userteam_id);
		$result = $this->db->get('webdocker_teamtask');
		if ($result->num_rows()>0) {
			return $result->result_array();
		}
		return FALSE;
	}
}

?>