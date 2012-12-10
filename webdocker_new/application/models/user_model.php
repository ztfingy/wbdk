<?php
use Entities\User;
class User_model extends CI_Model {	
	public function __construct() {
		parent::__construct();
	}
	
	function get_by_username($username) {
		$this->db->where('user_username',$username);
		$result = $this->db->get('webdocker_user');
		if ($result->num_rows() == 1) {
			return $result->row();
		}else{
			return FALSE;
		}
	}
	
	function check_password($username,$password){
		if ($user = $this->get_by_username($username)) {
			$this->session->set_userdata('userid',$user->user_id);
			$this->session->set_userdata('userteam_id',$user->user_userteam_id);
			$this->session->set_userdata('usergroup_id',$user->user_usergroup_id);
			return $user->user_password ==$password ? TRUE : FALSE;
		}
		return FALSE;
	}
	
	function check_user_login() {
		return $this->session->userdata('login');
	}
	
	function get_by_userid($id){
		$this->db->where('user_id',$id);
		$result = $this->db->get('webdocker_user');
	}
	
	function save_user(User $user){
		
	}
	
	function update_user(User $user){
	
	}
}
