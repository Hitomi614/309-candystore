<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

$config = array (
	'auto/register' => array(
		array(
			'field' => 'username',
			'label' => 'Username',
			'rules' => 'required'
		),
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|min_length[6]'
		),
		array(
			'field' => 'passconf',
			'label' => 'Password Confirmation',
			'rules' => 'required|min_length[6]|matches[password]'
		),
		array(
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|callback_email_check'
		),
		array(
			'field' => 'ccard',
			'label' => 'Credit Card',
			'rules' => 'required|callback_ccard_check'
		),
		array(
			'field' => 'ccard_date',
			'label' => 'Credit Card date',
			'rules' => 'required|callback_ccard_date_check|callback_ccard_exp_check'
		),
		array(
			'field' => 'username',
			'label' => '',
			'rules' => 'required|'
		),
	)
);
