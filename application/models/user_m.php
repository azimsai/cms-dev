<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends MY_Model {

	protected $_table_name = 'users';	
	protected $_order_by = 'name';
	public $_rules = array(
		'email'    => array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|valid_email|xss_clean'),
		'password' => array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|required'),
	); 

	public $rules_admin = array(
		'name'    => array('field' => 'name', 'label' => 'Name', 'rules' => 'trim|required|xss_clean'),
		'email'    => array('field' => 'email', 'label' => 'Email', 'rules' => 'trim|required|callback__unique_email|valid_email|xss_clean'),
		'password' => array('field' => 'password', 'label' => 'Password', 'rules' => 'trim|matches[password_confirm]'),
		'password_confirm' => array('field' => 'password_confirm', 'label' => 'Confirm Password', 'rules' => 'trim|matches[password]'),
	); 

	public function __construct()
	{
		parent::__construct();		
	}

	public function login()
	{
		$user = $this->get_by(array(
			'email' => $this->input->post('email'),
			'password' =>$this->hash($this->input->post('password'))
			), TRUE);
		if (count($user)) {			
			$data = array(
				'email' => $user->email,
				'name' => $user->name,
				'id'=>$user->id,
				'loggedin' =>TRUE
				);
			$this->session->set_userdata($data);			
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
	}

	public function loggedin()
	{
		return (bool) $this->session->userdata('loggedin');
	}

	public function hash($password)
	{
		return hash('sha512',$password . config_item('encryption_key'));
	}

	public function get_new()
	{
		$user = new stdClass();
		$user->name = '';
		$user->email = '';
		$user->password = '';
		return $user;
	}

	public function delete($id)
	{
		$filter = $this->_primary_filter;
		$id = $filter($id);

		if( !$id || $id == $this->session->userdata('id'))
		{
			return false;
		}

		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
		return true;
	}

}

/* End of file user_m.php */
/* Location: ./application/models/user_m.php */