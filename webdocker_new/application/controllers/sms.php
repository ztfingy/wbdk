<?php

/** 
 * @author FEI
 * 
 * 
 */
class Sms extends MY_Controller {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ();
		$this->load->model('sms_model');
	}
	
	
	function received() {
		
		$data['received_sms'] = array();
		
		if ($sms_recents = $this->sms_model->get_sms(10)) {
		
			$data['received_sms'] = $sms_recents;
		
		}
		
		
		
		$this->template->add_js('sms');
		$this->template->add_js('global');
		

		$this->template->add_css('sms');
		
		$this->template->set_content('sms/sms_received',$data);
		$this->template->build();
	}
	
	function sent(){
		$data = array();
		
		$this->template->add_js('sms');
		$this->template->add_js('global');
		

		$this->template->add_css('sms');
		
		$this->template->set_content('sms/sms_sent',$data);
		$this->template->build();
	}
	
	function deleted($param) {
		$data = array();
		
		$this->template->add_js('sms');
		$this->template->add_js('global');
		

		$this->template->add_css('sms');
		
		$this->template->set_content('sms/sms_deleted',$data);
		$this->template->build();
	}
	
	function new_sms(){
		$data = array();
		
		$this->template->add_js('sms');
		$this->template->add_js('global');
		

		$this->template->add_css('sms');
		
		$this->template->set_content('sms/sms_new',$data);
		$this->template->build();
	}
	
	function read(){
		
	}
	
	function get_unread_sms_num(){
		$this->output->enable_profiler(FALSE);
		echo $this->sms_model->unread_sms_num();
	}
	
	function get_recent_sms(){
		$this->output->enable_profiler(FALSE);
		$data = '';
		if ($sms_recents = $this->sms_model->get_sms(3)) {
			$data .= "<table class='well welcome_table' >";
			foreach ($sms_recents as $sms_recent) {
				$data.= "<tr><td width='100px'><a href='".site_url('sms/read/'.$sms_recent['sms_id'])."'>";
				
				if($sms_recent['sms_read']==0){						
					$data.= "<strong>".$sms_recent['user_username']."</strong>";							
				}else{
					$data.=$sms_recent['user_username'];	
				}
					
				$data .= "</a></td><td>{$sms_recent['sms_senddate']}</td></tr><tr><td colspan='2' class='welcome_item_content'><a href='".site_url('sms/read/'.$sms_recent['sms_id'])."' style='color:#747474;'>";
				if(strlen($sms_recent['sms_content'])>40){ 
					$data .= substr($sms_recent['sms_content'],0,40)."..." ;
				} else {
					$data .= $sms_recent['sms_content'];
				}
				
				$data .= "</a></td></tr>";
			};
			$data .= "</table>";
		}
		echo $data;
	}
}

?>