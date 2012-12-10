<?php
	class MY_Controller extends CI_Controller {
		function __construct() {
			parent::__construct();
			
			$this->output->enable_profiler($this->config->item('enable_profiler'));
			
			if (!$this->session->userdata('logged_in')) {
				redirect('authentication');
			}
			if ($this->uri->segment(1)==='admin') {
				if (!($this->session->userdata('group_role')==='administrator'||$this->session->userdata('group_role')==='power')) {
					redirect('error/no_admin_rights');
				};
			}
			
		}
	}