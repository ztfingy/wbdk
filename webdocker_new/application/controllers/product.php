<?php

class Product extends MY_Controller {
	function __construct() {
		parent::__construct();

		$this->load->helper(array('form','image'));
		$this->load->library('form_validation');
		$this->load->model('product_model');
		$this->load->model('field_model');
		$this->load->model('field_group_model');
		$this->load->model('field_value_model');
		
		
	}
	function check_product_name($product_name=''){
		$this->output->enable_profiler(FALSE);
		if ($product = $this->product_model->get_product_by_name($product_name)) {			
			echo '1';
		}else{
			echo '0';
		}
	}
	
	function save_product_basic_info(){
		$name = $this->input->post('name');
		$type = $this->input->post('type');
		$this->output->enable_profiler(FALSE);
		
		if ($this->product_model->product_name_exist($name)) {
			
			$data['stat'] = '0';
			echo json_encode($data);
		}else{
			if ($product_id = $this->product_model->save_product_basic_info('',$name,$type)) {
				$data['stat'] = '1';
				$data['url']=site_url('/product/modify/'.$type.'/'.$product_id);
				$this->product_model->save_product_event($product_id,$name,'create');
				echo json_encode($data);
			}else{
			
				$data['stat'] = '2';
				echo json_encode($data);
			}
		}
	}
	
	function save_product_detail_info($product_id){
		$this->output->enable_profiler(FALSE);
		$info = $this->input->post();
		if(isset($info['product_cdrfulllink'])){
			$this->product_model->save_product_basic_info($product_id,'','',element('product_preview', $info),element('product_cdrfulllink', $info),element('product_pdffulllink', $info));
			unset($info['product_preview']);
			unset($info['product_cdrfulllink']);
			unset($info['product_pdffulllink']);
		}
		$this->product_model->save_product_detail_info($product_id,$info);
		echo '1';
	}
	
	
	
	/**
	 * 
	 * new product form
	 * @param string $type  :  product  accessory
	 */
	function add($type='product') {
/*
		$data['product_type'] = $type;
		$this->load->model('field_model');
		$this->load->model('field_group_model');
				
		if ($product_field_group = $this->field_group_model->get_all_field_group($type)) {
			$group_info = array();
			foreach ($product_field_group as $field_group) {
				$group_info[$field_group['fieldgroup_id']] = $field_group;
			}
			$data['field_group']=$group_info;
		}
				
		if ($product_fields = $this->field_model->get_all_fields_product('edit',$type)) {
			$data['fields'] = array();
			$product_fields_id = array();
			foreach ($product_fields as $field) {
				$product_fields_id[]=$field['field_id'];
						
				if ($field['fieldgroup_of_'.$type]=='1'||$field['field_fieldgroup_id']=='0') {
					$order = is_null($field['fieldgroup_order'])?0:$field['fieldgroup_order'];
					$group_id = $field['field_fieldgroup_id'];
					$field_and_group[$order][$group_id][]=$field;
					ksort($field_and_group);
					$data['fields_group']=$field_and_group;
				}
			};
					
			$this->load->model('field_value_model');
			if ($product_fields_value = $this->field_value_model->get_more_fields_value($product_fields_id)) {						
				
					$data['fields_value']=$product_fields_value;
				
											
			}
		}
		$source = $this->session->userdata('source')?$this->session->userdata('source'):'cdf';			
		$this->template->add_js('jquery/jquery.ui.datepicker');
		$this->template->add_js('jquery/jquery.ui.datepicker-fr');
		$this->template->add_js('jquery/ui.dropdownchecklist');
		$this->template->add_js('webdocker_'.$source);
		$this->template->add_js('global');
		
		$this->template->add_css('ui.dropdownchecklist');
		$this->template->add_css('product');
		
		$this->template->set_content('product/add_product',$data);
		$this->template->build();
*/
		switch ($type) {
			case 'product':
				$data['product_type']='Produit';
				$data['type']='product';	
				break;
			case 'accessory':
				$data['product_type']='Fourniture';	
				$data['type']='accessory';
				break;
			default:
				$data['product_type']='Produit';
				$data['type']='product';
				break;
		}
		$this->output->enable_profiler(FALSE);
		$this->load->view('product/add_product',$data);
	}
	
