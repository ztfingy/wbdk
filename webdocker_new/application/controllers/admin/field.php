<?php

/** 
 * @author FEI
 * 
 * 
 */
class Field extends MY_Controller {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ();
		$this->load->model(array('field_model','field_value_model'));
		$this->load->helper(array('form','array'));
	}
	function index(){
		$data['fields'] = array();
		$data['field_groups'][0] = '';
		$data['field_type_array']=array('dropdown'=>'Liste deroulante',
										'multiselect'=>'Multi Selection List',
										'listvariable'=>'Liste Variable',
										'text'=>'Champs libre',
										'note'=>'Note',
										'date'=>'Date',
										'price'=>'Prix');
		
		if($fields = $this->field_model->get_fields_by_id()){
			$data['fields'] = $fields;
		}
		
		$this->load->model('field_group_model');
		if($field_groups = $this->field_group_model->get_all_field_group()){
			foreach ($field_groups as $field_group){
				$data['field_groups'][$field_group['fieldgroup_id']] = $field_group['fieldgroup_name'];
			}
			
		}
		
		$data1['admin_content'] = $this->load->view('admin/field',$data,true);
		$this->load->view('admin/admin',$data1);
	}
	
	
	function expand($field_id){
				
		$data['field'] = array();
		$data['field_values'] = array();
		
		$fields = $this->field_model->get_fields_by_id($field_id);
		$data['field'] = $fields[0];

		if($field_values = $this->field_value_model->get_field_value($field_id)){
			$data['field_values'] = $field_values;
		}
		
		$data1['admin_content'] = $this->load->view('admin/field_value',$data,true);
		$this->load->view('admin/admin',$data1);
	}
	
	function get_sunfield(){
		$field_id = $this->input->post('field_id');
		$res = '';
		if ($subfields = $this->field_model->get_subfield($field_id)) {
			$res = "<ul class='unstyled'>";
			foreach ($subfields as $subfield) {
				$res .="<li><input type='radio' name='subfield' value='".$subfield['field_id']."' />".$subfield['field_name']."</li>";
			}
			$res .="</ul>";
		}
		echo $res;
	}
}

?>