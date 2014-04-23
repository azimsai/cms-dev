<?php
/**
* 
*/
class Migration extends Admin_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('migration');
	}
	public function index()
	{
		if ( ! $this->migration->current())
		{
			show_error($this->migration->error_string());
		}
		else
		{
			echo "Migration Created";
		}
	}
}