	function modify($type='product',$product_id) {
		
		if ($this->check_prodcut_right($product_id)) {
			
			
			
			$this->load->helper('array');			
			$data['product_type'] = $type;
					
			if ($product_field_group = $this->field_group_model->get_all_field_group($type)) {
				$group_info = array();
				foreach ($product_field_group as $field_group) {
					$group_info[$field_group['fieldgroup_id']] = $field_group;
				}
				$data['field_group']=$group_info;
			}
					
			if ($product_fields = $this->field_model->get_all_fields_product('edit',$type)) {
				$data['fields'] = array();
				$product_fields_id = array();
				foreach ($product_fields as $field) {
					$product_fields_id[]=$field['field_id'];
							
					if ($field['fieldgroup_of_'.$type]=='1'||$field['field_fieldgroup_id']=='0') {
						$order = is_null($field['fieldgroup_order'])?0:$field['fieldgroup_order'];
						$group_id = $field['field_fieldgroup_id'];
						$field_and_group[$order][$group_id][]=$field;
						ksort($field_and_group);
						$data['fields_group']=$field_and_group;
					}
				};
						
			
				if ($product_fields_value = $this->field_value_model->get_more_fields_value($product_fields_id)) {											
					$data['fields_value']=$product_fields_value;															
				}
			}
			$data['product_value']=array();
			if ($product_value = $this->product_model->get_product_by_id($product_id)) {
				$data['product_value']=$product_value;
				$this->product_model->save_product_event($product_id,$data['product_value']['basic_info']['product_name'],'open');
			}
			
			$source = $this->session->userdata('source')?$this->session->userdata('source'):'cdf';			
			$this->template->add_js('jquery/jquery.ui.datepicker');
			$this->template->add_js('jquery/jquery.ui.datepicker-fr');
			$this->template->add_js('jquery/ui.dropdownchecklist');	
			$this->template->add_js('jquery/jquery.numeric');	
				
			$this->template->add_js('product_modify_'.$source);
			$this->template->add_js('product_modify');
			$this->template->add_js('global');
			
			$this->template->add_css('ui.dropdownchecklist');
			$this->template->add_css('jquery.ui.datepicker');
			$this->template->add_css('product');
			
			$this->template->set_content('product/modify_product',$data);
			$this->template->build();
		}else{
			redirect('/error/no_product_right');
		}
	}
	
	function modify_multiple(){
		$selected_products = $this->session->userdata('result_products_id');
		$selected_fields = $this->session->userdata('result_fields_id');
		
		
	}
	
	
	function delete($id){
		$this->product_model->delete;
	}
	
	function search($type='product'){
		$data['product_type'] = $type;

				
		if ($product_field_group = $this->field_group_model->get_all_field_group($type)) {
			$group_info = array();
			foreach ($product_field_group as $field_group) {
				$group_info[$field_group['fieldgroup_id']] = $field_group;
			}
			$data['field_group']=$group_info;
		}
				
		if ($product_fields = $this->field_model->get_all_fields_product('search',$type)) 
		{
			$data['fields'] = array();
			$product_fields_id = array();
			foreach ($product_fields as $field) {
				$product_fields_id[]=$field['field_id'];
						
				if ($field['fieldgroup_of_'.$type]=='1'||$field['field_fieldgroup_id']=='0') {
					$order = is_null($field['fieldgroup_order'])?0:$field['fieldgroup_order'];
					$group_id = $field['field_fieldgroup_id'];
					$field_and_group[$order][$group_id][]=$field;
					ksort($field_and_group);
					$data['fields_group']=$field_and_group;
				}
			};
					

			if ($product_fields_value = $this->field_value_model->get_more_fields_value($product_fields_id)) {						

				$data['fields_value']=$product_fields_value;
			
											
			}
		}
			
		$this->template->add_js('jquery/jquery.ui.datepicker');
		$this->template->add_js('jquery/jquery.ui.datepicker-fr');
		$this->template->add_js('jquery/ui.dropdownchecklist');
		$this->template->add_js('product_search');
		$this->template->add_js('global');
		
		$this->template->add_css('ui.dropdownchecklist');
		$this->template->add_css('product');
		
		$this->template->set_content('product/search_product',$data);
		$this->template->build();
	}
	
