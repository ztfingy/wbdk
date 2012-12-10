<?php
	class Field_group_model extends CI_Model {
		function __construct() {
			parent::__construct();
		}
		
		function add() {
			;
		}
		
		function modify() {
			;
		}
		
		function delete() {
			;
		}
		
		function get_all_field_group($type=''){
			if($type!=''){
				$this->db->where("fieldgroup_of_".$type,1);
			}
			$this->db->order_by('fieldgroup_order asc,fieldgroup_name asc');
				
			$result = $this->db->get('webdocker_fieldgroup');
			if ($result->num_rows()>0) {
				return $result->result_array();
			}else{
				return FALSE;
			}
		}
		
		function get_all($param) {
			;
		}
		
	}