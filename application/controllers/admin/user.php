<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->library('session');	
	}

	public function index()
	{
		//Fetch all users
		$this->data['users'] = $this->user_m->get();

		//Load view
		$this->data['sub_view'] = 'admin/user/index';
		$this->load->view('admin/_layout_main', $this->data);

	}
	public function edit($id = NULL)
	{	
		//Fetch a user or set a new user	
		if ($id) {
			$this->data['user'] = $this->user_m->get($id);
			count($this->data['user']) || $this->data['errors'][] = "The user cannot be found";
		}else{
			$this->data['user'] = $this->user_m->get_new();
		}

		//Set validation rules for the form		
		$rules = $this->user_m->rules_admin;
		$id || $rules['password']['rules'] .= '|required';		
		$this->form_validation->set_rules($rules);

		//Run the validation 
		if ($this->form_validation->run() == TRUE) {
			//Get data from post			
			$data = $this->user_m->get_data_from_post(array('name','email','password'));
			//Check if the password field is empty and is it an edit.
			//If it is an edit and password is empty set it to previous password else it is create and set data from the post 
			if($id && $data['password'] == NULL){
				$data['password'] = $this->data['user']->password;
			}else
			$data['password'] = $this->user_m->hash($data['password']);
			//Save the data and redirect
			$this->user_m->save($data, $id);
			redirect('admin/user');
		}
		//load the view
		$this->data['sub_view'] = 'admin/user/edit';
		$this->load->view('admin/_layout_main', $this->data);

	}

	public function delete($id)
	{
		$this->user_m->delete($id);
		redirect('admin/user/');
	}

	public function login()
	{
		$dashboard = 'admin/dashboard';
		//Redirect the user if already logged in
		$this->user_m->loggedin() == FALSE || redirect($dashboard);

		//Set the validation rules and process the form
		$rules = $this->user_m->_rules;
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == TRUE) {
			
			if ($this->user_m->login() == TRUE){
				redirect($dashboard);
			}else{
				$this->session->set_flashdata('error', 'Username/Password is wrong.');
				redirect('admin/user/login','refresh');
			}		
			
		}
		//Load the view
		$this->data['sub_view'] = 'admin/user/login';
		$this->load->view('admin/_layout_modal', $this->data);
	}

	public function logout()
	{
		$this->user_m->logout();
		redirect('admin/user/login');
	}

	public function _unique_email($str)
	{
		//Do not validate if the email is already exist unless the email is of the current user
		$id = $this->uri->segment(4);
		$this->db->where('email',$this->input->post('email'));
		!$id || $this->db->where('id !=',$id);
		$user = $this->user_m->get();
		if (count($user)) {
			$this->form_validation->set_message('_unique_email','The %s already taken');
			return FALSE;
		}
		return TRUE;
	}

}

/* End of file users.php */
/* Location: ./application/controllers/users.php */