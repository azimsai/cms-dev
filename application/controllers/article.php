<?php
/**
* 
*/
class Article extends Frontend_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('article_m');
		
	}

	public function index()
	{			
		$articles = $this->article_m->get();
		var_dump($articles);
		
	}
	public function save()
	{
		$data = array(
			'title' => 'Test',
			'slug' => 'test',
			'order' => 5,
			'body' => 'Test article',
			);			
		$id= $this->article_m->save($data,5);
		var_dump($id);
		
	}
	public function delete()
	{
				
		if($this->article_m->delete(5))
			echo "Sucessfilly deleted";
		else
			echo "Please try again";
		
	}
}