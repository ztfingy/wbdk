<?php

/** 
 * @author Fei
 * 
 * 
 */
class Revision_model extends CI_Model {
	
	/**
	 * 
	 * @access  public
	  
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	
	function get_recent_revision($limit = 0){
		$this->load->model('userteam_model');
		$products_array = array();
		if ($products_task = $this->userteam_model->get_userteam_product($this->session->userdata('userteam_id'))) {
			foreach ($products_task as $product_task) {
				$products_array[] = $product_task['teamtask_product_id'];
			};
		}
		
		
		$this->db->select('*');
		$this->db->from('webdocker_revisions');
		$this->db->join('webdocker_products','webdocker_revisions.revision_product_id = webdocker_products.product_id','left');
		if($this->session->userdata('all_products')==1||$this->session->userdata('team_right')==1){
			
		}else{
			$this->db->where_in('webdocker_revisions.revision_product_id',$products_array);
		}
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