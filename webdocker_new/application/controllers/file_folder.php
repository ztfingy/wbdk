<?php

/** 
 * @author Figo
 * 
 * 
 */
class File_folder extends MY_Controller {
	
	/**
	 * 
	 */
	public function __construct() {
		parent::__construct ();
		$this->output->enable_profiler(FALSE);
	}
	
	public function get_folder_info(){
		
	}
	
	function get_file_destination($product_name){
		
		$this->load->model('file_folder_model');
		$folderarray = array();
		if ($team_folders = $this->file_folder_model->get_file_folder()) {
			
			foreach ($team_folders as $team_folder){
				if ($team_folder['folderconfig_userteam_id']==$this->session->userdata('userteam_id')) {
					$folderarray = $team_folder;
				}
			};
		}
		
		if (sizeof($folderarray)>0) {
			$year = Date("Y");
			$cdrpath = $folderarray['folderconfig_cdr_folder'];
			$pdfpath = $folderarray['folderconfig_pdf_folder'];
			$attpath = $folderarray['folderconfig_attachment_folder'];
			
			$data['cdrpath'] = $cdrpath;
			$data['pdfpath'] = $pdfpath;
			$data['attpath'] = $attpath;
	
			$data['cdrfolderpath'] = $cdrpath.$year.DIRECTORY_SEPARATOR.$product_name.DIRECTORY_SEPARATOR;
			$data['pdffolderpath'] = $pdfpath.$year.DIRECTORY_SEPARATOR.$product_name.DIRECTORY_SEPARATOR;
			$data['attfolderpath'] = $attpath.$year.DIRECTORY_SEPARATOR.$product_name.DIRECTORY_SEPARATOR;
	
			echo json_encode($data);
	
		}else {
			echo "1";
		}
	}
}

?>