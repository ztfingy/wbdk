<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
		
		$this->load->model('adminconfig_model');
		if ($adminconfigs = $this->adminconfig_model->get_adminconfig()) {
			foreach ($adminconfigs as $adminconfig) {
				$this->session->set_userdata($adminconfig['config_item'],$adminconfig['config_value']);
			};
		}
	}
	
	public function index($source='cdf') {
		$this->output->enable_profiler(FALSE);
		$this->session->set_userdata('source',$source);
		$this->load->model('user_model');
		if ($this->user_model->check_user_login()) {
			redirect('/');
		}
		$this->load->view('auth/login');
	}
	
	public function submit(){
		if($this->_submit_validate()===FALSE){
			$this->index();
			return ;
		}
		redirect("/");
	}
	
	private function _submit_validate() {
		$this->form_validation->set_rules('username','Username','trim|required|xss_clean|callback_authenticate');
		$this->form_validation->set_rules('password','Password','trim|required|md5');
		$this->form_validation->set_message('authenticate','Invalid login, please try again');
		$this->form_validation->set_message('authenticate',$this->input->post('username').$this->input->post('password'));
		return $this->form_validation->run();
	}
	
	public function authenticate() {

		switch ($this->session->userdata('auth_type')) {		
			case 'ad':
				$this->load->library('auth_ldap');
				if ($this->auth_ldap->login($this->input->post('username'),$this->input->post('password'))) {
					return TRUE;
				}else{
					return FALSE;
				}
				break;
			
			case 'wd-ad':
				$this->load->model("user_model");
				if ($this->user_model->check_password($this->input->post('username'),$this->input->post('password'))) {
					$this->session->set_userdata('username',$this->input->post('username'));
					$this->session->set_userdata('logged_in',TRUE);
					return TRUE;
				}else {
					$this->load->library('auth_ldap');
					if ($this->auth_ldap->login($this->input->post('username'),$this->input->post('password'))) {
						return TRUE;
					}else{
						return FALSE;
					}
				};
				break;
			
			default:
				$this->load->model("user_model");
				if ($this->user_model->check_password($this->input->post('username'),$this->input->post('password'))) {
					$this->session->set_userdata('username',$this->input->post('username'));
					$this->session->set_userdata('logged_in',TRUE);
					
					$this->load->model('userteam_model');
					
					if ($userteams = $this->userteam_model->get_userteam($this->session->userdata('userteam_id'))) {
						foreach ($userteams as $userteam) {
							$this->session->set_userdata('team_right',$userteam['userteam_all_products']);
						}
						
					}
										
					$this->load->model('usergroup_model');
					if ($usergroups = $this->usergroup_model->get_usergroup($this->session->userdata('usergroup_id'))) {
						foreach ($usergroups as $usergroup) {
							$this->session->set_userdata('group_role',$usergroup['usergroup_role']);
						}
										
					}
					
					return TRUE;
				}else {
					return FALSE;
				};
				break;
		}
		
	}
	
	public function logout() {
		
		$this->session->sess_destroy();
		redirect("/");
	}
	
}

	
/* End of file authentication.php */
/* Location: ./application/controllers/authentication.php */