<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Controller {


function __construct() {
        parent::_construct();
}


function index($product_id) {
        $this->load->view('product/login.php');
}


function login() {
	$this->load->library('form_validation');
	if ($this->form_validation->run() == FALSE) {
		redirect('login/index', 'refresh');
	} else {
		$_SESSION["loggedIn"] = "true";
		$_SESSION["username"] = $this->input->get_post("login");
		redirect('candystore/index', 'refresh');
	}
}


$g_login;

// checks that login exists in database
function valid_login($login) {
	global $g_login;
	$this->db->where('login', $login);
	$query = $this->db->get('customer');

	// login exists
	if ($query->num_rows() == 1) {
		$g_login = $login;
		return true;
	}
	$this->form_validation->set_message('valid_login', 'Login doesn\' exist!');
	return false;
	
}


// checks that password matches login
function valid_password($password) {
	$this->db->select('password');
	$this->db->where('login', $g_login);
	$query = $this->db->get('customer');
	$row = $query ->row(0, 'customer');
	$c_password = $row->password;

	if ($c_password == $password) {
		return true;
	}
	$this->form_validation->set_message('valid_password', 'Invalid login-password combination');
	return false;
}
