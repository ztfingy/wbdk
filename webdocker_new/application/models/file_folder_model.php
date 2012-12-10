<?php

/** 
 * @author Figo
 * 
 * 
 */
class File_folder_model extends CI_Model {
	
	/**
	 * 
	 * @access  public
	  
	 */
	public function __construct() {
		parent::__construct ();
	
	}
	
	function get_file_folder(){
		$result = $this->db->get('webdocker_folderconfig');
		if ($result->num_rows()>0) {
			return $result->result_array();
		}else{
			return FALSE;
		}
		
	}
}

?>