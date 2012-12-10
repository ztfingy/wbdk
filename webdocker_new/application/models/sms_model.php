<?php

/** 
 * @author Fei
 * 
 * 
 */
class Sms_model extends CI_Model {
	
	/**
	 * 
	 * @access  public
	  
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	
	function unread_sms_num() {
		$this->db->where('sms_touserid',$this->session->userdata('userid'));
		$this->db->where('sms_read','0');
		$result = $this->db->get('webdocker_sms');
		
		return $result->num_rows();
	}
	
	function get_sms($limit = 0){
		
		$this->db->select('sms.*,user.user_username')
				->from('webdocker_sms sms,webdocker_user user')
				->where('sms.sms_touserid',$this->session->userdata('userid'))
				->where('sms.sms_fromuserid = user.user_id')
		  		->where('sms.sms_show',1)
				->order_by('sms.sms_senddate','DESC');
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		$result = $this->db->get();
		if ($result->num_rows()>0) {
			return $result->result_array();
		}
		return FALSE;
	}
}

?>