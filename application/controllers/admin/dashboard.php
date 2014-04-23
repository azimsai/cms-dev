<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->data['sub_view'] = 'admin/dashboard/index';
		$this->load->view('admin/_layout_main', $this->data);
	}
	public function modal()
	{
		$this->load->view('admin/_layout_modal', $this->data);
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */