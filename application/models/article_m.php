<?php
/**
* 
*/
class Article_m extends MY_Model
{
	protected $_table_name = 'articles';	
	protected $_order_by = 'pubdate desc,id desc';
	protected $_times_stamp = TRUE;
	
	public function __construct()
	{
		parent::__construct();
	}


	public $_rules = array(
		'pubdate'    => array('field' => 'pubdate', 'label' => 'Publication date', 'rules' => 'trim|required|exact_length[10]|xss_clean'),
		'title'    => array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|max_lehgth[100]|xss_clean'),
		'slug' => array('field' => 'slug', 'label' => 'Slug', 'rules' => 'trim|required|url_title|xss_clean'),
		'body' => array('field' => 'body', 'label' => 'Body', 'rules' => 'trim|required'),
	);
	

	public function get_new()
	{
		$article = new stdClass();
		$article->pubdate = date('Y-m-d');
		$article->title = '';
		$article->slug = '';		
		$article->body = '';

		return $article;
	}
	
}