	function search_result(){
		$post_array = $this->input->post();
		$product_name = trim($post_array['product_name']);
		$type = $post_array['product_type'];

		unset($post_array['product_name']);
		unset($post_array['product_type']);
		
		
		foreach ($post_array as $key => $value) {
			if (is_array($value)) {
				$post_array[$key]=array_filter($post_array[$key]);
			}
		}
		$post_array_filter = array_filter($post_array);  //剩下有值的元素

		if (sizeof($post_array_filter)>0) {
			$product_id_search_result = $this->product_model->get_product_by_detail_info($post_array_filter,$product_name,$type);
			
		}else if($product_name!=''){
			$product_id_search_result = $this->product_model->get_product_by_name($product_name,$type);	
					
		}else{
			$product_id_search_result = $this->product_model->get_all_product_id($type);
			
		}
		$products_result = array();
		if (is_array($product_id_search_result)&&sizeof($product_id_search_result)>0) {
			if ($this->session->userdata('all_products')==1||$this->session->userdata('userteam_right')==1) {
				$products_result = $this->product_model->get_product_basic_info_by_id($product_id_search_result);;
			}else {
				$userteam_product_array = array();
				$this->load->model('userteam_model');
				if($team_prodcuts = $this->userteam_model->get_userteam_product($this->session->userdata('userteam_id'))){
					foreach ($team_prodcuts as $team_product) {
						$userteam_product_array[] = $team_product['teamtask_product_id'];
					}
					
					$product_id_search_result = array_intersect($userteam_product_array, $product_id_search_result);
				}
			}
			
			
			
		}else{
			$product_id_search_result = array();
		}
		
		$product_fields_id = array();
		if($product_fields = $this->field_model->get_all_fields_product('edit',$type)){
			
			foreach ($product_fields as $field) {
				$product_fields_id[]=$field['field_id'];
						
				if ($field['fieldgroup_of_'.$type]=='1'||$field['field_fieldgroup_id']=='0') {
					$order = is_null($field['fieldgroup_order'])?0:$field['fieldgroup_order'];
					$group_id = $field['field_fieldgroup_id'];
					$field_and_group[$order][$group_id][]=$field;
					ksort($field_and_group);
					$data['fields_group']=$field_and_group;
				}
			};
			
		}else{
			$data['fields_group']=array();
		}
		

		if ($product_field_group = $this->field_group_model->get_all_field_group($type)) {
			$group_info = array();
			foreach ($product_field_group as $field_group) {
				$group_info[$field_group['fieldgroup_id']] = $field_group;
			}
			$data['field_group']=$group_info;
		}
		

		$data['products_id']=$product_id_search_result;
		$data['products']=$products_result;

		$data['result_product_id'] = implode(',',$product_id_search_result);
		$data['result_field_id'] = implode(',',$product_fields_id);
		

		$this->template->add_http_header('Cache-Control: private');
		$this->template->add_js('product_result');
		$this->template->add_js('global');		
		$this->template->add_css('product');
		
		$this->template->set_content('product/search_product_result',$data);
		$this->template->build();
	}

	function merchandise($list=''){
		$data['list'] = $list;
		$this->template->add_css('product');
		$this->template->set_content('product/merchandise',$data);
		$this->template->build();
	}
	
	
	function get_recent_visit_product(){
		$this->output->enable_profiler(FALSE);
		$data = '';
		if($recent_visit_products = $this->product_model->get_recent_visit_product(3)){
			$data = "<table class='well welcome_table' >";
			foreach ($recent_visit_products as $recent_visit_product) {
				$data .= "<tr><td  class='welcome_item_content'  width='35px'> <a href='".site_url('product/modify/'.$recent_visit_product['product_type'].'/'.$recent_visit_product['productevents_product_id'])."'>";
				$data .= scaleimage(preview_url().$recent_visit_product['productevents_product_name'].".cdr_CDFWD.jpg",30,30);
				$data .= "</a> </td><td  class='welcome_item_content'><a href='".site_url('product/modify/'.$recent_visit_product['product_type'].'/'.$recent_visit_product['productevents_product_id'])."'>";
				$data .= "<b>".$recent_visit_product['productevents_product_name']."</b></a> is opened<br /> at : ".$recent_visit_product['productevents_execute_at']."</td></tr>";
	
           		
			}
			$data .= "</table>";
		}
		
		
		
		echo $data;
	}
	
