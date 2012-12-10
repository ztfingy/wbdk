<?php

/** 
 * @author Figo
 * 
 * 
 */
class Dashboard extends MY_Controller {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ();
		$this->load->model('product_model');
		$this->load->model('field_model');
		$this->load->helper(array('image','array'));
	}
	function horizontal(){
		$selected_products = $this->session->userdata('result_products_id');
		$selected_fields = $this->session->userdata('result_fields_id');
		$data1['products_info'] = array();
		
		if ($fields = $this->field_model->get_fields_by_id()) {
			foreach ($fields as $field) {
				$data1['fields_info'][$field['field_id']] = $field['field_name'];
			};
		}
		
		if ($products_basic = $this->product_model->get_product_basic_info_by_id($selected_products)) {
			foreach ($products_basic as $product_basic) {
				$data1['products_info'][$product_basic['product_id']]['product_name'] = $product_basic['product_name'];
			}			
		}
		
		if ($products_detail = $this->product_model->get_product_detail_info($selected_products,$selected_fields)) {
			foreach ($products_detail as $product_detail) {
				$data1['products_info'][$product_detail['productdetail_product_id']][$product_detail['productdetail_field_id']] = $product_detail['productdetail_field_value'];
			}
		}
		
		$data2['dashboard_content'] = $this->load->view('dashboard/horizontal',$data1,true);
		$this->load->view('dashboard/dashboard',$data2);
	}
	function vertical() {
		$selected_products = $this->session->userdata('result_products_id');
		$selected_fields = $this->session->userdata('result_fields_id');
		$data1['products_info'] = array();
		
		if ($fields = $this->field_model->get_fields_by_id()) {
			foreach ($fields as $field) {
				$data1['fields_info'][$field['field_id']] = $field['field_name'];
			};
		}
		
		if ($products_basic = $this->product_model->get_product_basic_info_by_id($selected_products)) {
			foreach ($products_basic as $product_basic) {
				$data1['products_info'][$product_basic['product_id']]['product_name'] = $product_basic['product_name'];
			}			
		}
		
		if ($products_detail = $this->product_model->get_product_detail_info($selected_products,$selected_fields)) {
			foreach ($products_detail as $product_detail) {
				$data1['products_info'][$product_detail['productdetail_product_id']][$product_detail['productdetail_field_id']] = $product_detail['productdetail_field_value'];
			}
		}
		
		$data2['dashboard_content'] = $this->load->view('dashboard/vertical',$data1,true);
		$this->load->view('dashboard/dashboard',$data2);
	}
	
	function horizontal_group(){
		$selected_products = $this->session->userdata('result_products_id');
		$selected_fields = $this->session->userdata('result_fields_id');		
	}
	
	function vertical_group(){
		$selected_products = $this->session->userdata('result_products_id');
		$selected_fields = $this->session->userdata('result_fields_id');
	}
	
	function fourniture(){
		$selected_products = $this->session->userdata('result_products_id');
		$selected_fields = $this->session->userdata('result_fields_id');
		
		
	}
	
	function product(){
		$selected_products = $this->session->userdata('result_products_id');
		$selected_fields = $this->session->userdata('result_fields_id');
	}
	
	function alerts() {
		$selected_products = $this->session->userdata('result_products_id');
		$selected_fields = $this->session->userdata('result_fields_id');
	}
	
	function analysis() {
		$selected_products = $this->session->userdata('result_products_id');
		$selected_fields = $this->session->userdata('result_fields_id');
		$data1['products_info'] = array();
		
		if ($fields = $this->field_model->get_fields_by_id()) {
			foreach ($fields as $field) {
				$data1['fields_info'][$field['field_id']] = $field['field_name'];
			};
		}
		
		if ($products_basic = $this->product_model->get_product_basic_info_by_id($selected_products)) {
			foreach ($products_basic as $product_basic) {
				$data1['products_info'][$product_basic['product_id']]['product_name'] = $product_basic['product_name'];
			}			
		}
		
		if ($products_detail = $this->product_model->get_product_detail_info($selected_products,$selected_fields)) {
			foreach ($products_detail as $product_detail) {
				$data1['products_info'][$product_detail['productdetail_product_id']][$product_detail['productdetail_field_id']] = $product_detail['productdetail_field_value'];
			}
		}

		$data2['dashboard_content'] = $this->load->view('dashboard/analysis',$data1,true);
	
		$this->load->view('dashboard/dashboard',$data2);
	}
	
	function validate_field(){
		$selected_products = $this->session->userdata('result_products_id');
		$selected_fields = $this->session->userdata('result_fields_id');
	}
}

?>