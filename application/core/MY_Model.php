<?php

/**
* 
*/
class MY_Model extends CI_model
{
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public    $_rules = array(); 
	protected $_times_stamp = FALSE; 
	
	public function __construct()
	{
		parent::__construct();
	}

	public function get_data_from_post($fields)
	{		
		$data =array();
		foreach ($fields as $field) {			
			$data[$field] = $this->input->post($field);			
		}
		return $data;
	}

	public function get($id = NULL, $single = FALSE)
	{
		if ($id != NULL) 
		{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row';
		}
		elseif ($single == TRUE) 
		{
			$method = 'row';
		}
		else
		{
			$method = 'result';
		}
		if (! count($this->db->ar_orderby)) {

			$this->db->order_by($this->_order_by);
		}
		
		 return $this->db->get($this->_table_name)->$method();
		 //echo $this->db->last_query();
	}

	public function get_by($where, $single = FALSE)
	{

		$this->db->where($where);
		return $this->get(NULL,$single);
	}

	public function save($data, $id = NULL )
	{
		//set timestamps
		if ($this->_times_stamp == TRUE) {
			$now =date('Y,m,d H:i:s');
			$id || $data['created'] = $now;
			$data['modified'] = $now;
		}
		//insert
		if ($id == NULL) 
		{
			!isset($data->this->_primary_key) || $data->this->_primary_key = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		//update
		else
		{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key, $id);
			$this->db->update($this->_table_name);
		}

		return $id;
		
	}

	public function delete($id)
	{
		$filter = $this->_primary_filter;
		$id = $filter($id);		

		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
		return true;
	}
	

}