	function get_recent_new_product(){
		$this->output->enable_profiler(FALSE);
		$data = '';
		if ($recent_new_products = $this->product_model->get_recent_new_product(3)) {
			
			$data = "<table class='well welcome_table'>";
			foreach ($recent_new_products as $recent_new_product) {
			$data .= "<tr><td class='welcome_item_content' width='35px'><a href='".site_url('product/modify/'.$recent_new_product['product_type'].'/'.$recent_new_product['productevents_product_id'])."'>";
			$data .= scaleimage(preview_url().$recent_new_product['productevents_product_name'].".cdr_CDFWD.jpg",30,30);
			$data .= "</a></td>";
            $data .= "<td class='welcome_item_content'><a href='".site_url('product/modify/'.$recent_new_product['product_type'].'/'.$recent_new_product['productevents_product_id'])."'>";
            $data .= "<b>".$recent_new_product['productevents_product_name']."</b></a> is created by ".$recent_new_product['productevents_execute_by_name']." <br /> at : ".$recent_new_product['productevents_execute_at']."</td></tr>";
			}
			$data .= "</table>";
			
			
		}
		echo $data;
	}
	
	function get_recent_product_validation(){
		$this->output->enable_profiler(FALSE);
		$data = '';
		if($recent_product_validations = $this->product_model->get_recent_product_validation(3)){
			
			$data = "<table class='well welcome_table'>";
			foreach ($recent_product_validations as $recent_product_validation) {
			$data .= "<tr><td class='welcome_item_content' width='35px'><a href='".site_url('product/modify/'.$recent_product_validation['product_type'].'/'.$recent_product_validation['product_id'])."'>";
			$data .= scaleimage(preview_url().$recent_product_validation['product_name'].".cdr_CDFWD.jpg",30,30);
			$data .= "</a></td>";
            $data .= "<td class='welcome_item_content'><a href='".site_url('product/modify/'.$recent_product_validation['product_type'].'/'.$recent_product_validation['product_id'])."'>";
            $data .= "<b>".$recent_product_validation['product_name']."</b></a>  was validated <br /> at : ".$recent_product_validation['product_execute_at']."</td></tr>";
			}
			$data .= "</table>";
		}
		
		echo $data;
	}
	
	function get_recent_group_validation(){
		$this->output->enable_profiler(FALSE);
		$data = '';
		if($recent_group_validations = $this->product_model->get_recent_group_validation(3)){
		 	$data .= "<table class='well welcome_table'>";
			foreach ($recent_group_validations as $recent_group_validation) {
				$data .= "<tr><td class='welcome_item_content' width='35px'><a href='".site_url('product/modify/'.$recent_group_validation['product_type'].'/'.$recent_group_validation['product_id'])."'>";
				$data .= scaleimage(preview_url().$recent_group_validation['product_name'].".cdr_CDFWD.jpg",30,30);
				$data .= "</a></td>";
             	$data .= "<td class='welcome_item_content'><b>".$recent_group_validation['fieldgroup_name']."</b>  in <b>".$recent_group_validation['product_name']."</b> was validated <br /> at : ".$recent_group_validation['fieldgroupvalidate_execute_at']." by ".$recent_group_validation['fieldgroupvalidate_execute_by_name']."</td></tr>";
			}
             
            $data .= "</table>";
            }
		echo $data;
	}

	
	
	
	/**
	 * 
	 * check if the user has right to access this product
	 * @param unknown_type $product_id
	 * @return boolean
	 */
	function check_prodcut_right($product_id){
		if ($this->session->userdata('group_role')==='administrator'||$this->session->userdata('group_role')==='power') {
			return TRUE;
		}else{
			
			if ($this->session->userdata('all_products')==1||$this->session->userdata('userteam_right')==1) {
				return TRUE;
			}else{
				return $this->userteam_model->check_userteam_right($product_id);				
			}
		}
		
		return FALSE;
	}
	/**
	 * 
	 * save selected products and fields in session 
	 * from product search result
	 */
	function products_id_temp() {
		$products_id = $this->input->post('products_array')?$this->input->post('products_array'):array();
		$fields_id = $this->input->post('fields_array')?$this->input->post('fields_array'):array();
		
		$this->session->set_userdata('result_products_id',$products_id);
		$this->session->set_userdata('result_fields_id',$fields_id);
		
	}
	
	
}



/* End of file product.php */
/* Location: ./application/controllers/product.php */