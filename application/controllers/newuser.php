<?php

//session_start();
class Newuser extends CI_Controller {
	function __construct() {
		// call the controller constructor
		parent::__construct();
	}

	
	function index() {
		$this->load->view('users/newUser.php');
	}

	function register() {
		$this->load->library('form_validation');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('users/newUser.php');
		} else {
			// insert user into database
			$this->load->model('customer_model');

			$customer = new Customer();
			$customer->first = $this->input->get_post('first');
			$customer->last = $this->input->get_post('last');
			$customer->login = $this->input->get_post('login');
			$customer->password = $this->input->get_post('password');
			$customer->email = $this->input->get_post('email');

			$customer_id = $this->customer_model->insert($customer);

			// set session: assumes that we are not logged in atm
			$_SESSION["loggedIn"] = "true";
			$_SESSION["username"] = "$customer->login";
			$_SESSION["customer_id"] = $customer_id;
			
			$this->load->view('users/regSuccess.php');
		}
	}
	

	// returns true if login doesn't exist yet
	public function unique_login($login) {
		$this->db->where('login', $login);
		$query = $this->db->get('customer');
		if ($query->num_rows() > 0) { // login already exists
			$this->form_validation->set_message('unique_login', 'Username already exists!');
			return false;
		}
		return true;
	}


        // returns true if email doesn't exist yet
        public function unique_email($email) {
                $this->db->where('email', $email);
                $query = $this->db->get('customer');
                if ($query->num_rows() > 0) { // email already exists
                        $this->form_validation->set_message('unique_email', 'Email is already in use.');
                        return false;
                }
                return true;
        }
}
