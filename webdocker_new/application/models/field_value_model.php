<?php

/** 
 * @author Figo
 * 
 * 
 */
class Field_value_model extends CI_Model {
	
	/**
	 * 
	 * @access  public
	  
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	
	function add(){
		
	}
	
	function modify() {
		;
	}
	
	function delete($id) {
		;
	}
	
	function get_field_value($field_id) {
		$this->db->where('fieldvalue_field_id',$field_id);
		$result = $this->db->get('webdocker_fieldvalue');
		if ($result->num_rows()>0) {
			return $result->result_array();
		}else{
			return FALSE;
		}
	}
	
	function get_more_fields_value($field_id_array){
		$this->db->where_in('fieldvalue_field_id',$field_id_array);
		$result = $this->db->get('webdocker_fieldvalue');
		if ($result->num_rows()>0) {
			$data = array();
			foreach ($result->result_array() as $array) {
				
				$data[$array['fieldvalue_field_id']][$array['fieldvalue_id']] = $array['fieldvalue_value'];
			}
			
			return $data;
		}else{
			return FALSE;
		}
	}
	
	
}

?>