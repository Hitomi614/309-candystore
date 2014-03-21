<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config = array(
	'newuser/register' => array(
                array(
                        'field' => 'first',
                        'label' => 'First Name',
                        'rules' => 'required|max_length[24]'
                ),
                array(
                        'field' => 'last',
                        'label' => 'Last Name',
                        'rules' => 'required|max_length[24]'
                ),
		array(
			'field' => 'login',
			'label' => 'Username',
			'rules' => 'required|min_length[5]|max_length[16]|is_unique[customer.login]'
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|min_length[6]'
		),
		/*array(
			'field' => 'passconf',
			'label' => 'Password Confirmation',
			'rules' => 'required|min_length[6]|matches[password]'
		),*/
                array(
                        'field' => 'email',
                        'label' => 'Email',
                        'rules' => 'required|valid_email|max_length[45]|is_unique[customer.email]'
                )
	),

        'candystore/loginuser' => array(
                array(
                        'field' => 'login',
                        'label' => 'Login',
                        'rules' => 'required|callback_valid_login'
                ),
                array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required|callback_valid_password'
                )
        ),
		'checkout/checkout1' => array(
                array(
                        'field' => 'ccardno',
                        'label' => 'Credit Card',
                        'rules' => 'required|callback_ccard_check'
                ),
		array(
                        'field' => 'month',
                        'label' => 'MM',
                        'rules' => 'required|callback_ccard_month'
                ),
		array(
                        'field' => 'year',
                        'label' => 'YY',
                        'rules' => 'required|callback_ccard_year|callback_ccard_exp'
                )
        )
);


