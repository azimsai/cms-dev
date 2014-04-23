<?php
/**
* 
*/
class Admin_Controller extends MY_controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->data['meta_title'] = "My CMS";
		$this->load->model('user_m');

		$login_exception_uris = array('admin/user/login','admin/user/logout');
		if (in_array(uri_string(), $login_exception_uris) == FALSE) {
			if ($this->user_m->loggedin() == FALSE) {
				redirect('admin/user/login');
			}
		}
		
	}
}