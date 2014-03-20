<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout extends CI_Controller {


	function __construct() {
		parent::_construct();
	}


	function index() {
		$this->load->view(); // TODO: fill view()
	}


	function checkout() {
	        $this->load->library('form_validation');
                if ($this->form_validation->run() == FALSE) {
                        $this->load->view(); // TODO: fill in view();
                } else {
                        $this->load->view(); // TODO: success page
                }
        }


	// TODO: INSERT ORDER INFO INTO DATABASE
        // checks that the credit card has 16 digits
        public function ccard_check($ccard) {
                if (preg_match("/^\d{16}$/", $ccard) == 0) {
                        $this->form_validation->set_message('ccard_check', 'Credit card must have 16 digits.');
                        return false;
                }
                return true;
        }


        // checks that the credit card has a valid date format MM/YY
        public function ccard_date_check($ccard_date) {
                if (preg_match("/^(0[1-9]|1[0-2])\/[0-9]{2}$/", $ccard_date) == 0) {
                        $this->form_validation->set_message('ccard_date_check', 'Date format must be MM/YY.');
                        return false;
                }
                return true;
        }


        // checks that the credit card has not expired
        public function ccard_exp_check($ccard_date) {
                // get user's month and year
                $month = intval(substr($ccard_date, 0, 2));
                $year  = intval(substr($ccard_date, 3, 2));

                // get current month and year
                $cmonth = date('m');
                $cyear  = date('y');

                // false if provided year is smaller than current year, or
                //           if provided month is smaller than current month AND
                //          provided year is smaller or equal to current year
                if ( ($year < $cyear) || (($month < $cmonth) && ($year <= $cyear))) {
                        $this->form_validation->set_message('ccard_exp_check', 'Credit card has expired!');
                        return false;
                }
                return true;
        }
}
