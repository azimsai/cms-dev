<?php
/**
* 
*/
class Page_m extends MY_Model
{
	protected $_table_name = 'pages';	
	protected $_order_by = 'parent_id, order';
	
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_nested()
	{
		$this->db->order_by($this->_order_by);
		$pages = $this->db->get('pages')->result_array();
		$array =array();
		foreach ($pages as $page) {
			if (!$page['parent_id']) {
				$array[$page['id']] = $page;				
			}else{			
				$array[$page['parent_id']]['children'][] = $page;
			}
		}
		return $array;
	}


	public $_rules = array(
		'parent'    => array('field' => 'parent_id', 'label' => 'Parent', 'rules' => 'trim|intval'),
		'title'    => array('field' => 'title', 'label' => 'Title', 'rules' => 'trim|required|max_lehgth[100]|xss_clean'),
		'slug' => array('field' => 'slug', 'label' => 'Slug', 'rules' => 'trim|required|url_title|xss_clean|callback__unique_slug'),
		'body' => array('field' => 'body', 'label' => 'Body', 'rules' => 'trim|required'),
	);

	public function delete($id){
		//Delete the page
		parent::delete($id);

		//Reset the parent id of its children
		$this->db->set(array('parent_id'=>0))->where('parent_id',$id)->update($this->_table_name);

	}

	public function save_order($pages)
	{
		if (count($pages)) {
			foreach ($pages as $order => $page) {
				if ($page['item_id'] != '') {
					$data = array('parent_id' => (int) $page['parent_id'], 'order' => $order);
					$this->db->set($data)->where($this->_primary_key, $page['item_id'])->update($this->_table_name);
				}
			}
		}
	}

	public function get_with_parents($id = NULL, $single = FALSE)
	{
		$this->db->select('pages.*, p.slug as parent_slug, p.title as parent_title');
		$this->db->join('pages as p ','pages.parent_id = p.id', 'left');
		return parent::get($id, $single);
	}

	public function get_new()
	{
		$page = new stdClass();
		$page->parent_id = 0;
		$page->title = '';
		$page->slug = '';		
		$page->body = '';

		return $page;
	}

	public function get_no_parents()
	{
		//fetch pages with no parents
		$this->db->select('id,title');
		$this->db->where('parent_id', 0);
		$pages = parent::get();
		//Return key value pair
		$array = array('0'=>'No parent');
		if (count($pages)) {
			//dump($pages);die();
			foreach ($pages as $page){
				$array[$page->id] = $page->title;
			}			
		}
		return $array;
	}
	
}