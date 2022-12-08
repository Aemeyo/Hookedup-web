<?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class Common_model extends CI_Model{ 

	function checkAdminUserPermission($permission_id,$no_return = true) {
		if($this->session->userdata('access_module')) {
			/*echo $permission_id; 
			echo '<pre>ddd<pre>'; print_r($this->session->userdata('access_module'));
			exit;*/
			if(in_array($permission_id, $this->session->userdata('access_module'))){
				return true;
			}else{
				if($no_return){
					if($this->input->is_ajax_request()){
						$data['success'] = false;
						$data['message_title'] = 'Permissions Denied';
						$data['message'] = 'Sorry You are not allowed to access this feature';
						$data['error_type'] = 'auth';
						echo json_encode($data); die;
					}else{
						echo '<h1 align="center">Permissions Denied - Sorry You are not allowed to access this feature</h1>';die;
					}
				}else{
					return false;
				}
			}
		} else {
			redirect(base_url('admin'));
		}
	}
    
    /** To check create, update, delete and status changes for except Admin login */
    function checkAdminLogin() {
    	if($this->session->userdata('role') == 1) {
    		return true;
    	} else {
    		$checkstatus = settingValue('demo_access');
	    	if($checkstatus == 1) {
	    		return true;
	    	} else {
	    		$this->session->set_flashdata('error_message', 'Unable to access this feature in Demo mode');
				redirect($_SERVER['HTTP_REFERER']);
	    	}
    	}
    	
    }
}