<?php
/**
* 
*/
class Page extends Frontend_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('page_m');
		
	}

	public function index()
	{			
		$pages = $this->page_m->get();
		var_dump($pages);
		
	}
	public function save()
	{
		$data = array(
			'title' => 'Test',
			'slug' => 'test',
			'order' => 5,
			'body' => 'Test page',
			);			
		$id= $this->page_m->save($data,5);
		var_dump($id);
		
	}
	public function delete()
	{
				
		if($this->page_m->delete(5))
			echo "Sucessfilly deleted";
		else
			echo "Please try again";
		
	}
}