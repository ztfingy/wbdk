<?php

/** 
 * @author Fei
 * 
 * 
 */
class Field_group extends MY_Controller {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ();
		$this->load->model('field_group_model');
	}
	
	function index(){
		$data['field_groups'] = array();
		
		if($field_groups = $this->field_group_model->get_all_field_group()){
			$data['field_groups'] = $field_groups;
		}
		
		$data1['admin_content'] = $this->load->view('admin/field_group',$data,true);
		$this->load->view('admin/admin',$data1);
	}
	
	
}

?>