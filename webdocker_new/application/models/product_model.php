<?php

class Product_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}
	/**
	 * 
	 * 检测产品名是否存在
	 * @param string $product_name
	 * @return BooleanType
	 */
	function product_name_exist($product_name) {
		$this->db->where('product_name',$product_name);
		$result=$this->db->get('webdocker_products');
		if ($result->num_rows()>0) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	/**
	 * 
	 * 保存产品基本信息
	 * @param unknown_type $id
	 * @param unknown_type $name
	 * @param unknown_type $type
	 * @param unknown_type $preview
	 * @param unknown_type $cdrfulllink
	 * @param unknown_type $pdffulllink
	 */
	function save_product_basic_info($id,$name='',$type='',$preview='',$cdrfulllink='',$pdffulllink=''){

		$executeby = $this->session->userdata('userid');
		
		if ($id!='') {
			$data = array(
				'product_preview'=>$preview,
				'product_cdrfulllink'=>$cdrfulllink,
				'product_pdffulllink'=>$pdffulllink
			);
			$this->db->where('product_id', $id);
			return $this->db->update('webdocker_products', $data); 
		}else{
			$data = array(
				'product_name'=>$name,
				'product_type'=>$type,
				'product_executeBy'=>$executeby,
			);
			
			if($this->db->insert('webdocker_products', $data)){
				return $this->db->insert_id();
			}else{
				return FALSE;
			};
		}
		
		return TRUE;
		
	}
	
	/**
	 * 
	 * 保存产品详细信息
	 * @param unknown_type $product_id
	 * @param unknown_type $info_array
	 */
	function save_product_detail_info($product_id,$info_array){
		foreach ($info_array as $key=>$value) {
			if (is_array($value)) {
				$value = implode(',', $value);
			};
			
			$this->db->delete('webdocker_productdetail',array('productdetail_product_id'=>$product_id,'productdetail_field_id'=>$key));
			$this->db->insert('webdocker_productdetail',array('productdetail_product_id'=>$product_id,'productdetail_field_id'=>$key,'productdetail_field_value'=>$value));
		}
		return TRUE;	
	}
	
	/**
	 * 
	 * 通过id获得一个产品的基本信息和详细信息
	 * 返回$data['basic_info'] 和$data['detail_info']
	 * @param int $id
	 * @return product value|boolean
	 * 
	 *
	 */
		
	function get_product_by_id($id) {
		$this->db->where('product_id',$id);
		$result = $this->db->get('webdocker_products');
		if ($result->num_rows()>0) {
			$data['basic_info']=$result->row_array();
			$this->db->where('productdetail_product_id',$id);
			$result = $this->db->get('webdocker_productdetail');
			if ($result->num_rows()>0) {
				foreach ($result->result_array() as $array) {
					$detail[$array['productdetail_field_id']]=$array['productdetail_field_value'];
					$data['detail_info'] = $detail;
				}			
			}else{
				$data['detail_info'] = array();
			}
			return $data;
		}else{
			return FALSE;
		}
	}
	/**
	 * 
	 * 通过产品名称获得产品id 数组
	 * @param unknown_type $product_name
	 * @param unknown_type $type
	 * @return array  product id
	 */
	function get_product_by_name($product_name,$type='product'){
		$this->db->like('product_name',$product_name);
		$this->db->where('product_type',$type);
		$result=$this->db->get('webdocker_products');
		if ($result->num_rows()>0) {
			$data = array();
			foreach ($result->result_array() as $product) {
				$data[] = $product['product_id'];
			};
			return $data;
		}else{
			return FALSE;
		}
	}
	/**
	 * 
	 * 通过搜索产品的field信息返回搜索到的产品的id数组
	 * @param unknown_type $field_info
	 * @param unknown_type $product_name
	 * @param unknown_type $type
	 */
	
	function get_product_by_detail_info($field_info,$product_name='',$type='product'){
		

		$product_array = array();
		$product_name = trim($product_name);
		if ($product_name!='') {
			if ($product_temp_array = $this->get_product_by_name($product_name,$type)) {
				$product_array = $product_temp_array;
			};
		}
				
		$field_type = array();
		$this->load->model('field_model');
		
		if ($product_fields = $this->field_model->get_all_fields_product('search',$type)) 
		{
			foreach ($product_fields as $field) {
				$field_type[$field['field_id']]=$field['field_type'];
			};
		}
		$this->db->select('productdetail_product_id,count(*)');

		foreach ($field_info as $field_id => $value) {
			switch ($field_type[$field_id]) {
				case 'text':
					$this->db->or_where("(productdetail_field_id={$field_id} and productdetail_field_value LIKE '%{$value}%')");
				break;
						
				case 'date':

					if(isset($value[0])&&isset($value[1])){
						$this->db->or_where("(productdetail_field_id={$field_id} and productdetail_field_value>='{$value[0]}' and productdetail_field_value<='{$value[1]}')");
					}elseif (isset($value[0])){
						$this->db->or_where("(productdetail_field_id={$field_id} and productdetail_field_value>='{$value[0]}')");
					}elseif (isset($value[1])){
						$this->db->or_where("(productdetail_field_id={$field_id} and productdetail_field_value<='{$value[1]}')");
					}
						
				
				break;
						
				case 'dropdown':
					$this->db->or_where("(productdetail_field_id={$field_id} and productdetail_field_value IN ('".implode("','",$value)."'))");
				break;
						
				case 'multiselect':
					
				break;
						
				case 'price':
					
					if(isset($value[0])&&isset($value[1])){
						$this->db->or_where("(productdetail_field_id={$field_id} and productdetail_field_value>='{$value[0]}' and productdetail_field_value<='{$value[1]}')");
					}elseif (isset($value[0])){
						$this->db->or_where("(productdetail_field_id={$field_id} and productdetail_field_value>='{$value[0]}')");
					}elseif (isset($value[1])){
						$this->db->or_where("(productdetail_field_id={$field_id} and productdetail_field_value<='{$value[1]}')");
					}
					
				break;
						
				case 'note':
					$this->db->or_where("(productdetail_field_id={$field_id} and productdetail_field_value LIKE '%{$value}%')");
				break;
						
				case 'listvariable':
					$this->db->or_where("(productdetail_field_id={$field_id} and productdetail_field_value IN ('".implode("','",$value)."'))");
				break;
						
				default:

				break;
			}
		}
		if (sizeof($product_array)>0) {
			$this->db->where_in('productdetail_product_id',$product_array);
		}
		
		$this->db->group_by('productdetail_product_id');			
		$this->db->having('count(*)',sizeof($field_info));
		$this->db->order_by('productdetail_product_id');
		

		$result = $this->db->get('webdocker_productdetail');
		if ($result->num_rows()>0) {
			$products = array();
			
			foreach ($result->result_array() as $value) {
				$products[]=$value['productdetail_product_id'];
			};
			return $products;
		}else{
			return FALSE;
		}

		
		
	}
	
	/**
	 * 
	 * 通过产品的id然会产品的基本信息， 若id为空，返回所有产品基本信息
	 * @param unknown_type $id
	 */
	function get_product_basic_info_by_id($id=''){
				
			if(is_array($id)){			
				$this->db->where_in('product_id',$id);
							
			}else if($id!=''){
				$this->db->where('product_id',$id);	
			}
			$product_result = $this->db->get('webdocker_products');
			if ($product_result->num_rows()>0) {
				return $product_result->result_array();
			}else{
				return FALSE;
			}

	}
	
	function get_all_product_basic_info($type) {
		$this->db->where('product_type',$type);
		$product_result = $this->db->get('webdocker_products');
		if ($product_result->num_rows()>0) {
			return $product_result->result_array();
		}else{
			return FALSE;
		}
	}
	
	function get_product_detail_info($products_id_array,$fields_id_array) {
		if(sizeof($products_id_array)==0){
			$products_id_array[] = 0;
		}
		if(sizeof($fields_id_array)==0){
			$fields_id_array[]=0;
		}
		$this->db->where_in('productdetail_product_id',$products_id_array);
		$this->db->where_in('productdetail_field_id',$fields_id_array);
		$result = $this->db->get('webdocker_productdetail');
		
		if ($result->num_rows()>0) {
			return $result->result_array();
		}
		return FALSE;
	}
	
	
	/**
	 * 
	 * 通过产品类型获得所有产品的id
	 * @param unknown_type $type
	 */
	
	function get_all_product_id($type){
		$this->db->select('product_id');
		$this->db->where('product_type',$type);
		$product_result = $this->db->get('webdocker_products');
		if ($product_result->num_rows()>0) {
			$data = array();
			foreach ($product_result->result_array() as $value) {
				$data[] = $value['product_id'];
			}
			return $data;
		}else{
			return FALSE;
		}
	}
	
	function delete(){
		
	}
	
	function save_product_event($product_id,$product_name,$event){
		$data = array(	'productevents_product_id'=>$product_id,
						'productevents_product_name'=>$product_name,
						'productevents_event'=>$event,
						'productevents_execute_by_id'=>$this->session->userdata('userid'),
						'productevents_execute_by_name'=>$this->session->userdata('username'));
		$this->db->insert('webdocker_productevents',$data);
	}
	
	function get_recent_visit_product($limit = 0){
		$this->db->select('*');
		$this->db->from('webdocker_productevents');
		$this->db->join('webdocker_products','webdocker_productevents.productevents_product_id = webdocker_products.product_id','left');
		$this->db->where('webdocker_productevents.productevents_event','open');
		$this->db->where('webdocker_productevents.productevents_execute_by_id',$this->session->userdata('userid'));
		$this->db->order_by('webdocker_productevents.productevents_execute_at','DESC');
		if ($limit != 0) {
			$this->db->limit($limit);;
		}
		
		$result = $this->db->get();
		if ($result->num_rows()>0) {
			return $result->result_array();
		}
		return FALSE;
	}
	
	function get_recent_new_product($limit = 0){
		
		$this->db->select('teamtask_product_id')
				->from('webdocker_teamtask')
				->where('teamtask_userteam_id',$this->session->userdata('userteam_id'));
		$products_id = $this->db->get();
		$products_array = array();
		if ($products_id->num_rows()>0) {
			foreach ($products_id->result_array() as $product_id) {
				$products_array[] = $product_id['teamtask_product_id'];
			};
		}
		
		
		
		$this->db->select('*');
		$this->db->from('webdocker_productevents');
		$this->db->join('webdocker_products','webdocker_productevents.productevents_product_id = webdocker_products.product_id','left');		
		$this->db->where('webdocker_productevents.productevents_event','create');
		
		if($this->session->userdata('all_products')==1||$this->session->userdata('team_right')==1){
			
		}else{
			$this->db->where_in('webdocker_productevents.productevents_product_id',$products_array);
		}
		$this->db->order_by('webdocker_productevents.productevents_execute_at','DESC');
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		
		$result = $this->db->get();
		if ($result->num_rows()>0) {
			return $result->result_array();
		}
		return FALSE;
	}
	
	function get_recent_product_validation($limit = 0){
		$this->db->select('teamtask_product_id')
				->from('webdocker_teamtask')
				->where('teamtask_userteam_id',$this->session->userdata('userteam_id'));
		$products_id = $this->db->get();
		$products_array = array();
		if ($products_id->num_rows()>0) {
			foreach ($products_id->result_array() as $product_id) {
				$products_array[] = $product_id['teamtask_product_id'];
			};
		}
		
		
		$this->db->where('product_validation',1);
		if($this->session->userdata('all_products')==1||$this->session->userdata('team_right')==1){
			
		}else{
			$this->db->where_in('product_id',$products_array);
		}
		if ($limit != 0) {
			$this->db->limit($limit);
		}
		$result = $this->db->get('webdocker_products');
		
		if ($result->num_rows()>0) {
			return $result->result_array();
		}
		return FALSE;
	}
	
	function get_recent_group_validation($limit = 0){
		$this->load->model('userteam_model');
		$products_array = array();
		if ($products_task = $this->userteam_model->get_userteam_product($this->session->userdata('userteam_id'))) {
			foreach ($products_task as $product_task) {
				$products_array[] = $product_task['teamtask_product_id'];
			};
		}
		
		
		$this->db->select('*');
		$this->db->from('webdocker_fieldgroupvalidate');
		$this->db->join('webdocker_products','webdocker_fieldgroupvalidate.fieldgroupvalidate_product_id = webdocker_products.product_id','left');
		if($this->session->userdata('all_products')==1||$this->session->userdata('team_right')==1){
			
		}else{
			$this->db->where_in('webdocker_fieldgroupvalidate.fieldgroupvalidate_product_id',$products_array);
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