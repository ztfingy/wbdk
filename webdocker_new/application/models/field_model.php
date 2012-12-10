<?php

/** 
 * @author FEI
 * @copyright C-DESIGN
 * 
 */
class Field_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	
	function add(){
		
	}
	
	function modify($id){
		
	}
	
	function delete($id){
		
	}
	
	function get_all_fields_product($whichpage = 'edit',$type='product'){
		//用户可以看到的field array
		$fields_group_see_array = array('','0');
		$this->db->select('restriction_see_fieldgroup_id')
				->from('webdocker_usergroup_restriction_see')
				->where('restriction_see_usergroup_id',$this->session->userdata('usergroup_id')); 
		$result = $this->db->get();
		if ($result->num_rows()>0) {
			foreach ($result->result_array() as $field_group_id) {
				$fields_group_see_array[] = $field_group_id['restriction_see_fieldgroup_id'];
			};
		}
		
		
		$this->db->where("field_of_".$type,1);
		$this->db->where("field_show",1);
		
		switch ($whichpage) {
			case 'edit':								
			break;
			
			case 'search':
				$this->db->where("field_search",1);
			break;
			
			case 'cartouche':
				$this->db->where("field_cartouche",1);
			break;
			
			default:
			break;
		}
		$this->db->join('webdocker_fieldgroup','webdocker_fields.field_fieldgroup_id=webdocker_fieldgroup.fieldgroup_id','left');
		if ($this->session->userdata('group_role')=='restricted') {
			$this->db->where_in('webdocker_fields.field_fieldgroup_id',$fields_group_see_array);
		}
		$result = $this->db->get("webdocker_fields");
		if ($result->num_rows()>0) {
			return $result->result_array();
		}else{
			return FALSE;
		}
	}
	

	
	function get_fields_by_id($fields_id='') {
		if (is_array($fields_id)) {
			$this->db->where_in('field_id',$fields_id);
		}else if($fields_id!=''){
			$this->db->where('field_id',$fields_id);
		}
		$this->db->order_by('field_fieldgroup_id ASC,field_order ASC');
		$result = $this->db->get('webdocker_fields');
		if ($result->num_rows()>0) {
			return $result->result_array();
		}else{
			return FALSE;
		}
	}
	
	function get_subfield($field_id){
		$this->db->select('field_child_id')
				->from('webdocker_fields');
		$result = $this->db->get();
		$subfield_array[] = $field_id;
		foreach ($result->result_array() as $subfield) {
			$subfield_array[] = $subfield['field_child_id'];
		}
		$this->db->where('field_type','dropdown');
		$this->db->where_not_in('field_id',$subfield_array);
		$result2 = $this->db->get('webdocker_fields');
		if ($result2->num_rows()>0) {
			return $result2->result_array();;
		}else{
			return FALSE;
		}
	}
}

?>