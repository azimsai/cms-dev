<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->library('session');
		$this->load->model('page_m');
	}

	public function index()
	{
		//Fetch all pages
		$this->data['pages'] = $this->page_m->get_with_parents();

		//Load view
		$this->data['sub_view'] = 'admin/page/index';
		$this->load->view('admin/_layout_main', $this->data);

	}

	public function order()
	{
		$this->data['sortable'] = TRUE;
		//Load view
		$this->data['sub_view'] = 'admin/page/order';
		$this->load->view('admin/_layout_main', $this->data);
	}

	public function order_ajax()
	{
		if (isset($_POST['sortable'])) {
			$this->page_m->save_order($_POST['sortable']);
		}

		//Fetch all pages
		$this->data['pages'] = $this->page_m->get_nested();

		//Load view		
		$this->load->view('admin/page/order_ajax', $this->data);
	}



	public function edit($id = NULL)
	{	
		//Fetch a page or set a new page	
		if ($id) {
			$this->data['page'] = $this->page_m->get($id);
			count($this->data['page']) || $this->data['errors'][] = "The page cannot be found";
		}else{
			$this->data['page'] = $this->page_m->get_new();
		}

		//Set parent page drop down
		$this->data['page_no_parents'] = $this->page_m->get_no_parents();

		//Set validation rules for the form		
		$rules = $this->page_m->_rules;		
		$this->form_validation->set_rules($rules);

		//Run the validation 
		if ($this->form_validation->run() == TRUE) {
			//Get data from post			
			$data = $this->page_m->get_data_from_post(array('title','slug','body','parent_id'));			
			//Save the data and redirect
			$this->page_m->save($data, $id);
			redirect('admin/page');
		}
		//load the view
		$this->data['sub_view'] = 'admin/page/edit';
		$this->load->view('admin/_layout_main', $this->data);

	}

	public function delete($id)
	{
		$this->page_m->delete($id);
		redirect('admin/page/');
	}	

	public function _unique_slug($str)
	{
		//Do not validate if the slug is already exist unless the slug is of the current page
		$id = $this->uri->segment(4);
		$this->db->where('slug',$this->input->post('slug'));
		!$id || $this->db->where('id !=',$id);
		$page = $this->page_m->get();
		if (count($page)) {
			$this->form_validation->set_message('_unique_slug','The %s already taken');
			return FALSE;
		}
		return TRUE;
	}

}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */