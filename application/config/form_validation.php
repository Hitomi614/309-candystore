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
			'rules' => 'required|min_length[5]|max_length[16]'
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
                        'rules' => 'required|valid_email|max_length[45]'
                )
	),
	'checkout/checkout' => array(
                array(
                        'field' => 'ccard',
                        'label' => 'Credit Card',
                        'rules' => 'required|callback_ccard_check'
                ),
                array(
                        'field' => 'ccard_date',
                        'label' => 'Credit Card date',
                        'rules' => 'required|callback_ccard_date_check|callback_ccard_exp_check'
                )
        )
);


