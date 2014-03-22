<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$g_month = 00;
$g_year = 00;

class Checkout extends CI_Controller {


function __construct() {
	parent::__construct();
}


function index() {
	$this->load->view('users/checkout.php'); 
}


function checkout1() {
	$this->load->library('form_validation');
	
	// set rules here
	$this->form_validation->set_rules('ccard', 'Credit Card', 'required|callback_ccard_check');
	$this->form_validation->set_rules('month', 'MM', 'required|callback_ccard_month');
	$this->form_validation->set_rules('year', 'YY', 'required|callback_ccard_year|callback_ccard_exp');
	// set rules here 
	
	if ($this->form_validation->run() == FALSE) {
		//echo "<script type='text/javascript'>alert('checkout1');</script>";
		redirect('checkout/index', 'refresh');
	} else {
		$ccard = $this->input->get_post('ccard');
		$month = $this->input->get_post('month');
		$year = $this->input->get_post('year');

		$this->load->model('order_model');
		$this->order_model->finalize($ccard, $month, $year);
		
		// get customer email
		$query = $this->db->get_where('customer', array('login'=>$_SESSION["username"]));
		$row = $query->row(0, 'customer');
		$email = $row->email;
		
		//email receipt to customer
		$this->load->library('email');
		$this->email->from('candystore@gmail.com', 'CandyStore');
		$this->email->to($email);
		$this->email->subject('Receipt of Your Candy Orders');
		
		//TODO: fix this!! 
		$receipt = file_get_html('user/receipt.php');
		$this->email->message($receipt->find('div[#toEmail]', 0));
		$this->email->send();

		$this->load->view('user/receipt.php');
	}
}

 
	// checks that the credit card has 16 digits
	public function ccard_check($ccard) {
			//echo "<script type='text/javascript'>alert('ccard_check');</script>";
		if (preg_match("/^\d{16}$/", $ccard) == 0) {
			$this->form_validation->set_message('ccard_check', 'Credit card must have 16 digits.');
			return false;
		}
		return true;
	}



	// check that month has valid input
	public function ccard_month($month) {
		if (preg_match("/^(0[1-9]|1[0-2])$/", $month) == 0) {
            $this->form_validation->set_message('ccard_month', 'Month format must be two digits.');
			return false;
		}
		global $g_month;
		$g_month = $month;
			return true;
	}


        // check that year has valid input
        public function ccard_year($year) {
                if (preg_match("/^[0-9]{2}$/", $year) == 0) {
                        $this->form_validation->set_message('ccard_year', 'Year format must be the last two digits of the year.');
                        return false;
                }
		global $g_year;
		$g_year = $year;
                return true;
        }

	
	// checks that the credit card has not expired
	public function ccard_exp($year) {
		global $g_month;
		global $g_year;

		// get current month and year
		$cmonth = date('m');
		$cyear = date('y');

		// false if provided year is smaller than current year, or
		// if provided month is smaller than current month AND
		// provided year is smaller or equal to current year
		if ( ($g_year < $cyear) || (($g_month < $cmonth) && ($g_year <= $cyear))) {
			$this->form_validation->set_message('ccard_exp', 'Credit card has expired!');
			return false;
		}
		return true;
	}
	
}

