<?php
//include base_url().'application/models/customer.php';

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
			$this->load->model('customer');

			$customer = new Customer();
			$customer->first = $this->input->get_post('first');
			$customer->last = $this->input->get_post('last');
            $customer->login = $this->input->get_post('login');
            $customer->password = $this->input->get_post('password');
            $customer->email = $this->input->get_post('email');

			$this->customer->insert($customer);

<<<<<<< HEAD
			$this->load->view('candystore/index');
=======
			$this->load->view('users/regSuccess.php');
>>>>>>> 5c1250ddf9f1e4019ae26a2e9b5bfff607066245
		}
	}

	// must be of format XXX-XXX-XXXX
	public function phone_check($phone) {
		if (preg_match("/^\d{3}-\d{3}-\d{4}$/", $phone) == 0) {
			$this->form_validation->set_message('phone_check',
			'Invalid phone number. Must be of format XXX-XXX-XXXX.');
			return false;
		}
		return true;
	}
}
?>
