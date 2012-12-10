<?php

/** 
 * @author Fei
 * 
 * 
 */
class Revision extends MY_Controller {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ();
		$this->load->model('revision_model');
		$this->load->helper(array('image'));
	}
	
	function get_recent_revision(){
		$this->output->enable_profiler(FALSE);
		$data = '';
		if($recent_revisions = $this->revision_model->get_recent_revision(3)){
		 	$data .= "<table class='well welcome_table'>";
			foreach ($recent_revisions as $recent_revision) {
				$data .= "<tr><td class='welcome_item_content' width='35px'><a href='".site_url('product/modify/'.$recent_revision['product_type'].'/'.$recent_revision['product_id'])."'>";
				$data .= scaleimage(preview_url().$recent_revision['product_name'].".cdr_CDFWD.jpg",30,30);
				$data .= "</a></td>";
             	$data .= "<td class='welcome_item_content'><b>".$recent_revision['revision_title']."</b>  in <b>".$recent_revision['product_name']."</b> was added <br /> at : ".$recent_revision['revision_execute_at']."</td></tr>";
			}
             
            $data .= "</table>";
            }
		echo $data;
	}
	
	function all_revision($product_id){
		
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
}

?>