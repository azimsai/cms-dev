<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Article extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->library('session');
		$this->load->model('article_m');
	}

	public function index()
	{
		//Fetch all articles
		$this->data['articles'] = $this->article_m->get();

		//Load view
		$this->data['sub_view'] = 'admin/article/index';
		$this->load->view('admin/_layout_main', $this->data);

	}	

	public function edit($id = NULL)
	{	
		//Fetch a article or set a new article	
		if ($id) {
			$this->data['article'] = $this->article_m->get($id);
			count($this->data['article']) || $this->data['errors'][] = "The article cannot be found";
		}else{
			$this->data['article'] = $this->article_m->get_new();
		}	

		//Set validation rules for the form		
		$rules = $this->article_m->_rules;		
		$this->form_validation->set_rules($rules);

		//Run the validation 
		if ($this->form_validation->run() == TRUE) {
			//Get data from post			
			$data = $this->article_m->get_data_from_post(array('title','slug','body','pubdate'));			
			//Save the data and redirect
			$this->article_m->save($data, $id);
			redirect('admin/article');
		}
		//load the view
		$this->data['sub_view'] = 'admin/article/edit';
		$this->load->view('admin/_layout_main', $this->data);

	}

	public function delete($id)
	{
		
		$this->article_m->delete($id);
		redirect('admin/article/');
	}	

	

}

/* End of file articles.php */
/* Location: ./application/controllers/articles.php */